<?php

namespace App\Http\Requests\Admin;

use App\Enums\UserRole;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateUserRolesRequest extends FormRequest
{
    /**
     * Route middleware (`permission:role.manage`) is the real gate; this
     * FormRequest only validates shape.
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
            'roles' => ['present', 'array'],
            'roles.*' => ['string', Rule::in(array_column(UserRole::cases(), 'value'))],
        ];
    }

    /**
     * @return list<string>
     */
    public function roleNames(): array
    {
        return $this->input('roles', []);
    }
}
