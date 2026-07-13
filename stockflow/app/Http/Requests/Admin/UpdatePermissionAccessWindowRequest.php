<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePermissionAccessWindowRequest extends FormRequest
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
            'day_of_week' => (int) $this->input('day_of_week'),
            'starts_at' => $this->string('starts_at')->toString().':00',
            'ends_at' => $this->string('ends_at')->toString().':00',
            'timezone' => $this->string('timezone')->toString() ?: 'Africa/Cairo',
            'is_active' => $this->boolean('is_active', true),
            'bypass_for_super_admin' => $this->boolean('bypass_for_super_admin', true),
        ];
    }
}
