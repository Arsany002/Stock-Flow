<?php

namespace App\Http\Requests\Catalog;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePriceListItemRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()->can('updateItem', $this->route('priceListItem'));
    }

    /**
     * @return array<string, array<int, mixed>>
     */
    public function rules(): array
    {
        return [
            'unit_price' => ['required', 'numeric', 'min:0', 'decimal:0,2'],
            'min_qty' => ['required', 'integer', 'min:1'],
        ];
    }
}
