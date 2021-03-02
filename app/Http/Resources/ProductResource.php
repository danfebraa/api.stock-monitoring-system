<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array
     */
    public function toArray($request)
    {
        // BelongsTo
        $product_type = $this->whenLoaded('productType');
        return [
            'Id' => $this->id,
            'ProductTypeId' => $this->product_type_id,
            'ItemCode' => $this->item_code,
            'Description' => $this->description,
            'Quantity' => $this->quantity,
            'ProductType' => new ProductTypeResource($product_type),
            // HasMany
            'Transactions' => new TransactionCollection($this->whenLoaded('transactions'))
        ];
    }
}
