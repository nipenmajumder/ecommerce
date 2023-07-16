<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return $this->respondSuccess(session()->get('cart'), 'Cart items');
    }

    /**
     * Show the form for creating a new resource.
     * @throws \Exception
     */
    public function create(Request $request)
    {

    }

    /**
     * Store a newly created resource in storage.
     * @throws \Exception
     */
    public function store(Request $request)
    {
        try {
            $cart = session()->get('cart');
            $product = $request->product;
            $vatPercentage = cache()->get('settings.toArray')['vat_percentage'] ?? 7.5;
            if (isset($cart['items'][$product['id']])) {
                $cart['items'][$product['id']]['quantity'] += 1;
                $vat = ceil($product['sell_price'] * $vatPercentage / 100);
            } else {
                $vat = ceil($product['sell_price'] * $vatPercentage / 100);
                $cart['items'][$product['id']] = [
                    ...$product,
                    'quantity' => 1,
                ];
                $cart['count'] += 1;
            }
            $cart['total'] += $product['sell_price'];
            $cart['vat'] += $vat;
            $cart['discount'] += $product['discount'] ?? 0.00;
            $cart['sub_total'] += $product['sell_price'] + $vat;
            $cart['grand_total'] = $cart['sub_total'] - ($cart['discount'] ?? 0.00);

            session()->put('cart', $cart);
            return $this->respondSuccess($cart, $product['name'] . ' added to cart successfully.');
        } catch (\Exception $e) {
            return $this->respondError($e->getMessage());
        }

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $cart = session()->get('cart');

            if (isset($cart['items'][$id])) {
                $product = $cart['items'][$id];
                $vatPercentage = cache()->get('settings.toArray')['vat_percentage'] ?? 7.5;
                $vat = ceil($product['sell_price'] * $vatPercentage / 100);

                $cart['total'] -= $product['sell_price'];
                $cart['vat'] -= $vat;
                $cart['discount'] -= $product['discount'] ?? 0.00;
                $cart['sub_total'] -= $product['sell_price'] + $vat;
                $cart['grand_total'] = $cart['sub_total'] - ($cart['discount'] ?? 0.00);

                unset($cart['items'][$id]);
                $cart['count'] -= 1;

                session()->put('cart', $cart);
                return $this->respondSuccess($cart, $product['name'] . ' removed from cart successfully.');
            } else {
                return $this->respondError('Item not found in cart.');
            }
        } catch (\Exception $e) {
            return $this->respondError($e->getMessage());
        }
    }

}
