<?php

use Basketin\Dashboard\Http\Livewire\Account\LoginPage;
use Basketin\Dashboard\Http\Livewire\Admin\Home as AdminHome;
use Basketin\Dashboard\Http\Livewire\Home;
use Basketin\Dashboard\Http\Middleware\GlobalConfigMiddleware;
use Illuminate\Support\Facades\Route;

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

Route::prefix('basketin')->middleware(['web', GlobalConfigMiddleware::class])->group(function () {
    Route::get('/login', LoginPage::class)->name('basketin.admin.login');
    Route::middleware(['martTeam'])->group(function () {
        Route::get('/', Home::class)->name('basketin.dashboard.home');

        Route::prefix('admin-area')->group(function () {
            Route::get('/', AdminHome::class)->name('basketin.dashboard.admin-area.home');
        });
    });
});
