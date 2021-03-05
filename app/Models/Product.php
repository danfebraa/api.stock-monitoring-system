<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'products';
    protected $fillable = ['product_type_id','item_code', 'description', 'quantity', 'price'];

    public function productType()
    {
        return $this->belongsTo('App\Models\ProductType', 'product_type_id', 'id');
    }

    public function actionReports()
    {
        return $this->hasMany('App\Models\ActionReport');
    }

    public function transactions()
    {
        return $this->belongsToMany(
            'App\Models\Transaction',
            'App\Models\ProductTransaction',
            'product_id',
            'transaction_id')
            ->withPivot(['quantity', 'priced_at', 'total'])
            ->as('product_transaction');
    }
}
