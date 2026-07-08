<?php declare(strict_types = 1);

// osfsl-/var/www/html/vendor/composer/../laravel/passport/src/Console/ClientCommand.php-PHPStan\BetterReflection\Reflection\ReflectionClass-Laravel\Passport\Console\ClientCommand
return \PHPStan\Cache\CacheItem::__set_state(array(
   'variableKey' => 'v2-e6b3b7800b777ef2591ee215307d6750fd6b9b66c536be8b61b84b44332ba3a9-8.4.23-6.70.0.3',
   'data' => 
  array (
    'locatedSource' => 
    array (
      'class' => 'PHPStan\\BetterReflection\\SourceLocator\\Located\\LocatedSource',
      'data' => 
      array (
        'name' => 'Laravel\\Passport\\Console\\ClientCommand',
        'filename' => '/var/www/html/vendor/composer/../laravel/passport/src/Console/ClientCommand.php',
      ),
    ),
    'namespace' => 'Laravel\\Passport\\Console',
    'name' => 'Laravel\\Passport\\Console\\ClientCommand',
    'shortName' => 'ClientCommand',
    'isInterface' => false,
    'isTrait' => false,
    'isEnum' => false,
    'isBackedEnum' => false,
    'modifiers' => 0,
    'docComment' => NULL,
    'attributes' => 
    array (
      0 => 
      array (
        'name' => 'Symfony\\Component\\Console\\Attribute\\AsCommand',
        'isRepeated' => false,
        'arguments' => 
        array (
          'name' => 
          array (
            'code' => '\'passport:client\'',
            'attributes' => 
            array (
              'startLine' => 11,
              'endLine' => 11,
              'startTokenPos' => 38,
              'startFilePos' => 245,
              'endTokenPos' => 38,
              'endFilePos' => 261,
            ),
          ),
        ),
      ),
    ),
    'startLine' => 11,
    'endLine' => 160,
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
      'signature' => 
      array (
        'declaringClassName' => 'Laravel\\Passport\\Console\\ClientCommand',
        'implementingClassName' => 'Laravel\\Passport\\Console\\ClientCommand',
        'name' => 'signature',
        'modifiers' => 2,
        'type' => NULL,
        'default' => 
        array (
          'code' => '\'passport:client
            {--personal : Create a personal access token client}
            {--password : Create a password grant client}
            {--client : Create a client credentials grant client}
            {--implicit : Create an implicit grant client}
            {--device : Create a device authorization grant client}
            {--name= : The name of the client}
            {--provider= : The name of the user provider}
            {--redirect_uri= : The URI to redirect to after authorization }
            {--public : Create a public client (without secret) }\'',
          'attributes' => 
          array (
            'startLine' => 19,
            'endLine' => 28,
            'startTokenPos' => 60,
            'startFilePos' => 426,
            'endTokenPos' => 60,
            'endFilePos' => 1005,
          ),
        ),
        'docComment' => '/**
 * The name and signature of the console command.
 *
 * @var string
 */',
        'attributes' => 
        array (
        ),
        'startLine' => 19,
        'endLine' => 28,
        'startColumn' => 5,
        'endColumn' => 67,
        'isPromoted' => false,
        'declaredAtCompileTime' => true,
        'immediateVirtual' => false,
        'immediateHooks' => 
        array (
        ),
      ),
      'description' => 
      array (
        'declaringClassName' => 'Laravel\\Passport\\Console\\ClientCommand',
        'implementingClassName' => 'Laravel\\Passport\\Console\\ClientCommand',
        'name' => 'description',
        'modifiers' => 2,
        'type' => NULL,
        'default' => 
        array (
          'code' => '\'Create a client for issuing access tokens\'',
          'attributes' => 
          array (
            'startLine' => 35,
            'endLine' => 35,
            'startTokenPos' => 71,
            'startFilePos' => 1120,
            'endTokenPos' => 71,
            'endFilePos' => 1162,
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
        'startLine' => 35,
        'endLine' => 35,
        'startColumn' => 5,
        'endColumn' => 73,
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
          'clients' => 
          array (
            'name' => 'clients',
            'default' => NULL,
            'type' => 
            array (
              'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
              'data' => 
              array (
                'name' => 'Laravel\\Passport\\ClientRepository',
                'isIdentifier' => false,
              ),
            ),
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 40,
            'endLine' => 40,
            'startColumn' => 28,
            'endColumn' => 52,
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
            'name' => 'void',
            'isIdentifier' => true,
          ),
        ),
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * Execute the console command.
 */',
        'startLine' => 40,
        'endLine' => 68,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'Laravel\\Passport\\Console',
        'declaringClassName' => 'Laravel\\Passport\\Console\\ClientCommand',
        'implementingClassName' => 'Laravel\\Passport\\Console\\ClientCommand',
        'currentClassName' => 'Laravel\\Passport\\Console\\ClientCommand',
        'aliasName' => NULL,
      ),
      'createPersonalAccessClient' => 
      array (
        'name' => 'createPersonalAccessClient',
        'parameters' => 
        array (
          'clients' => 
          array (
            'name' => 'clients',
            'default' => NULL,
            'type' => 
            array (
              'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
              'data' => 
              array (
                'name' => 'Laravel\\Passport\\ClientRepository',
                'isIdentifier' => false,
              ),
            ),
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 73,
            'endLine' => 73,
            'startColumn' => 51,
            'endColumn' => 75,
            'parameterIndex' => 0,
            'isOptional' => false,
          ),
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
                  'name' => 'Laravel\\Passport\\Client',
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
 * Create a new personal access client.
 */',
        'startLine' => 73,
        'endLine' => 85,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 2,
        'namespace' => 'Laravel\\Passport\\Console',
        'declaringClassName' => 'Laravel\\Passport\\Console\\ClientCommand',
        'implementingClassName' => 'Laravel\\Passport\\Console\\ClientCommand',
        'currentClassName' => 'Laravel\\Passport\\Console\\ClientCommand',
        'aliasName' => NULL,
      ),
      'createPasswordClient' => 
      array (
        'name' => 'createPasswordClient',
        'parameters' => 
        array (
          'clients' => 
          array (
            'name' => 'clients',
            'default' => NULL,
            'type' => 
            array (
              'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
              'data' => 
              array (
                'name' => 'Laravel\\Passport\\ClientRepository',
                'isIdentifier' => false,
              ),
            ),
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 90,
            'endLine' => 90,
            'startColumn' => 45,
            'endColumn' => 69,
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
            'name' => 'Laravel\\Passport\\Client',
            'isIdentifier' => false,
          ),
        ),
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * Create a new password grant client.
 */',
        'startLine' => 90,
        'endLine' => 104,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 2,
        'namespace' => 'Laravel\\Passport\\Console',
        'declaringClassName' => 'Laravel\\Passport\\Console\\ClientCommand',
        'implementingClassName' => 'Laravel\\Passport\\Console\\ClientCommand',
        'currentClassName' => 'Laravel\\Passport\\Console\\ClientCommand',
        'aliasName' => NULL,
      ),
      'createClientCredentialsClient' => 
      array (
        'name' => 'createClientCredentialsClient',
        'parameters' => 
        array (
          'clients' => 
          array (
            'name' => 'clients',
            'default' => NULL,
            'type' => 
            array (
              'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
              'data' => 
              array (
                'name' => 'Laravel\\Passport\\ClientRepository',
                'isIdentifier' => false,
              ),
            ),
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 109,
            'endLine' => 109,
            'startColumn' => 54,
            'endColumn' => 78,
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
            'name' => 'Laravel\\Passport\\Client',
            'isIdentifier' => false,
          ),
        ),
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * Create a client credentials grant client.
 */',
        'startLine' => 109,
        'endLine' => 112,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 2,
        'namespace' => 'Laravel\\Passport\\Console',
        'declaringClassName' => 'Laravel\\Passport\\Console\\ClientCommand',
        'implementingClassName' => 'Laravel\\Passport\\Console\\ClientCommand',
        'currentClassName' => 'Laravel\\Passport\\Console\\ClientCommand',
        'aliasName' => NULL,
      ),
      'createImplicitClient' => 
      array (
        'name' => 'createImplicitClient',
        'parameters' => 
        array (
          'clients' => 
          array (
            'name' => 'clients',
            'default' => NULL,
            'type' => 
            array (
              'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
              'data' => 
              array (
                'name' => 'Laravel\\Passport\\ClientRepository',
                'isIdentifier' => false,
              ),
            ),
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 117,
            'endLine' => 117,
            'startColumn' => 45,
            'endColumn' => 69,
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
            'name' => 'Laravel\\Passport\\Client',
            'isIdentifier' => false,
          ),
        ),
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * Create an implicit grant client.
 */',
        'startLine' => 117,
        'endLine' => 125,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 2,
        'namespace' => 'Laravel\\Passport\\Console',
        'declaringClassName' => 'Laravel\\Passport\\Console\\ClientCommand',
        'implementingClassName' => 'Laravel\\Passport\\Console\\ClientCommand',
        'currentClassName' => 'Laravel\\Passport\\Console\\ClientCommand',
        'aliasName' => NULL,
      ),
      'createDeviceCodeClient' => 
      array (
        'name' => 'createDeviceCodeClient',
        'parameters' => 
        array (
          'clients' => 
          array (
            'name' => 'clients',
            'default' => NULL,
            'type' => 
            array (
              'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
              'data' => 
              array (
                'name' => 'Laravel\\Passport\\ClientRepository',
                'isIdentifier' => false,
              ),
            ),
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 130,
            'endLine' => 130,
            'startColumn' => 47,
            'endColumn' => 71,
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
            'name' => 'Laravel\\Passport\\Client',
            'isIdentifier' => false,
          ),
        ),
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * Create a device code client.
 */',
        'startLine' => 130,
        'endLine' => 137,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 2,
        'namespace' => 'Laravel\\Passport\\Console',
        'declaringClassName' => 'Laravel\\Passport\\Console\\ClientCommand',
        'implementingClassName' => 'Laravel\\Passport\\Console\\ClientCommand',
        'currentClassName' => 'Laravel\\Passport\\Console\\ClientCommand',
        'aliasName' => NULL,
      ),
      'createAuthCodeClient' => 
      array (
        'name' => 'createAuthCodeClient',
        'parameters' => 
        array (
          'clients' => 
          array (
            'name' => 'clients',
            'default' => NULL,
            'type' => 
            array (
              'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
              'data' => 
              array (
                'name' => 'Laravel\\Passport\\ClientRepository',
                'isIdentifier' => false,
              ),
            ),
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 142,
            'endLine' => 142,
            'startColumn' => 45,
            'endColumn' => 69,
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
            'name' => 'Laravel\\Passport\\Client',
            'isIdentifier' => false,
          ),
        ),
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * Create an authorization code client.
 */',
        'startLine' => 142,
        'endLine' => 159,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 2,
        'namespace' => 'Laravel\\Passport\\Console',
        'declaringClassName' => 'Laravel\\Passport\\Console\\ClientCommand',
        'implementingClassName' => 'Laravel\\Passport\\Console\\ClientCommand',
        'currentClassName' => 'Laravel\\Passport\\Console\\ClientCommand',
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