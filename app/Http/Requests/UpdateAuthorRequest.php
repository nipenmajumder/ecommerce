<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateAuthorRequest extends FormRequest
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
            'slug' => ['sometimes', 'required', 'string', 'max:255',
                Rule::unique('authors')->ignore($this->route('author')),
                'lowercase',
            ],
            'avatar' => 'nullable|image|max:1024',
            'email' => ['sometimes', 'required', 'email', 'max:255',
                Rule::unique('authors')->ignore($this->route('author')),
            ],
            'birthday' => 'required|date|date_format:Y-m-d',
            'death_day' => 'nullable|date_format:Y-m-d|after_or_equal:date_of_birth',
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
            'birthday.required' => 'Birthday is required!',
            'birthday.date_format' => 'Birthday must be date format!',
            'death_day.date_format' => 'Death day must be date format!',
            'death_day.after_or_equal' => 'Death day must be after or equal birthday!',
            'avatar.required' => 'Avatar is required!',
            'avatar.image' => 'Avatar must be image!',
            'avatar.max' => 'Avatar must be less than 1MB!',
        ];
    }
}
