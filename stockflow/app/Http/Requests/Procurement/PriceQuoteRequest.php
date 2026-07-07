<?php

namespace App\Http\Requests\Procurement;

use Illuminate\Foundation\Http\FormRequest;

class PriceQuoteRequest extends FormRequest
{
    /**
     * QuotePolicy::price() does the real (own-pricing-context) check —
     * `quote` here is the route-bound Quote model.
     */
    public function authorize(): bool
    {
        $quote = $this->route('quote');

        return $quote !== null && $this->user()->can('price', $quote);
    }

    /**
     * @return array<string, array<int, mixed>>
     */
    public function rules(): array
    {
        return [
            'prices' => ['required', 'array', 'min:1'],
            'prices.*' => ['required', 'numeric', 'min:0'],
        ];
    }
}
