<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;

Route::get('/', [HomeController::class, 'index'])->name('dashboard');

Route::get('order', [OrderController::class, 'index'])->name('order');
Route::get('order/edit', [OrderController::class, 'edit'])->name('order.edit');

Route::get('data-pesanan', [OrderController::class, 'orderData'])->name('order_data');
Route::post('data-pesanan/send', [OrderController::class, 'sendOrderData'])->name('send.order_data');