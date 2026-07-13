<?php

use App\Http\Controllers\Webhooks\FakeGatewayWebhookController;
use App\Http\Controllers\Webhooks\FawryWebhookController;
use App\Http\Controllers\Webhooks\PaymobWebhookController;
use App\Support\Access\AccessAction;
use Illuminate\Support\Facades\Route;

// Adaptive throttling only — no `abac` here. Payment providers call these
// whenever a transaction settles, any hour of any day, so company working
// hours / permission access windows must never apply (requirement:
// "don't overprotect payment webhooks... providers may call anytime").
// Signature verification + gateway_ref idempotency (PaymentService) remain
// the real security boundary for this group.
Route::middleware('adaptive.throttle:payment,'.AccessAction::WEBHOOK_PAYMENT)->group(function () {
    Route::post('/paymob', PaymobWebhookController::class)->name('webhooks.paymob');
    Route::post('/fawry', FawryWebhookController::class)->name('webhooks.fawry');
    Route::post('/fake-gateway', FakeGatewayWebhookController::class)->name('webhooks.fake-gateway');
});
