<?php

namespace App\Auth;

use App\Enums\PermissionName;
use App\Models\User;
use BackedEnum;
use Laravel\Passport\Client;

class ApiClientPrincipal extends User
{
    public function __construct(private readonly ?Client $apiClient = null)
    {
        parent::__construct([
            'name' => $apiClient?->name ?? 'API client',
            'email' => sprintf('oauth-client-%s@stockflow.local', $apiClient?->getKey() ?? 'boot'),
        ]);

        $this->exists = false;
    }

    public function getAuthIdentifier(): mixed
    {
        return 'oauth-client:'.$this->apiClient?->getKey();
    }

    public function hasRole(
        string|array|BackedEnum $name,
        mixed $team = null,
        bool $requireAll = false
    ): bool {
        return false;
    }

    public function hasPermission(
        string|array|BackedEnum $permission,
        mixed $team = null,
        bool $requireAll = false
    ): bool {
        $permissions = is_array($permission) ? $permission : [$permission];

        foreach ($permissions as $item) {
            $scope = $this->scopeForPermission($item);
            $hasPermission = $scope !== null && $this->tokenCan($scope);

            if ($requireAll && ! $hasPermission) {
                return false;
            }

            if (! $requireAll && $hasPermission) {
                return true;
            }
        }

        return $requireAll;
    }

    public function ability(
        string|array|BackedEnum $roles,
        string|array|BackedEnum $permissions,
        mixed $team = null,
        array $options = []
    ): array|bool {
        return $this->hasPermission($permissions, $team, (bool) ($options['validate_all'] ?? false));
    }

    private function scopeForPermission(string|BackedEnum $permission): ?string
    {
        $permission = $permission instanceof BackedEnum ? $permission->value : $permission;

        return match ($permission) {
            PermissionName::CatalogRead->value => 'catalog:read',
            PermissionName::StockRead->value => 'stock:read',
            default => null,
        };
    }
}
