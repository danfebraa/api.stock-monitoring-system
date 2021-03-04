<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;
    protected $table = 'clients';
    protected $fillable = ['name', 'address', 'contact_no', 'email', 'contact_person'];

    public function transactions()
    {
        return $this->hasMany('App\Models\Transaction');
    }
}
