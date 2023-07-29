<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\Ecommerce\CategoryController;
use App\Http\Controllers\Admin\Ecommerce\SubCategoryController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SiteController;
use App\Http\Controllers\Api\V1\ProductController;


// Route::group(['middleware' => 'auth:api'], function () {
    Route::group(['prefix' => 'admin'], function () {
        Route::group(['prefix' => 'ecommerece'], function () {
            Route::group(['prefix' => 'category'], function () {
                Route::post('/create', [CategoryController::class, 'Create']);
                Route::get('/list', [CategoryController::class, 'List']);
            });
            Route::group(['prefix' => 'subcategory'], function () {
                Route::post('/create', [SubCategoryController::class, 'Create']);
                Route::get('/list', [SubCategoryController::class, 'List']);
            });
        });
    });
// });

Route::group(['prefix' => 'user'], function () {
    Route::post('/register', [UserController::class, 'Register']);
});

