<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Carbon;

class TransactionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        // BelongsTo
        $client = $this->whenLoaded('client');
        $products = $this->whenLoaded('products');
        return [
            'Id' => $this->id,
            'ClientId' => $this->client_id,
            'ActionType' => $this->action_type,
            'RefDocNumber' => $this->ref_doc_number,
            'Remarks' => $this->remarks,
            // Grand Total in Philippine Peso
            'GrandTotal' => $this->grand_total,
            'Client' => new ClientResource($client),
            // HasMany
            'Products' => new ProductCollection($products),
            'DocDate' => Carbon::createFromDate($this->doc_date)->format('Y-m-d'),
            'EntryDate' => Carbon::createFromDate($this->entry_date)->format('Y-m-d'),
            'CreatedAt' => Carbon::createFromTimeStamp(strtotime($this->created_at))->format('Y-m-d')
        ];
    }
}
