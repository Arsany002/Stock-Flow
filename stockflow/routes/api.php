<?php

use App\Http\Controllers\Api\V1\CatalogController;
use App\Http\Controllers\Api\V1\PaymentController;
use App\Http\Controllers\Api\V1\PurchaseOrderController;
use App\Http\Controllers\Api\V1\QuoteController;
use App\Http\Controllers\Api\V1\StockAvailabilityController;
use App\Support\Access\AccessAction;
use Illuminate\Support\Facades\Route;

$readThrottle = 'adaptive.throttle:api,'.AccessAction::API_V1_READ;
$writeThrottle = 'adaptive.throttle:api,'.AccessAction::API_V1_WRITE;

Route::prefix('v1')
    ->middleware(['api.json', 'api.client-principal', 'auth:api', 'throttle:api'])
    ->group(function () use ($readThrottle, $writeThrottle) {
        Route::get('/catalog/products', [CatalogController::class, 'products'])
            ->middleware(['scope:catalog:read', 'permission:catalog.read,guard:api', $readThrottle]);

        Route::get('/stock/availability', StockAvailabilityController::class)
            ->middleware(['scope:stock:read', 'permission:stock.read,guard:api', $readThrottle]);

        Route::prefix('b2b')->group(function () use ($readThrottle, $writeThrottle) {
            Route::get('/quotes', [QuoteController::class, 'index'])
                ->middleware(['scope:orders:write', 'permission:quote.request|quote.price|po.approve,guard:api', $readThrottle]);
            Route::post('/quotes', [QuoteController::class, 'store'])
                ->middleware([
                    'scope:orders:write',
                    'permission:quote.request,guard:api',
                    $writeThrottle,
                    'abac:'.AccessAction::API_V1_WRITE.',quote.request',
                ]);

            Route::get('/purchase-orders', [PurchaseOrderController::class, 'index'])
                ->middleware(['scope:orders:write', 'permission:quote.request|po.approve|payment.settle,guard:api', $readThrottle]);
            Route::post('/purchase-orders/{purchaseOrder}/accept', [PurchaseOrderController::class, 'accept'])
                ->middleware([
                    'scope:orders:write',
                    'permission:quote.request|po.approve|payment.settle,guard:api',
                    $writeThrottle,
                    'abac:'.AccessAction::API_V1_WRITE.',po.approve',
                ]);

            Route::get('/payments', [PaymentController::class, 'index'])
                ->middleware(['scope:payments:write', 'permission:quote.request|payment.settle,guard:api', $readThrottle]);
            Route::post('/payments/bank-transfer-proof', [PaymentController::class, 'bankTransferProof'])
                ->middleware([
                    'scope:payments:write',
                    'permission:quote.request|payment.settle,guard:api',
                    $writeThrottle,
                    'abac:'.AccessAction::API_V1_WRITE.',payment.settle',
                ]);
        });
    });
