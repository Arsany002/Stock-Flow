<?php

namespace App\Http\Resources\Api\V1;

use App\Models\PurchaseOrder;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PaymentResource extends JsonResource
{
    /**
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'method' => $this->method->value,
            'method_label' => $this->method->label(),
            'status' => $this->status->value,
            'status_label' => $this->status->label(),
            'amount' => $this->amount,
            'gateway_ref' => $this->gateway_ref,
            'meta' => $this->meta,
            'created_at' => $this->created_at?->toJSON(),
            'payable' => $this->whenLoaded('payable', fn () => $this->payable instanceof PurchaseOrder ? [
                'type' => 'purchase_order',
                'id' => $this->payable->id,
                'status' => $this->payable->status->value,
            ] : null),
        ];
    }
}
