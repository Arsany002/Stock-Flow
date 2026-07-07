<?php

namespace App\Http\Requests\Catalog;

use App\Enums\PermissionName;
use Illuminate\Foundation\Http\FormRequest;

class StoreCategoryRequest extends FormRequest
{
    /**
     * Categories have no ownership concept (unlike products/price-list
     * items), so the `category.manage` permission alone — already enforced
     * by route middleware — is the full gate. No CategoryPolicy needed.
     */
    public function authorize(): bool
    {
        return $this->user()->isAbleTo(PermissionName::CategoryManage->value);
    }

    /**
     * @return array<string, array<int, mixed>>
     */
    public function rules(): array
    {
        return [
            'parent_id' => ['nullable', 'uuid', 'exists:categories,id'],
            'name' => ['required', 'string', 'max:255'],
            'slug' => ['required', 'string', 'max:255', 'alpha_dash', 'unique:categories,slug'],
        ];
    }
}
