<?php

use App\Http\Controllers\Api\V1\CatalogController;
use App\Http\Controllers\Api\V1\PaymentController;
use App\Http\Controllers\Api\V1\PurchaseOrderController;
use App\Http\Controllers\Api\V1\QuoteController;
use App\Http\Controllers\Api\V1\StockAvailabilityController;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')
    ->middleware(['api.json', 'api.client-principal', 'auth:api', 'throttle:api'])
    ->group(function () {
        Route::get('/catalog/products', [CatalogController::class, 'products'])
            ->middleware(['scope:catalog:read', 'permission:catalog.read,guard:api']);

        Route::get('/stock/availability', StockAvailabilityController::class)
            ->middleware(['scope:stock:read', 'permission:stock.read,guard:api']);

        Route::prefix('b2b')->group(function () {
            Route::get('/quotes', [QuoteController::class, 'index'])
                ->middleware(['scope:orders:write', 'permission:quote.request|quote.price|po.approve,guard:api']);
            Route::post('/quotes', [QuoteController::class, 'store'])
                ->middleware(['scope:orders:write', 'permission:quote.request,guard:api']);

            Route::get('/purchase-orders', [PurchaseOrderController::class, 'index'])
                ->middleware(['scope:orders:write', 'permission:quote.request|po.approve|payment.settle,guard:api']);
            Route::post('/purchase-orders/{purchaseOrder}/accept', [PurchaseOrderController::class, 'accept'])
                ->middleware(['scope:orders:write', 'permission:quote.request|po.approve|payment.settle,guard:api']);

            Route::get('/payments', [PaymentController::class, 'index'])
                ->middleware(['scope:payments:write', 'permission:quote.request|payment.settle,guard:api']);
            Route::post('/payments/bank-transfer-proof', [PaymentController::class, 'bankTransferProof'])
                ->middleware(['scope:payments:write', 'permission:quote.request|payment.settle,guard:api']);
        });
    });
