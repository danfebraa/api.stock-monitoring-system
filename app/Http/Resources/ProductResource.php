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
        $quantity = null;
        $price = [];
        switch($request->segment(2))
        {
            case "transactions" : {

                // Check used when updating a product's quantity via the transactions endpoint.
                $quantity = (!is_null($this->product_transaction))? $this->product_transaction->quantity : $this->quantity;
                $price = (!is_null($this->product_transaction))? ['PricedAt' => $this->product_transaction->priced_at, 'Total' => $this->product_transaction->total] : ['Price' => $this->price];
                break;
            }
            default : {
                $quantity = $this->quantity;
                $price = ['Price' => $this->price];
                break;
            }
        }
        // BelongsTo
        $product_type = $this->whenLoaded('productType');
        return array_merge([
            'Id' => $this->id,
            'ProductTypeId' => $this->product_type_id,
            'ItemCode' => $this->item_code,
            'Description' => $this->description,
            'Quantity' => $quantity,
            'ProductType' => new ProductTypeResource($product_type),
            // HasMany
            'Transactions' => new TransactionCollection($this->whenLoaded('transactions'))
        ], $price);
    }
}
