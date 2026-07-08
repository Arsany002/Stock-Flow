<?php

namespace App\Http\Resources\Api\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PurchaseOrderResource extends JsonResource
{
    /**
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'quote_id' => $this->quote_id,
            'status' => $this->status->value,
            'status_label' => $this->status->label(),
            'subtotal' => $this->subtotal,
            'tax' => $this->tax,
            'total' => $this->total,
            'due_date' => $this->due_date?->toDateString(),
            'created_at' => $this->created_at?->toJSON(),
            'business_account' => $this->whenLoaded('businessAccount', fn () => [
                'id' => $this->businessAccount?->id,
                'company_name' => $this->businessAccount?->company_name,
                'credit_limit' => $this->businessAccount?->credit_limit,
                'outstanding_balance' => $this->businessAccount?->outstanding_balance,
            ]),
            'items' => $this->whenLoaded('items', fn () => $this->items->map(fn ($item) => [
                'id' => $item->id,
                'quantity' => $item->quantity,
                'unit_price' => $item->unit_price,
                'product' => [
                    'id' => $item->product?->id,
                    'sku' => $item->product?->sku,
                    'name' => $item->product?->name,
                ],
                'warehouse' => [
                    'id' => $item->warehouse?->id,
                    'code' => $item->warehouse?->code,
                    'name' => $item->warehouse?->name,
                ],
            ])->values()),
            'payments' => $this->whenLoaded('payments', fn () => $this->payments->map(fn ($payment) => [
                'id' => $payment->id,
                'method' => $payment->method->value,
                'status' => $payment->status->value,
                'amount' => $payment->amount,
            ])->values()),
        ];
    }
}
