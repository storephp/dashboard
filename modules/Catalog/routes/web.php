<?php

use Illuminate\Support\Facades\Route;
use OutMart\Modules\Catalog\Http\Livewire\Categories\CategoriesIndex;
use OutMart\Modules\Catalog\Http\Livewire\Categories\CategoryCreate;
use OutMart\Modules\Catalog\Http\Livewire\Categories\CategoryEdit;
use OutMart\Modules\Catalog\Http\Livewire\Products\ProductCreate;
use OutMart\Modules\Catalog\Http\Livewire\Products\ProductEdit;
use OutMart\Modules\Catalog\Http\Livewire\Products\ProductsIndex;

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
Route::prefix('categories')->group(function () {
    Route::get('/', CategoriesIndex::class)->name('outmart.dashboard.catalog.categories.index');
    Route::get('/create', CategoryCreate::class)->name('outmart.dashboard.catalog.categories.create');
    Route::get('/{category}/edit', CategoryEdit::class)->name('outmart.dashboard.catalog.categories.edit');
});


Route::prefix('products')->group(function () {
    Route::get('/', ProductsIndex::class)->name('outmart.dashboard.catalog.products.index');
    Route::get('/create-{productType}', ProductCreate::class)->name('outmart.dashboard.catalog.products.create');
    Route::get('/{product}/edit', ProductEdit::class)->name('outmart.dashboard.catalog.products.edit');
});
