<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class ProductTransaction extends Pivot
{

    protected $table = 'product_transaction';
    protected $fillable = ['product_id','transaction_id','quantity', 'priced_at', 'total'];

    public function product()
    {
        return $this->belongsTo('App\Models\Product', 'product_id', 'id');
    }

    public function transaction()
    {
        return $this->belongsTo('App\Models\Transaction', 'transaction_id', 'id');
    }
}
