<?php

namespace App\Http\Requests\Api\V1;

use App\Enums\PermissionName;
use Illuminate\Foundation\Http\FormRequest;

class ListPaymentsRequest extends FormRequest
{
    public function authorize(): bool
    {
        $user = $this->user();

        return $user !== null && (
            $user->isAbleTo(PermissionName::QuoteRequest->value)
            || $user->isAbleTo(PermissionName::PaymentSettle->value)
        );
    }

    /**
     * @return array<string, array<int, mixed>>
     */
    public function rules(): array
    {
        return [
            'per_page' => ['nullable', 'integer', 'min:1', 'max:100'],
        ];
    }
}
