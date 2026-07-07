<?php

namespace App\Http\Requests\Stock;

use App\Models\Warehouse;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreStockAdjustmentRequest extends FormRequest
{
    /**
     * StockPolicy::adjust() does the real (warehouse-team-scoped) check;
     * `warehouse_id` is only in the request body (no route-bound model) so
     * it's resolved here first.
     */
    public function authorize(): bool
    {
        $warehouse = Warehouse::query()->find($this->input('warehouse_id'));

        return $warehouse !== null && $this->user()->can('adjust', $warehouse);
    }

    /**
     * @return array<string, array<int, mixed>>
     */
    public function rules(): array
    {
        return [
            'product_id' => ['required', 'uuid', 'exists:products,id'],
            'warehouse_id' => ['required', 'uuid', 'exists:warehouses,id'],
            'quantity' => ['required', 'integer', Rule::notIn([0])],
            'reason' => ['required', 'string', 'max:255'],
        ];
    }
}
