<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;

Route::get('/', [HomeController::class, 'index'])->name('dashboard');

Route::get('/produk', [ProductController::class, 'index'])->name('product');

Route::get('/data-pesanan', [OrderController::class, 'orderData'])->name('order_data');