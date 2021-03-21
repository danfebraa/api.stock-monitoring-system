<?php

namespace App\Http\Requests\Web;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'description' => 'bail|required|unique:products',
            'quantity' => 'bail|required',
            'product_type_id' => 'bail|required|exists:product_types,id',
            'price' => 'bail|required',
        ];
    }

    public function messages()
    {
        return [
            'description.required' => 'A Description is required.',
            'quantity.required'  => 'Quantity is required.',
            'product_type_id.required'  => 'Select one Product Type, it is required.',
            'product_type_id.exists'  => 'Product type does not exists.',
            'price.required'  => 'Quantity is required.',
        ];
    }
}
