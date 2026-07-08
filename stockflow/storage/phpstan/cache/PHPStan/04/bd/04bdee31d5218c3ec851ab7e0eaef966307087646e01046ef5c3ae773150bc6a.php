<?php declare(strict_types = 1);

// odsl-/var/www/html/app/Http/Controllers/Web/Admin/AuditLogController.php-PHPStan\BetterReflection\Reflection\ReflectionClass-App\Http\Controllers\Web\Admin\AuditLogController
return \PHPStan\Cache\CacheItem::__set_state(array(
   'variableKey' => 'v2-6.70.0.3-8.4.23-3643da2209da0d14afdad8de7b434a4717618f9cc6beac3431e059c09f63306f',
   'data' => 
  array (
    'locatedSource' => 
    array (
      'class' => 'PHPStan\\BetterReflection\\SourceLocator\\Located\\LocatedSource',
      'data' => 
      array (
        'name' => 'App\\Http\\Controllers\\Web\\Admin\\AuditLogController',
        'filename' => '/var/www/html/app/Http/Controllers/Web/Admin/AuditLogController.php',
      ),
    ),
    'namespace' => 'App\\Http\\Controllers\\Web\\Admin',
    'name' => 'App\\Http\\Controllers\\Web\\Admin\\AuditLogController',
    'shortName' => 'AuditLogController',
    'isInterface' => false,
    'isTrait' => false,
    'isEnum' => false,
    'isBackedEnum' => false,
    'modifiers' => 0,
    'docComment' => NULL,
    'attributes' => 
    array (
    ),
    'startLine' => 13,
    'endLine' => 60,
    'startColumn' => 1,
    'endColumn' => 1,
    'parentClassName' => 'App\\Http\\Controllers\\Controller',
    'implementsClassNames' => 
    array (
    ),
    'traitClassNames' => 
    array (
    ),
    'immediateConstants' => 
    array (
      'EVENTS' => 
      array (
        'declaringClassName' => 'App\\Http\\Controllers\\Web\\Admin\\AuditLogController',
        'implementingClassName' => 'App\\Http\\Controllers\\Web\\Admin\\AuditLogController',
        'name' => 'EVENTS',
        'modifiers' => 4,
        'type' => NULL,
        'value' => 
        array (
          'code' => '[\'stock.adjusted\', \'po.approved\', \'po.rejected\', \'payment.settled\', \'user.roles_updated\', \'role.permissions_updated\']',
          'attributes' => 
          array (
            'startLine' => 23,
            'endLine' => 30,
            'startTokenPos' => 62,
            'startFilePos' => 758,
            'endTokenPos' => 82,
            'endFilePos' => 929,
          ),
        ),
        'docComment' => '/**
 * The fixed set of event names this codebase ever records (see
 * requirement #2 / the *::record() call sites in StockService,
 * PurchaseOrderService, PaymentService, RoleAssignmentService,
 * RolePermissionService). Hardcoded instead of a DISTINCT query so the
 * filter dropdown always lists every possible event, even ones that
 * haven\'t happened yet, without scanning the table on every page load.
 */',
        'attributes' => 
        array (
        ),
        'startLine' => 23,
        'endLine' => 30,
        'startColumn' => 5,
        'endColumn' => 6,
      ),
    ),
    'immediateProperties' => 
    array (
      'audit' => 
      array (
        'declaringClassName' => 'App\\Http\\Controllers\\Web\\Admin\\AuditLogController',
        'implementingClassName' => 'App\\Http\\Controllers\\Web\\Admin\\AuditLogController',
        'name' => 'audit',
        'modifiers' => 132,
        'type' => 
        array (
          'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
          'data' => 
          array (
            'name' => 'App\\Services\\AuditService',
            'isIdentifier' => false,
          ),
        ),
        'default' => NULL,
        'docComment' => NULL,
        'attributes' => 
        array (
        ),
        'startLine' => 32,
        'endLine' => 32,
        'startColumn' => 33,
        'endColumn' => 68,
        'isPromoted' => true,
        'declaredAtCompileTime' => true,
        'immediateVirtual' => false,
        'immediateHooks' => 
        array (
        ),
      ),
    ),
    'immediateMethods' => 
    array (
      '__construct' => 
      array (
        'name' => '__construct',
        'parameters' => 
        array (
          'audit' => 
          array (
            'name' => 'audit',
            'default' => NULL,
            'type' => 
            array (
              'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
              'data' => 
              array (
                'name' => 'App\\Services\\AuditService',
                'isIdentifier' => false,
              ),
            ),
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => true,
            'attributes' => 
            array (
            ),
            'startLine' => 32,
            'endLine' => 32,
            'startColumn' => 33,
            'endColumn' => 68,
            'parameterIndex' => 0,
            'isOptional' => false,
          ),
        ),
        'returnsReference' => false,
        'returnType' => NULL,
        'attributes' => 
        array (
        ),
        'docComment' => NULL,
        'startLine' => 32,
        'endLine' => 32,
        'startColumn' => 5,
        'endColumn' => 72,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'App\\Http\\Controllers\\Web\\Admin',
        'declaringClassName' => 'App\\Http\\Controllers\\Web\\Admin\\AuditLogController',
        'implementingClassName' => 'App\\Http\\Controllers\\Web\\Admin\\AuditLogController',
        'currentClassName' => 'App\\Http\\Controllers\\Web\\Admin\\AuditLogController',
        'aliasName' => NULL,
      ),
      'index' => 
      array (
        'name' => 'index',
        'parameters' => 
        array (
          'request' => 
          array (
            'name' => 'request',
            'default' => NULL,
            'type' => 
            array (
              'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
              'data' => 
              array (
                'name' => 'Illuminate\\Http\\Request',
                'isIdentifier' => false,
              ),
            ),
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 34,
            'endLine' => 34,
            'startColumn' => 27,
            'endColumn' => 42,
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
            'name' => 'Inertia\\Response',
            'isIdentifier' => false,
          ),
        ),
        'attributes' => 
        array (
        ),
        'docComment' => NULL,
        'startLine' => 34,
        'endLine' => 59,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'App\\Http\\Controllers\\Web\\Admin',
        'declaringClassName' => 'App\\Http\\Controllers\\Web\\Admin\\AuditLogController',
        'implementingClassName' => 'App\\Http\\Controllers\\Web\\Admin\\AuditLogController',
        'currentClassName' => 'App\\Http\\Controllers\\Web\\Admin\\AuditLogController',
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