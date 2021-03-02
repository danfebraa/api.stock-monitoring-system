<?php

namespace App\Observers;

use App\Models\Product;
use App\Models\ProductType;
use App\Events\ProductCreatedWebsocketEvent;
use App\Events\ProductUpdatedWebsocketEvent;
class ProductObserver
{

    /**
     * Handle the Product "creating" event.
     *
     * @param  \App\Models\Product  $product
     * @return $product
     */
    public function creating(Product $product)
    {
        
        $limit_reached = false;
        $product_type = $product->productType;
        $product_count = $product_type->products->count();
        
        if($product_count > 0)
        {
            $limit_reached = $product_count % 100 === 0;
        }
            
        if($limit_reached) 
        { 
            $latest_product_type = ProductType::latest()->first();
            $product_type->update(['prefix' => $latest_product_type->prefix + 100]);
        }

        $product->item_code = $product_type->prefix + ($product_count + 1);
        return $product;
    }

    /**
     * Handle the Product "created" event.
     *
     * @param  \App\Models\Product  $product
     * @return void
     */
    public function created(Product $product)
    {
        event(new ProductCreatedWebsocketEvent($product->id));
    }

    /**
     * Handle the Product "updated" event.
     *
     * @param  \App\Models\Product  $product
     * @return void
     */
    public function updated(Product $product)
    {
        event(new ProductUpdatedWebsocketEvent($product->id));
    }

    /**
     * Handle the Product "deleted" event.
     *
     * @param  \App\Models\Product  $product
     * @return void
     */
    public function deleted(Product $product)
    {
        //
    }

    /**
     * Handle the Product "restored" event.
     *
     * @param  \App\Models\Product  $product
     * @return void
     */
    public function restored(Product $product)
    {
        //
    }

    /**
     * Handle the Product "force deleted" event.
     *
     * @param  \App\Models\Product  $product
     * @return void
     */
    public function forceDeleted(Product $product)
    {
        //
    }
}
