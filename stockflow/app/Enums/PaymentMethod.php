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
    case Fake = 'fake';

    public function label(): string
    {
        return match ($this) {
            self::Paymob => 'Paymob',
            self::Fawry => 'Fawry',
            self::Cod => 'Cash on delivery',
            self::BankTransfer => 'Bank transfer',
            self::Fake => 'Fake gateway (demo)',
        };
    }

    /**
     * Paymob and Fawry have no real integration yet (see app/Payments) — a
     * checkout using either leaves the payment `pending` for manual
     * settlement instead of processing anything. Cod and Fake are both
     * fully wired: Cod stays `pending` until a staff delivery/settlement
     * action; Fake resolves synchronously at checkout time (demo/test only).
     */
    public function isPlaceholder(): bool
    {
        return match ($this) {
            self::Paymob, self::Fawry => true,
            self::Cod, self::BankTransfer, self::Fake => false,
        };
    }
}
