<?php

use App\Http\Controllers\Webhooks\FakeGatewayWebhookController;
use App\Http\Controllers\Webhooks\FawryWebhookController;
use App\Http\Controllers\Webhooks\PaymobWebhookController;
use Illuminate\Support\Facades\Route;

Route::post('/paymob', PaymobWebhookController::class)->name('webhooks.paymob');
Route::post('/fawry', FawryWebhookController::class)->name('webhooks.fawry');
Route::post('/fake-gateway', FakeGatewayWebhookController::class)->name('webhooks.fake-gateway');
