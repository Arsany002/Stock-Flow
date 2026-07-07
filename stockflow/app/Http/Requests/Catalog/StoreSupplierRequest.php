<?php

namespace App\Http\Requests\Catalog;

use App\Enums\PermissionName;
use Illuminate\Foundation\Http\FormRequest;

class StoreSupplierRequest extends FormRequest
{
    /**
     * Suppliers have no dedicated PRD permission; gated under
     * `product.manage` since they're a product-catalog concern managed by
     * the same roles (SuperAdmin, Inventory Manager).
     */
    public function authorize(): bool
    {
        return $this->user()->isAbleTo(PermissionName::ProductManage->value);
    }

    /**
     * @return array<string, array<int, mixed>>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['nullable', 'email', 'max:255'],
            'phone' => ['nullable', 'string', 'max:50'],
            'is_active' => ['boolean'],
        ];
    }
}
