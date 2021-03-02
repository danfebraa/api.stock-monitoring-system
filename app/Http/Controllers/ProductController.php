<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Http\Resources\ProductCollection;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return ProductCollection|JsonResponse
     */
    public function index()
    {
        $products = Product::with(['productType'])->get();
        return new ProductCollection($products);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return ProductResource|array
     */
    public function store(ProductRequest $request)
    {
        $valid = $request->only([
            'Description',
            'Quantity',
            'ProductTypeId',
            'Price',
        ]);
        $toBeCreated = collect($valid)->transformKeys(fn ($key) => Str::snake($key))->toArray();
        $product = Product::firstOrCreate($toBeCreated);
        return new ProductResource($product->loadMissing('productType'));

    }

    /**
     * Display the specified resource.
     *
     * @param Product $product
     * @return Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Product $product
     * @return Response
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Product $product
     * @return Response
     */
    public function destroy(Product $product)
    {
        //
    }
}
