<?php

namespace App\Http\Requests\Admin;

use App\Enums\PermissionName;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateRolePermissionsRequest extends FormRequest
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
            'permissions' => ['present', 'array'],
            'permissions.*' => ['string', Rule::in(array_column(PermissionName::cases(), 'value'))],
        ];
    }

    /**
     * @return list<string>
     */
    public function permissionNames(): array
    {
        return $this->input('permissions', []);
    }
}
