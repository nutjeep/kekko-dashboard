<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\ProductThemeController;
use App\Http\Controllers\ProductPackageController;

Route::get('/', [HomeController::class, 'index'])->name('dashboard');

Route::get('order', [OrderController::class, 'index'])->name('order');
Route::get('order/edit/{id}', [OrderController::class, 'edit'])->name('order.edit');
Route::get('order/get_by_id/{id}', [OrderController::class, 'getOrderById'])->name('order.get_by_id');
Route::post('order/update/{id}', [OrderController::class, 'update'])->name('order.update');

Route::get('transaction', [TransactionController::class, 'index'])->name('transaction');
Route::post('transaction/store', [TransactionController::class, 'store'])->name('transaction.store');

Route::get('product', [ProductController::class, 'index'])->name('product');
Route::post('product/store', [ProductController::class, 'store'])->name('product.store');
Route::get('product/edit/{id}', [ProductController::class, 'edit'])->name('product.edit');
Route::post('product/update/{id}', [ProductController::class, 'update'])->name('product.update');

Route::get('product/theme', [ProductThemeController::class, 'index'])->name('product_theme');
Route::post('product/theme/store', [ProductThemeController::class, 'store'])->name('product_theme.store');
Route::get('product/theme/edit/{id}', [ProductThemeController::class, 'edit'])->name('product_theme.edit');
Route::post('product/theme/update/{id}', [ProductThemeController::class, 'update'])->name('product_theme.update'); 

Route::get('product/package', [ProductPackageController::class, 'index'])->name('product_package');
Route::post('product/package/store', [ProductPackageController::class, 'store'])->name('product_package.store');
Route::get('product/package/edit/{id}', [ProductPackageController::class, 'edit'])->name('product_package.edit');
Route::post('product/package/update/{id}', [ProductPackageController::class, 'update'])->name('product_package.update');

Route::get('data-pesanan', [OrderController::class, 'orderData'])->name('order_data');
Route::post('data-pesanan/send', [OrderController::class, 'sendOrderData'])->name('send.order_data');