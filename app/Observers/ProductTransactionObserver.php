<?php

namespace App\Observers;

use App\Models\ProductTransaction;

class ProductTransactionObserver
{
    /**
     * Handle the ProductTransaction "created" event.
     * For every attachment of a product to a transaction, this will trigger.
     * @param  \App\Models\ProductTransaction  $productTransaction
     * @return void
     */
    public function created(ProductTransaction $productTransaction)
    {

    }

    /**
     * Handle the ProductTransaction "updated" event.
     *
     * @param  \App\Models\ProductTransaction  $productTransaction
     * @return void
     */
    public function updated(ProductTransaction $productTransaction)
    {
        //
    }

    /**
     * Handle the ProductTransaction "deleted" event.
     *
     * @param  \App\Models\ProductTransaction  $productTransaction
     * @return void
     */
    public function deleted(ProductTransaction $productTransaction)
    {
        //
    }

    /**
     * Handle the ProductTransaction "restored" event.
     *
     * @param  \App\Models\ProductTransaction  $productTransaction
     * @return void
     */
    public function restored(ProductTransaction $productTransaction)
    {
        //
    }

    /**
     * Handle the ProductTransaction "force deleted" event.
     *
     * @param  \App\Models\ProductTransaction  $productTransaction
     * @return void
     */
    public function forceDeleted(ProductTransaction $productTransaction)
    {
        //
    }
}
