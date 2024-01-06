<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductFormRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'product.name' => 'required|string',
            'product.slug' => 'required|string',
            'product.short_description' => 'required|string',
            'product.long_description' => 'required|string',
            'product.price' => 'required|numeric',
            'product.sku' => 'required|string',
            'product.thumbnail' => 'nullable',
            'product.brand_id' => 'required|numeric',
        ];
    }
}
