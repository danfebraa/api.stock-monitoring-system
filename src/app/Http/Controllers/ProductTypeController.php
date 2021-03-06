<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductTypeRequest;
use App\Http\Resources\ProductTypeResource;
use App\Models\ProductType;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Str;

class ProductTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index()
    {
        $product_type = ProductType::get();
        return ProductTypeResource::collection($product_type)->response();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(ProductTypeRequest $request)
    {
        $valid = $request->only([
            'Name',
        ]);
        $toBeCreated = collect($valid)->transformKeys(fn ($key) => Str::snake($key))->toArray();
        $productType = ProductType::create($toBeCreated);
        return new ProductTypeResource($productType);
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
