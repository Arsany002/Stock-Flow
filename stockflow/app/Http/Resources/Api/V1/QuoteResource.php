<?php

namespace App\Http\Resources\Api\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class QuoteResource extends JsonResource
{
    /**
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'status' => $this->status->value,
            'status_label' => $this->status->label(),
            'subtotal' => $this->subtotal,
            'tax' => $this->tax,
            'total' => $this->total,
            'expires_at' => $this->expires_at?->toDateString(),
            'created_at' => $this->created_at?->toJSON(),
            'business_account' => $this->whenLoaded('businessAccount', fn () => [
                'id' => $this->businessAccount?->id,
                'company_name' => $this->businessAccount?->company_name,
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
            ])->values()),
            'purchase_orders' => $this->whenLoaded('purchaseOrders', fn () => $this->purchaseOrders->map(fn ($po) => [
                'id' => $po->id,
                'status' => $po->status->value,
            ])->values()),
        ];
    }
}
