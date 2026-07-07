<?php

namespace App\Http\Requests\Stock;

use App\Models\Warehouse;
use Illuminate\Foundation\Http\FormRequest;

class StoreStockTransferRequest extends FormRequest
{
    /**
     * StockPolicy::transfer() does the real (warehouse-team-scoped) check
     * against both warehouses; they're only in the request body (no
     * route-bound model) so they're resolved here first.
     */
    public function authorize(): bool
    {
        $from = Warehouse::query()->find($this->input('from_warehouse_id'));
        $to = Warehouse::query()->find($this->input('to_warehouse_id'));

        return $from !== null && $to !== null && $this->user()->can('transfer', [Warehouse::class, $from, $to]);
    }

    /**
     * @return array<string, array<int, mixed>>
     */
    public function rules(): array
    {
        return [
            'product_id' => ['required', 'uuid', 'exists:products,id'],
            'from_warehouse_id' => ['required', 'uuid', 'exists:warehouses,id'],
            'to_warehouse_id' => ['required', 'uuid', 'exists:warehouses,id', 'different:from_warehouse_id'],
            'quantity' => ['required', 'integer', 'min:1'],
        ];
    }
}
