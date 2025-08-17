<?php

namespace App\Http\Requests;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;

class SingleProductFormRequest extends FormRequest
{
    public function authorize(): bool
    {
        return Auth::check();
    }

    public function rules(): array
    {
        return [
            'uuid' => ['required', 'uuid'],
            'name' => ['required', 'string', 'max:255'],
            'slug' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'price' => ['required', 'numeric', 'min:0'],
            'stock' => ['required', 'integer', 'min:0'],
            'image' => ['nullable', 'image', 'mimes:jpeg,jpg,png,gif,pjpeg', 'max:3048'],
            'is_active' => ['required', 'in:0,1'],
            'category_id' => ['required', 'exists:categories,id']
        ];
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'slug' => $this->name ? Str::slug($this->name) : null,
            'uuid' => (string) Str::uuid(),
            'is_active' => $this->is_active == true ? 1 : 0,
        ]);
    }

    protected function failedValidation(\Illuminate\Contracts\Validation\Validator $validator)
    {
        \Log::info('Validation errors:', $validator->errors()->toArray());
        parent::failedValidation($validator);
    }
}