<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\ProductThemeController;

Route::get('/', [HomeController::class, 'index'])->name('dashboard');

Route::get('order', [OrderController::class, 'index'])->name('order');
Route::get('order/edit/{id}', [OrderController::class, 'edit'])->name('order.edit');
Route::get('order/get_by_id/{id}', [OrderController::class, 'getOrderById'])->name('order.get_by_id');
Route::post('order/update/{id}', [OrderController::class, 'update'])->name('order.update');

Route::get('transaction', [TransactionController::class, 'index'])->name('transaction');
Route::post('transaction/create', [TransactionController::class, 'create'])->name('transaction.create');

Route::get('product/theme', [ProductThemeController::class, 'index'])->name('product_theme');
Route::get('product/theme/store', [ProductThemeController::class, 'store'])->name('product_theme.store');

Route::get('data-pesanan', [OrderController::class, 'orderData'])->name('order_data');
Route::post('data-pesanan/send', [OrderController::class, 'sendOrderData'])->name('send.order_data');