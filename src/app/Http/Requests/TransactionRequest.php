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
            'ClientId' => 'bail|required_if:ActionType,Return To Return to Warehouse,Goods Issue',
            'SupplierId' => 'bail|required_if:ActionType,Goods Receipt,Return to Supplier',
            'ActionType' => 'bail|required',
            'RefDocNumber' => 'bail|required|unique:transactions,ref_doc_number',
            'DocDate' => 'bail|required',
            'EntryDate' => 'bail|required',
            'Remarks' => 'bail|sometimes',
        ];
    }
    public function messages()
    {
        return [
            'Products.required' => 'Cannot proceed if no product is selected.',
            'ClientId.required_if' => 'A Client is required when Action Type is set to Return To Return to Warehouse or Goods Issue',
            'SupplierId.required_if' => 'A Supplier is required when Action Type is set to Goods Receipt or Return to Supplier',
            'ActionType.required'  => 'Action Type is required',
            'RefDocNumber.required'  => 'Reference Document Number is required.',
            'DocDate.required'  => 'Document Date is required.',
            'EntryDate.required'  => 'Entry Date is required.',
            'RefDocNumber.unique'  => 'Reference Document Number already exists.',
            'Remarks.required'  => 'Remarks is required'
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
