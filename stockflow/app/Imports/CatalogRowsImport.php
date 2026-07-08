<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithCalculatedFormulas;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class CatalogRowsImport implements SkipsEmptyRows, ToCollection, WithCalculatedFormulas, WithHeadingRow
{
    /**
     * @var Collection<int, array<string, mixed>>
     */
    private Collection $rows;

    public function __construct()
    {
        $this->rows = collect();
    }

    /**
     * @param  Collection<int, mixed>  $rows
     */
    public function collection(Collection $rows): void
    {
        $this->rows = $rows
            ->map(fn ($row) => collect($row)->toArray())
            ->values();
    }

    /**
     * @return Collection<int, array<string, mixed>>
     */
    public function rows(): Collection
    {
        return $this->rows;
    }
}
