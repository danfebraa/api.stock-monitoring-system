<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class TransactionRequest extends FormRequest
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
            'Products' => 'bail|required',
            'ClientId' => 'bail|required_if:ActionType,==,Delivery',
            'ActionType' => 'bail|required',
            'PurchaseOrder' => 'bail|required',
            'Remarks' => 'bail|sometimes',
        ];
    }
    public function messages()
    {
        return [
            'Products.required' => 'Cannot proceed if no product is selected.',
            'ClientId.required_if' => 'A Client is required when Action Type is set to Delivery',
            'ActionType.required'  => 'Action Type is required',
            'PurchaseOrder.required'  => 'PurchaseOrder is required',
            'Remarks.required'  => 'Remarks is required',
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
