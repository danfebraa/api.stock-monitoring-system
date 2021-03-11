<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'client_id',
        'supplier_id',
        'action_type',
        'ref_doc_number',
        'remarks',
        'grand_total',
        'doc_date',
        'entry_date'
    ];
    public function client()
    {
        return $this->belongsTo('App\Models\Client', 'client_id', 'id');
    }

    public function supplier()
    {
        return $this->belongsTo('App\Models\Supplier', 'supplier_id', 'id');
    }

    public function products()
    {
        return $this->belongsToMany(
            'App\Models\Product',
            'App\Models\ProductTransaction',
            'transaction_id',
            'product_id')->withPivot(['quantity', 'unit_price', 'exchange_rate','total'])
            ->as('product_transaction');
    }
}
