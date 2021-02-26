<?php

namespace App\Observers;

use App\Models\ProductType;

class ProductTypeObserver
{
    /**
     * Handle the ProductType "created" event.
     *
     * @param  \App\Models\ProductType  $productType
     * @return void
     */
    public function created(ProductType $productType)
    {
        //
    }

    /**
     * Handle the ProductType "updated" event.
     *
     * @param  \App\Models\ProductType  $productType
     * @return void
     */
    public function updated(ProductType $productType)
    {
        //
    }

    /**
     * Handle the ProductType "deleted" event.
     *
     * @param  \App\Models\ProductType  $productType
     * @return void
     */
    public function deleted(ProductType $productType)
    {
        //
    }

    /**
     * Handle the ProductType "restored" event.
     *
     * @param  \App\Models\ProductType  $productType
     * @return void
     */
    public function restored(ProductType $productType)
    {
        //
    }

    /**
     * Handle the ProductType "force deleted" event.
     *
     * @param  \App\Models\ProductType  $productType
     * @return void
     */
    public function forceDeleted(ProductType $productType)
    {
        //
    }
}
