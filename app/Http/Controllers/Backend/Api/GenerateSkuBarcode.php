<?php

namespace App\Http\Controllers\Backend\Api;

use App\Http\Controllers\Controller;
use App\Models\FragmentProduct;
use App\Models\Product;
use Illuminate\Http\Request;

class GenerateSkuBarcode extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        try {
            $data['sku'] = $this->generateSku();
            $data['barcode'] = $this->generateBarcode();

            return $this->respondSuccess($data, 'SKU and Barcode generated successfully');
        } catch (\Throwable $exception) {
            return $this->respondError($exception->getMessage(), $exception->getCode());
        }
    }

    private function generateBarcode(): string
    {
        $latestBarcode = Product::query()->max('barcode');
        $fragmentLatestBarcode = FragmentProduct::query()->max('barcode');
        $maxBarcode = max($latestBarcode,$fragmentLatestBarcode);
        $nextBarcode = ($maxBarcode !== null) ? ($maxBarcode + 1) : 1;

        return str_pad((string) $nextBarcode, 8, '0', STR_PAD_LEFT);
    }

    private function generateSku()
    {
        $productCount = Product::query()->count();
        $fragmentProductCount = FragmentProduct::query()->count();
        $productCode = $productCount + $fragmentProductCount;
        $productCode = (int) $productCode + 1;

        return 'BOOK'.'-'.str_pad($productCode, 7, '0', STR_PAD_LEFT);
    }
}
