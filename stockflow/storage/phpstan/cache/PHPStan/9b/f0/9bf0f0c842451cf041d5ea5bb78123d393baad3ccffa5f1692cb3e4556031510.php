<?php declare(strict_types = 1);

// osfsl-/var/www/html/vendor/composer/../symfony/http-foundation/BinaryFileResponse.php-PHPStan\BetterReflection\Reflection\ReflectionClass-Symfony\Component\HttpFoundation\BinaryFileResponse
return \PHPStan\Cache\CacheItem::__set_state(array(
   'variableKey' => 'v2-57abfc94590d66be6faa9b2f7792fc6b652fd86be9adae09277183e7cf35a1f8-8.4.23-6.70.0.3',
   'data' => 
  array (
    'locatedSource' => 
    array (
      'class' => 'PHPStan\\BetterReflection\\SourceLocator\\Located\\LocatedSource',
      'data' => 
      array (
        'name' => 'Symfony\\Component\\HttpFoundation\\BinaryFileResponse',
        'filename' => '/var/www/html/vendor/composer/../symfony/http-foundation/BinaryFileResponse.php',
      ),
    ),
    'namespace' => 'Symfony\\Component\\HttpFoundation',
    'name' => 'Symfony\\Component\\HttpFoundation\\BinaryFileResponse',
    'shortName' => 'BinaryFileResponse',
    'isInterface' => false,
    'isTrait' => false,
    'isEnum' => false,
    'isBackedEnum' => false,
    'modifiers' => 0,
    'docComment' => '/**
 * BinaryFileResponse represents an HTTP response delivering a file.
 *
 * @author Niklas Fiekas <niklas.fiekas@tu-clausthal.de>
 * @author stealth35 <stealth35-php@live.fr>
 * @author Igor Wiedler <igor@wiedler.ch>
 * @author Jordan Alliot <jordan.alliot@gmail.com>
 * @author Sergey Linnik <linniksa@gmail.com>
 */',
    'attributes' => 
    array (
    ),
    'startLine' => 27,
    'endLine' => 409,
    'startColumn' => 1,
    'endColumn' => 1,
    'parentClassName' => 'Symfony\\Component\\HttpFoundation\\Response',
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
      'trustXSendfileTypeHeader' => 
      array (
        'declaringClassName' => 'Symfony\\Component\\HttpFoundation\\BinaryFileResponse',
        'implementingClassName' => 'Symfony\\Component\\HttpFoundation\\BinaryFileResponse',
        'name' => 'trustXSendfileTypeHeader',
        'modifiers' => 18,
        'type' => 
        array (
          'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
          'data' => 
          array (
            'name' => 'bool',
            'isIdentifier' => true,
          ),
        ),
        'default' => 
        array (
          'code' => 'false',
          'attributes' => 
          array (
            'startLine' => 29,
            'endLine' => 29,
            'startTokenPos' => 46,
            'startFilePos' => 893,
            'endTokenPos' => 46,
            'endFilePos' => 897,
          ),
        ),
        'docComment' => NULL,
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
      'file' => 
      array (
        'declaringClassName' => 'Symfony\\Component\\HttpFoundation\\BinaryFileResponse',
        'implementingClassName' => 'Symfony\\Component\\HttpFoundation\\BinaryFileResponse',
        'name' => 'file',
        'modifiers' => 2,
        'type' => 
        array (
          'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
          'data' => 
          array (
            'name' => 'Symfony\\Component\\HttpFoundation\\File\\File',
            'isIdentifier' => false,
          ),
        ),
        'default' => NULL,
        'docComment' => NULL,
        'attributes' => 
        array (
        ),
        'startLine' => 31,
        'endLine' => 31,
        'startColumn' => 5,
        'endColumn' => 25,
        'isPromoted' => false,
        'declaredAtCompileTime' => true,
        'immediateVirtual' => false,
        'immediateHooks' => 
        array (
        ),
      ),
      'tempFileObject' => 
      array (
        'declaringClassName' => 'Symfony\\Component\\HttpFoundation\\BinaryFileResponse',
        'implementingClassName' => 'Symfony\\Component\\HttpFoundation\\BinaryFileResponse',
        'name' => 'tempFileObject',
        'modifiers' => 2,
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
                  'name' => 'SplTempFileObject',
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
        'default' => 
        array (
          'code' => 'null',
          'attributes' => 
          array (
            'startLine' => 32,
            'endLine' => 32,
            'startTokenPos' => 65,
            'startFilePos' => 979,
            'endTokenPos' => 65,
            'endFilePos' => 982,
          ),
        ),
        'docComment' => NULL,
        'attributes' => 
        array (
        ),
        'startLine' => 32,
        'endLine' => 32,
        'startColumn' => 5,
        'endColumn' => 57,
        'isPromoted' => false,
        'declaredAtCompileTime' => true,
        'immediateVirtual' => false,
        'immediateHooks' => 
        array (
        ),
      ),
      'offset' => 
      array (
        'declaringClassName' => 'Symfony\\Component\\HttpFoundation\\BinaryFileResponse',
        'implementingClassName' => 'Symfony\\Component\\HttpFoundation\\BinaryFileResponse',
        'name' => 'offset',
        'modifiers' => 2,
        'type' => 
        array (
          'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
          'data' => 
          array (
            'name' => 'int',
            'isIdentifier' => true,
          ),
        ),
        'default' => 
        array (
          'code' => '0',
          'attributes' => 
          array (
            'startLine' => 33,
            'endLine' => 33,
            'startTokenPos' => 76,
            'startFilePos' => 1013,
            'endTokenPos' => 76,
            'endFilePos' => 1013,
          ),
        ),
        'docComment' => NULL,
        'attributes' => 
        array (
        ),
        'startLine' => 33,
        'endLine' => 33,
        'startColumn' => 5,
        'endColumn' => 30,
        'isPromoted' => false,
        'declaredAtCompileTime' => true,
        'immediateVirtual' => false,
        'immediateHooks' => 
        array (
        ),
      ),
      'maxlen' => 
      array (
        'declaringClassName' => 'Symfony\\Component\\HttpFoundation\\BinaryFileResponse',
        'implementingClassName' => 'Symfony\\Component\\HttpFoundation\\BinaryFileResponse',
        'name' => 'maxlen',
        'modifiers' => 2,
        'type' => 
        array (
          'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
          'data' => 
          array (
            'name' => 'int',
            'isIdentifier' => true,
          ),
        ),
        'default' => 
        array (
          'code' => '-1',
          'attributes' => 
          array (
            'startLine' => 34,
            'endLine' => 34,
            'startTokenPos' => 87,
            'startFilePos' => 1044,
            'endTokenPos' => 88,
            'endFilePos' => 1045,
          ),
        ),
        'docComment' => NULL,
        'attributes' => 
        array (
        ),
        'startLine' => 34,
        'endLine' => 34,
        'startColumn' => 5,
        'endColumn' => 31,
        'isPromoted' => false,
        'declaredAtCompileTime' => true,
        'immediateVirtual' => false,
        'immediateHooks' => 
        array (
        ),
      ),
      'deleteFileAfterSend' => 
      array (
        'declaringClassName' => 'Symfony\\Component\\HttpFoundation\\BinaryFileResponse',
        'implementingClassName' => 'Symfony\\Component\\HttpFoundation\\BinaryFileResponse',
        'name' => 'deleteFileAfterSend',
        'modifiers' => 2,
        'type' => 
        array (
          'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
          'data' => 
          array (
            'name' => 'bool',
            'isIdentifier' => true,
          ),
        ),
        'default' => 
        array (
          'code' => 'false',
          'attributes' => 
          array (
            'startLine' => 35,
            'endLine' => 35,
            'startTokenPos' => 99,
            'startFilePos' => 1090,
            'endTokenPos' => 99,
            'endFilePos' => 1094,
          ),
        ),
        'docComment' => NULL,
        'attributes' => 
        array (
        ),
        'startLine' => 35,
        'endLine' => 35,
        'startColumn' => 5,
        'endColumn' => 48,
        'isPromoted' => false,
        'declaredAtCompileTime' => true,
        'immediateVirtual' => false,
        'immediateHooks' => 
        array (
        ),
      ),
      'chunkSize' => 
      array (
        'declaringClassName' => 'Symfony\\Component\\HttpFoundation\\BinaryFileResponse',
        'implementingClassName' => 'Symfony\\Component\\HttpFoundation\\BinaryFileResponse',
        'name' => 'chunkSize',
        'modifiers' => 2,
        'type' => 
        array (
          'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
          'data' => 
          array (
            'name' => 'int',
            'isIdentifier' => true,
          ),
        ),
        'default' => 
        array (
          'code' => '16 * 1024',
          'attributes' => 
          array (
            'startLine' => 36,
            'endLine' => 36,
            'startTokenPos' => 110,
            'startFilePos' => 1128,
            'endTokenPos' => 114,
            'endFilePos' => 1136,
          ),
        ),
        'docComment' => NULL,
        'attributes' => 
        array (
        ),
        'startLine' => 36,
        'endLine' => 36,
        'startColumn' => 5,
        'endColumn' => 41,
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
      '__construct' => 
      array (
        'name' => '__construct',
        'parameters' => 
        array (
          'file' => 
          array (
            'name' => 'file',
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
                      'name' => 'SplFileInfo',
                      'isIdentifier' => false,
                    ),
                  ),
                  1 => 
                  array (
                    'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
                    'data' => 
                    array (
                      'name' => 'string',
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
            'startLine' => 50,
            'endLine' => 50,
            'startColumn' => 33,
            'endColumn' => 57,
            'parameterIndex' => 0,
            'isOptional' => false,
          ),
          'status' => 
          array (
            'name' => 'status',
            'default' => 
            array (
              'code' => '200',
              'attributes' => 
              array (
                'startLine' => 50,
                'endLine' => 50,
                'startTokenPos' => 138,
                'startFilePos' => 2055,
                'endTokenPos' => 138,
                'endFilePos' => 2057,
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
            'startLine' => 50,
            'endLine' => 50,
            'startColumn' => 60,
            'endColumn' => 76,
            'parameterIndex' => 1,
            'isOptional' => true,
          ),
          'headers' => 
          array (
            'name' => 'headers',
            'default' => 
            array (
              'code' => '[]',
              'attributes' => 
              array (
                'startLine' => 50,
                'endLine' => 50,
                'startTokenPos' => 147,
                'startFilePos' => 2077,
                'endTokenPos' => 148,
                'endFilePos' => 2078,
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
            'startLine' => 50,
            'endLine' => 50,
            'startColumn' => 79,
            'endColumn' => 97,
            'parameterIndex' => 2,
            'isOptional' => true,
          ),
          'public' => 
          array (
            'name' => 'public',
            'default' => 
            array (
              'code' => 'true',
              'attributes' => 
              array (
                'startLine' => 50,
                'endLine' => 50,
                'startTokenPos' => 157,
                'startFilePos' => 2096,
                'endTokenPos' => 157,
                'endFilePos' => 2099,
              ),
            ),
            'type' => 
            array (
              'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
              'data' => 
              array (
                'name' => 'bool',
                'isIdentifier' => true,
              ),
            ),
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 50,
            'endLine' => 50,
            'startColumn' => 100,
            'endColumn' => 118,
            'parameterIndex' => 3,
            'isOptional' => true,
          ),
          'contentDisposition' => 
          array (
            'name' => 'contentDisposition',
            'default' => 
            array (
              'code' => 'null',
              'attributes' => 
              array (
                'startLine' => 50,
                'endLine' => 50,
                'startTokenPos' => 167,
                'startFilePos' => 2132,
                'endTokenPos' => 167,
                'endFilePos' => 2135,
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
            'startLine' => 50,
            'endLine' => 50,
            'startColumn' => 121,
            'endColumn' => 154,
            'parameterIndex' => 4,
            'isOptional' => true,
          ),
          'autoEtag' => 
          array (
            'name' => 'autoEtag',
            'default' => 
            array (
              'code' => 'false',
              'attributes' => 
              array (
                'startLine' => 50,
                'endLine' => 50,
                'startTokenPos' => 176,
                'startFilePos' => 2155,
                'endTokenPos' => 176,
                'endFilePos' => 2159,
              ),
            ),
            'type' => 
            array (
              'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
              'data' => 
              array (
                'name' => 'bool',
                'isIdentifier' => true,
              ),
            ),
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 50,
            'endLine' => 50,
            'startColumn' => 157,
            'endColumn' => 178,
            'parameterIndex' => 5,
            'isOptional' => true,
          ),
          'autoLastModified' => 
          array (
            'name' => 'autoLastModified',
            'default' => 
            array (
              'code' => 'true',
              'attributes' => 
              array (
                'startLine' => 50,
                'endLine' => 50,
                'startTokenPos' => 185,
                'startFilePos' => 2187,
                'endTokenPos' => 185,
                'endFilePos' => 2190,
              ),
            ),
            'type' => 
            array (
              'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
              'data' => 
              array (
                'name' => 'bool',
                'isIdentifier' => true,
              ),
            ),
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 50,
            'endLine' => 50,
            'startColumn' => 181,
            'endColumn' => 209,
            'parameterIndex' => 6,
            'isOptional' => true,
          ),
        ),
        'returnsReference' => false,
        'returnType' => NULL,
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * @param \\SplFileInfo|string $file               The file to stream
 * @param int                 $status             The response status code (200 "OK" by default)
 * @param array               $headers            An array of response headers
 * @param bool                $public             Files are public by default
 * @param string|null         $contentDisposition The type of Content-Disposition to set automatically with the filename
 * @param bool                $autoEtag           Whether the ETag header should be automatically set
 * @param bool                $autoLastModified   Whether the Last-Modified header should be automatically set
 *
 * @throws FileNotFoundException If the given path is not a file
 * @throws FileException         If the file is not readable
 */',
        'startLine' => 50,
        'endLine' => 59,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'Symfony\\Component\\HttpFoundation',
        'declaringClassName' => 'Symfony\\Component\\HttpFoundation\\BinaryFileResponse',
        'implementingClassName' => 'Symfony\\Component\\HttpFoundation\\BinaryFileResponse',
        'currentClassName' => 'Symfony\\Component\\HttpFoundation\\BinaryFileResponse',
        'aliasName' => NULL,
      ),
      'setFile' => 
      array (
        'name' => 'setFile',
        'parameters' => 
        array (
          'file' => 
          array (
            'name' => 'file',
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
                      'name' => 'SplFileInfo',
                      'isIdentifier' => false,
                    ),
                  ),
                  1 => 
                  array (
                    'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
                    'data' => 
                    array (
                      'name' => 'string',
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
            'startLine' => 69,
            'endLine' => 69,
            'startColumn' => 29,
            'endColumn' => 53,
            'parameterIndex' => 0,
            'isOptional' => false,
          ),
          'contentDisposition' => 
          array (
            'name' => 'contentDisposition',
            'default' => 
            array (
              'code' => 'null',
              'attributes' => 
              array (
                'startLine' => 69,
                'endLine' => 69,
                'startTokenPos' => 262,
                'startFilePos' => 2711,
                'endTokenPos' => 262,
                'endFilePos' => 2714,
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
            'startLine' => 69,
            'endLine' => 69,
            'startColumn' => 56,
            'endColumn' => 89,
            'parameterIndex' => 1,
            'isOptional' => true,
          ),
          'autoEtag' => 
          array (
            'name' => 'autoEtag',
            'default' => 
            array (
              'code' => 'false',
              'attributes' => 
              array (
                'startLine' => 69,
                'endLine' => 69,
                'startTokenPos' => 271,
                'startFilePos' => 2734,
                'endTokenPos' => 271,
                'endFilePos' => 2738,
              ),
            ),
            'type' => 
            array (
              'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
              'data' => 
              array (
                'name' => 'bool',
                'isIdentifier' => true,
              ),
            ),
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 69,
            'endLine' => 69,
            'startColumn' => 92,
            'endColumn' => 113,
            'parameterIndex' => 2,
            'isOptional' => true,
          ),
          'autoLastModified' => 
          array (
            'name' => 'autoLastModified',
            'default' => 
            array (
              'code' => 'true',
              'attributes' => 
              array (
                'startLine' => 69,
                'endLine' => 69,
                'startTokenPos' => 280,
                'startFilePos' => 2766,
                'endTokenPos' => 280,
                'endFilePos' => 2769,
              ),
            ),
            'type' => 
            array (
              'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
              'data' => 
              array (
                'name' => 'bool',
                'isIdentifier' => true,
              ),
            ),
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 69,
            'endLine' => 69,
            'startColumn' => 116,
            'endColumn' => 144,
            'parameterIndex' => 3,
            'isOptional' => true,
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
 * Sets the file to stream.
 *
 * @return $this
 *
 * @throws FileNotFoundException If the given path is not a file
 * @throws FileException         If the file is not readable
 */',
        'startLine' => 69,
        'endLine' => 101,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'Symfony\\Component\\HttpFoundation',
        'declaringClassName' => 'Symfony\\Component\\HttpFoundation\\BinaryFileResponse',
        'implementingClassName' => 'Symfony\\Component\\HttpFoundation\\BinaryFileResponse',
        'currentClassName' => 'Symfony\\Component\\HttpFoundation\\BinaryFileResponse',
        'aliasName' => NULL,
      ),
      'getFile' => 
      array (
        'name' => 'getFile',
        'parameters' => 
        array (
        ),
        'returnsReference' => false,
        'returnType' => 
        array (
          'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
          'data' => 
          array (
            'name' => 'Symfony\\Component\\HttpFoundation\\File\\File',
            'isIdentifier' => false,
          ),
        ),
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * Gets the file.
 */',
        'startLine' => 106,
        'endLine' => 109,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'Symfony\\Component\\HttpFoundation',
        'declaringClassName' => 'Symfony\\Component\\HttpFoundation\\BinaryFileResponse',
        'implementingClassName' => 'Symfony\\Component\\HttpFoundation\\BinaryFileResponse',
        'currentClassName' => 'Symfony\\Component\\HttpFoundation\\BinaryFileResponse',
        'aliasName' => NULL,
      ),
      'setChunkSize' => 
      array (
        'name' => 'setChunkSize',
        'parameters' => 
        array (
          'chunkSize' => 
          array (
            'name' => 'chunkSize',
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
            'startLine' => 116,
            'endLine' => 116,
            'startColumn' => 34,
            'endColumn' => 47,
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
 * Sets the response stream chunk size.
 *
 * @return $this
 */',
        'startLine' => 116,
        'endLine' => 125,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'Symfony\\Component\\HttpFoundation',
        'declaringClassName' => 'Symfony\\Component\\HttpFoundation\\BinaryFileResponse',
        'implementingClassName' => 'Symfony\\Component\\HttpFoundation\\BinaryFileResponse',
        'currentClassName' => 'Symfony\\Component\\HttpFoundation\\BinaryFileResponse',
        'aliasName' => NULL,
      ),
      'setAutoLastModified' => 
      array (
        'name' => 'setAutoLastModified',
        'parameters' => 
        array (
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
 * Automatically sets the Last-Modified header according the file modification date.
 *
 * @return $this
 */',
        'startLine' => 132,
        'endLine' => 137,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'Symfony\\Component\\HttpFoundation',
        'declaringClassName' => 'Symfony\\Component\\HttpFoundation\\BinaryFileResponse',
        'implementingClassName' => 'Symfony\\Component\\HttpFoundation\\BinaryFileResponse',
        'currentClassName' => 'Symfony\\Component\\HttpFoundation\\BinaryFileResponse',
        'aliasName' => NULL,
      ),
      'setAutoEtag' => 
      array (
        'name' => 'setAutoEtag',
        'parameters' => 
        array (
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
 * Automatically sets the ETag header according to the checksum of the file.
 *
 * @return $this
 */',
        'startLine' => 144,
        'endLine' => 149,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'Symfony\\Component\\HttpFoundation',
        'declaringClassName' => 'Symfony\\Component\\HttpFoundation\\BinaryFileResponse',
        'implementingClassName' => 'Symfony\\Component\\HttpFoundation\\BinaryFileResponse',
        'currentClassName' => 'Symfony\\Component\\HttpFoundation\\BinaryFileResponse',
        'aliasName' => NULL,
      ),
      'setContentDisposition' => 
      array (
        'name' => 'setContentDisposition',
        'parameters' => 
        array (
          'disposition' => 
          array (
            'name' => 'disposition',
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
            'startLine' => 160,
            'endLine' => 160,
            'startColumn' => 43,
            'endColumn' => 61,
            'parameterIndex' => 0,
            'isOptional' => false,
          ),
          'filename' => 
          array (
            'name' => 'filename',
            'default' => 
            array (
              'code' => '\'\'',
              'attributes' => 
              array (
                'startLine' => 160,
                'endLine' => 160,
                'startTokenPos' => 691,
                'startFilePos' => 5362,
                'endTokenPos' => 691,
                'endFilePos' => 5363,
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
            'startLine' => 160,
            'endLine' => 160,
            'startColumn' => 64,
            'endColumn' => 84,
            'parameterIndex' => 1,
            'isOptional' => true,
          ),
          'filenameFallback' => 
          array (
            'name' => 'filenameFallback',
            'default' => 
            array (
              'code' => '\'\'',
              'attributes' => 
              array (
                'startLine' => 160,
                'endLine' => 160,
                'startTokenPos' => 700,
                'startFilePos' => 5393,
                'endTokenPos' => 700,
                'endFilePos' => 5394,
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
            'startLine' => 160,
            'endLine' => 160,
            'startColumn' => 87,
            'endColumn' => 115,
            'parameterIndex' => 2,
            'isOptional' => true,
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
 * Sets the Content-Disposition header with the given filename.
 *
 * @param string $disposition      ResponseHeaderBag::DISPOSITION_INLINE or ResponseHeaderBag::DISPOSITION_ATTACHMENT
 * @param string $filename         Optionally use this UTF-8 encoded filename instead of the real name of the file
 * @param string $filenameFallback A fallback filename, containing only ASCII characters. Defaults to an automatically encoded filename
 *
 * @return $this
 */',
        'startLine' => 160,
        'endLine' => 184,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'Symfony\\Component\\HttpFoundation',
        'declaringClassName' => 'Symfony\\Component\\HttpFoundation\\BinaryFileResponse',
        'implementingClassName' => 'Symfony\\Component\\HttpFoundation\\BinaryFileResponse',
        'currentClassName' => 'Symfony\\Component\\HttpFoundation\\BinaryFileResponse',
        'aliasName' => NULL,
      ),
      'prepare' => 
      array (
        'name' => 'prepare',
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
                'name' => 'Symfony\\Component\\HttpFoundation\\Request',
                'isIdentifier' => false,
              ),
            ),
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 186,
            'endLine' => 186,
            'startColumn' => 29,
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
            'name' => 'static',
            'isIdentifier' => false,
          ),
        ),
        'attributes' => 
        array (
        ),
        'docComment' => NULL,
        'startLine' => 186,
        'endLine' => 294,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'Symfony\\Component\\HttpFoundation',
        'declaringClassName' => 'Symfony\\Component\\HttpFoundation\\BinaryFileResponse',
        'implementingClassName' => 'Symfony\\Component\\HttpFoundation\\BinaryFileResponse',
        'currentClassName' => 'Symfony\\Component\\HttpFoundation\\BinaryFileResponse',
        'aliasName' => NULL,
      ),
      'hasValidIfRangeHeader' => 
      array (
        'name' => 'hasValidIfRangeHeader',
        'parameters' => 
        array (
          'header' => 
          array (
            'name' => 'header',
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
            'startLine' => 296,
            'endLine' => 296,
            'startColumn' => 44,
            'endColumn' => 58,
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
        'docComment' => NULL,
        'startLine' => 296,
        'endLine' => 307,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 4,
        'namespace' => 'Symfony\\Component\\HttpFoundation',
        'declaringClassName' => 'Symfony\\Component\\HttpFoundation\\BinaryFileResponse',
        'implementingClassName' => 'Symfony\\Component\\HttpFoundation\\BinaryFileResponse',
        'currentClassName' => 'Symfony\\Component\\HttpFoundation\\BinaryFileResponse',
        'aliasName' => NULL,
      ),
      'sendContent' => 
      array (
        'name' => 'sendContent',
        'parameters' => 
        array (
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
        'docComment' => NULL,
        'startLine' => 309,
        'endLine' => 362,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'Symfony\\Component\\HttpFoundation',
        'declaringClassName' => 'Symfony\\Component\\HttpFoundation\\BinaryFileResponse',
        'implementingClassName' => 'Symfony\\Component\\HttpFoundation\\BinaryFileResponse',
        'currentClassName' => 'Symfony\\Component\\HttpFoundation\\BinaryFileResponse',
        'aliasName' => NULL,
      ),
      'setContent' => 
      array (
        'name' => 'setContent',
        'parameters' => 
        array (
          'content' => 
          array (
            'name' => 'content',
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
            'startLine' => 367,
            'endLine' => 367,
            'startColumn' => 32,
            'endColumn' => 47,
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
 * @throws \\LogicException when the content is not null
 */',
        'startLine' => 367,
        'endLine' => 374,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'Symfony\\Component\\HttpFoundation',
        'declaringClassName' => 'Symfony\\Component\\HttpFoundation\\BinaryFileResponse',
        'implementingClassName' => 'Symfony\\Component\\HttpFoundation\\BinaryFileResponse',
        'currentClassName' => 'Symfony\\Component\\HttpFoundation\\BinaryFileResponse',
        'aliasName' => NULL,
      ),
      'getContent' => 
      array (
        'name' => 'getContent',
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
                  'name' => 'false',
                  'isIdentifier' => true,
                ),
              ),
            ),
          ),
        ),
        'attributes' => 
        array (
        ),
        'docComment' => NULL,
        'startLine' => 376,
        'endLine' => 379,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'Symfony\\Component\\HttpFoundation',
        'declaringClassName' => 'Symfony\\Component\\HttpFoundation\\BinaryFileResponse',
        'implementingClassName' => 'Symfony\\Component\\HttpFoundation\\BinaryFileResponse',
        'currentClassName' => 'Symfony\\Component\\HttpFoundation\\BinaryFileResponse',
        'aliasName' => NULL,
      ),
      'trustXSendfileTypeHeader' => 
      array (
        'name' => 'trustXSendfileTypeHeader',
        'parameters' => 
        array (
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
 * Trust X-Sendfile-Type header.
 */',
        'startLine' => 384,
        'endLine' => 387,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 17,
        'namespace' => 'Symfony\\Component\\HttpFoundation',
        'declaringClassName' => 'Symfony\\Component\\HttpFoundation\\BinaryFileResponse',
        'implementingClassName' => 'Symfony\\Component\\HttpFoundation\\BinaryFileResponse',
        'currentClassName' => 'Symfony\\Component\\HttpFoundation\\BinaryFileResponse',
        'aliasName' => NULL,
      ),
      'deleteFileAfterSend' => 
      array (
        'name' => 'deleteFileAfterSend',
        'parameters' => 
        array (
          'shouldDelete' => 
          array (
            'name' => 'shouldDelete',
            'default' => 
            array (
              'code' => 'true',
              'attributes' => 
              array (
                'startLine' => 395,
                'endLine' => 395,
                'startTokenPos' => 2520,
                'startFilePos' => 13727,
                'endTokenPos' => 2520,
                'endFilePos' => 13730,
              ),
            ),
            'type' => 
            array (
              'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
              'data' => 
              array (
                'name' => 'bool',
                'isIdentifier' => true,
              ),
            ),
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 395,
            'endLine' => 395,
            'startColumn' => 41,
            'endColumn' => 65,
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
            'name' => 'static',
            'isIdentifier' => false,
          ),
        ),
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * If this is set to true, the file will be unlinked after the request is sent
 * Note: If the X-Sendfile header is used, the deleteFileAfterSend setting will not be used.
 *
 * @return $this
 */',
        'startLine' => 395,
        'endLine' => 400,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'Symfony\\Component\\HttpFoundation',
        'declaringClassName' => 'Symfony\\Component\\HttpFoundation\\BinaryFileResponse',
        'implementingClassName' => 'Symfony\\Component\\HttpFoundation\\BinaryFileResponse',
        'currentClassName' => 'Symfony\\Component\\HttpFoundation\\BinaryFileResponse',
        'aliasName' => NULL,
      ),
      'shouldDeleteFileAfterSend' => 
      array (
        'name' => 'shouldDeleteFileAfterSend',
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
 * Returns whether the file will be unlinked after the request is sent.
 */',
        'startLine' => 405,
        'endLine' => 408,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'Symfony\\Component\\HttpFoundation',
        'declaringClassName' => 'Symfony\\Component\\HttpFoundation\\BinaryFileResponse',
        'implementingClassName' => 'Symfony\\Component\\HttpFoundation\\BinaryFileResponse',
        'currentClassName' => 'Symfony\\Component\\HttpFoundation\\BinaryFileResponse',
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