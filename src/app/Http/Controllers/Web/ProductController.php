<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\Web\ProductRequest;
use App\Models\Product;
use App\Models\ProductType;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\Response as ResponseAlias;
use Illuminate\Support\Arr;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        $products = Product::get();
        return view('pages.products.index', compact('products'));
    }

    /**
     * Show create product form.
     * @return Application|Factory|View
     */
    public function create()
    {
        $productTypes = ProductType::get();
        return view('pages.products.create', compact('productTypes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(ProductRequest $request)
    {
        // if code reaches here that means the validation was successful
        $valid = $request->validated();
        $productType = ProductType::find($request['product_type_id']);
        $productType->products()->create(Arr::except($valid,['product_type_id']));
        return redirect()->back()->with('success', 'Product has been successfully added!');
    }

    /**
     * Display the specified resource.
     *
     * @param Product $product
     * @return ResponseAlias
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Product $product
     * @return ResponseAlias
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Product $product
     * @return ResponseAlias
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Product $product
     * @return ResponseAlias
     */
    public function destroy(Product $product)
    {
        //
    }
}
