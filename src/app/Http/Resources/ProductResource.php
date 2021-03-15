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
        $quantity = (!is_null($this->product_transaction))? $this->product_transaction->quantity : $this->quantity;
        $price = (!is_null($this->product_transaction))? [
            'UnitPrice' => $this->product_transaction->unit_price,
            'ExchangeRate' => $this->product_transaction->exchange_rate,
            'Total' => $this->product_transaction->total] : ['Price' => $this->price];
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
