<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ActionReportResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $product = $this->whenLoaded('product');
        $client = $this->whenLoaded('client');
        return [
            'ProductId' => $this->product_id,
            'ClientId' => $this->client_id,
            'ActionType' => $this->action_type,
            'UOM' => $this->u_o_m,
            'Quantity' => $this->quantity,
            'PurchaseOrder' => $this->purchase_order,
            'Remarks' => $this->remarks,
            'Product' => new ProductTypeResource($product),
            'Client' => new ProductTypeResource($client),
        ];
    }
}
