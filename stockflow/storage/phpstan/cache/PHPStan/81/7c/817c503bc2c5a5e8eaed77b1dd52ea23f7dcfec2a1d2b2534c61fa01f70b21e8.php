<?php declare(strict_types = 1);

// osfsl-/var/www/html/vendor/composer/../psr/http-factory/src/UploadedFileFactoryInterface.php-PHPStan\BetterReflection\Reflection\ReflectionClass-Psr\Http\Message\UploadedFileFactoryInterface
return \PHPStan\Cache\CacheItem::__set_state(array(
   'variableKey' => 'v2-712c705ac850b43dbf47458e571c8be314d1d1f01b0e470407ed014b702d9e5b-8.4.23-6.70.0.3',
   'data' => 
  array (
    'locatedSource' => 
    array (
      'class' => 'PHPStan\\BetterReflection\\SourceLocator\\Located\\LocatedSource',
      'data' => 
      array (
        'name' => 'Psr\\Http\\Message\\UploadedFileFactoryInterface',
        'filename' => '/var/www/html/vendor/composer/../psr/http-factory/src/UploadedFileFactoryInterface.php',
      ),
    ),
    'namespace' => 'Psr\\Http\\Message',
    'name' => 'Psr\\Http\\Message\\UploadedFileFactoryInterface',
    'shortName' => 'UploadedFileFactoryInterface',
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
      'createUploadedFile' => 
      array (
        'name' => 'createUploadedFile',
        'parameters' => 
        array (
          'stream' => 
          array (
            'name' => 'stream',
            'default' => NULL,
            'type' => 
            array (
              'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
              'data' => 
              array (
                'name' => 'Psr\\Http\\Message\\StreamInterface',
                'isIdentifier' => false,
              ),
            ),
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 28,
            'endLine' => 28,
            'startColumn' => 9,
            'endColumn' => 31,
            'parameterIndex' => 0,
            'isOptional' => false,
          ),
          'size' => 
          array (
            'name' => 'size',
            'default' => 
            array (
              'code' => 'null',
              'attributes' => 
              array (
                'startLine' => 29,
                'endLine' => 29,
                'startTokenPos' => 34,
                'startFilePos' => 973,
                'endTokenPos' => 34,
                'endFilePos' => 976,
              ),
            ),
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
                      'name' => 'int',
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
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 29,
            'endLine' => 29,
            'startColumn' => 9,
            'endColumn' => 25,
            'parameterIndex' => 1,
            'isOptional' => true,
          ),
          'error' => 
          array (
            'name' => 'error',
            'default' => 
            array (
              'code' => '\\UPLOAD_ERR_OK',
              'attributes' => 
              array (
                'startLine' => 30,
                'endLine' => 30,
                'startTokenPos' => 43,
                'startFilePos' => 1000,
                'endTokenPos' => 43,
                'endFilePos' => 1013,
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
            'startLine' => 30,
            'endLine' => 30,
            'startColumn' => 9,
            'endColumn' => 35,
            'parameterIndex' => 2,
            'isOptional' => true,
          ),
          'clientFilename' => 
          array (
            'name' => 'clientFilename',
            'default' => 
            array (
              'code' => 'null',
              'attributes' => 
              array (
                'startLine' => 31,
                'endLine' => 31,
                'startTokenPos' => 53,
                'startFilePos' => 1050,
                'endTokenPos' => 53,
                'endFilePos' => 1053,
              ),
            ),
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
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 31,
            'endLine' => 31,
            'startColumn' => 9,
            'endColumn' => 38,
            'parameterIndex' => 3,
            'isOptional' => true,
          ),
          'clientMediaType' => 
          array (
            'name' => 'clientMediaType',
            'default' => 
            array (
              'code' => 'null',
              'attributes' => 
              array (
                'startLine' => 32,
                'endLine' => 32,
                'startTokenPos' => 63,
                'startFilePos' => 1091,
                'endTokenPos' => 63,
                'endFilePos' => 1094,
              ),
            ),
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
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 32,
            'endLine' => 32,
            'startColumn' => 9,
            'endColumn' => 39,
            'parameterIndex' => 4,
            'isOptional' => true,
          ),
        ),
        'returnsReference' => false,
        'returnType' => 
        array (
          'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
          'data' => 
          array (
            'name' => 'Psr\\Http\\Message\\UploadedFileInterface',
            'isIdentifier' => false,
          ),
        ),
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * Create a new uploaded file.
 *
 * If a size is not provided it will be determined by checking the size of
 * the file.
 *
 * @see http://php.net/manual/features.file-upload.post-method.php
 * @see http://php.net/manual/features.file-upload.errors.php
 *
 * @param StreamInterface $stream Underlying stream representing the
 *     uploaded file content.
 * @param int|null $size in bytes
 * @param int $error PHP file upload error
 * @param string|null $clientFilename Filename as provided by the client, if any.
 * @param string|null $clientMediaType Media type as provided by the client, if any.
 *
 * @return UploadedFileInterface
 *
 * @throws \\InvalidArgumentException If the file resource is not readable.
 */',
        'startLine' => 27,
        'endLine' => 33,
        'startColumn' => 5,
        'endColumn' => 29,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'Psr\\Http\\Message',
        'declaringClassName' => 'Psr\\Http\\Message\\UploadedFileFactoryInterface',
        'implementingClassName' => 'Psr\\Http\\Message\\UploadedFileFactoryInterface',
        'currentClassName' => 'Psr\\Http\\Message\\UploadedFileFactoryInterface',
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