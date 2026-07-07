<?php

namespace App\Http\Requests\Catalog;

use App\Enums\PermissionName;
use App\Enums\UserRole;
use App\Models\Product;
use Illuminate\Foundation\Http\FormRequest;

class StorePriceListItemRequest extends FormRequest
{
    /**
     * A Vendor may only add items for their own products (Enterprise PRD
     * §3, pricelist.manage "own"). There's no PriceListItem yet to hand to
     * a Policy at create time, so the ownership check is done here against
     * the submitted product_id.
     */
    public function authorize(): bool
    {
        $user = $this->user();

        if (! $user->isAbleTo(PermissionName::PricelistManage->value)) {
            return false;
        }

        if (! $user->hasRole(UserRole::VendorSupplier->value)) {
            return true;
        }

        $product = Product::query()->find($this->input('product_id'));

        return $product !== null
            && $product->supplier !== null
            && $product->supplier->user_id === $user->id;
    }

    /**
     * @return array<string, array<int, mixed>>
     */
    public function rules(): array
    {
        return [
            'product_id' => ['required', 'uuid', 'exists:products,id'],
            'unit_price' => ['required', 'numeric', 'min:0', 'decimal:0,2'],
            'min_qty' => ['required', 'integer', 'min:1'],
        ];
    }
}
