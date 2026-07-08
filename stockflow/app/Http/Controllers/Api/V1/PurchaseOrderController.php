<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Requests\Api\V1\AcceptPurchaseOrderRequest;
use App\Http\Requests\Api\V1\ListPurchaseOrdersRequest;
use App\Http\Resources\Api\V1\PurchaseOrderResource;
use App\Models\PurchaseOrder;
use App\Services\PurchaseOrderService;
use Illuminate\Http\JsonResponse;

class PurchaseOrderController extends ApiController
{
    public function __construct(private readonly PurchaseOrderService $purchaseOrders) {}

    public function index(ListPurchaseOrdersRequest $request): JsonResponse
    {
        $validated = $request->validated();

        $purchaseOrders = $this->purchaseOrders->listForViewer(
            $request->user()->businessAccount,
            (int) ($validated['per_page'] ?? 15),
        );

        $purchaseOrders->getCollection()->load(['businessAccount', 'items.product', 'items.warehouse', 'payments']);

        return $this->paginated($purchaseOrders, PurchaseOrderResource::class, $request);
    }

    public function accept(AcceptPurchaseOrderRequest $request, PurchaseOrder $purchaseOrder): JsonResponse
    {
        $purchaseOrder = $this->purchaseOrders->find($purchaseOrder->id) ?? $purchaseOrder;
        $purchaseOrder->load(['businessAccount', 'items.product', 'items.warehouse', 'payments']);

        return $this->resource(new PurchaseOrderResource($purchaseOrder), $request, meta: [
            'note' => 'Purchase orders are created by accepting quotes; this endpoint acknowledges the existing purchase order without changing its state.',
        ]);
    }
}
