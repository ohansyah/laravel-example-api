<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Resources\ProductJsonApiResource;

class ProductJsonApiResourceController
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        return ProductJsonApiResource::collection(
            Product::with(['brand', 'category'])
                ->cursorPaginate(5)
                ->withQueryString()
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $products_json_api)
    {
        return new ProductJsonApiResource($products_json_api);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        //
    }
}
