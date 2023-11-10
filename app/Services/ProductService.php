<?php

namespace App\Services;

use App\Models\Product;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class ProductService
{
    public static function barCodeWiseProduct($barcode): array
    {
        $product = Product::query()->where('barcode', $barcode)->first();
        if (! isset($product)) {
            $validator = Validator::make([], []);
            $validator->errors()->add('barcode', 'Product not found');
            throw new ValidationException($validator);
        }

        return [self::productVariantBarcode($product)];
    }

    private static function productVariantBarcode($product): array
    {
        return [
            'product_id' => $product->id,
            'product_name' => $product->name,
            'product_buy_price' => $product->buy_price,
            'product_sell_price' => $product->sell_price,
            'product_barcode' => $product->barcode,
            'variation_sku' => $product->sku,
            'total_price' => $product->buy_price,
            'quantity' => 1,
        ];
    }
}
