<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\CheckoutRequest;
use App\Models\Order;
use App\Models\OrderDetails;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CheckoutController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('frontend.common.checkout');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CheckoutRequest $request)
    {
        try {
            DB::beginTransaction();
            User::where('id', auth()->id())->update([
                'name' => $request->name,
                'phone' => $request->phone,
                'address' => $request->address,
            ]);
            $order = new Order();
            $order->date = date('Y-m-d');
            $order->invoice = Order::generateInvoiceCode();
            $order->user_id = auth()->id();
            $order->total_quantity = session()->get('cart')['count'];
            $order->total_vat = session()->get('cart')['vat'];
            $order->subtotal = session()->get('cart')['sub_total'];
            $order->total = session()->get('cart')['grand_total'];
            $order->note = $request->note;
            $order->status = 1;
            $order->save();
            $cartItems = session()->get('cart')['items'];
            $items = [];
            foreach ($cartItems as $item) {
                $items[] = [
                    'user_id' => auth()->id(),
                    'order_id' => $order->id,
                    'product_id' => $item['id'],
                    'purchase_price' => $item['buy_price'],
                    'sell_price' => $item['sell_price'],
                    'quantity' => $item['quantity'],
                    'total' => $item['sell_price'] * $item['quantity'],
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                    'created_by' => auth()->id(),
                ];
            }
            OrderDetails::insert($items);
            $cart = [
                'items' => [],
                'total' => 0.00,
                'vat' => 0.00,
                'discount' => 0.00,
                'sub_total' => 0.00,
                'grand_total' => 0.00,
                'count' => 0,
            ];
            session(['cart' => $cart]);
            DB::commit();

            return redirect()->route('home')->with('success', 'Order has been placed successfully');
        } catch (\Exception $e) {
            DB::rollBack();

            return redirect()->back()->with('error', $e->getMessage());
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
