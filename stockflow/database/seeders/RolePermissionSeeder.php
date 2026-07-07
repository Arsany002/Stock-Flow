<?php

namespace Database\Seeders;

use App\Enums\PermissionName;
use App\Enums\UserRole;
use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Seeder;

/**
 * Seeds the six roles and full permission catalog from the Enterprise PRD §3
 * permission matrix, and wires each role to its permissions.
 *
 * Cells marked "own" / "team" / "self" in the PRD matrix still grant the base
 * permission to the role here — that scoping is enforced at the
 * controller/service layer (Policies for own/self, Laratrust teams for
 * warehouse-scoped "team" permissions), not by omitting the permission.
 * See docs/project/canonical-decisions.md §3.
 */
class RolePermissionSeeder extends Seeder
{
    /**
     * @var array<string, list<PermissionName>>
     */
    private const MATRIX = [
        // SuperAdmin is granted every permission separately below.
        UserRole::InventoryManager->value => [
            PermissionName::CatalogRead,
            PermissionName::ProductManage,
            PermissionName::CategoryManage,
            PermissionName::StockMove,
            PermissionName::StockTransfer,
            PermissionName::StockRead,
            PermissionName::ImportRun,
            PermissionName::PricelistManage,
            PermissionName::QuotePrice,
            PermissionName::PoApprove,
            PermissionName::PaymentSettle,
            PermissionName::AuditRead,
        ],
        UserRole::SalesCashier->value => [
            PermissionName::CatalogRead,
            PermissionName::StockRead,
            PermissionName::SaleCreate,
            PermissionName::PaymentSettle,
        ],
        UserRole::VendorSupplier->value => [
            PermissionName::CatalogRead,
            PermissionName::ProductManage,   // own price-list items only (Policy)
            PermissionName::StockRead,       // own products only (Policy)
            PermissionName::PricelistManage, // own price-list only (Policy)
            PermissionName::QuotePrice,
        ],
        UserRole::BusinessBuyer->value => [
            PermissionName::CatalogRead,
            PermissionName::QuoteRequest,
        ],
        UserRole::RetailCustomer->value => [
            PermissionName::CatalogRead,
            PermissionName::SaleCreate, // self (own orders only, via Policy)
        ],
    ];

    public function run(): void
    {
        $permissions = collect(PermissionName::cases())->mapWithKeys(
            fn (PermissionName $permission) => [
                $permission->value => Permission::query()->firstOrCreate(
                    ['name' => $permission->value],
                    ['display_name' => $permission->label()]
                ),
            ]
        );

        $roles = collect(UserRole::cases())->mapWithKeys(
            fn (UserRole $role) => [
                $role->value => Role::query()->firstOrCreate(
                    ['name' => $role->value],
                    ['display_name' => $role->label(), 'description' => $role->description()]
                ),
            ]
        );

        /** @var Role $superAdmin */
        $superAdmin = $roles[UserRole::SuperAdmin->value];
        $superAdmin->syncPermissions($permissions->values()->all());

        foreach (self::MATRIX as $roleName => $rolePermissions) {
            $roles[$roleName]->syncPermissions(
                collect($rolePermissions)
                    ->map(fn (PermissionName $permission) => $permissions[$permission->value])
                    ->all()
            );
        }
    }
}
