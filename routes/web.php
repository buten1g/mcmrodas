<?php

use App\Http\Controllers\CatalogController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Requests\ProductRequest;
use Illuminate\Support\Facades\Auth;


Route::get('/', [CatalogController::class, 'catalog']);
Route::get('/products/{category}', [CatalogController::class, 'products'])->name('products');
Route::get('/modal/product/{product}', [CatalogController::class, 'modal_product'])->name('modal.product');
Route::post('/modal/product/{product}/add', [CatalogController::class, 'modal_product_add'])->name('modal.product.add');
Route::post('/modal/product/{rowId}/remove', [CatalogController::class, 'product_remove'])->name('product.remove');

Route::get('/cart', [CatalogController::class, 'cart'])->name('cart');
Route::get('/pdf', [CatalogController::class, 'pdf'])->name('pdf');
Route::post('/pdf', [CatalogController::class, 'pdf'])->name('pdf-generate');

Auth::routes(['register' => false]);
Route::middleware('auth')->prefix('painel')->name('painel.')->group(function () {
    Route::get('/', [App\Http\Controllers\DashboardController::class, 'index'])->name('index');
    //
    Route::get('products/ordering', [ProductController::class, 'productsOrdering'])->name('products.ordering');
    Route::post('products/ordering', [ProductController::class, 'productsOrderingPost'])->name('products.ordering.post');
    Route::resource('products', ProductController::class)->except(['show']);
    Route::resource('categories', CategoryController::class)->except(['show']);
});
