<?php

namespace App\Enums;

/**
 * payments.method — Egyptian payment integrations (PRD §10.1).
 */
enum PaymentMethod: string
{
    case Paymob = 'paymob';
    case Fawry = 'fawry';
    case Cod = 'cod';
    case BankTransfer = 'bank_transfer';

    public function label(): string
    {
        return match ($this) {
            self::Paymob => 'Paymob',
            self::Fawry => 'Fawry',
            self::Cod => 'Cash on delivery',
            self::BankTransfer => 'Bank transfer',
        };
    }
}
