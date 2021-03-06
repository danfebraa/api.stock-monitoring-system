<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductTypeResource extends JsonResource
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
            'Prefix' => $this->prefix,
            'Name' => $this->name,
            'Products' => new ProductCollection($this->whenLoaded('products'))
        ];
    }
}
