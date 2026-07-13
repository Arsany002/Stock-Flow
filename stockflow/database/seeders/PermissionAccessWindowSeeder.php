<?php

namespace Database\Seeders;

use App\Enums\PermissionName;
use App\Models\PermissionAccessWindow;
use App\Support\Access\AccessAction;
use Illuminate\Database\Seeder;

/**
 * Example action-specific access windows, stricter than (and overriding)
 * the global company_working_hours schedule — see
 * AccessWindowService::hasActiveWindows(). Saturday-Thursday here means
 * day_of_week 6,0,1,2,3,4 (Carbon: 0=Sunday..6=Saturday); Friday (5) is
 * deliberately left with no row for most of these, so it falls through to
 * "no window matches today" => blocked, same as the company being closed
 * Friday. checkout.confirm gets its own explicit (wider) Friday window
 * per the brief.
 */
class PermissionAccessWindowSeeder extends Seeder
{
    private const SAT_TO_THU = [6, 0, 1, 2, 3, 4];

    public function run(): void
    {
        $this->seedRange(PermissionName::StockMove->value, AccessAction::STOCK_MOVE, self::SAT_TO_THU, '09:00:00', '17:00:00');
        $this->seedRange(PermissionName::StockTransfer->value, AccessAction::STOCK_TRANSFER, self::SAT_TO_THU, '09:00:00', '17:00:00');
        $this->seedRange(PermissionName::PaymentSettle->value, AccessAction::PAYMENT_SETTLE, self::SAT_TO_THU, '10:00:00', '16:00:00');
        $this->seedRange(PermissionName::PoApprove->value, AccessAction::PO_APPROVE, self::SAT_TO_THU, '10:00:00', '17:00:00');
        $this->seedRange(PermissionName::ImportRun->value, AccessAction::IMPORT_RUN, self::SAT_TO_THU, '09:00:00', '15:00:00');

        $this->seedRange(PermissionName::SaleCreate->value, AccessAction::CHECKOUT_CONFIRM, self::SAT_TO_THU, '09:00:00', '23:00:00');
        $this->seedRange(PermissionName::SaleCreate->value, AccessAction::CHECKOUT_CONFIRM, [5], '12:00:00', '23:00:00');
    }

    /**
     * @param  list<int>  $days
     */
    private function seedRange(string $permission, string $action, array $days, string $startsAt, string $endsAt): void
    {
        foreach ($days as $day) {
            PermissionAccessWindow::query()->updateOrCreate(
                [
                    'permission_name' => $permission,
                    'action' => $action,
                    'role_id' => null,
                    'day_of_week' => $day,
                ],
                [
                    'starts_at' => $startsAt,
                    'ends_at' => $endsAt,
                    'timezone' => 'Africa/Cairo',
                    'is_active' => true,
                    'bypass_for_super_admin' => true,
                ],
            );
        }
    }
}
