<?php

namespace App\Http\Controllers\Backend;

use App\Actions\PurchaseStoreAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\StorePurchaseRequest;
use App\Http\Requests\UpdatePurchaseRequest;
use App\Model\User;
use App\Models\Purchase;
use Illuminate\Support\Facades\DB;

class PurchaseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $purchase = Purchase::query()->paginate(10);
        return view('backend.purchase.index', compact('purchase'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $purchaseCount = Purchase::query()->whereDate('date', date('Y-m-d'))->count();
        $purchaseCount = $purchaseCount ?? 0;
        $invoice = 'P' . '-' . auth()->user()->id . '-' . date('dmy') .
            (str_pad($purchaseCount + 1, 3, '0', STR_PAD_LEFT));
        $user = auth()->user();
        $date = date('Y-m-d');
        return view('backend.purchase.create', compact('invoice', 'user', 'date'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePurchaseRequest $request,PurchaseStoreAction $action, Purchase $purchase)
    {
        try {
            DB::beginTransaction();
            $saved = $action->handle($request, $purchase);
            DB::commit();
            return $this->respondCreated($saved, 'Product purchased successfully');
        } catch (\Throwable $e) {
            DB::rollBack();
            return $this->respondError($e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Purchase $purchase)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Purchase $purchase)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePurchaseRequest $request, Purchase $purchase)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Purchase $purchase)
    {
        //
    }
}
