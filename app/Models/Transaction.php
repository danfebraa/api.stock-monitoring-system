<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'client_id',
        'action_type',
        'purchase_order',
        'remarks'
    ];
    public function client()
    {
        return $this->belongsTo('App\Models\Client', 'client_id', 'id');
    }
    public function products()
    {
        return $this->belongsToMany(
            'App\Models\Product',
            'products_transactions',
            'transaction_id',
            'product_id')
            ->withPivot(['quantity'])
            ->as('product_transaction');
    }
}
