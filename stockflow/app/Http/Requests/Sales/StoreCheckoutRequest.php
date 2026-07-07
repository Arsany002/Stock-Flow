<?php

namespace App\Http\Requests\Sales;

use App\Enums\PaymentMethod;
use App\Models\Order;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreCheckoutRequest extends FormRequest
{
    /**
     * OrderPolicy::create() is the real gate (`sale.create`) — checked here
     * rather than only via route middleware, per the task's explicit "Use
     * OrderPolicy" requirement.
     */
    public function authorize(): bool
    {
        return $this->user()->can('create', Order::class);
    }

    /**
     * @return array<string, array<int, mixed>>
     */
    public function rules(): array
    {
        return [
            'payment_method' => ['required', Rule::in([
                PaymentMethod::Cod->value,
                PaymentMethod::Fake->value,
                PaymentMethod::Paymob->value,
                PaymentMethod::Fawry->value,
            ])],
            // Only meaningful for payment_method=fake — lets a demo/test
            // checkout choose the simulated outcome. Ignored by every other
            // gateway driver.
            'outcome' => ['nullable', Rule::in(['succeed', 'fail'])],
        ];
    }
}
