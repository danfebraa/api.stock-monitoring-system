<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SupplierResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'Id' => $this->id,
            'SupplierCode' => $this->supplier_code,
            'Name' => $this->name,
            'Address' => $this->address,
            'Email' => $this->email,
            'ContactNo' => $this->contact_no,
            'ContactPerson' => $this->contact_person,
            'Transactions' => new TransactionCollection($this->whenLoaded('transactions'))
        ];
    }
}
