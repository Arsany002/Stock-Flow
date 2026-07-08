<?php declare(strict_types = 1);

// osfsl-/var/www/html/vendor/composer/../santigarcor/laratrust/src/Console/UpgradeCommand.php-PHPStan\BetterReflection\Reflection\ReflectionClass-Laratrust\Console\UpgradeCommand
return \PHPStan\Cache\CacheItem::__set_state(array(
   'variableKey' => 'v2-cda44760cddcdb6d2c194204342f64c16be42d39da8007a04e56e9db344ae4eb-8.4.23-6.70.0.3',
   'data' => 
  array (
    'locatedSource' => 
    array (
      'class' => 'PHPStan\\BetterReflection\\SourceLocator\\Located\\LocatedSource',
      'data' => 
      array (
        'name' => 'Laratrust\\Console\\UpgradeCommand',
        'filename' => '/var/www/html/vendor/composer/../santigarcor/laratrust/src/Console/UpgradeCommand.php',
      ),
    ),
    'namespace' => 'Laratrust\\Console',
    'name' => 'Laratrust\\Console\\UpgradeCommand',
    'shortName' => 'UpgradeCommand',
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
    'endLine' => 150,
    'startColumn' => 1,
    'endColumn' => 1,
    'parentClassName' => 'Illuminate\\Console\\Command',
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
      'name' => 
      array (
        'declaringClassName' => 'Laratrust\\Console\\UpgradeCommand',
        'implementingClassName' => 'Laratrust\\Console\\UpgradeCommand',
        'name' => 'name',
        'modifiers' => 2,
        'type' => NULL,
        'default' => 
        array (
          'code' => '\'laratrust:upgrade\'',
          'attributes' => 
          array (
            'startLine' => 15,
            'endLine' => 15,
            'startTokenPos' => 35,
            'startFilePos' => 245,
            'endTokenPos' => 35,
            'endFilePos' => 263,
          ),
        ),
        'docComment' => '/**
 * The console command name.
 *
 * @var string
 */',
        'attributes' => 
        array (
        ),
        'startLine' => 15,
        'endLine' => 15,
        'startColumn' => 5,
        'endColumn' => 42,
        'isPromoted' => false,
        'declaredAtCompileTime' => true,
        'immediateVirtual' => false,
        'immediateHooks' => 
        array (
        ),
      ),
      'description' => 
      array (
        'declaringClassName' => 'Laratrust\\Console\\UpgradeCommand',
        'implementingClassName' => 'Laratrust\\Console\\UpgradeCommand',
        'name' => 'description',
        'modifiers' => 2,
        'type' => NULL,
        'default' => 
        array (
          'code' => '\'Creates a migration to upgrade laratrust from version 7.x to 8.x.\'',
          'attributes' => 
          array (
            'startLine' => 22,
            'endLine' => 22,
            'startTokenPos' => 46,
            'startFilePos' => 378,
            'endTokenPos' => 46,
            'endFilePos' => 444,
          ),
        ),
        'docComment' => '/**
 * The console command description.
 *
 * @var string
 */',
        'attributes' => 
        array (
        ),
        'startLine' => 22,
        'endLine' => 22,
        'startColumn' => 5,
        'endColumn' => 97,
        'isPromoted' => false,
        'declaredAtCompileTime' => true,
        'immediateVirtual' => false,
        'immediateHooks' => 
        array (
        ),
      ),
      'migrationSuffix' => 
      array (
        'declaringClassName' => 'Laratrust\\Console\\UpgradeCommand',
        'implementingClassName' => 'Laratrust\\Console\\UpgradeCommand',
        'name' => 'migrationSuffix',
        'modifiers' => 2,
        'type' => NULL,
        'default' => 
        array (
          'code' => '\'laratrust_upgrade_tables\'',
          'attributes' => 
          array (
            'startLine' => 29,
            'endLine' => 29,
            'startTokenPos' => 57,
            'startFilePos' => 560,
            'endTokenPos' => 57,
            'endFilePos' => 585,
          ),
        ),
        'docComment' => '/**
 * Suffix of the migration name.
 *
 * @var string
 */',
        'attributes' => 
        array (
        ),
        'startLine' => 29,
        'endLine' => 29,
        'startColumn' => 5,
        'endColumn' => 60,
        'isPromoted' => false,
        'declaredAtCompileTime' => true,
        'immediateVirtual' => false,
        'immediateHooks' => 
        array (
        ),
      ),
    ),
    'immediateMethods' => 
    array (
      'handle' => 
      array (
        'name' => 'handle',
        'parameters' => 
        array (
        ),
        'returnsReference' => false,
        'returnType' => NULL,
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * Execute the console command.
 *
 * @return void
 */',
        'startLine' => 36,
        'endLine' => 73,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'Laratrust\\Console',
        'declaringClassName' => 'Laratrust\\Console\\UpgradeCommand',
        'implementingClassName' => 'Laratrust\\Console\\UpgradeCommand',
        'currentClassName' => 'Laratrust\\Console\\UpgradeCommand',
        'aliasName' => NULL,
      ),
      'createMigration' => 
      array (
        'name' => 'createMigration',
        'parameters' => 
        array (
        ),
        'returnsReference' => false,
        'returnType' => NULL,
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * Create the migration.
 *
 * @return bool
 */',
        'startLine' => 80,
        'endLine' => 98,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 2,
        'namespace' => 'Laratrust\\Console',
        'declaringClassName' => 'Laratrust\\Console\\UpgradeCommand',
        'implementingClassName' => 'Laratrust\\Console\\UpgradeCommand',
        'currentClassName' => 'Laratrust\\Console\\UpgradeCommand',
        'aliasName' => NULL,
      ),
      'getExistingMigrationsWarning' => 
      array (
        'name' => 'getExistingMigrationsWarning',
        'parameters' => 
        array (
          'existingMigrations' => 
          array (
            'name' => 'existingMigrations',
            'default' => NULL,
            'type' => 
            array (
              'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
              'data' => 
              array (
                'name' => 'array',
                'isIdentifier' => true,
              ),
            ),
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 107,
            'endLine' => 107,
            'startColumn' => 53,
            'endColumn' => 77,
            'parameterIndex' => 0,
            'isOptional' => false,
          ),
        ),
        'returnsReference' => false,
        'returnType' => NULL,
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * Build a warning regarding possible duplication
 * due to already existing migrations.
 *
 * @param  array  $existingMigrations
 * @return string
 */',
        'startLine' => 107,
        'endLine' => 118,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 2,
        'namespace' => 'Laratrust\\Console',
        'declaringClassName' => 'Laratrust\\Console\\UpgradeCommand',
        'implementingClassName' => 'Laratrust\\Console\\UpgradeCommand',
        'currentClassName' => 'Laratrust\\Console\\UpgradeCommand',
        'aliasName' => NULL,
      ),
      'alreadyExistingMigrations' => 
      array (
        'name' => 'alreadyExistingMigrations',
        'parameters' => 
        array (
        ),
        'returnsReference' => false,
        'returnType' => NULL,
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * Check if there is another migration
 * with the same suffix.
 *
 * @return array
 */',
        'startLine' => 126,
        'endLine' => 133,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 2,
        'namespace' => 'Laratrust\\Console',
        'declaringClassName' => 'Laratrust\\Console\\UpgradeCommand',
        'implementingClassName' => 'Laratrust\\Console\\UpgradeCommand',
        'currentClassName' => 'Laratrust\\Console\\UpgradeCommand',
        'aliasName' => NULL,
      ),
      'getMigrationPath' => 
      array (
        'name' => 'getMigrationPath',
        'parameters' => 
        array (
          'date' => 
          array (
            'name' => 'date',
            'default' => 
            array (
              'code' => 'null',
              'attributes' => 
              array (
                'startLine' => 144,
                'endLine' => 144,
                'startTokenPos' => 520,
                'startFilePos' => 3588,
                'endTokenPos' => 520,
                'endFilePos' => 3591,
              ),
            ),
            'type' => NULL,
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 144,
            'endLine' => 144,
            'startColumn' => 41,
            'endColumn' => 52,
            'parameterIndex' => 0,
            'isOptional' => true,
          ),
        ),
        'returnsReference' => false,
        'returnType' => NULL,
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * Get the migration path.
 *
 * The date parameter is optional for ability
 * to provide a custom value or a wildcard.
 *
 * @param  string|null  $date
 * @return string
 */',
        'startLine' => 144,
        'endLine' => 149,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 2,
        'namespace' => 'Laratrust\\Console',
        'declaringClassName' => 'Laratrust\\Console\\UpgradeCommand',
        'implementingClassName' => 'Laratrust\\Console\\UpgradeCommand',
        'currentClassName' => 'Laratrust\\Console\\UpgradeCommand',
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