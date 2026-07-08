<?php

namespace App\Http\Requests\Api\V1;

use App\Models\PurchaseOrder;
use Illuminate\Foundation\Http\FormRequest;

class StoreBankTransferProofRequest extends FormRequest
{
    public function authorize(): bool
    {
        $purchaseOrder = PurchaseOrder::query()->find($this->input('purchase_order_id'));

        return $purchaseOrder !== null
            && ($this->user()?->can('view', $purchaseOrder) ?? false);
    }

    /**
     * @return array<string, array<int, mixed>>
     */
    public function rules(): array
    {
        return [
            'purchase_order_id' => ['required', 'uuid', 'exists:purchase_orders,id'],
            'reference' => ['required', 'string', 'max:255'],
            'proof_url' => ['nullable', 'url', 'max:2048'],
            'proof_note' => ['nullable', 'string', 'max:1000'],
        ];
    }
}
