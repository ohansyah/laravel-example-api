<?php

namespace App\Http\Resources;

use App\Http\Resources\BrandJsonApiResource;
use App\Http\Resources\CategoryJsonApiResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\JsonApi\JsonApiResource;

class ProductJsonApiResource extends JsonApiResource
{
    /**
     * The resource's attributes.
     */
    public $attributes = [
        'brand_id',
        'category_id',
        'name',
        'barcode',
        'sku',
        'price',
        'views',
    ];

    /**
     * The resource's relationships.
     */
    public $relationships = [
        'brand' => BrandJsonApiResource::class,
        'category' => CategoryJsonApiResource::class,
    ];
}
