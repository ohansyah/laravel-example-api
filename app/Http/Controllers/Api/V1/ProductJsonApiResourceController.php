<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Resources\ProductJsonApiResource;
use App\Models\Product;
use Dedoc\Scramble\Attributes\Endpoint;
use Dedoc\Scramble\Attributes\QueryParameter;
use Dedoc\Scramble\Attributes\Response;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\Enums\FilterOperator;
use Spatie\QueryBuilder\QueryBuilder;

class ProductJsonApiResourceController
{
    /**
     * Display a listing of the resource.
     */
    #[Endpoint(
        title: 'List products (JSON:API)',
        description: 'Returns a paginated JSON:API list of products with filtering, sorting, and includes.'
    )]
    #[QueryParameter('filter[brand_id]', 'Filter by brand id.', type: 'integer', example: 1)]
    #[QueryParameter('filter[category_id]', 'Filter by category id.', type: 'integer', example: 1)]
    #[QueryParameter('filter[name]', 'Partial match by product name.', type: 'string', example: 'milk')]
    #[QueryParameter('filter[barcode]', 'Exact match by barcode.', type: 'string', example: '1234567890123')]
    #[QueryParameter('filter[sku]', 'Exact match by SKU.', type: 'string', example: 'SKU-001')]
    #[QueryParameter('filter[price]', 'Dynamic operator filter for price (for example 500, >500, >=500, <500, <=500).', type: 'string', example: '>500')]
    #[QueryParameter('sort', 'Sort by price or views. Prefix with - for descending.', type: 'string', example: '-price')]
    #[QueryParameter('include', 'Comma-separated relationships to include: brand,category.', type: 'string', example: 'brand,category')]
    #[QueryParameter('cursor', 'Cursor for pagination.', type: 'string')]
    #[Response(200, 'Successful response.', examples: [
        [
            'data' => [
                [
                    'id' => '1',
                    'type' => 'product_json_apis',
                    'attributes' => [
                        'brand_id' => 7,
                        'category_id' => 10,
                        'name' => 'qui',
                        'barcode' => '9183620038675',
                        'sku' => 'oel-96684721',
                        'price' => '980.81',
                        'views' => 0,
                    ],
                ],
            ],
            'links' => [
                'first' => '/api/v1/products?cursor=abc123',
                'next' => '/api/v1/products?cursor=def456',
                'prev' => null,
                'last' => '/api/v1/products?cursor=xyz789',
            ],
        ],
    ])]
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
    #[Endpoint(
        title: 'Show product (JSON:API)',
        description: 'Returns a single product by id in JSON:API format.'
    )]
    #[Response(200, 'Successful response.', examples: [
        [
            'data' => [
                'id' => '1',
                'type' => 'product_json_apis',
                'attributes' => [
                    'brand_id' => 7,
                    'category_id' => 10,
                    'name' => 'qui',
                    'barcode' => '9183620038675',
                    'sku' => 'oel-96684721',
                    'price' => '980.81',
                    'views' => 0,
                ],
            ],
        ],
    ])]
    #[Response(404, 'Product not found.', examples: [
        [
            'message' => 'Resource not found.',
            'status' => 'error',
            'code' => 404,
        ],
    ])]
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
