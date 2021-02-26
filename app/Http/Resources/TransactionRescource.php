<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TransactionRescource extends JsonResource
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
        return [
            'Id' => $this->id,
            'ClientId' => $this->client_id,
            'ActionType' => $this->action_type,
            'PurchaseOrder' => $this->purchase_order,
            'Remarks' => $this->remarks,
            'Client' => new ClientResource($client),
            // HasMany
            'Products' => new ProductCollection($this->whenLoaded('products')->loadMissing('productType'))
        ];
    }
}
