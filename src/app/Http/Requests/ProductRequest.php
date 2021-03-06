<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

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
    public function rules()
    {
        return [
            'Description' => 'bail|required|unique:products',
            'Quantity' => 'bail|required',
            'ProductTypeId' => 'bail|required|exists:product_types,id',
            'Price' => 'bail|required',
        ];
    }

    public function messages()
    {
        return [
            'Description.required' => 'A Description is required',
            'Quantity.required'  => 'Quantity is required',
            'ProductTypeId.required'  => 'Select one Product Type, it is required',
            'ProductTypeId.exists'  => 'Produuct type does not exists.',
            'Price.required'  => 'Quantity is required',
        ];
    }

    public function failedValidation(Validator $validator)
    {
        $error_bag = [
            "errors" => $validator->getMessageBag()->all()
        ];
        throw new HttpResponseException(response()->json($error_bag, 422));
    }
}
