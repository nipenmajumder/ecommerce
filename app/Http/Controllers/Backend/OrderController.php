<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreOrderRequest;
use App\Http\Requests\UpdateOrderRequest;
use App\Models\Order;
use App\Models\Stock;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $orders = Order::latest()->with(['customer'])->paginate(10);

        return view('backend.order.index', compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.order.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreOrderRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {
        if ($order->status == Order::STATUS['pending']) {
            $order->status = Order::STATUS['processing'];
        } elseif ($order->status = Order::STATUS['processing']) {

            $order->load(['orderDetails']);

            foreach ($order->orderDetails as $orderDetail) {
                Stock::query()
                    ->where('product_id', $orderDetail->product_id)
                    ->orderBy('purchase_id', 'asc')
                    ->limit((int) $orderDetail->quantity)
                    ->update([
                        'stock_status' => 2,
                    ]);
            }

            $order->status = Order::STATUS['completed'];
        }
        $order->save();

        return redirect()->back()->with('success', 'Order status changed successfully!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Order $order)
    {
        $order->loadCount('orderDetails')->load(['customer', 'orderDetails.product', 'seller']);

        return view('backend.order.edit', compact('order'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateOrderRequest $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        //
    }
}
