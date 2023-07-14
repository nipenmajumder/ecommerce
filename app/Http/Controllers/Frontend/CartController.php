<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return session()->get('cart');

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
//        try {
//            $cart = session()->get('cart');
//            $productId = $request->product['id'];
//            $vat = $request->product['sell_price'] * cache()->get('settings.toArray')['vat_percentage'] / 100;
//
//            if (isset($cart['items'][$productId])) {
//                // If the product already exists in the cart, increase the quantity by one
//                $cart['items'][$productId]['quantity'] += 1;
//                $cart['total'] += $request->product['sell_price'];
//                $cart['vat'] += $vat;
//                $cart['discount'] += $request->product['discount'] ?? 0.00;
//                $cart['sub_total'] += $request->product['sell_price'] + $vat;
//                $cart['grand_total'] += $cart['sub_total'] - ($request->product['discount'] ?? 0.00);
//            } else {
//                // If the product does not exist in the cart, add it as a new item
//                $cart['items'][$productId] = [
//                    ...$request->product,
//                    'quantity' => 1,
//                ];
//                $cart['count'] += 1;
//                // Update other cart values (total, vat, discount, sub_total, grand_total) accordingly
//                $cart['total'] += $request->product['sell_price'];
//                $cart['vat'] += $vat;
//                $cart['discount'] += $request->product['discount'] ?? 0.00;
//                $cart['sub_total'] += $request->product['sell_price'] + $vat;
//                $cart['grand_total'] += $cart['sub_total'] - ($request->product['discount'] ?? 0.00);
//            }
//
//            session()->put('cart', $cart);
//            $this->respondSuccess($cart, $request->product['name'] . ' added to cart successfully.');
//        } catch (\Exception $e) {
//            $this->respondError($e->getMessage());
//        }
        try {
            $cart = session()->get('cart');
            $productId = $request->product['id'];

//            if (isset($cart['items'][$productId])) {
//                // If the product already exists in the cart, increase the quantity by one
//                $cart['items'][$productId]['quantity'] += 1;
//
//                // Update other cart values based on the increased quantity
//                $vat = $request->product['sell_price'] * cache()->get('settings.toArray')['vat_percentage'] / 100;
//                $cart['total'] += $request->product['sell_price'];
//                $cart['vat'] += $vat;
//                $cart['discount'] += $request->product['discount'] ?? 0.00;
//                $cart['sub_total'] += $request->product['sell_price'] + $vat;
//                $cart['grand_total'] += $cart['sub_total'] - ($request->product['discount'] ?? 0.00);
//            } else {
//                // If the product does not exist in the cart, add it as a new item
//                $vat = $request->product['sell_price'] * cache()->get('settings.toArray')['vat_percentage'] / 100;
//                $cart['items'][$productId] = [
//                    ...$request->product,
//                    'quantity' => 1,
//                ];
//                $cart['count'] += 1;
//                // Update other cart values (total, vat, discount, sub_total, grand_total) accordingly
//                $cart['total'] += $request->product['sell_price'];
//                $cart['vat'] += $vat;
//                $cart['discount'] += $request->product['discount'] ?? 110.00;
//                $cart['sub_total'] += $request->product['sell_price'] + $vat;
//                $cart['grand_total'] += $cart['sub_total'] - ($request->product['discount'] ?? 110.00);
//            }
            if (isset($cart['items'][$productId])) {
                // If the product already exists in the cart, increase the quantity by one
                $cart['items'][$productId]['quantity'] += 1;

                // Update other cart values based on the increased quantity
                $vat = $request->product['sell_price'] * cache()->get('settings.toArray')['vat_percentage'] / 100;
                $cart['total'] += $request->product['sell_price'];
                $cart['vat'] += $vat;
                $cart['discount'] += $request->product['discount'] ?? 0.00;
                $cart['sub_total'] += $request->product['sell_price'] + $vat;
            } else {
                // If the product does not exist in the cart, add it as a new item
                $vat = $request->product['sell_price'] * cache()->get('settings.toArray')['vat_percentage'] / 100;
                $cart['items'][$productId] = [
                    ...$request->product,
                    'quantity' => 1,
                ];
                $cart['count'] += 1;
                // Update other cart values (total, vat, discount, sub_total) accordingly
                $cart['total'] += $request->product['sell_price'];
                $cart['vat'] += $vat;
                $cart['discount'] += $request->product['discount'] ?? 0.00;
                $cart['sub_total'] += $request->product['sell_price'] + $vat;
            }

            $cart['grand_total'] = $cart['sub_total'] - ($cart['discount'] ?? 0.00);


            session()->put('cart', $cart);
            return $this->respondSuccess($cart, $request->product['name'] . ' added to cart successfully.');
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
        //
    }
}
