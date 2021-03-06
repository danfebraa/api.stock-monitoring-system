<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Factory as ValidationFactory;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Routing\Redirector;

class ActionReportRequest extends FormRequest
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
    /*protected $rules = [
        'ProductId' => 'bail|required',
        'ClientId' => 'bail|sometimes',
        'ActionType' => 'bail|required',
        'UOM' => 'bail|required',
        'Quantity' => 'bail|required',
        'PurchaseOrder' => 'bail|required',
        'Remarks' => 'bail|required',
    ];

    protected $messages = [
        'ProductId.required' => 'A Product is required',
        'ClientId.required'  => 'A Client is required',
        'ActionType.required'  => 'Select one Action Type, it is required',
        'UOM.required'  => 'Select one unit of measure, it is required',
        'Quantity.required'  => 'Quantity is required',
        'PurchaseOrder.required'  => 'PurchaseOrder is required',
        'Remarks.required'  => 'Remarks is required',
        ];*/
    public function rules()
    {
        return [
            'ProductId' => 'bail|required',
            'ClientId' => 'bail|sometimes',
            'ActionType' => 'bail|required',
            'UOM' => 'bail|required',
            'Quantity' => 'bail|required',
            'PurchaseOrder' => 'bail|required',
            'Remarks' => 'bail|required',
        ];
    }

    public function messages()
    {
        return [
            'ProductId.required' => 'A Product is required',
            'ClientId.required'  => 'A Client is required',
            'ActionType.required'  => 'Select one Action Type, it is required',
            'UOM.required'  => 'Select one unit of measure, it is required',
            'Quantity.required'  => 'Quantity is required',
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
