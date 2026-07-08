<?php declare(strict_types = 1);

// odsl-/var/www/html/app/Exceptions/UnauthorizedWarehouseException.php-PHPStan\BetterReflection\Reflection\ReflectionClass-App\Exceptions\UnauthorizedWarehouseException
return \PHPStan\Cache\CacheItem::__set_state(array(
   'variableKey' => 'v2-6.70.0.3-8.4.23-8308890ead925ec162c9d8bfe9b39df80ad87221cfc52269638d688fb564a63b',
   'data' => 
  array (
    'locatedSource' => 
    array (
      'class' => 'PHPStan\\BetterReflection\\SourceLocator\\Located\\LocatedSource',
      'data' => 
      array (
        'name' => 'App\\Exceptions\\UnauthorizedWarehouseException',
        'filename' => '/var/www/html/app/Exceptions/UnauthorizedWarehouseException.php',
      ),
    ),
    'namespace' => 'App\\Exceptions',
    'name' => 'App\\Exceptions\\UnauthorizedWarehouseException',
    'shortName' => 'UnauthorizedWarehouseException',
    'isInterface' => false,
    'isTrait' => false,
    'isEnum' => false,
    'isBackedEnum' => false,
    'modifiers' => 0,
    'docComment' => '/**
 * Thrown when a warehouse-scoped action (stock.move, stock.transfer) is
 * attempted against a warehouse outside the actor\'s assigned Laratrust
 * team(s).
 *
 * @see docs/project/canonical-decisions.md §3 — warehouse-scoping via
 *      Laratrust teams (one team per warehouse).
 */',
    'attributes' => 
    array (
    ),
    'startLine' => 13,
    'endLine' => 22,
    'startColumn' => 1,
    'endColumn' => 1,
    'parentClassName' => 'App\\Exceptions\\DomainException',
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
      'forWarehouse' => 
      array (
        'name' => 'forWarehouse',
        'parameters' => 
        array (
          'warehouseId' => 
          array (
            'name' => 'warehouseId',
            'default' => NULL,
            'type' => 
            array (
              'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
              'data' => 
              array (
                'name' => 'string',
                'isIdentifier' => true,
              ),
            ),
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 15,
            'endLine' => 15,
            'startColumn' => 41,
            'endColumn' => 59,
            'parameterIndex' => 0,
            'isOptional' => false,
          ),
        ),
        'returnsReference' => false,
        'returnType' => 
        array (
          'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
          'data' => 
          array (
            'name' => 'self',
            'isIdentifier' => false,
          ),
        ),
        'attributes' => 
        array (
        ),
        'docComment' => NULL,
        'startLine' => 15,
        'endLine' => 21,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 17,
        'namespace' => 'App\\Exceptions',
        'declaringClassName' => 'App\\Exceptions\\UnauthorizedWarehouseException',
        'implementingClassName' => 'App\\Exceptions\\UnauthorizedWarehouseException',
        'currentClassName' => 'App\\Exceptions\\UnauthorizedWarehouseException',
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