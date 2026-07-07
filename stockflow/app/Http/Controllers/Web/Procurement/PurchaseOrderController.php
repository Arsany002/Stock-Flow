<?php

namespace App\Http\Controllers\Web\Procurement;

use App\Enums\PaymentMethod;
use App\Http\Controllers\Controller;
use App\Http\Requests\Procurement\ApprovePurchaseOrderRequest;
use App\Http\Requests\Procurement\RejectPurchaseOrderRequest;
use App\Http\Requests\Procurement\StoreBankTransferSettlementRequest;
use App\Models\PurchaseOrder;
use App\Services\PaymentService;
use App\Services\PurchaseOrderService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Inertia\Response;

class PurchaseOrderController extends Controller
{
    public function __construct(
        private readonly PurchaseOrderService $purchaseOrders,
        private readonly PaymentService $payments,
    ) {}

    public function index(): Response
    {
        $businessAccount = Auth::user()->businessAccount;

        $purchaseOrders = $this->purchaseOrders->listForViewer($businessAccount)->through(fn (PurchaseOrder $po) => [
            'id' => $po->id,
            'status' => $po->status->value,
            'status_label' => $po->status->label(),
            'total' => $po->total,
            'created_at' => $po->created_at,
        ]);

        return Inertia::render('Procurement/PurchaseOrders/Index', [
            'purchaseOrders' => $purchaseOrders,
        ]);
    }

    public function show(PurchaseOrder $purchaseOrder): Response
    {
        $this->authorize('view', $purchaseOrder);

        $purchaseOrder->load(['items.product', 'items.warehouse', 'businessAccount', 'approvals.approver', 'payments']);
        $user = Auth::user();

        return Inertia::render('Procurement/PurchaseOrders/Show', [
            'purchaseOrder' => [
                'id' => $purchaseOrder->id,
                'status' => $purchaseOrder->status->value,
                'status_label' => $purchaseOrder->status->label(),
                'subtotal' => $purchaseOrder->subtotal,
                'tax' => $purchaseOrder->tax,
                'total' => $purchaseOrder->total,
                'due_date' => $purchaseOrder->due_date,
                'created_at' => $purchaseOrder->created_at,
                'business_account' => $purchaseOrder->businessAccount->only([
                    'id', 'company_name', 'credit_limit', 'outstanding_balance',
                ]),
                'items' => $purchaseOrder->items->map(fn ($item) => [
                    'id' => $item->id,
                    'product' => $item->product->only(['id', 'name', 'sku']),
                    'warehouse' => $item->warehouse->only(['id', 'name']),
                    'quantity' => $item->quantity,
                    'unit_price' => $item->unit_price,
                ]),
                'approvals' => $purchaseOrder->approvals->map(fn ($approval) => [
                    'id' => $approval->id,
                    'decision' => $approval->decision->value,
                    'note' => $approval->note,
                    'approver' => $approval->approver->only(['id', 'name']),
                    'created_at' => $approval->created_at,
                ]),
                'payments' => $purchaseOrder->payments->map(fn ($payment) => [
                    'id' => $payment->id,
                    'method_label' => $payment->method->label(),
                    'status_label' => $payment->status->label(),
                    'amount' => $payment->amount,
                ]),
            ],
            'canApprove' => $user->can('approve', $purchaseOrder),
            'canReject' => $user->can('reject', $purchaseOrder),
            'canSettle' => $user->can('settle', $purchaseOrder),
        ]);
    }

    public function approveCreate(PurchaseOrder $purchaseOrder): Response
    {
        $this->authorize('approve', $purchaseOrder);

        $purchaseOrder->load('businessAccount');
        $account = $purchaseOrder->businessAccount;
        $projectedBalance = bcadd($account->outstanding_balance, $purchaseOrder->total, 2);

        return Inertia::render('Procurement/PurchaseOrders/Approve', [
            'purchaseOrder' => [
                'id' => $purchaseOrder->id,
                'total' => $purchaseOrder->total,
                'business_account' => $account->only(['id', 'company_name', 'credit_limit', 'outstanding_balance']),
            ],
            'projectedBalance' => $projectedBalance,
            'withinCreditLimit' => bccomp($projectedBalance, $account->credit_limit, 2) <= 0,
        ]);
    }

    public function approve(ApprovePurchaseOrderRequest $request, PurchaseOrder $purchaseOrder): RedirectResponse
    {
        $this->purchaseOrders->approve($purchaseOrder, Auth::user(), $request->validated('note'));

        return redirect()->route('procurement.purchase-orders.show', $purchaseOrder)
            ->with('flash.success', 'Purchase order approved — stock reserved.');
    }

    public function reject(RejectPurchaseOrderRequest $request, PurchaseOrder $purchaseOrder): RedirectResponse
    {
        $this->purchaseOrders->reject($purchaseOrder, Auth::user(), $request->validated('note'));

        return redirect()->route('procurement.purchase-orders.show', $purchaseOrder)
            ->with('flash.success', 'Purchase order rejected.');
    }

    public function bankTransferCreate(PurchaseOrder $purchaseOrder): Response
    {
        $this->authorize('settle', $purchaseOrder);

        return Inertia::render('Procurement/PurchaseOrders/BankTransferSettlement', [
            'purchaseOrder' => [
                'id' => $purchaseOrder->id,
                'status' => $purchaseOrder->status->value,
                'total' => $purchaseOrder->total,
            ],
        ]);
    }

    public function bankTransferStore(StoreBankTransferSettlementRequest $request, PurchaseOrder $purchaseOrder): RedirectResponse
    {
        $payment = $this->payments->initiate(
            $purchaseOrder,
            PaymentMethod::BankTransfer,
            (float) $purchaseOrder->total,
            ['reference' => $request->validated('reference')]
        );

        $this->payments->settleManually($payment);
        $this->purchaseOrders->settle($purchaseOrder, Auth::user());

        return redirect()->route('procurement.purchase-orders.show', $purchaseOrder)
            ->with('flash.success', 'Bank transfer settled — order fulfilled.');
    }

    public function close(PurchaseOrder $purchaseOrder): RedirectResponse
    {
        $this->authorize('settle', $purchaseOrder);

        $this->purchaseOrders->close($purchaseOrder);

        return redirect()->route('procurement.purchase-orders.show', $purchaseOrder)
            ->with('flash.success', 'Purchase order closed.');
    }
}
