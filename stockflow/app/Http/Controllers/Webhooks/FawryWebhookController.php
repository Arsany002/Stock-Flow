<?php

namespace App\Http\Controllers\Webhooks;

use App\Enums\PaymentMethod;
use App\Http\Controllers\Controller;
use App\Services\PaymentService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class FawryWebhookController extends Controller
{
    public function __invoke(Request $request, PaymentService $payments): JsonResponse
    {
        $payment = $payments->verifyWebhook(
            PaymentMethod::Fawry,
            $request->all(),
            $this->headers($request),
        );

        return response()->json([
            'status' => 'ok',
            'payment_id' => $payment->id,
            'payment_status' => $payment->status->value,
        ]);
    }

    /**
     * @return array<string, mixed>
     */
    private function headers(Request $request): array
    {
        return [
            ...$request->headers->all(),
            'x-fawry-signature' => $request->header('X-Fawry-Signature'),
            'raw_body' => $request->getContent(),
        ];
    }
}
