<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

/**
 * Public self-registration — anyone may submit this. It only ever creates
 * a Retail Customer (see RegisterController); there is deliberately no
 * `role` field here at all, so a request can't even attempt to ask for
 * SuperAdmin/Inventory Manager/Sales/Vendor/Business Buyer — those roles
 * are assigned only by staff via Admin/Users (`user.manage`/`role.manage`).
 */
class RegisterRequest extends FormRequest
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
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'confirmed', Password::defaults()],
        ];
    }

    /**
     * @return array{name: string, email: string, password: string}
     */
    public function registrationData(): array
    {
        return $this->only('name', 'email', 'password');
    }
}
