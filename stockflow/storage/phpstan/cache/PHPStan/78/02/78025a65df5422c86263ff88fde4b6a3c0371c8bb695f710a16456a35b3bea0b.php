<?php declare(strict_types = 1);

// odsl-/var/www/html/database/seeders/DatabaseSeeder.php-PHPStan\BetterReflection\Reflection\ReflectionClass-Database\Seeders\DatabaseSeeder
return \PHPStan\Cache\CacheItem::__set_state(array(
   'variableKey' => 'v2-6.70.0.3-8.4.23-1c2a7e2b14073fc69cd77cf1123a3681b5d25a89027965787ce1f6e86bc3329f',
   'data' => 
  array (
    'locatedSource' => 
    array (
      'class' => 'PHPStan\\BetterReflection\\SourceLocator\\Located\\LocatedSource',
      'data' => 
      array (
        'name' => 'Database\\Seeders\\DatabaseSeeder',
        'filename' => '/var/www/html/database/seeders/DatabaseSeeder.php',
      ),
    ),
    'namespace' => 'Database\\Seeders',
    'name' => 'Database\\Seeders\\DatabaseSeeder',
    'shortName' => 'DatabaseSeeder',
    'isInterface' => false,
    'isTrait' => false,
    'isEnum' => false,
    'isBackedEnum' => false,
    'modifiers' => 0,
    'docComment' => NULL,
    'attributes' => 
    array (
    ),
    'startLine' => 8,
    'endLine' => 37,
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
        'docComment' => '/**
 * Seed the application\'s database.
 *
 * Flushes the cache first. `migrate:fresh` resets bigint auto-increment
 * IDs (users/roles/permissions all use bigint PKs — see the ERD
 * deviation note in CLAUDE.md), so a freshly-seeded user can be handed
 * the exact same numeric ID a *different* user had in a previous
 * seeding pass. Laratrust\'s permission cache is keyed by that ID
 * (`laratrust_roles_for_users_{id}`) — `migrate:fresh` doesn\'t touch
 * Redis, so a stale "this ID has no roles" entry from before the reset
 * survives and is silently served to the new user, making a
 * newly-seeded SuperAdmin look unauthorized everywhere until the cache
 * happens to expire or is cleared by hand. See docs/technical/cache.md
 * §"Known failure mode: stale Laratrust cache after migrate:fresh".
 */',
        'startLine' => 25,
        'endLine' => 36,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'Database\\Seeders',
        'declaringClassName' => 'Database\\Seeders\\DatabaseSeeder',
        'implementingClassName' => 'Database\\Seeders\\DatabaseSeeder',
        'currentClassName' => 'Database\\Seeders\\DatabaseSeeder',
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