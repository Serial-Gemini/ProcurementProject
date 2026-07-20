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
Route::post('/requisitions/store', [RequisitionController::class, 'store'])->name('requisition.store');
// This route matches the URL in your fetch() call
Route::post('/requisitions/{id}/decide', [RequisitionController::class, 'decide'])->name('requisition.decide');

// --- Supplier Management Routes ---
Route::get('/waylon', [SupplierController::class, 'index'])->name('supplier.index');
Route::post('/suppliers/store', [SupplierController::class, 'store'])->name('supplier.store');

// --- Purchase Order Routes ---
Route::get('/bulugagao', [PurchaseOrderController::class, 'index'])->name('po.index');
Route::post('/purchase-orders/store', [PurchaseOrderController::class, 'store'])->name('po.store');

// --- Goods Receipt View ---
Route::get('/malacaste', [ReceiptController::class, 'index'])->name('receipt.index');

// Goods Receipt Javascript-Based AJAX APIs
Route::prefix('api')->group(function () {
    Route::get('/receipts', [ReceiptController::class, 'apiIndex']);
    Route::post('/receipts', [ReceiptController::class, 'apiStore']);
    Route::post('/receipts/{id}/step', [ReceiptController::class, 'apiUpdateStep']);
    Route::post('/receipts/{id}/verify', [ReceiptController::class, 'apiVerify']);
    Route::post('/receipts/clear', [ReceiptController::class, 'apiClear']);
});