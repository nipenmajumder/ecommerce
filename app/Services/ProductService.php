<?php

namespace App\Services;

use App\Models\FragmentProduct;
use App\Models\Product;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class ProductService
{
    public static function barCodeWiseProduct($barcode): array
    {
        $product = Product::query()->where('barcode', $barcode)->first();
        $fragmentProduct = FragmentProduct::query()->where('barcode', $barcode)->first();
        if (!isset($product) && !isset($fragmentProduct)) {
            $validator = Validator::make([], []);
            $validator->errors()->add('barcode', 'Product not found');
            throw new ValidationException($validator);
        }

        $formatProduct = $product ?: $fragmentProduct;

        return [self::productVariantBarcode($formatProduct)];
    }

    private static function productVariantBarcode($product): array
    {
        return [
            'product_id' => $product->id,
            'product_name' => $product->name,
            'category_id' => $product->category_id,
            'product_buy_price' => $product->buy_price,
            'product_sell_price' => $product->sell_price,
            'product_barcode' => $product->barcode,
            'variation_sku' => $product->sku,
            'total_price' => $product->buy_price,
            'quantity' => 1,
        ];
    }
}
