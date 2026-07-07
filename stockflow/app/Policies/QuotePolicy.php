<?php

namespace App\Policies;

use App\Enums\PermissionName;
use App\Enums\UserRole;
use App\Models\Quote;
use App\Models\User;

/**
 * Record-level authorization for B2B quotes (RFQs). `quote.request`
 * (Business Buyer) / `quote.price` (Vendor, Inventory Manager) are the
 * coarse route gates; this Policy adds the "own" scoping: a Business Buyer
 * only ever sees/acts on their own account's quotes, and a Vendor only
 * ever sees/prices quotes containing at least one product they supply
 * ("own pricing context" — Enterprise PRD §3).
 */
class QuotePolicy
{
    public function view(User $user, Quote $quote): bool
    {
        if ($this->ownsAccount($user, $quote)) {
            return true;
        }

        if ($user->hasRole(UserRole::VendorSupplier->value)) {
            return $this->hasOwnLine($user, $quote);
        }

        return $user->isAbleTo(PermissionName::QuotePrice->value) || $user->isAbleTo(PermissionName::PoApprove->value);
    }

    public function create(User $user): bool
    {
        return $user->isAbleTo(PermissionName::QuoteRequest->value);
    }

    /**
     * Sets prices on a quote's lines. A Vendor holding `quote.price` may
     * only price quotes that include one of their own products; Inventory
     * Manager/SuperAdmin (also `quote.price`, but not Vendor) may price any.
     */
    public function price(User $user, Quote $quote): bool
    {
        if (! $user->isAbleTo(PermissionName::QuotePrice->value)) {
            return false;
        }

        if (! $user->hasRole(UserRole::VendorSupplier->value)) {
            return true;
        }

        return $this->hasOwnLine($user, $quote);
    }

    /**
     * accept()/reject() are the owning Business Buyer's decision alone.
     */
    public function accept(User $user, Quote $quote): bool
    {
        return $this->ownsAccount($user, $quote);
    }

    public function reject(User $user, Quote $quote): bool
    {
        return $this->ownsAccount($user, $quote);
    }

    private function ownsAccount(User $user, Quote $quote): bool
    {
        return $quote->businessAccount !== null && $quote->businessAccount->user_id === $user->id;
    }

    private function hasOwnLine(User $user, Quote $quote): bool
    {
        return $quote->items->contains(
            fn ($item) => $item->product?->supplier?->user_id === $user->id
        );
    }
}
