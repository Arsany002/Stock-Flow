<?php

namespace App\Http\Requests\Storefront;

use Illuminate\Foundation\Http\FormRequest;

/**
 * The cart is session state, not a Model, so there's no Policy to defer
 * to — this request has no auth gate at all (guests and authenticated
 * users alike may add to cart). Active/availability checks happen in
 * CartService::add(), not here, so every failure mode (product doesn't
 * exist, is inactive, or is out of stock) redirects back with the same
 * flash-message UX via the generic DomainException handler, instead of
 * some failures being a 422 validation error and others a flash redirect.
 */
class AddToCartRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    /**
     * @return array<string, array<int, mixed>>
     */
    public function rules(): array
    {
        return [
            'product_id' => ['required', 'uuid', 'exists:products,id'],
            'quantity' => ['required', 'integer', 'min:1'],
        ];
    }
}
