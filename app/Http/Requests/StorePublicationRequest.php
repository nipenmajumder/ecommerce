<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePublicationRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:publications',
            'email' => 'required|email|max:255|unique:publications',
            'phone' => 'required|string|max:255|unique:publications',
            'address' => 'required|string|max:255',
            'description' => 'required|string|max:255',
//            'image' => 'required|image|max:1024',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Name is required!',
            'slug.required' => 'Slug is required!',
            'slug.unique' => 'Slug must be unique!',
            'email.required' => 'Email is required!',
            'email.unique' => 'Email must be unique!',
            'phone.required' => 'Phone is required!',
            'address.required' => 'Address is required!',
            'description.required' => 'Description is required!',
            'image.required' => 'Image is required!',
        ];
    }
}
