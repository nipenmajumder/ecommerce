<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Darryldecode\Cart\Cart;
use Illuminate\Http\Request;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     * @throws \Exception
     */
    public function create(Request $request)
    {
        $product = Product::find($request->product_id);
        \Cart::session(auth()->id())->add(array(
            'id' => 1,
            'name' => $product->name,
            'price' => $product->sell_price,
            'quantity' => 4,
            'attributes' => array(),
            'associatedModel' => $product
        ));
        $items = \Cart::getContent();
        dd($items->toArray());
    }

    /**
     * Store a newly created resource in storage.
     * @throws \Exception
     */
    public function store(Request $request, Product $product)
    {

        return redirect()->back()->with('message', 'Item added to cart successfully');
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
