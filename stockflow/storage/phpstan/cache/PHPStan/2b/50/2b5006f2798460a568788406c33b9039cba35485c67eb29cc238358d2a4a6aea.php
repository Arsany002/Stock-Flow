<?php declare(strict_types = 1);

// odsl-/var/www/html/database/seeders/DemoCatalogSeeder.php-PHPStan\BetterReflection\Reflection\ReflectionClass-Database\Seeders\DemoCatalogSeeder
return \PHPStan\Cache\CacheItem::__set_state(array(
   'variableKey' => 'v2-6.70.0.3-8.4.23-0ea64f6b4eb55dc7eec8a737aa0c22ba380d72e17a9e63750c20feec61eaa001',
   'data' => 
  array (
    'locatedSource' => 
    array (
      'class' => 'PHPStan\\BetterReflection\\SourceLocator\\Located\\LocatedSource',
      'data' => 
      array (
        'name' => 'Database\\Seeders\\DemoCatalogSeeder',
        'filename' => '/var/www/html/database/seeders/DemoCatalogSeeder.php',
      ),
    ),
    'namespace' => 'Database\\Seeders',
    'name' => 'Database\\Seeders\\DemoCatalogSeeder',
    'shortName' => 'DemoCatalogSeeder',
    'isInterface' => false,
    'isTrait' => false,
    'isEnum' => false,
    'isBackedEnum' => false,
    'modifiers' => 0,
    'docComment' => '/**
 * Demo categories, suppliers, products, price lists, and opening stock.
 * Requires DemoWarehouseSeeder to have run first.
 *
 * Opening stock is recorded as `purchase_in` ledger rows (not just a
 * stock_levels insert), matching FR-7.5 / docs/project/canonical-decisions.md §6:
 * stock_levels is always a projection of stock_movements, never a
 * standalone source of truth.
 */',
    'attributes' => 
    array (
    ),
    'startLine' => 26,
    'endLine' => 119,
    'startColumn' => 1,
    'endColumn' => 1,
    'parentClassName' => 'Illuminate\\Database\\Seeder',
    'implementsClassNames' => 
    array (
    ),
    'traitClassNames' => 
    array (
    ),
    'immediateConstants' => 
    array (
    ),
    'immediateProperties' => 
    array (
    ),
    'immediateMethods' => 
    array (
      'run' => 
      array (
        'name' => 'run',
        'parameters' => 
        array (
        ),
        'returnsReference' => false,
        'returnType' => 
        array (
          'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
          'data' => 
          array (
            'name' => 'void',
            'isIdentifier' => true,
          ),
        ),
        'attributes' => 
        array (
        ),
        'docComment' => NULL,
        'startLine' => 28,
        'endLine' => 118,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'Database\\Seeders',
        'declaringClassName' => 'Database\\Seeders\\DemoCatalogSeeder',
        'implementingClassName' => 'Database\\Seeders\\DemoCatalogSeeder',
        'currentClassName' => 'Database\\Seeders\\DemoCatalogSeeder',
        'aliasName' => NULL,
      ),
    ),
    'traitsData' => 
    array (
      'aliases' => 
      array (
      ),
      'modifiers' => 
      array (
      ),
      'precedences' => 
      array (
      ),
      'hashes' => 
      array (
      ),
    ),
  ),
));