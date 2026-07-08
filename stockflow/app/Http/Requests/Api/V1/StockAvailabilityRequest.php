<?php

namespace App\Http\Requests\Api\V1;

use App\Enums\PermissionName;
use Illuminate\Foundation\Http\FormRequest;

class StockAvailabilityRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()?->isAbleTo(PermissionName::StockRead->value) ?? false;
    }

    /**
     * @return array<string, array<int, mixed>>
     */
    public function rules(): array
    {
        return [
            'product_id' => ['nullable', 'uuid', 'exists:products,id'],
            'warehouse_id' => ['nullable', 'uuid', 'exists:warehouses,id'],
            'per_page' => ['nullable', 'integer', 'min:1', 'max:100'],
        ];
    }
}
