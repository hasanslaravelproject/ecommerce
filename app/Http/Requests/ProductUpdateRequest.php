<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => ['required', 'max:255', 'string'],
            'slug' => ['nullable', 'max:255', 'string'],
            'status' => ['nullable', 'in:inactive,active'],
            'image' => ['nullable', 'image', 'max:1024'],
            'shop_id' => ['required', 'exists:shops,id'],
            'category_id' => ['required', 'exists:categories,id'],
            'brand_id' => ['required', 'exists:brands,id'],
        ];
    }
}
