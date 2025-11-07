<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\PegawaiController;
use App\Http\Controllers\Api\BarangController;
use App\Http\Controllers\Api\CustomerController;
use App\Http\Controllers\Api\SupplierController;
use App\Http\Controllers\Api\GudangController;
use App\Http\Controllers\Api\SatuanController;
use App\Http\Controllers\Api\KategoriController;
use App\Http\Controllers\Api\AkunBankController;
use App\Http\Controllers\Api\AdminController;
use App\Http\Controllers\Api\SalesOrderController;
use App\Http\Controllers\Api\DeliveryOrderController;
use App\Http\Controllers\Api\InvoiceController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Public Routes
Route::post('/login', [AuthController::class, 'login']);

// Protected Routes
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/profile', [AuthController::class, 'profile']);

    // Master Data Routes
    Route::apiResource('pegawai', PegawaiController::class);
    Route::apiResource('barang', BarangController::class);
    Route::apiResource('customer', CustomerController::class);
    Route::apiResource('supplier', SupplierController::class);
    Route::apiResource('gudang', GudangController::class);
    Route::apiResource('satuan', SatuanController::class);
    Route::apiResource('kategori', KategoriController::class);
    Route::apiResource('akun-bank', AkunBankController::class);
    Route::apiResource('admin', AdminController::class);
    
    // Transaction Routes
    Route::apiResource('sales-order', SalesOrderController::class);
    Route::apiResource('delivery-order', DeliveryOrderController::class);
    Route::apiResource('invoice', InvoiceController::class);
});