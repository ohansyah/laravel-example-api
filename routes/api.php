<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\ProductController;
use App\Http\Controllers\Api\V1\ProductJsonApiResourceController;

Route::group(['prefix' => 'v1'], function () {
    Route::apiResource('products', ProductController::class)->only(['index', 'show']);
    Route::apiResource('products-json-api', ProductJsonApiResourceController::class)->only(['index', 'show']);
});
