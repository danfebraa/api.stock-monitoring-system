<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class ProductTransaction extends Pivot
{
    protected $fillable = ['action_type', 'quantity', 'remarks'];
}
