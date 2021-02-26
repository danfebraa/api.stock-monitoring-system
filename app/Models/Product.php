<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'products';
    protected $fillable = ['product_type_id', 'description', 'quantity'];

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
            'products_transactions',
            'product_id',
            'transaction_id');
    }
}
