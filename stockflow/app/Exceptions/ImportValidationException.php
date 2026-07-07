<?php

namespace App\Exceptions;

/**
 * Thrown for a single import row that fails validation. Per FR-7.3, one
 * row's failure must not fail the whole batch — the ImportService is
 * expected to catch this per-row, record it against import_rows, and
 * continue processing the rest of the file.
 */
class ImportValidationException extends DomainException
{
    /**
     * @param  array<string, list<string>>  $errors  field => messages
     */
    public static function forRow(int $rowNumber, array $errors): self
    {
        return new self(
            "Row {$rowNumber} failed validation.",
            ['row_number' => $rowNumber, 'errors' => $errors]
        );
    }

    /**
     * @return array<string, list<string>>
     */
    public function errors(): array
    {
        return $this->context()['errors'] ?? [];
    }
}
