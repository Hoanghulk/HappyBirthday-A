<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\again2_slider;
use App\Http\Controllers\Banners\banner_laravel;

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

Route::get('slider', [again2_slider::class, 'slider'])->name('slider');

Route::group(['prefix' => 'banner'], function () {
    Route::get('list', [banner_laravel::class, 'list'])->name('clients.banner.list');

    Route::match(['GET', 'POST'], 'store', [banner_laravel::class, 'store'])->name('clients.banner.store');

    Route::match(['GET', 'POST'], '{id}/edit', [banner_laravel::class, 'edit'])->name('clients.banner.edit');

    Route::post('{id}/update-status', [banner_laravel::class, 'update-status'])->name('clients.banner.update-status');

    // Xóa không dùng ajax
//    Route::get('{id}/delete', [banner_again2::class, 'delete'])->name('clients.banner.delete');

    // Xóa dùng ajax
    Route::delete('{id}/delete', [banner_laravel::class, 'delete'])->name('clients.banner.delete');

});
