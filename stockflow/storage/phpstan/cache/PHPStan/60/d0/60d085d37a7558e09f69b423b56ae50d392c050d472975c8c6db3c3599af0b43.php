<?php declare(strict_types = 1);

// osfsl-/var/www/html/vendor/composer/../laravel/passport/src/Token.php-PHPStan\BetterReflection\Reflection\ReflectionClass-Laravel\Passport\Token
return \PHPStan\Cache\CacheItem::__set_state(array(
   'variableKey' => 'v2-4831cabca437dd97a8494b0b4a486ad9addba3bc3e231908a0961aa268b69f15-8.4.23-6.70.0.3',
   'data' => 
  array (
    'locatedSource' => 
    array (
      'class' => 'PHPStan\\BetterReflection\\SourceLocator\\Located\\LocatedSource',
      'data' => 
      array (
        'name' => 'Laravel\\Passport\\Token',
        'filename' => '/var/www/html/vendor/composer/../laravel/passport/src/Token.php',
      ),
    ),
    'namespace' => 'Laravel\\Passport',
    'name' => 'Laravel\\Passport\\Token',
    'shortName' => 'Token',
    'isInterface' => false,
    'isTrait' => false,
    'isEnum' => false,
    'isBackedEnum' => false,
    'modifiers' => 0,
    'docComment' => NULL,
    'attributes' => 
    array (
    ),
    'startLine' => 9,
    'endLine' => 124,
    'startColumn' => 1,
    'endColumn' => 1,
    'parentClassName' => 'Illuminate\\Database\\Eloquent\\Model',
    'implementsClassNames' => 
    array (
    ),
    'traitClassNames' => 
    array (
      0 => 'Laravel\\Passport\\ResolvesInheritedScopes',
    ),
    'immediateConstants' => 
    array (
    ),
    'immediateProperties' => 
    array (
      'table' => 
      array (
        'declaringClassName' => 'Laravel\\Passport\\Token',
        'implementingClassName' => 'Laravel\\Passport\\Token',
        'name' => 'table',
        'modifiers' => 2,
        'type' => NULL,
        'default' => 
        array (
          'code' => '\'oauth_access_tokens\'',
          'attributes' => 
          array (
            'startLine' => 18,
            'endLine' => 18,
            'startTokenPos' => 45,
            'startFilePos' => 354,
            'endTokenPos' => 45,
            'endFilePos' => 374,
          ),
        ),
        'docComment' => '/**
 * The database table used by the model.
 *
 * @var string
 */',
        'attributes' => 
        array (
        ),
        'startLine' => 18,
        'endLine' => 18,
        'startColumn' => 5,
        'endColumn' => 45,
        'isPromoted' => false,
        'declaredAtCompileTime' => true,
        'immediateVirtual' => false,
        'immediateHooks' => 
        array (
        ),
      ),
      'keyType' => 
      array (
        'declaringClassName' => 'Laravel\\Passport\\Token',
        'implementingClassName' => 'Laravel\\Passport\\Token',
        'name' => 'keyType',
        'modifiers' => 2,
        'type' => NULL,
        'default' => 
        array (
          'code' => '\'string\'',
          'attributes' => 
          array (
            'startLine' => 25,
            'endLine' => 25,
            'startTokenPos' => 56,
            'startFilePos' => 486,
            'endTokenPos' => 56,
            'endFilePos' => 493,
          ),
        ),
        'docComment' => '/**
 * The "type" of the primary key ID.
 *
 * @var string
 */',
        'attributes' => 
        array (
        ),
        'startLine' => 25,
        'endLine' => 25,
        'startColumn' => 5,
        'endColumn' => 34,
        'isPromoted' => false,
        'declaredAtCompileTime' => true,
        'immediateVirtual' => false,
        'immediateHooks' => 
        array (
        ),
      ),
      'incrementing' => 
      array (
        'declaringClassName' => 'Laravel\\Passport\\Token',
        'implementingClassName' => 'Laravel\\Passport\\Token',
        'name' => 'incrementing',
        'modifiers' => 1,
        'type' => NULL,
        'default' => 
        array (
          'code' => 'false',
          'attributes' => 
          array (
            'startLine' => 32,
            'endLine' => 32,
            'startTokenPos' => 67,
            'startFilePos' => 615,
            'endTokenPos' => 67,
            'endFilePos' => 619,
          ),
        ),
        'docComment' => '/**
 * Indicates if the IDs are auto-incrementing.
 *
 * @var bool
 */',
        'attributes' => 
        array (
        ),
        'startLine' => 32,
        'endLine' => 32,
        'startColumn' => 5,
        'endColumn' => 33,
        'isPromoted' => false,
        'declaredAtCompileTime' => true,
        'immediateVirtual' => false,
        'immediateHooks' => 
        array (
        ),
      ),
      'guarded' => 
      array (
        'declaringClassName' => 'Laravel\\Passport\\Token',
        'implementingClassName' => 'Laravel\\Passport\\Token',
        'name' => 'guarded',
        'modifiers' => 2,
        'type' => NULL,
        'default' => 
        array (
          'code' => 'false',
          'attributes' => 
          array (
            'startLine' => 39,
            'endLine' => 39,
            'startTokenPos' => 78,
            'startFilePos' => 746,
            'endTokenPos' => 78,
            'endFilePos' => 750,
          ),
        ),
        'docComment' => '/**
 * The guarded attributes on the model.
 *
 * @var array<string>|bool
 */',
        'attributes' => 
        array (
        ),
        'startLine' => 39,
        'endLine' => 39,
        'startColumn' => 5,
        'endColumn' => 31,
        'isPromoted' => false,
        'declaredAtCompileTime' => true,
        'immediateVirtual' => false,
        'immediateHooks' => 
        array (
        ),
      ),
      'casts' => 
      array (
        'declaringClassName' => 'Laravel\\Passport\\Token',
        'implementingClassName' => 'Laravel\\Passport\\Token',
        'name' => 'casts',
        'modifiers' => 2,
        'type' => NULL,
        'default' => 
        array (
          'code' => '[\'scopes\' => \'array\', \'revoked\' => \'bool\', \'expires_at\' => \'datetime\']',
          'attributes' => 
          array (
            'startLine' => 46,
            'endLine' => 50,
            'startTokenPos' => 89,
            'startFilePos' => 893,
            'endTokenPos' => 112,
            'endFilePos' => 993,
          ),
        ),
        'docComment' => '/**
 * The attributes that should be cast to native types.
 *
 * @var array<string, string>
 */',
        'attributes' => 
        array (
        ),
        'startLine' => 46,
        'endLine' => 50,
        'startColumn' => 5,
        'endColumn' => 6,
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
      'client' => 
      array (
        'name' => 'client',
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
        'docComment' => '/**
 * Get the client that the token belongs to.
 *
 * @return \\Illuminate\\Database\\Eloquent\\Relations\\BelongsTo<\\Laravel\\Passport\\Client, $this>
 */',
        'startLine' => 57,
        'endLine' => 60,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'Laravel\\Passport',
        'declaringClassName' => 'Laravel\\Passport\\Token',
        'implementingClassName' => 'Laravel\\Passport\\Token',
        'currentClassName' => 'Laravel\\Passport\\Token',
        'aliasName' => NULL,
      ),
      'refreshToken' => 
      array (
        'name' => 'refreshToken',
        'parameters' => 
        array (
        ),
        'returnsReference' => false,
        'returnType' => 
        array (
          'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
          'data' => 
          array (
            'name' => 'Illuminate\\Database\\Eloquent\\Relations\\HasOne',
            'isIdentifier' => false,
          ),
        ),
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * Get the refresh token associated with the token.
 *
 * @return \\Illuminate\\Database\\Eloquent\\Relations\\HasOne<\\Laravel\\Passport\\RefreshToken, $this>
 */',
        'startLine' => 67,
        'endLine' => 70,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'Laravel\\Passport',
        'declaringClassName' => 'Laravel\\Passport\\Token',
        'implementingClassName' => 'Laravel\\Passport\\Token',
        'currentClassName' => 'Laravel\\Passport\\Token',
        'aliasName' => NULL,
      ),
      'user' => 
      array (
        'name' => 'user',
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
        'docComment' => '/**
 * Get the user that the token belongs to.
 *
 * @deprecated Will be removed in a future Laravel version.
 *
 * @return \\Illuminate\\Database\\Eloquent\\Relations\\BelongsTo<\\Illuminate\\Foundation\\Auth\\User, $this>
 */',
        'startLine' => 79,
        'endLine' => 86,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'Laravel\\Passport',
        'declaringClassName' => 'Laravel\\Passport\\Token',
        'implementingClassName' => 'Laravel\\Passport\\Token',
        'currentClassName' => 'Laravel\\Passport\\Token',
        'aliasName' => NULL,
      ),
      'can' => 
      array (
        'name' => 'can',
        'parameters' => 
        array (
          'scope' => 
          array (
            'name' => 'scope',
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
            'startLine' => 91,
            'endLine' => 91,
            'startColumn' => 25,
            'endColumn' => 37,
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
            'name' => 'bool',
            'isIdentifier' => true,
          ),
        ),
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * Determine if the token has a given scope.
 */',
        'startLine' => 91,
        'endLine' => 99,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'Laravel\\Passport',
        'declaringClassName' => 'Laravel\\Passport\\Token',
        'implementingClassName' => 'Laravel\\Passport\\Token',
        'currentClassName' => 'Laravel\\Passport\\Token',
        'aliasName' => NULL,
      ),
      'cant' => 
      array (
        'name' => 'cant',
        'parameters' => 
        array (
          'scope' => 
          array (
            'name' => 'scope',
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
            'startLine' => 104,
            'endLine' => 104,
            'startColumn' => 26,
            'endColumn' => 38,
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
            'name' => 'bool',
            'isIdentifier' => true,
          ),
        ),
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * Determine if the token is missing a given scope.
 */',
        'startLine' => 104,
        'endLine' => 107,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'Laravel\\Passport',
        'declaringClassName' => 'Laravel\\Passport\\Token',
        'implementingClassName' => 'Laravel\\Passport\\Token',
        'currentClassName' => 'Laravel\\Passport\\Token',
        'aliasName' => NULL,
      ),
      'revoke' => 
      array (
        'name' => 'revoke',
        'parameters' => 
        array (
        ),
        'returnsReference' => false,
        'returnType' => 
        array (
          'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
          'data' => 
          array (
            'name' => 'bool',
            'isIdentifier' => true,
          ),
        ),
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * Revoke the token instance.
 */',
        'startLine' => 112,
        'endLine' => 115,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'Laravel\\Passport',
        'declaringClassName' => 'Laravel\\Passport\\Token',
        'implementingClassName' => 'Laravel\\Passport\\Token',
        'currentClassName' => 'Laravel\\Passport\\Token',
        'aliasName' => NULL,
      ),
      'getConnectionName' => 
      array (
        'name' => 'getConnectionName',
        'parameters' => 
        array (
        ),
        'returnsReference' => false,
        'returnType' => 
        array (
          'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionUnionType',
          'data' => 
          array (
            'types' => 
            array (
              0 => 
              array (
                'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
                'data' => 
                array (
                  'name' => 'string',
                  'isIdentifier' => true,
                ),
              ),
              1 => 
              array (
                'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
                'data' => 
                array (
                  'name' => 'null',
                  'isIdentifier' => true,
                ),
              ),
            ),
          ),
        ),
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * Get the current connection name for the model.
 */',
        'startLine' => 120,
        'endLine' => 123,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'Laravel\\Passport',
        'declaringClassName' => 'Laravel\\Passport\\Token',
        'implementingClassName' => 'Laravel\\Passport\\Token',
        'currentClassName' => 'Laravel\\Passport\\Token',
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