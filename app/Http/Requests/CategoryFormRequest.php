<?php

namespace App\Http\Requests;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;

class CategoryFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            //validations
        'uuid'=> ['required'],
        'name'=> ['required'],
        'slug'=> ['required'],
        'description'=> ['required'],
        'status'=> ['required'],
        'popular'=> ['required'],
        'image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:3048'],
        'meta_title'=> ['required'],
        'meta_description'=> ['required'],
        'meta_keyword'=> ['required'],
        ];
    }

        protected function prepareForValidation(): void
        {
            $this->merge([
                'slug' => Str::slug($this->name),
                'uuid' => Str::uuid(),
                'popular' =>$this->popular == true ? 1:0,
                'status'=> $this->status == true ? 1:0
        ]);
        }
}