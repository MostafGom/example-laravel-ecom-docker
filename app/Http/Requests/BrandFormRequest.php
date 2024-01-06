<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BrandFormRequest extends FormRequest
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

    public function rules()
    {
        return [
            'brand.name' => 'required|string',
            'brand.slug' => 'required|string',
            'brand.is_active' => 'required|in:1,0,true,false,on,off',
            'brand.image_id' => 'nullable',
        ];
    }
}
