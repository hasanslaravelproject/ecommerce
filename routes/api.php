<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\ShopController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\RoleController;
use App\Http\Controllers\Api\BrandController;
use App\Http\Controllers\Api\OrderController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\UserCartsController;
use App\Http\Controllers\Api\PermissionController;
use App\Http\Controllers\Api\UserCommentsController;
use App\Http\Controllers\Api\ShopProductsController;
use App\Http\Controllers\Api\BrandProductsController;
use App\Http\Controllers\Api\ProductCommentsController;
use App\Http\Controllers\Api\CategoryProductsController;
use App\Http\Controllers\Api\OrderOrderDetailsController;
use App\Http\Controllers\Api\ProductOrderDetailsController;
use App\Http\Controllers\Api\ProductProductDetailsController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('/login', [AuthController::class, 'login'])->name('api.login');

Route::middleware('auth:sanctum')
    ->get('/user', function (Request $request) {
        return $request->user();
    })
    ->name('api.user');

Route::name('api.')
    ->middleware('auth:sanctum')
    ->group(function () {
        Route::apiResource('roles', RoleController::class);
        Route::apiResource('permissions', PermissionController::class);

        Route::get('/users', [UserController::class, 'index'])->name(
            'users.index'
        );
        Route::post('/users', [UserController::class, 'store'])->name(
            'users.store'
        );
        Route::get('/users/{user}', [UserController::class, 'show'])->name(
            'users.show'
        );
        Route::put('/users/{user}', [UserController::class, 'update'])->name(
            'users.update'
        );
        Route::delete('/users/{user}', [
            UserController::class,
            'destroy',
        ])->name('users.destroy');

        // User Carts
        Route::get('/users/{user}/carts', [
            UserCartsController::class,
            'index',
        ])->name('users.carts.index');
        Route::post('/users/{user}/carts', [
            UserCartsController::class,
            'store',
        ])->name('users.carts.store');

        // User Comments
        Route::get('/users/{user}/comments', [
            UserCommentsController::class,
            'index',
        ])->name('users.comments.index');
        Route::post('/users/{user}/comments', [
            UserCommentsController::class,
            'store',
        ])->name('users.comments.store');

        Route::get('/shops', [ShopController::class, 'index'])->name(
            'shops.index'
        );
        Route::post('/shops', [ShopController::class, 'store'])->name(
            'shops.store'
        );
        Route::get('/shops/{shop}', [ShopController::class, 'show'])->name(
            'shops.show'
        );
        Route::put('/shops/{shop}', [ShopController::class, 'update'])->name(
            'shops.update'
        );
        Route::delete('/shops/{shop}', [
            ShopController::class,
            'destroy',
        ])->name('shops.destroy');

        // Shop Products
        Route::get('/shops/{shop}/products', [
            ShopProductsController::class,
            'index',
        ])->name('shops.products.index');
        Route::post('/shops/{shop}/products', [
            ShopProductsController::class,
            'store',
        ])->name('shops.products.store');

        Route::get('/brands', [BrandController::class, 'index'])->name(
            'brands.index'
        );
        Route::post('/brands', [BrandController::class, 'store'])->name(
            'brands.store'
        );
        Route::get('/brands/{brand}', [BrandController::class, 'show'])->name(
            'brands.show'
        );
        Route::put('/brands/{brand}', [BrandController::class, 'update'])->name(
            'brands.update'
        );
        Route::delete('/brands/{brand}', [
            BrandController::class,
            'destroy',
        ])->name('brands.destroy');

        // Brand Products
        Route::get('/brands/{brand}/products', [
            BrandProductsController::class,
            'index',
        ])->name('brands.products.index');
        Route::post('/brands/{brand}/products', [
            BrandProductsController::class,
            'store',
        ])->name('brands.products.store');

        Route::get('/products', [ProductController::class, 'index'])->name(
            'products.index'
        );
        Route::post('/products', [ProductController::class, 'store'])->name(
            'products.store'
        );
        Route::get('/products/{product}', [
            ProductController::class,
            'show',
        ])->name('products.show');
        Route::put('/products/{product}', [
            ProductController::class,
            'update',
        ])->name('products.update');
        Route::delete('/products/{product}', [
            ProductController::class,
            'destroy',
        ])->name('products.destroy');

        // Product Comments
        Route::get('/products/{product}/comments', [
            ProductCommentsController::class,
            'index',
        ])->name('products.comments.index');
        Route::post('/products/{product}/comments', [
            ProductCommentsController::class,
            'store',
        ])->name('products.comments.store');

        // Product Order Details
        Route::get('/products/{product}/order-details', [
            ProductOrderDetailsController::class,
            'index',
        ])->name('products.order-details.index');
        Route::post('/products/{product}/order-details', [
            ProductOrderDetailsController::class,
            'store',
        ])->name('products.order-details.store');

        // Product Product Details
        Route::get('/products/{product}/product-details', [
            ProductProductDetailsController::class,
            'index',
        ])->name('products.product-details.index');
        Route::post('/products/{product}/product-details', [
            ProductProductDetailsController::class,
            'store',
        ])->name('products.product-details.store');

        Route::get('/categories', [CategoryController::class, 'index'])->name(
            'categories.index'
        );
        Route::post('/categories', [CategoryController::class, 'store'])->name(
            'categories.store'
        );
        Route::get('/categories/{category}', [
            CategoryController::class,
            'show',
        ])->name('categories.show');
        Route::put('/categories/{category}', [
            CategoryController::class,
            'update',
        ])->name('categories.update');
        Route::delete('/categories/{category}', [
            CategoryController::class,
            'destroy',
        ])->name('categories.destroy');

        // Category Products
        Route::get('/categories/{category}/products', [
            CategoryProductsController::class,
            'index',
        ])->name('categories.products.index');
        Route::post('/categories/{category}/products', [
            CategoryProductsController::class,
            'store',
        ])->name('categories.products.store');

        Route::get('/orders', [OrderController::class, 'index'])->name(
            'orders.index'
        );
        Route::post('/orders', [OrderController::class, 'store'])->name(
            'orders.store'
        );
        Route::get('/orders/{order}', [OrderController::class, 'show'])->name(
            'orders.show'
        );
        Route::put('/orders/{order}', [OrderController::class, 'update'])->name(
            'orders.update'
        );
        Route::delete('/orders/{order}', [
            OrderController::class,
            'destroy',
        ])->name('orders.destroy');

        // Order Order Details
        Route::get('/orders/{order}/order-details', [
            OrderOrderDetailsController::class,
            'index',
        ])->name('orders.order-details.index');
        Route::post('/orders/{order}/order-details', [
            OrderOrderDetailsController::class,
            'store',
        ])->name('orders.order-details.store');
    });
