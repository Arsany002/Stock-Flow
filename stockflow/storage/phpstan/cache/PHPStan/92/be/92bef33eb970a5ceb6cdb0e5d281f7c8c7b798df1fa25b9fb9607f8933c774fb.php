<?php declare(strict_types = 1);

// osfsl-/var/www/html/vendor/composer/../laravel/passport/src/Contracts/OAuthenticatable.php-PHPStan\BetterReflection\Reflection\ReflectionClass-Laravel\Passport\Contracts\OAuthenticatable
return \PHPStan\Cache\CacheItem::__set_state(array(
   'variableKey' => 'v2-ee8ae7f468d3b225c4dda8ba509f4d2c8b9fbe1d961e802ee384e0d422fb1bf4-8.4.23-6.70.0.3',
   'data' => 
  array (
    'locatedSource' => 
    array (
      'class' => 'PHPStan\\BetterReflection\\SourceLocator\\Located\\LocatedSource',
      'data' => 
      array (
        'name' => 'Laravel\\Passport\\Contracts\\OAuthenticatable',
        'filename' => '/var/www/html/vendor/composer/../laravel/passport/src/Contracts/OAuthenticatable.php',
      ),
    ),
    'namespace' => 'Laravel\\Passport\\Contracts',
    'name' => 'Laravel\\Passport\\Contracts\\OAuthenticatable',
    'shortName' => 'OAuthenticatable',
    'isInterface' => true,
    'isTrait' => false,
    'isEnum' => false,
    'isBackedEnum' => false,
    'modifiers' => 0,
    'docComment' => NULL,
    'attributes' => 
    array (
    ),
    'startLine' => 10,
    'endLine' => 57,
    'startColumn' => 1,
    'endColumn' => 1,
    'parentClassName' => NULL,
    'implementsClassNames' => 
    array (
      0 => 'Illuminate\\Contracts\\Auth\\Authenticatable',
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
      'oauthApps' => 
      array (
        'name' => 'oauthApps',
        'parameters' => 
        array (
        ),
        'returnsReference' => false,
        'returnType' => 
        array (
          'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
          'data' => 
          array (
            'name' => 'Illuminate\\Database\\Eloquent\\Relations\\MorphMany',
            'isIdentifier' => false,
          ),
        ),
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * Get all the user\'s registered OAuth applications.
 *
 * @return \\Illuminate\\Database\\Eloquent\\Relations\\MorphMany<\\Laravel\\Passport\\Client, \\Illuminate\\Foundation\\Auth\\User>
 */',
        'startLine' => 17,
        'endLine' => 17,
        'startColumn' => 5,
        'endColumn' => 43,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'Laravel\\Passport\\Contracts',
        'declaringClassName' => 'Laravel\\Passport\\Contracts\\OAuthenticatable',
        'implementingClassName' => 'Laravel\\Passport\\Contracts\\OAuthenticatable',
        'currentClassName' => 'Laravel\\Passport\\Contracts\\OAuthenticatable',
        'aliasName' => NULL,
      ),
      'tokens' => 
      array (
        'name' => 'tokens',
        'parameters' => 
        array (
        ),
        'returnsReference' => false,
        'returnType' => 
        array (
          'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
          'data' => 
          array (
            'name' => 'Illuminate\\Database\\Eloquent\\Relations\\HasMany',
            'isIdentifier' => false,
          ),
        ),
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * Get all the access tokens for the user.
 *
 * @return \\Illuminate\\Database\\Eloquent\\Relations\\HasMany<\\Laravel\\Passport\\Token, \\Illuminate\\Foundation\\Auth\\User>
 */',
        'startLine' => 24,
        'endLine' => 24,
        'startColumn' => 5,
        'endColumn' => 38,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'Laravel\\Passport\\Contracts',
        'declaringClassName' => 'Laravel\\Passport\\Contracts\\OAuthenticatable',
        'implementingClassName' => 'Laravel\\Passport\\Contracts\\OAuthenticatable',
        'currentClassName' => 'Laravel\\Passport\\Contracts\\OAuthenticatable',
        'aliasName' => NULL,
      ),
      'tokenCan' => 
      array (
        'name' => 'tokenCan',
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
            'startLine' => 29,
            'endLine' => 29,
            'startColumn' => 30,
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
            'name' => 'bool',
            'isIdentifier' => true,
          ),
        ),
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * Determine if the current API token has a given scope.
 */',
        'startLine' => 29,
        'endLine' => 29,
        'startColumn' => 5,
        'endColumn' => 50,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'Laravel\\Passport\\Contracts',
        'declaringClassName' => 'Laravel\\Passport\\Contracts\\OAuthenticatable',
        'implementingClassName' => 'Laravel\\Passport\\Contracts\\OAuthenticatable',
        'currentClassName' => 'Laravel\\Passport\\Contracts\\OAuthenticatable',
        'aliasName' => NULL,
      ),
      'tokenCant' => 
      array (
        'name' => 'tokenCant',
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
            'startLine' => 34,
            'endLine' => 34,
            'startColumn' => 31,
            'endColumn' => 43,
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
 * Determine if the current API token is missing a given scope.
 */',
        'startLine' => 34,
        'endLine' => 34,
        'startColumn' => 5,
        'endColumn' => 51,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'Laravel\\Passport\\Contracts',
        'declaringClassName' => 'Laravel\\Passport\\Contracts\\OAuthenticatable',
        'implementingClassName' => 'Laravel\\Passport\\Contracts\\OAuthenticatable',
        'currentClassName' => 'Laravel\\Passport\\Contracts\\OAuthenticatable',
        'aliasName' => NULL,
      ),
      'createToken' => 
      array (
        'name' => 'createToken',
        'parameters' => 
        array (
          'name' => 
          array (
            'name' => 'name',
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
            'startLine' => 41,
            'endLine' => 41,
            'startColumn' => 33,
            'endColumn' => 44,
            'parameterIndex' => 0,
            'isOptional' => false,
          ),
          'scopes' => 
          array (
            'name' => 'scopes',
            'default' => 
            array (
              'code' => '[]',
              'attributes' => 
              array (
                'startLine' => 41,
                'endLine' => 41,
                'startTokenPos' => 118,
                'startFilePos' => 1223,
                'endTokenPos' => 119,
                'endFilePos' => 1224,
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
            'startLine' => 41,
            'endLine' => 41,
            'startColumn' => 47,
            'endColumn' => 64,
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
            'name' => 'Laravel\\Passport\\PersonalAccessTokenResult',
            'isIdentifier' => false,
          ),
        ),
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * Create a new personal access token for the user.
 *
 * @param  string[]  $scopes
 */',
        'startLine' => 41,
        'endLine' => 41,
        'startColumn' => 5,
        'endColumn' => 93,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'Laravel\\Passport\\Contracts',
        'declaringClassName' => 'Laravel\\Passport\\Contracts\\OAuthenticatable',
        'implementingClassName' => 'Laravel\\Passport\\Contracts\\OAuthenticatable',
        'currentClassName' => 'Laravel\\Passport\\Contracts\\OAuthenticatable',
        'aliasName' => NULL,
      ),
      'currentAccessToken' => 
      array (
        'name' => 'currentAccessToken',
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
                  'name' => 'Laravel\\Passport\\Contracts\\ScopeAuthorizable',
                  'isIdentifier' => false,
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
 * Get the access token currently associated with the user.
 */',
        'startLine' => 46,
        'endLine' => 46,
        'startColumn' => 5,
        'endColumn' => 61,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'Laravel\\Passport\\Contracts',
        'declaringClassName' => 'Laravel\\Passport\\Contracts\\OAuthenticatable',
        'implementingClassName' => 'Laravel\\Passport\\Contracts\\OAuthenticatable',
        'currentClassName' => 'Laravel\\Passport\\Contracts\\OAuthenticatable',
        'aliasName' => NULL,
      ),
      'withAccessToken' => 
      array (
        'name' => 'withAccessToken',
        'parameters' => 
        array (
          'accessToken' => 
          array (
            'name' => 'accessToken',
            'default' => NULL,
            'type' => 
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
                      'name' => 'Laravel\\Passport\\Contracts\\ScopeAuthorizable',
                      'isIdentifier' => false,
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
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 51,
            'endLine' => 51,
            'startColumn' => 37,
            'endColumn' => 67,
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
            'name' => 'static',
            'isIdentifier' => false,
          ),
        ),
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * Set the current access token for the user.
 */',
        'startLine' => 51,
        'endLine' => 51,
        'startColumn' => 5,
        'endColumn' => 77,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'Laravel\\Passport\\Contracts',
        'declaringClassName' => 'Laravel\\Passport\\Contracts\\OAuthenticatable',
        'implementingClassName' => 'Laravel\\Passport\\Contracts\\OAuthenticatable',
        'currentClassName' => 'Laravel\\Passport\\Contracts\\OAuthenticatable',
        'aliasName' => NULL,
      ),
      'getProviderName' => 
      array (
        'name' => 'getProviderName',
        'parameters' => 
        array (
        ),
        'returnsReference' => false,
        'returnType' => 
        array (
          'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
          'data' => 
          array (
            'name' => 'string',
            'isIdentifier' => true,
          ),
        ),
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * Get the user provider name.
 */',
        'startLine' => 56,
        'endLine' => 56,
        'startColumn' => 5,
        'endColumn' => 46,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'Laravel\\Passport\\Contracts',
        'declaringClassName' => 'Laravel\\Passport\\Contracts\\OAuthenticatable',
        'implementingClassName' => 'Laravel\\Passport\\Contracts\\OAuthenticatable',
        'currentClassName' => 'Laravel\\Passport\\Contracts\\OAuthenticatable',
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