<?php

namespace App\Http\Controllers;

use App\Http\Resources\SupplierCollection;
use App\Models\Supplier;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    public function index()
    {
        $suppliers = Supplier::get();
        return new SupplierCollection($suppliers);
    }
}
