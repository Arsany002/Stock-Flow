<?php

namespace App\Http\Requests\Catalog;

use App\Enums\PriceListType;
use App\Models\PriceList;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StorePriceListRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()->can('create', PriceList::class);
    }

    /**
     * @return array<string, array<int, mixed>>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'type' => ['required', Rule::in(array_column(PriceListType::cases(), 'value'))],
            'is_active' => ['boolean'],
        ];
    }
}
