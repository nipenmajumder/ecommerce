<?php

namespace App\Http\Controllers\Backend\Api;

use App\Http\Controllers\Controller;
use App\Services\ProductService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class BarcodeWiseProduct extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $product_sku = $request->get('barcode');
        $product = ProductService::barCodeWiseProduct($product_sku);
        if (!isset($product)) {
            $validator = Validator::make([], []);
            $validator->errors()->add('barcode', 'Product not found');
            throw new ValidationException($validator);
        }
        return $this->respondSuccess($product, 'Barcode product fetch successfully');
    }
}
