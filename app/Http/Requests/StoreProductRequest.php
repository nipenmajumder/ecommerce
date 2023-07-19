<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:products|lowercase:products',
            'sku' => 'required|string|max:255|unique:products',
            'barcode' => 'required|string|max:255|unique:products',
            'category_id' => 'required|integer',
            'author_id' => 'required|integer|exists:authors,id',
            'publication_id' => 'nullable|integer|exists:publications,id',
            'buy_price' => 'required|numeric|gt:0',
            'sell_price' => 'required|numeric|gt:0|gte:buy_price',
            'image' => 'nullable|image|max:1024|mimes:jpg,jpeg,png',
            'description' => 'nullable|string',
            'status' => 'required|integer|in:0,1',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Product name is required',
            'name.string' => 'Product name must be string',
            'name.max' => 'Product name must be maximum 255 characters',
            'slug.required' => 'Product slug is required',
            'slug.string' => 'Product slug must be string',
            'slug.max' => 'Product slug must be maximum 255 characters',
            'slug.unique' => 'Product slug has already been taken',
            'slug.lowercase' => 'Product slug must be lowercase',
            'sku.required' => 'Product sku is required',
            'sku.string' => 'Product sku must be string',
            'sku.max' => 'Product sku must be maximum 255 characters',
            'sku.unique' => 'Product sku has already been taken',
            'barcode.required' => 'Product barcode is required',
            'barcode.string' => 'Product barcode must be string',
            'barcode.max' => 'Product barcode must be maximum 255 characters',
            'barcode.unique' => 'Product barcode has already been taken',
            'author_id.required' => 'Product author is required',
            'author_id.integer' => 'Product author must be integer',
            'author_id.exists' => 'Product author is not exists',
            'publication_id.integer' => 'Product publication must be integer',
            'publication_id.exists' => 'Product publication is not exists',
            'buy_price.required' => 'Product buy price is required',
            'buy_price.numeric' => 'Product buy price must be numeric',
            'buy_price.gt' => 'Product buy price must be greater than 0',
            'sell_price.required' => 'Product sell price is required',
            'sell_price.numeric' => 'Product sell price must be numeric',
            'sell_price.gt' => 'Product sell price must be greater than 0',
            'sell_price.gte' => 'Product sell price must be greater than or equal to buy price',
            'image.image' => 'Product image must be image',
            'image.max' => 'Product image must be maximum 1024 kilobytes',
            'image.mimes' => 'Product image must be jpg, jpeg, or png',
            'description.string' => 'Product description must be string',
            'status.required' => 'Product status is required',
            'status.integer' => 'Product status must be integer',
            'status.in' => 'Product status must be 0 or 1',
        ];
    }
}
