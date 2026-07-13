<?php

namespace App\Http\Requests\Admin;

use App\Enums\PermissionName;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StorePermissionAccessWindowRequest extends FormRequest
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
            'permission_name' => ['required', 'string', Rule::in(array_column(PermissionName::cases(), 'value'))],
            'action' => ['nullable', 'string', 'max:100'],
            'role_id' => ['nullable', 'integer', 'exists:roles,id'],
            'day_of_week' => ['required', 'integer', 'min:0', 'max:6'],
            'starts_at' => ['required', 'date_format:H:i'],
            'ends_at' => ['required', 'date_format:H:i'],
            'timezone' => ['nullable', 'string', 'max:64'],
            'is_active' => ['nullable', 'boolean'],
            'bypass_for_super_admin' => ['nullable', 'boolean'],
        ];
    }

    /**
     * @return array<string, mixed>
     */
    public function attributesToPersist(): array
    {
        return [
            'permission_name' => $this->string('permission_name')->toString(),
            'action' => $this->string('action')->toString() ?: null,
            'role_id' => $this->input('role_id') ?: null,
            'day_of_week' => (int) $this->input('day_of_week'),
            'starts_at' => $this->string('starts_at')->toString().':00',
            'ends_at' => $this->string('ends_at')->toString().':00',
            'timezone' => $this->string('timezone')->toString() ?: 'Africa/Cairo',
            'is_active' => $this->boolean('is_active', true),
            'bypass_for_super_admin' => $this->boolean('bypass_for_super_admin', true),
        ];
    }
}
