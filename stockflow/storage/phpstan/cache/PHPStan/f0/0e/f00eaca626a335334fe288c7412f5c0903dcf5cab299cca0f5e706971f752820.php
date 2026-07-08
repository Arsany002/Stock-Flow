<?php declare(strict_types = 1);

// odsl-/var/www/html/app/Repositories/Contracts/AuditLogRepositoryInterface.php-PHPStan\BetterReflection\Reflection\ReflectionClass-App\Repositories\Contracts\AuditLogRepositoryInterface
return \PHPStan\Cache\CacheItem::__set_state(array(
   'variableKey' => 'v2-6.70.0.3-8.4.23-7b8df7840cb92acb8c66826de794e08f596d929d93d6c0214da51a0485fadfd6',
   'data' => 
  array (
    'locatedSource' => 
    array (
      'class' => 'PHPStan\\BetterReflection\\SourceLocator\\Located\\LocatedSource',
      'data' => 
      array (
        'name' => 'App\\Repositories\\Contracts\\AuditLogRepositoryInterface',
        'filename' => '/var/www/html/app/Repositories/Contracts/AuditLogRepositoryInterface.php',
      ),
    ),
    'namespace' => 'App\\Repositories\\Contracts',
    'name' => 'App\\Repositories\\Contracts\\AuditLogRepositoryInterface',
    'shortName' => 'AuditLogRepositoryInterface',
    'isInterface' => true,
    'isTrait' => false,
    'isEnum' => false,
    'isBackedEnum' => false,
    'modifiers' => 0,
    'docComment' => NULL,
    'attributes' => 
    array (
    ),
    'startLine' => 9,
    'endLine' => 34,
    'startColumn' => 1,
    'endColumn' => 1,
    'parentClassName' => NULL,
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
      'create' => 
      array (
        'name' => 'create',
        'parameters' => 
        array (
          'attributes' => 
          array (
            'name' => 'attributes',
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
            'startLine' => 17,
            'endLine' => 17,
            'startColumn' => 28,
            'endColumn' => 44,
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
            'name' => 'App\\Models\\ActivityLog',
            'isIdentifier' => false,
          ),
        ),
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * Appends an audit entry. `activity_log` is write-once from the
 * application\'s perspective — nothing ever updates or deletes a row.
 *
 * @param  array<string, mixed>  $attributes
 */',
        'startLine' => 17,
        'endLine' => 17,
        'startColumn' => 5,
        'endColumn' => 59,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'App\\Repositories\\Contracts',
        'declaringClassName' => 'App\\Repositories\\Contracts\\AuditLogRepositoryInterface',
        'implementingClassName' => 'App\\Repositories\\Contracts\\AuditLogRepositoryInterface',
        'currentClassName' => 'App\\Repositories\\Contracts\\AuditLogRepositoryInterface',
        'aliasName' => NULL,
      ),
      'paginate' => 
      array (
        'name' => 'paginate',
        'parameters' => 
        array (
          'perPage' => 
          array (
            'name' => 'perPage',
            'default' => NULL,
            'type' => 
            array (
              'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
              'data' => 
              array (
                'name' => 'int',
                'isIdentifier' => true,
              ),
            ),
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 24,
            'endLine' => 24,
            'startColumn' => 30,
            'endColumn' => 41,
            'parameterIndex' => 0,
            'isOptional' => false,
          ),
          'filters' => 
          array (
            'name' => 'filters',
            'default' => 
            array (
              'code' => '[]',
              'attributes' => 
              array (
                'startLine' => 24,
                'endLine' => 24,
                'startTokenPos' => 64,
                'startFilePos' => 739,
                'endTokenPos' => 65,
                'endFilePos' => 740,
              ),
            ),
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
            'startLine' => 24,
            'endLine' => 24,
            'startColumn' => 44,
            'endColumn' => 62,
            'parameterIndex' => 1,
            'isOptional' => true,
          ),
        ),
        'returnsReference' => false,
        'returnType' => 
        array (
          'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
          'data' => 
          array (
            'name' => 'Illuminate\\Contracts\\Pagination\\LengthAwarePaginator',
            'isIdentifier' => false,
          ),
        ),
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * Paginated, filterable listing for the Admin/AuditLog/Index page.
 *
 * @param  array<string, mixed>  $filters  event, causer_id, subject_type, date_from, date_to
 */',
        'startLine' => 24,
        'endLine' => 24,
        'startColumn' => 5,
        'endColumn' => 86,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'App\\Repositories\\Contracts',
        'declaringClassName' => 'App\\Repositories\\Contracts\\AuditLogRepositoryInterface',
        'implementingClassName' => 'App\\Repositories\\Contracts\\AuditLogRepositoryInterface',
        'currentClassName' => 'App\\Repositories\\Contracts\\AuditLogRepositoryInterface',
        'aliasName' => NULL,
      ),
      'recent' => 
      array (
        'name' => 'recent',
        'parameters' => 
        array (
          'limit' => 
          array (
            'name' => 'limit',
            'default' => 
            array (
              'code' => '5',
              'attributes' => 
              array (
                'startLine' => 33,
                'endLine' => 33,
                'startTokenPos' => 86,
                'startFilePos' => 1051,
                'endTokenPos' => 86,
                'endFilePos' => 1051,
              ),
            ),
            'type' => 
            array (
              'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
              'data' => 
              array (
                'name' => 'int',
                'isIdentifier' => true,
              ),
            ),
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 33,
            'endLine' => 33,
            'startColumn' => 28,
            'endColumn' => 41,
            'parameterIndex' => 0,
            'isOptional' => true,
          ),
        ),
        'returnsReference' => false,
        'returnType' => 
        array (
          'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
          'data' => 
          array (
            'name' => 'Illuminate\\Support\\Collection',
            'isIdentifier' => false,
          ),
        ),
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * The most recent $limit entries — the dashboard\'s "recent activity"
 * KPI. Deliberately unfiltered/unpaginated: it\'s a small, fixed-size
 * peek, not a report.
 *
 * @return Collection<int, ActivityLog>
 */',
        'startLine' => 33,
        'endLine' => 33,
        'startColumn' => 5,
        'endColumn' => 55,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'App\\Repositories\\Contracts',
        'declaringClassName' => 'App\\Repositories\\Contracts\\AuditLogRepositoryInterface',
        'implementingClassName' => 'App\\Repositories\\Contracts\\AuditLogRepositoryInterface',
        'currentClassName' => 'App\\Repositories\\Contracts\\AuditLogRepositoryInterface',
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