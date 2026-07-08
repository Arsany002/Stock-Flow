<?php declare(strict_types = 1);

// osfsl-/var/www/html/vendor/composer/../psr/http-factory/src/StreamFactoryInterface.php-PHPStan\BetterReflection\Reflection\ReflectionClass-Psr\Http\Message\StreamFactoryInterface
return \PHPStan\Cache\CacheItem::__set_state(array(
   'variableKey' => 'v2-25fe9d048ce6718141d21c122ef9b3498be45025300717ccbe912ef5bc0083ec-8.4.23-6.70.0.3',
   'data' => 
  array (
    'locatedSource' => 
    array (
      'class' => 'PHPStan\\BetterReflection\\SourceLocator\\Located\\LocatedSource',
      'data' => 
      array (
        'name' => 'Psr\\Http\\Message\\StreamFactoryInterface',
        'filename' => '/var/www/html/vendor/composer/../psr/http-factory/src/StreamFactoryInterface.php',
      ),
    ),
    'namespace' => 'Psr\\Http\\Message',
    'name' => 'Psr\\Http\\Message\\StreamFactoryInterface',
    'shortName' => 'StreamFactoryInterface',
    'isInterface' => true,
    'isTrait' => false,
    'isEnum' => false,
    'isBackedEnum' => false,
    'modifiers' => 0,
    'docComment' => NULL,
    'attributes' => 
    array (
    ),
    'startLine' => 5,
    'endLine' => 45,
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
      'createStream' => 
      array (
        'name' => 'createStream',
        'parameters' => 
        array (
          'content' => 
          array (
            'name' => 'content',
            'default' => 
            array (
              'code' => '\'\'',
              'attributes' => 
              array (
                'startLine' => 16,
                'endLine' => 16,
                'startTokenPos' => 27,
                'startFilePos' => 375,
                'endTokenPos' => 27,
                'endFilePos' => 376,
              ),
            ),
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
            'startLine' => 16,
            'endLine' => 16,
            'startColumn' => 34,
            'endColumn' => 53,
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
            'name' => 'Psr\\Http\\Message\\StreamInterface',
            'isIdentifier' => false,
          ),
        ),
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * Create a new stream from a string.
 *
 * The stream SHOULD be created with a temporary resource.
 *
 * @param string $content String content with which to populate the stream.
 *
 * @return StreamInterface
 */',
        'startLine' => 16,
        'endLine' => 16,
        'startColumn' => 5,
        'endColumn' => 72,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'Psr\\Http\\Message',
        'declaringClassName' => 'Psr\\Http\\Message\\StreamFactoryInterface',
        'implementingClassName' => 'Psr\\Http\\Message\\StreamFactoryInterface',
        'currentClassName' => 'Psr\\Http\\Message\\StreamFactoryInterface',
        'aliasName' => NULL,
      ),
      'createStreamFromFile' => 
      array (
        'name' => 'createStreamFromFile',
        'parameters' => 
        array (
          'filename' => 
          array (
            'name' => 'filename',
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
            'startLine' => 33,
            'endLine' => 33,
            'startColumn' => 42,
            'endColumn' => 57,
            'parameterIndex' => 0,
            'isOptional' => false,
          ),
          'mode' => 
          array (
            'name' => 'mode',
            'default' => 
            array (
              'code' => '\'r\'',
              'attributes' => 
              array (
                'startLine' => 33,
                'endLine' => 33,
                'startTokenPos' => 53,
                'startFilePos' => 1067,
                'endTokenPos' => 53,
                'endFilePos' => 1069,
              ),
            ),
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
            'startLine' => 33,
            'endLine' => 33,
            'startColumn' => 60,
            'endColumn' => 77,
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
            'name' => 'Psr\\Http\\Message\\StreamInterface',
            'isIdentifier' => false,
          ),
        ),
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * Create a stream from an existing file.
 *
 * The file MUST be opened using the given mode, which may be any mode
 * supported by the `fopen` function.
 *
 * The `$filename` MAY be any string supported by `fopen()`.
 *
 * @param string $filename Filename or stream URI to use as basis of stream.
 * @param string $mode Mode with which to open the underlying filename/stream.
 *
 * @return StreamInterface
 * @throws \\RuntimeException If the file cannot be opened.
 * @throws \\InvalidArgumentException If the mode is invalid.
 */',
        'startLine' => 33,
        'endLine' => 33,
        'startColumn' => 5,
        'endColumn' => 96,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'Psr\\Http\\Message',
        'declaringClassName' => 'Psr\\Http\\Message\\StreamFactoryInterface',
        'implementingClassName' => 'Psr\\Http\\Message\\StreamFactoryInterface',
        'currentClassName' => 'Psr\\Http\\Message\\StreamFactoryInterface',
        'aliasName' => NULL,
      ),
      'createStreamFromResource' => 
      array (
        'name' => 'createStreamFromResource',
        'parameters' => 
        array (
          'resource' => 
          array (
            'name' => 'resource',
            'default' => NULL,
            'type' => NULL,
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 44,
            'endLine' => 44,
            'startColumn' => 46,
            'endColumn' => 54,
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
            'name' => 'Psr\\Http\\Message\\StreamInterface',
            'isIdentifier' => false,
          ),
        ),
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * Create a new stream from an existing resource.
 *
 * The stream MUST be readable and may be writable.
 *
 * @param resource $resource PHP resource to use as basis of stream.
 *
 * @return StreamInterface
 */',
        'startLine' => 44,
        'endLine' => 44,
        'startColumn' => 5,
        'endColumn' => 73,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'Psr\\Http\\Message',
        'declaringClassName' => 'Psr\\Http\\Message\\StreamFactoryInterface',
        'implementingClassName' => 'Psr\\Http\\Message\\StreamFactoryInterface',
        'currentClassName' => 'Psr\\Http\\Message\\StreamFactoryInterface',
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