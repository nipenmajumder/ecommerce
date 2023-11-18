<?php

namespace App\Actions;

use App\Models\FragmentPurchase;
use App\Models\FragmentPurchaseDetails;
use App\Models\FragmentStock;
use App\Models\Purchase;
use App\Models\PurchaseDetails;
use App\Models\Stock;

class PurchaseStoreAction
{
    public function handle($request, Purchase $purchase): Purchase
    {
        $fragmentPurchase = new FragmentPurchase();
        $fragmentPurchaseDetails = new FragmentPurchaseDetails();
        $data = [
            'date' => date('Y-m-d', strtotime($request->date)),
            'invoice' => $request->invoice,
            'subtotal' => $request->totalPurchase,
            'total' => $request->totalPurchase,
            'total_quantity' => $request->total_quantity,
            'status' => Purchase::STATUS['approved'],
        ];
        $purchase->fill($data)->save();
        $fragmentPurchase->fill($data)->save();

        foreach ($request->purchase_products as $key => $value) {
            $purchaseDetail = new PurchaseDetails();
            $details = [
                'date' => date('Y-m-d', strtotime($request->date)),
                'invoice' => $request->invoice,
                'user_id' => auth()->id(),
                'purchase_id' => $purchase->id,
                'product_id' => $value['product_id'],
                'purchase_price' => $value['product_buy_price'],
                'sell_price' => $value['product_sell_price'],
                'quantity' => $value['quantity'],
                'total' => $value['total_price'],
            ];
            $purchaseDetail->fill($details)->save();
            $fragmentPurchaseDetails->fill($details)->save();
            $stock_data = [];
            for ($i = 1; $i <= $value['quantity']; $i++) {
                $stock_data[] = [
                    'date' => date('Y-m-d', strtotime($request->date)),
                    'user_id' => auth()->id(),
                    'purchase_id' => $purchase->id,
                    'product_id' => $value['product_id'],
                    'product_sku' => $value['variation_sku'],
                    'product_barcode' => $value['product_barcode'],
                    'purchase_price' => $value['product_buy_price'],
                    'sell_price' => $value['product_sell_price'],
                    'stock_status' => Stock::STATUS['Stock'],
                    'created_by' => auth()->id(),
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ];
            }
            if ($value['category_id'] == 1) {
                Stock::insert($stock_data);
            } else {
                FragmentStock::insert($stock_data);
            }
        }

        return $purchase;
    }
}
