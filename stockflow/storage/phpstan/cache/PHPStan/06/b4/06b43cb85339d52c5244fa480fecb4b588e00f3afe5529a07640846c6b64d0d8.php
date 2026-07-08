<?php declare(strict_types = 1);

// odsl-/var/www/html/app/Models/Team.php-PHPStan\BetterReflection\Reflection\ReflectionClass-App\Models\Team
return \PHPStan\Cache\CacheItem::__set_state(array(
   'variableKey' => 'v2-6.70.0.3-8.4.23-36c3bf16a28297672db9362db8577135153a6217a4e2614657bed8fc4b6ecf0d',
   'data' => 
  array (
    'locatedSource' => 
    array (
      'class' => 'PHPStan\\BetterReflection\\SourceLocator\\Located\\LocatedSource',
      'data' => 
      array (
        'name' => 'App\\Models\\Team',
        'filename' => '/var/www/html/app/Models/Team.php',
      ),
    ),
    'namespace' => 'App\\Models',
    'name' => 'App\\Models\\Team',
    'shortName' => 'Team',
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
    'endLine' => 28,
    'startColumn' => 1,
    'endColumn' => 1,
    'parentClassName' => 'Laratrust\\Models\\Team',
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
      'guarded' => 
      array (
        'declaringClassName' => 'App\\Models\\Team',
        'implementingClassName' => 'App\\Models\\Team',
        'name' => 'guarded',
        'modifiers' => 1,
        'type' => NULL,
        'default' => 
        array (
          'code' => '[]',
          'attributes' => 
          array (
            'startLine' => 10,
            'endLine' => 10,
            'startTokenPos' => 37,
            'startFilePos' => 186,
            'endTokenPos' => 38,
            'endFilePos' => 187,
          ),
        ),
        'docComment' => NULL,
        'attributes' => 
        array (
        ),
        'startLine' => 10,
        'endLine' => 10,
        'startColumn' => 5,
        'endColumn' => 25,
        'isPromoted' => false,
        'declaredAtCompileTime' => true,
        'immediateVirtual' => false,
        'immediateHooks' => 
        array (
        ),
      ),
      'fillable' => 
      array (
        'declaringClassName' => 'App\\Models\\Team',
        'implementingClassName' => 'App\\Models\\Team',
        'name' => 'fillable',
        'modifiers' => 2,
        'type' => NULL,
        'default' => 
        array (
          'code' => '[\'name\', \'display_name\', \'description\', \'warehouse_id\']',
          'attributes' => 
          array (
            'startLine' => 22,
            'endLine' => 22,
            'startTokenPos' => 49,
            'startFilePos' => 777,
            'endTokenPos' => 60,
            'endFilePos' => 831,
          ),
        ),
        'docComment' => '/**
 * The parent Laratrust\\Models\\Team declares $fillable =
 * [\'name\', \'display_name\', \'description\']. Since that property is
 * non-empty, Eloquent uses it instead of falling back to our $guarded
 * above (redeclaring a parent\'s protected property doesn\'t erase it —
 * PHP property inheritance just shadows it, and Eloquent\'s
 * isFillable() checks $fillable first whenever it\'s non-empty). That
 * silently stripped `warehouse_id` from mass-assignment. Redeclaring
 * $fillable here to include it is the fix.
 */',
        'attributes' => 
        array (
        ),
        'startLine' => 22,
        'endLine' => 22,
        'startColumn' => 5,
        'endColumn' => 82,
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
      'warehouse' => 
      array (
        'name' => 'warehouse',
        'parameters' => 
        array (
        ),
        'returnsReference' => false,
        'returnType' => 
        array (
          'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
          'data' => 
          array (
            'name' => 'Illuminate\\Database\\Eloquent\\Relations\\BelongsTo',
            'isIdentifier' => false,
          ),
        ),
        'attributes' => 
        array (
        ),
        'docComment' => NULL,
        'startLine' => 24,
        'endLine' => 27,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'App\\Models',
        'declaringClassName' => 'App\\Models\\Team',
        'implementingClassName' => 'App\\Models\\Team',
        'currentClassName' => 'App\\Models\\Team',
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