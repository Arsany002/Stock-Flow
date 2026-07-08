<?php

namespace App\Http\Requests\Import;

use App\Enums\ImportEntity;
use App\Enums\PermissionName;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreImportRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()?->isAbleTo(PermissionName::ImportRun->value) ?? false;
    }

    /**
     * @return array<string, array<int, mixed>>
     */
    public function rules(): array
    {
        return [
            'entity' => ['required', Rule::in(array_column(ImportEntity::cases(), 'value'))],
            'file' => ['required', 'file', 'mimes:xlsx,xls,csv,txt', 'max:10240'],
        ];
    }
}
