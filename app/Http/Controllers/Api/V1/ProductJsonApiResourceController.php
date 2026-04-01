<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Resources\ProductJsonApiResource;
use App\Models\Product;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\Enums\FilterOperator;
use Spatie\QueryBuilder\QueryBuilder;

class ProductJsonApiResourceController
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $products = QueryBuilder::for(Product::class)
            ->allowedFilters(
                AllowedFilter::exact('brand_id'),
                AllowedFilter::exact('category_id'),
                AllowedFilter::partial('name'),
                AllowedFilter::exact('barcode'),
                AllowedFilter::exact('sku'),
                AllowedFilter::operator('price', FilterOperator::DYNAMIC),
            )
            ->allowedSorts('price', 'views')
            ->allowedIncludes('brand', 'category')
            ->with(['brand', 'category'])
            ->cursorPaginate(5)
            ->withQueryString();

        return ProductJsonApiResource::collection($products);
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
