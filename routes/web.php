<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RequisitionController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\PurchaseOrderController;
use App\Http\Controllers\ReceiptController;

// Sidebar Navigation Mappings
Route::get('/', function () { return redirect()->route('requisition.index'); });

// --- Requisition Management Routes ---
Route::get('/mari', [RequisitionController::class, 'index'])->name('requisition.index');
Route::post('/requisitions/store', [RequisitionController::class, 'store'])->name('requisitions.store');
Route::post('/requisitions/{id}/decide', [RequisitionController::class, 'decide'])->name('requisition.decide');

// --- Supplier Management Routes ---
Route::get('/waylon', [SupplierController::class, 'index'])->name('supplier.index');
Route::post('/suppliers/store', [SupplierController::class, 'store'])->name('supplier.store');

// --- Purchase Order Routes ---
Route::get('/bulugagao', [PurchaseOrderController::class, 'index'])->name('po.index');
Route::post('/purchase-orders/store', [PurchaseOrderController::class, 'store'])->name('po.store');

// --- Goods Receipt & 3-Way Matching Views ---
Route::get('/malacaste', [ReceiptController::class, 'index'])->name('receipt.index');

// Goods Receipt AJAX APIs
Route::prefix('api')->group(function () {
    Route::post('/receipts/{id}/approve', [ReceiptController::class, 'apiVerify']);
    Route::post('/receipts/{id}/verify', [ReceiptController::class, 'apiVerify']);
});