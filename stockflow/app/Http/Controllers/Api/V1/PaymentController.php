<?php

namespace App\Http\Controllers\Api\V1;

use App\Enums\PaymentMethod;
use App\Http\Requests\Api\V1\ListPaymentsRequest;
use App\Http\Requests\Api\V1\StoreBankTransferProofRequest;
use App\Http\Resources\Api\V1\PaymentResource;
use App\Services\PaymentService;
use App\Services\PurchaseOrderService;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class PaymentController extends ApiController
{
    public function __construct(
        private readonly PaymentService $payments,
        private readonly PurchaseOrderService $purchaseOrders,
    ) {}

    public function index(ListPaymentsRequest $request): JsonResponse
    {
        $validated = $request->validated();

        $payments = $this->payments->listForViewer($request->user(), (int) ($validated['per_page'] ?? 15));
        $payments->getCollection()->load('payable');

        return $this->paginated($payments, PaymentResource::class, $request);
    }

    public function bankTransferProof(StoreBankTransferProofRequest $request): JsonResponse
    {
        $validated = $request->validated();
        $purchaseOrder = $this->purchaseOrders->find($validated['purchase_order_id']);

        if (! $purchaseOrder) {
            throw new NotFoundHttpException('Purchase order not found.');
        }

        $payment = $this->payments->initiate(
            $purchaseOrder,
            PaymentMethod::BankTransfer,
            (string) $purchaseOrder->total,
            [
                'reference' => $validated['reference'],
                'proof_url' => $validated['proof_url'] ?? null,
                'proof_note' => $validated['proof_note'] ?? null,
            ],
        );

        $payment->load('payable');

        return $this->resource(new PaymentResource($payment), $request, 201, [
            'note' => 'Bank transfer proof recorded. Finance must settle the payment before stock is converted to sale_out.',
        ]);
    }
}
