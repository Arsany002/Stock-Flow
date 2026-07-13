<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCompanyWorkingHoursRequest extends FormRequest
{
    /**
     * Route middleware (`permission:access.manage`) is the real gate.
     */
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
            'days' => ['required', 'array', 'size:7'],
            'days.*.day_of_week' => ['required', 'integer', 'min:0', 'max:6', 'distinct'],
            'days.*.is_open' => ['required', 'boolean'],
            'days.*.opens_at' => ['nullable', 'required_if:days.*.is_open,true', 'date_format:H:i'],
            'days.*.closes_at' => ['nullable', 'required_if:days.*.is_open,true', 'date_format:H:i'],
            'days.*.timezone' => ['nullable', 'string', 'max:64'],
        ];
    }

    /**
     * @return list<array{day_of_week: int, is_open: bool, opens_at: ?string, closes_at: ?string, timezone: string}>
     */
    public function days(): array
    {
        return collect($this->input('days', []))
            ->map(fn (array $day) => [
                'day_of_week' => (int) $day['day_of_week'],
                'is_open' => (bool) $day['is_open'],
                'opens_at' => $day['is_open'] ? $day['opens_at'].':00' : null,
                'closes_at' => $day['is_open'] ? $day['closes_at'].':00' : null,
                'timezone' => $day['timezone'] ?? 'Africa/Cairo',
            ])
            ->all();
    }
}
