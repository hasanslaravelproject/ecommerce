<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\customer\AuthController;
use App\Http\Controllers\customer\CartController;
use App\Http\Controllers\customer\CustomerController;
use App\Http\Controllers\SettingsController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::prefix('/')
    ->middleware('auth')
    ->group(function () {
        Route::resource('roles', RoleController::class);
        Route::resource('permissions', PermissionController::class);

        Route::get('users', [UserController::class, 'index'])->name(
            'users.index'
        );
        Route::post('users', [UserController::class, 'store'])->name(
            'users.store'
        );
        Route::get('users/create', [UserController::class, 'create'])->name(
            'users.create'
        );
        Route::get('users/{user}', [UserController::class, 'show'])->name(
            'users.show'
        );
        Route::get('users/{user}/edit', [UserController::class, 'edit'])->name(
            'users.edit'
        );
        Route::put('users/{user}', [UserController::class, 'update'])->name(
            'users.update'
        );
        Route::delete('users/{user}', [UserController::class, 'destroy'])->name(
            'users.destroy'
        );

        Route::get('shops', [ShopController::class, 'index'])->name(
            'shops.index'
        );
        Route::post('shops', [ShopController::class, 'store'])->name(
            'shops.store'
        );
        Route::get('shops/create', [ShopController::class, 'create'])->name(
            'shops.create'
        );
        Route::get('shops/{shop}', [ShopController::class, 'show'])->name(
            'shops.show'
        );
        Route::get('shops/{shop}/edit', [ShopController::class, 'edit'])->name(
            'shops.edit'
        );
        Route::put('shops/{shop}', [ShopController::class, 'update'])->name(
            'shops.update'
        );
        Route::delete('shops/{shop}', [ShopController::class, 'destroy'])->name(
            'shops.destroy'
        );

        Route::get('brands', [BrandController::class, 'index'])->name(
            'brands.index'
        );
        Route::post('brands', [BrandController::class, 'store'])->name(
            'brands.store'
        );
        Route::get('brands/create', [BrandController::class, 'create'])->name(
            'brands.create'
        );
        Route::get('brands/{brand}', [BrandController::class, 'show'])->name(
            'brands.show'
        );
        Route::get('brands/{brand}/edit', [
            BrandController::class,
            'edit',
        ])->name('brands.edit');
        Route::put('brands/{brand}', [BrandController::class, 'update'])->name(
            'brands.update'
        );
        Route::delete('brands/{brand}', [
            BrandController::class,
            'destroy',
        ])->name('brands.destroy');

        Route::get('products', [ProductController::class, 'index'])->name(
            'products.index'
        );
        Route::post('products', [ProductController::class, 'store'])->name(
            'products.store'
        );
        Route::get('products/create', [
            ProductController::class,
            'create',
        ])->name('products.create');
        Route::get('products/{slug}', [
            ProductController::class,
            'show',
        ])->name('products.show');
        Route::get('products/edit/{slug}', [
            ProductController::class,
            'edit',
        ])->name('products.edit');
        Route::put('products/update', [
            ProductController::class,
            'update',
        ])->name('products.update');
        Route::delete('products/{product}', [
            ProductController::class,
            'destroy',
        ])->name('products.destroy');

        Route::get('categories', [CategoryController::class, 'index'])->name(
            'categories.index'
        );
        Route::post('categories', [CategoryController::class, 'store'])->name(
            'categories.store'
        );
        Route::get('categories/create', [
            CategoryController::class,
            'create',
        ])->name('categories.create');
        Route::get('categories/{category}', [
            CategoryController::class,
            'show',
        ])->name('categories.show');
        Route::get('categories/{category}/edit', [
            CategoryController::class,
            'edit',
        ])->name('categories.edit');
        Route::put('categories/{category}', [
            CategoryController::class,
            'update',
        ])->name('categories.update');
        Route::delete('categories/{category}', [
            CategoryController::class,
            'destroy',
        ])->name('categories.destroy');

        Route::get('orders', [OrderController::class, 'index'])->name(
            'orders.index'
        );
        Route::get('order-status/changed', [OrderController::class, 'orderStatus'])->name(
            'orders.status.change'
        );
        Route::post('orders', [OrderController::class, 'store'])->name(
            'orders.store'
        );
        Route::get('orders/create', [OrderController::class, 'create'])->name(
            'orders.create'
        );
        Route::get('orders/{order}', [OrderController::class, 'show'])->name(
            'orders.show'
        );
        Route::get('orders/{order}/edit', [
            OrderController::class,
            'edit',
        ])->name('orders.edit');
        Route::put('orders/{order}', [OrderController::class, 'update'])->name(
            'orders.update'
        );
        Route::delete('orders/{order}', [
            OrderController::class,
            'destroy',
        ])->name('orders.destroy');
    });

Route::get('customers', [CustomerController::class, 'index'])->name(
    'customer.index'
);
Route::post('customers/authentication', [AuthController::class, 'authentication'])->name(
    'customer.authentication'
);
Route::post('add-to/cart', [CartController::class, 'addToCart'])->name(
    'add-to.cart'
);
Route::get('view/cart', [CartController::class, 'viewCart'])->name(
    'view.cart'
);
Route::get('checkout', [CustomerController::class, 'checkout'])->name(
    'checkout'
);
Route::post('place-order', [CustomerController::class, 'placeOrder'])->name(
    'place.order'
);
Route::get('cart-delete', [CartController::class, 'cartDelete'])->name(
    'cart.delete'
);
// Settings
Route::get('admin/settings', [SettingsController::class, 'index'])->name(
    'admin.settings'
);
Route::put('admin/order/settings', [SettingsController::class, 'orderSetting'])->name(
    'order.settings'
);
Route::put('admin/payment-gateway', [SettingsController::class, 'paymentGateway'])->name(
    'admin.payment.gateway'
);
