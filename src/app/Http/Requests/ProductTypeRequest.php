<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class ProductTypeRequest extends FormRequest
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
            'Name' => 'bail|required|unique:product_types',

        ];
    }

    public function messages()
    {
        return [
            'Name.required' => 'A Name is required',
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
