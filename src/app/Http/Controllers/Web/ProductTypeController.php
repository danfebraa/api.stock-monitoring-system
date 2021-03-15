<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductTypeRequest;
use App\Models\ProductType;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Str;

class ProductTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        $product_types = ProductType::paginate(10);
        return view('pages.product_types.index', compact('product_types'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        return view('pages.product_types.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param ProductTypeRequest $request
     * @return string
     */
    public function store(Request $request)
    {
        $valid = $request->validate([
            'name' => 'required|unique:product_types,name',
        ]);

        if($valid)
        {
            $productType = ProductType::create($valid);
        }

        return route('product-types.index');
    }

    /**
     * Display the specified resource.
     *
     * @param ProductType $productType
     * @return Response
     */
    public function show(ProductType $productType)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param ProductType $productType
     * @return Response
     */
    public function edit(ProductType $productType)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param ProductType $productType
     * @return Response
     */
    public function update(Request $request, ProductType $productType)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param ProductType $productType
     * @return Response
     */
    public function destroy(ProductType $productType)
    {
        //
    }
}
