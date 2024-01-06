<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryFormRequest extends FormRequest
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
            'category.name' => [
                'required',
                'string',
            ],
            'category.slug' => [
                'required',
                'string',
            ],
            'category.description' => [
                'required',
                'string',
            ],
            'category.image_id' => [
                'nullable',
                'numeric',
            ],
            'category.meta_title' => [
                'required',
                'string',
            ],
            'category.meta_keyword' => [
                'required',
                'string',
            ],
            'category.meta_description' => [
                'required',
                'string',
            ],
            'category.is_active' => [
                'required',
                'in:1,0,true,false,on,off',
            ],

        ];
    }
}
