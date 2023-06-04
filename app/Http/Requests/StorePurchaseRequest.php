<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePurchaseRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'date' => ['required', 'date'],
            'invoice' => ['required', 'string', 'max:255', 'unique:purchases,invoice'],
            'total_quantity' => ['required', 'numeric'],
            'subtotal' => ['required', 'numeric'],
            'total' => ['required', 'numeric'],
            'note' => ['nullable', 'string', 'max:255'],
            'purchase_products' => 'required|array',
        ];
    }

    public function messages()
    {
        return [
            'date.required' => 'Date is required',
            'invoice.required' => 'Invoice is required',
            'total_quantity.required' => 'Total quantity is required',
            'subtotal.required' => 'Subtotal is required',
            'total.required' => 'Total is required',
            'purchase_products.required' => 'Please add product for purchase',
        ];
    }
}
