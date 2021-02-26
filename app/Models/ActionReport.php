<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ActionReport extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'action_reports';
    protected $fillable = [
        'product_id',
        'client_id',
        'action_type',
        'u_o_m',
        'quantity',
        'purchase_order',
        'remarks'
    ];

    public function product()
    {
        return $this->belongsTo('App\Models\Product','product_id', 'id');
    }

    public function client()
    {
        return $this->belongsTo('App\Models\Client','client_id', 'id');
    }

}
