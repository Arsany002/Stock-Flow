<?php declare(strict_types = 1);

// ftm-/var/www/html/app/Services/ImportService.php
return \PHPStan\Cache\CacheItem::__set_state(array(
   'variableKey' => 'v5-2.3.2',
   'data' => 
  array (
    0 => 
    array (
      '94b3a563d3ff1b2ad8dd952e0028c934' => 
      \PHPStan\Analyser\IntermediaryNameScope::__set_state(array(
         'namespace' => 'App\\Services',
         'uses' => 
        array (
          'importentity' => 'App\\Enums\\ImportEntity',
          'importrowstatus' => 'App\\Enums\\ImportRowStatus',
          'importstatus' => 'App\\Enums\\ImportStatus',
          'pricelisttype' => 'App\\Enums\\PriceListType',
          'importvalidationexception' => 'App\\Exceptions\\ImportValidationException',
          'catalogrowsimport' => 'App\\Imports\\CatalogRowsImport',
          'importcatalogjob' => 'App\\Jobs\\ImportCatalogJob',
          'category' => 'App\\Models\\Category',
          'importbatch' => 'App\\Models\\ImportBatch',
          'importrow' => 'App\\Models\\ImportRow',
          'pricelist' => 'App\\Models\\PriceList',
          'pricelistitem' => 'App\\Models\\PriceListItem',
          'product' => 'App\\Models\\Product',
          'stocklevel' => 'App\\Models\\StockLevel',
          'supplier' => 'App\\Models\\Supplier',
          'user' => 'App\\Models\\User',
          'warehouse' => 'App\\Models\\Warehouse',
          'importrepositoryinterface' => 'App\\Repositories\\Contracts\\ImportRepositoryInterface',
          'lengthawarepaginator' => 'Illuminate\\Contracts\\Pagination\\LengthAwarePaginator',
          'uploadedfile' => 'Illuminate\\Http\\UploadedFile',
          'collection' => 'Illuminate\\Support\\Collection',
          'cache' => 'Illuminate\\Support\\Facades\\Cache',
          'db' => 'Illuminate\\Support\\Facades\\DB',
          'validator' => 'Illuminate\\Support\\Facades\\Validator',
          'str' => 'Illuminate\\Support\\Str',
          'rule' => 'Illuminate\\Validation\\Rule',
          'excel' => 'Maatwebsite\\Excel\\Facades\\Excel',
          'runtimeexception' => 'RuntimeException',
          'throwable' => 'Throwable',
        ),
         'className' => 'App\\Services\\ImportService',
         'functionName' => NULL,
         'templatePhpDocNodes' => 
        array (
        ),
         'parent' => NULL,
         'typeAliasesMap' => 
        array (
        ),
         'bypassTypeAliases' => false,
         'constUses' => 
        array (
        ),
         'typeAliasClassName' => NULL,
         'traitData' => NULL,
      )),
      'aa9e03dc6fc7754b5c76da460d33053c' => 
      \PHPStan\Analyser\IntermediaryNameScope::__set_state(array(
         'namespace' => 'App\\Services',
         'uses' => 
        array (
          'importentity' => 'App\\Enums\\ImportEntity',
          'importrowstatus' => 'App\\Enums\\ImportRowStatus',
          'importstatus' => 'App\\Enums\\ImportStatus',
          'pricelisttype' => 'App\\Enums\\PriceListType',
          'importvalidationexception' => 'App\\Exceptions\\ImportValidationException',
          'catalogrowsimport' => 'App\\Imports\\CatalogRowsImport',
          'importcatalogjob' => 'App\\Jobs\\ImportCatalogJob',
          'category' => 'App\\Models\\Category',
          'importbatch' => 'App\\Models\\ImportBatch',
          'importrow' => 'App\\Models\\ImportRow',
          'pricelist' => 'App\\Models\\PriceList',
          'pricelistitem' => 'App\\Models\\PriceListItem',
          'product' => 'App\\Models\\Product',
          'stocklevel' => 'App\\Models\\StockLevel',
          'supplier' => 'App\\Models\\Supplier',
          'user' => 'App\\Models\\User',
          'warehouse' => 'App\\Models\\Warehouse',
          'importrepositoryinterface' => 'App\\Repositories\\Contracts\\ImportRepositoryInterface',
          'lengthawarepaginator' => 'Illuminate\\Contracts\\Pagination\\LengthAwarePaginator',
          'uploadedfile' => 'Illuminate\\Http\\UploadedFile',
          'collection' => 'Illuminate\\Support\\Collection',
          'cache' => 'Illuminate\\Support\\Facades\\Cache',
          'db' => 'Illuminate\\Support\\Facades\\DB',
          'validator' => 'Illuminate\\Support\\Facades\\Validator',
          'str' => 'Illuminate\\Support\\Str',
          'rule' => 'Illuminate\\Validation\\Rule',
          'excel' => 'Maatwebsite\\Excel\\Facades\\Excel',
          'runtimeexception' => 'RuntimeException',
          'throwable' => 'Throwable',
        ),
         'className' => 'App\\Services\\ImportService',
         'functionName' => '__construct',
         'templatePhpDocNodes' => 
        array (
        ),
         'parent' => NULL,
         'typeAliasesMap' => 
        array (
        ),
         'bypassTypeAliases' => false,
         'constUses' => 
        array (
        ),
         'typeAliasClassName' => NULL,
         'traitData' => NULL,
      )),
      '2a3d4116ffa5946a3529b8277aeaa870' => 
      \PHPStan\Analyser\IntermediaryNameScope::__set_state(array(
         'namespace' => 'App\\Services',
         'uses' => 
        array (
          'importentity' => 'App\\Enums\\ImportEntity',
          'importrowstatus' => 'App\\Enums\\ImportRowStatus',
          'importstatus' => 'App\\Enums\\ImportStatus',
          'pricelisttype' => 'App\\Enums\\PriceListType',
          'importvalidationexception' => 'App\\Exceptions\\ImportValidationException',
          'catalogrowsimport' => 'App\\Imports\\CatalogRowsImport',
          'importcatalogjob' => 'App\\Jobs\\ImportCatalogJob',
          'category' => 'App\\Models\\Category',
          'importbatch' => 'App\\Models\\ImportBatch',
          'importrow' => 'App\\Models\\ImportRow',
          'pricelist' => 'App\\Models\\PriceList',
          'pricelistitem' => 'App\\Models\\PriceListItem',
          'product' => 'App\\Models\\Product',
          'stocklevel' => 'App\\Models\\StockLevel',
          'supplier' => 'App\\Models\\Supplier',
          'user' => 'App\\Models\\User',
          'warehouse' => 'App\\Models\\Warehouse',
          'importrepositoryinterface' => 'App\\Repositories\\Contracts\\ImportRepositoryInterface',
          'lengthawarepaginator' => 'Illuminate\\Contracts\\Pagination\\LengthAwarePaginator',
          'uploadedfile' => 'Illuminate\\Http\\UploadedFile',
          'collection' => 'Illuminate\\Support\\Collection',
          'cache' => 'Illuminate\\Support\\Facades\\Cache',
          'db' => 'Illuminate\\Support\\Facades\\DB',
          'validator' => 'Illuminate\\Support\\Facades\\Validator',
          'str' => 'Illuminate\\Support\\Str',
          'rule' => 'Illuminate\\Validation\\Rule',
          'excel' => 'Maatwebsite\\Excel\\Facades\\Excel',
          'runtimeexception' => 'RuntimeException',
          'throwable' => 'Throwable',
        ),
         'className' => 'App\\Services\\ImportService',
         'functionName' => 'listBatches',
         'templatePhpDocNodes' => 
        array (
        ),
         'parent' => NULL,
         'typeAliasesMap' => 
        array (
        ),
         'bypassTypeAliases' => false,
         'constUses' => 
        array (
        ),
         'typeAliasClassName' => NULL,
         'traitData' => NULL,
      )),
      'acb9439f481a0b28b9a0dba6f827b232' => 
      \PHPStan\Analyser\IntermediaryNameScope::__set_state(array(
         'namespace' => 'App\\Services',
         'uses' => 
        array (
          'importentity' => 'App\\Enums\\ImportEntity',
          'importrowstatus' => 'App\\Enums\\ImportRowStatus',
          'importstatus' => 'App\\Enums\\ImportStatus',
          'pricelisttype' => 'App\\Enums\\PriceListType',
          'importvalidationexception' => 'App\\Exceptions\\ImportValidationException',
          'catalogrowsimport' => 'App\\Imports\\CatalogRowsImport',
          'importcatalogjob' => 'App\\Jobs\\ImportCatalogJob',
          'category' => 'App\\Models\\Category',
          'importbatch' => 'App\\Models\\ImportBatch',
          'importrow' => 'App\\Models\\ImportRow',
          'pricelist' => 'App\\Models\\PriceList',
          'pricelistitem' => 'App\\Models\\PriceListItem',
          'product' => 'App\\Models\\Product',
          'stocklevel' => 'App\\Models\\StockLevel',
          'supplier' => 'App\\Models\\Supplier',
          'user' => 'App\\Models\\User',
          'warehouse' => 'App\\Models\\Warehouse',
          'importrepositoryinterface' => 'App\\Repositories\\Contracts\\ImportRepositoryInterface',
          'lengthawarepaginator' => 'Illuminate\\Contracts\\Pagination\\LengthAwarePaginator',
          'uploadedfile' => 'Illuminate\\Http\\UploadedFile',
          'collection' => 'Illuminate\\Support\\Collection',
          'cache' => 'Illuminate\\Support\\Facades\\Cache',
          'db' => 'Illuminate\\Support\\Facades\\DB',
          'validator' => 'Illuminate\\Support\\Facades\\Validator',
          'str' => 'Illuminate\\Support\\Str',
          'rule' => 'Illuminate\\Validation\\Rule',
          'excel' => 'Maatwebsite\\Excel\\Facades\\Excel',
          'runtimeexception' => 'RuntimeException',
          'throwable' => 'Throwable',
        ),
         'className' => 'App\\Services\\ImportService',
         'functionName' => 'findBatch',
         'templatePhpDocNodes' => 
        array (
        ),
         'parent' => NULL,
         'typeAliasesMap' => 
        array (
        ),
         'bypassTypeAliases' => false,
         'constUses' => 
        array (
        ),
         'typeAliasClassName' => NULL,
         'traitData' => NULL,
      )),
      '17552962243e19e368148bc6483858c8' => 
      \PHPStan\Analyser\IntermediaryNameScope::__set_state(array(
         'namespace' => 'App\\Services',
         'uses' => 
        array (
          'importentity' => 'App\\Enums\\ImportEntity',
          'importrowstatus' => 'App\\Enums\\ImportRowStatus',
          'importstatus' => 'App\\Enums\\ImportStatus',
          'pricelisttype' => 'App\\Enums\\PriceListType',
          'importvalidationexception' => 'App\\Exceptions\\ImportValidationException',
          'catalogrowsimport' => 'App\\Imports\\CatalogRowsImport',
          'importcatalogjob' => 'App\\Jobs\\ImportCatalogJob',
          'category' => 'App\\Models\\Category',
          'importbatch' => 'App\\Models\\ImportBatch',
          'importrow' => 'App\\Models\\ImportRow',
          'pricelist' => 'App\\Models\\PriceList',
          'pricelistitem' => 'App\\Models\\PriceListItem',
          'product' => 'App\\Models\\Product',
          'stocklevel' => 'App\\Models\\StockLevel',
          'supplier' => 'App\\Models\\Supplier',
          'user' => 'App\\Models\\User',
          'warehouse' => 'App\\Models\\Warehouse',
          'importrepositoryinterface' => 'App\\Repositories\\Contracts\\ImportRepositoryInterface',
          'lengthawarepaginator' => 'Illuminate\\Contracts\\Pagination\\LengthAwarePaginator',
          'uploadedfile' => 'Illuminate\\Http\\UploadedFile',
          'collection' => 'Illuminate\\Support\\Collection',
          'cache' => 'Illuminate\\Support\\Facades\\Cache',
          'db' => 'Illuminate\\Support\\Facades\\DB',
          'validator' => 'Illuminate\\Support\\Facades\\Validator',
          'str' => 'Illuminate\\Support\\Str',
          'rule' => 'Illuminate\\Validation\\Rule',
          'excel' => 'Maatwebsite\\Excel\\Facades\\Excel',
          'runtimeexception' => 'RuntimeException',
          'throwable' => 'Throwable',
        ),
         'className' => 'App\\Services\\ImportService',
         'functionName' => 'rowsForBatch',
         'templatePhpDocNodes' => 
        array (
        ),
         'parent' => NULL,
         'typeAliasesMap' => 
        array (
        ),
         'bypassTypeAliases' => false,
         'constUses' => 
        array (
        ),
         'typeAliasClassName' => NULL,
         'traitData' => NULL,
      )),
      'f9a5618672927bfb0ab5890aa01120fa' => 
      \PHPStan\Analyser\IntermediaryNameScope::__set_state(array(
         'namespace' => 'App\\Services',
         'uses' => 
        array (
          'importentity' => 'App\\Enums\\ImportEntity',
          'importrowstatus' => 'App\\Enums\\ImportRowStatus',
          'importstatus' => 'App\\Enums\\ImportStatus',
          'pricelisttype' => 'App\\Enums\\PriceListType',
          'importvalidationexception' => 'App\\Exceptions\\ImportValidationException',
          'catalogrowsimport' => 'App\\Imports\\CatalogRowsImport',
          'importcatalogjob' => 'App\\Jobs\\ImportCatalogJob',
          'category' => 'App\\Models\\Category',
          'importbatch' => 'App\\Models\\ImportBatch',
          'importrow' => 'App\\Models\\ImportRow',
          'pricelist' => 'App\\Models\\PriceList',
          'pricelistitem' => 'App\\Models\\PriceListItem',
          'product' => 'App\\Models\\Product',
          'stocklevel' => 'App\\Models\\StockLevel',
          'supplier' => 'App\\Models\\Supplier',
          'user' => 'App\\Models\\User',
          'warehouse' => 'App\\Models\\Warehouse',
          'importrepositoryinterface' => 'App\\Repositories\\Contracts\\ImportRepositoryInterface',
          'lengthawarepaginator' => 'Illuminate\\Contracts\\Pagination\\LengthAwarePaginator',
          'uploadedfile' => 'Illuminate\\Http\\UploadedFile',
          'collection' => 'Illuminate\\Support\\Collection',
          'cache' => 'Illuminate\\Support\\Facades\\Cache',
          'db' => 'Illuminate\\Support\\Facades\\DB',
          'validator' => 'Illuminate\\Support\\Facades\\Validator',
          'str' => 'Illuminate\\Support\\Str',
          'rule' => 'Illuminate\\Validation\\Rule',
          'excel' => 'Maatwebsite\\Excel\\Facades\\Excel',
          'runtimeexception' => 'RuntimeException',
          'throwable' => 'Throwable',
        ),
         'className' => 'App\\Services\\ImportService',
         'functionName' => 'failedRowsForBatch',
         'templatePhpDocNodes' => 
        array (
        ),
         'parent' => NULL,
         'typeAliasesMap' => 
        array (
        ),
         'bypassTypeAliases' => false,
         'constUses' => 
        array (
        ),
         'typeAliasClassName' => NULL,
         'traitData' => NULL,
      )),
      '60dc8c0b0cc3fe2d11e4c1ab3efa1be4' => 
      \PHPStan\Analyser\IntermediaryNameScope::__set_state(array(
         'namespace' => 'App\\Services',
         'uses' => 
        array (
          'importentity' => 'App\\Enums\\ImportEntity',
          'importrowstatus' => 'App\\Enums\\ImportRowStatus',
          'importstatus' => 'App\\Enums\\ImportStatus',
          'pricelisttype' => 'App\\Enums\\PriceListType',
          'importvalidationexception' => 'App\\Exceptions\\ImportValidationException',
          'catalogrowsimport' => 'App\\Imports\\CatalogRowsImport',
          'importcatalogjob' => 'App\\Jobs\\ImportCatalogJob',
          'category' => 'App\\Models\\Category',
          'importbatch' => 'App\\Models\\ImportBatch',
          'importrow' => 'App\\Models\\ImportRow',
          'pricelist' => 'App\\Models\\PriceList',
          'pricelistitem' => 'App\\Models\\PriceListItem',
          'product' => 'App\\Models\\Product',
          'stocklevel' => 'App\\Models\\StockLevel',
          'supplier' => 'App\\Models\\Supplier',
          'user' => 'App\\Models\\User',
          'warehouse' => 'App\\Models\\Warehouse',
          'importrepositoryinterface' => 'App\\Repositories\\Contracts\\ImportRepositoryInterface',
          'lengthawarepaginator' => 'Illuminate\\Contracts\\Pagination\\LengthAwarePaginator',
          'uploadedfile' => 'Illuminate\\Http\\UploadedFile',
          'collection' => 'Illuminate\\Support\\Collection',
          'cache' => 'Illuminate\\Support\\Facades\\Cache',
          'db' => 'Illuminate\\Support\\Facades\\DB',
          'validator' => 'Illuminate\\Support\\Facades\\Validator',
          'str' => 'Illuminate\\Support\\Str',
          'rule' => 'Illuminate\\Validation\\Rule',
          'excel' => 'Maatwebsite\\Excel\\Facades\\Excel',
          'runtimeexception' => 'RuntimeException',
          'throwable' => 'Throwable',
        ),
         'className' => 'App\\Services\\ImportService',
         'functionName' => 'start',
         'templatePhpDocNodes' => 
        array (
        ),
         'parent' => NULL,
         'typeAliasesMap' => 
        array (
        ),
         'bypassTypeAliases' => false,
         'constUses' => 
        array (
        ),
         'typeAliasClassName' => NULL,
         'traitData' => NULL,
      )),
      'eeb854577b1de7ef307e6579836322d0' => 
      \PHPStan\Analyser\IntermediaryNameScope::__set_state(array(
         'namespace' => 'App\\Services',
         'uses' => 
        array (
          'importentity' => 'App\\Enums\\ImportEntity',
          'importrowstatus' => 'App\\Enums\\ImportRowStatus',
          'importstatus' => 'App\\Enums\\ImportStatus',
          'pricelisttype' => 'App\\Enums\\PriceListType',
          'importvalidationexception' => 'App\\Exceptions\\ImportValidationException',
          'catalogrowsimport' => 'App\\Imports\\CatalogRowsImport',
          'importcatalogjob' => 'App\\Jobs\\ImportCatalogJob',
          'category' => 'App\\Models\\Category',
          'importbatch' => 'App\\Models\\ImportBatch',
          'importrow' => 'App\\Models\\ImportRow',
          'pricelist' => 'App\\Models\\PriceList',
          'pricelistitem' => 'App\\Models\\PriceListItem',
          'product' => 'App\\Models\\Product',
          'stocklevel' => 'App\\Models\\StockLevel',
          'supplier' => 'App\\Models\\Supplier',
          'user' => 'App\\Models\\User',
          'warehouse' => 'App\\Models\\Warehouse',
          'importrepositoryinterface' => 'App\\Repositories\\Contracts\\ImportRepositoryInterface',
          'lengthawarepaginator' => 'Illuminate\\Contracts\\Pagination\\LengthAwarePaginator',
          'uploadedfile' => 'Illuminate\\Http\\UploadedFile',
          'collection' => 'Illuminate\\Support\\Collection',
          'cache' => 'Illuminate\\Support\\Facades\\Cache',
          'db' => 'Illuminate\\Support\\Facades\\DB',
          'validator' => 'Illuminate\\Support\\Facades\\Validator',
          'str' => 'Illuminate\\Support\\Str',
          'rule' => 'Illuminate\\Validation\\Rule',
          'excel' => 'Maatwebsite\\Excel\\Facades\\Excel',
          'runtimeexception' => 'RuntimeException',
          'throwable' => 'Throwable',
        ),
         'className' => 'App\\Services\\ImportService',
         'functionName' => 'run',
         'templatePhpDocNodes' => 
        array (
        ),
         'parent' => NULL,
         'typeAliasesMap' => 
        array (
        ),
         'bypassTypeAliases' => false,
         'constUses' => 
        array (
        ),
         'typeAliasClassName' => NULL,
         'traitData' => NULL,
      )),
      'd1f037d47571f8f188d344e11c0b254f' => 
      \PHPStan\Analyser\IntermediaryNameScope::__set_state(array(
         'namespace' => 'App\\Services',
         'uses' => 
        array (
          'importentity' => 'App\\Enums\\ImportEntity',
          'importrowstatus' => 'App\\Enums\\ImportRowStatus',
          'importstatus' => 'App\\Enums\\ImportStatus',
          'pricelisttype' => 'App\\Enums\\PriceListType',
          'importvalidationexception' => 'App\\Exceptions\\ImportValidationException',
          'catalogrowsimport' => 'App\\Imports\\CatalogRowsImport',
          'importcatalogjob' => 'App\\Jobs\\ImportCatalogJob',
          'category' => 'App\\Models\\Category',
          'importbatch' => 'App\\Models\\ImportBatch',
          'importrow' => 'App\\Models\\ImportRow',
          'pricelist' => 'App\\Models\\PriceList',
          'pricelistitem' => 'App\\Models\\PriceListItem',
          'product' => 'App\\Models\\Product',
          'stocklevel' => 'App\\Models\\StockLevel',
          'supplier' => 'App\\Models\\Supplier',
          'user' => 'App\\Models\\User',
          'warehouse' => 'App\\Models\\Warehouse',
          'importrepositoryinterface' => 'App\\Repositories\\Contracts\\ImportRepositoryInterface',
          'lengthawarepaginator' => 'Illuminate\\Contracts\\Pagination\\LengthAwarePaginator',
          'uploadedfile' => 'Illuminate\\Http\\UploadedFile',
          'collection' => 'Illuminate\\Support\\Collection',
          'cache' => 'Illuminate\\Support\\Facades\\Cache',
          'db' => 'Illuminate\\Support\\Facades\\DB',
          'validator' => 'Illuminate\\Support\\Facades\\Validator',
          'str' => 'Illuminate\\Support\\Str',
          'rule' => 'Illuminate\\Validation\\Rule',
          'excel' => 'Maatwebsite\\Excel\\Facades\\Excel',
          'runtimeexception' => 'RuntimeException',
          'throwable' => 'Throwable',
        ),
         'className' => 'App\\Services\\ImportService',
         'functionName' => 'processRow',
         'templatePhpDocNodes' => 
        array (
        ),
         'parent' => NULL,
         'typeAliasesMap' => 
        array (
        ),
         'bypassTypeAliases' => false,
         'constUses' => 
        array (
        ),
         'typeAliasClassName' => NULL,
         'traitData' => NULL,
      )),
      '774c04d548e01df8c23d39a353054117' => 
      \PHPStan\Analyser\IntermediaryNameScope::__set_state(array(
         'namespace' => 'App\\Services',
         'uses' => 
        array (
          'importentity' => 'App\\Enums\\ImportEntity',
          'importrowstatus' => 'App\\Enums\\ImportRowStatus',
          'importstatus' => 'App\\Enums\\ImportStatus',
          'pricelisttype' => 'App\\Enums\\PriceListType',
          'importvalidationexception' => 'App\\Exceptions\\ImportValidationException',
          'catalogrowsimport' => 'App\\Imports\\CatalogRowsImport',
          'importcatalogjob' => 'App\\Jobs\\ImportCatalogJob',
          'category' => 'App\\Models\\Category',
          'importbatch' => 'App\\Models\\ImportBatch',
          'importrow' => 'App\\Models\\ImportRow',
          'pricelist' => 'App\\Models\\PriceList',
          'pricelistitem' => 'App\\Models\\PriceListItem',
          'product' => 'App\\Models\\Product',
          'stocklevel' => 'App\\Models\\StockLevel',
          'supplier' => 'App\\Models\\Supplier',
          'user' => 'App\\Models\\User',
          'warehouse' => 'App\\Models\\Warehouse',
          'importrepositoryinterface' => 'App\\Repositories\\Contracts\\ImportRepositoryInterface',
          'lengthawarepaginator' => 'Illuminate\\Contracts\\Pagination\\LengthAwarePaginator',
          'uploadedfile' => 'Illuminate\\Http\\UploadedFile',
          'collection' => 'Illuminate\\Support\\Collection',
          'cache' => 'Illuminate\\Support\\Facades\\Cache',
          'db' => 'Illuminate\\Support\\Facades\\DB',
          'validator' => 'Illuminate\\Support\\Facades\\Validator',
          'str' => 'Illuminate\\Support\\Str',
          'rule' => 'Illuminate\\Validation\\Rule',
          'excel' => 'Maatwebsite\\Excel\\Facades\\Excel',
          'runtimeexception' => 'RuntimeException',
          'throwable' => 'Throwable',
        ),
         'className' => 'App\\Services\\ImportService',
         'functionName' => 'createRowsFromFile',
         'templatePhpDocNodes' => 
        array (
        ),
         'parent' => NULL,
         'typeAliasesMap' => 
        array (
        ),
         'bypassTypeAliases' => false,
         'constUses' => 
        array (
        ),
         'typeAliasClassName' => NULL,
         'traitData' => NULL,
      )),
      'f1d827070ca6e680a445ccd78d289fa4' => 
      \PHPStan\Analyser\IntermediaryNameScope::__set_state(array(
         'namespace' => 'App\\Services',
         'uses' => 
        array (
          'importentity' => 'App\\Enums\\ImportEntity',
          'importrowstatus' => 'App\\Enums\\ImportRowStatus',
          'importstatus' => 'App\\Enums\\ImportStatus',
          'pricelisttype' => 'App\\Enums\\PriceListType',
          'importvalidationexception' => 'App\\Exceptions\\ImportValidationException',
          'catalogrowsimport' => 'App\\Imports\\CatalogRowsImport',
          'importcatalogjob' => 'App\\Jobs\\ImportCatalogJob',
          'category' => 'App\\Models\\Category',
          'importbatch' => 'App\\Models\\ImportBatch',
          'importrow' => 'App\\Models\\ImportRow',
          'pricelist' => 'App\\Models\\PriceList',
          'pricelistitem' => 'App\\Models\\PriceListItem',
          'product' => 'App\\Models\\Product',
          'stocklevel' => 'App\\Models\\StockLevel',
          'supplier' => 'App\\Models\\Supplier',
          'user' => 'App\\Models\\User',
          'warehouse' => 'App\\Models\\Warehouse',
          'importrepositoryinterface' => 'App\\Repositories\\Contracts\\ImportRepositoryInterface',
          'lengthawarepaginator' => 'Illuminate\\Contracts\\Pagination\\LengthAwarePaginator',
          'uploadedfile' => 'Illuminate\\Http\\UploadedFile',
          'collection' => 'Illuminate\\Support\\Collection',
          'cache' => 'Illuminate\\Support\\Facades\\Cache',
          'db' => 'Illuminate\\Support\\Facades\\DB',
          'validator' => 'Illuminate\\Support\\Facades\\Validator',
          'str' => 'Illuminate\\Support\\Str',
          'rule' => 'Illuminate\\Validation\\Rule',
          'excel' => 'Maatwebsite\\Excel\\Facades\\Excel',
          'runtimeexception' => 'RuntimeException',
          'throwable' => 'Throwable',
        ),
         'className' => 'App\\Services\\ImportService',
         'functionName' => 'processPendingRows',
         'templatePhpDocNodes' => 
        array (
        ),
         'parent' => NULL,
         'typeAliasesMap' => 
        array (
        ),
         'bypassTypeAliases' => false,
         'constUses' => 
        array (
        ),
         'typeAliasClassName' => NULL,
         'traitData' => NULL,
      )),
      '5a0c727a4064044f549099db84d13ba1' => 
      \PHPStan\Analyser\IntermediaryNameScope::__set_state(array(
         'namespace' => 'App\\Services',
         'uses' => 
        array (
          'importentity' => 'App\\Enums\\ImportEntity',
          'importrowstatus' => 'App\\Enums\\ImportRowStatus',
          'importstatus' => 'App\\Enums\\ImportStatus',
          'pricelisttype' => 'App\\Enums\\PriceListType',
          'importvalidationexception' => 'App\\Exceptions\\ImportValidationException',
          'catalogrowsimport' => 'App\\Imports\\CatalogRowsImport',
          'importcatalogjob' => 'App\\Jobs\\ImportCatalogJob',
          'category' => 'App\\Models\\Category',
          'importbatch' => 'App\\Models\\ImportBatch',
          'importrow' => 'App\\Models\\ImportRow',
          'pricelist' => 'App\\Models\\PriceList',
          'pricelistitem' => 'App\\Models\\PriceListItem',
          'product' => 'App\\Models\\Product',
          'stocklevel' => 'App\\Models\\StockLevel',
          'supplier' => 'App\\Models\\Supplier',
          'user' => 'App\\Models\\User',
          'warehouse' => 'App\\Models\\Warehouse',
          'importrepositoryinterface' => 'App\\Repositories\\Contracts\\ImportRepositoryInterface',
          'lengthawarepaginator' => 'Illuminate\\Contracts\\Pagination\\LengthAwarePaginator',
          'uploadedfile' => 'Illuminate\\Http\\UploadedFile',
          'collection' => 'Illuminate\\Support\\Collection',
          'cache' => 'Illuminate\\Support\\Facades\\Cache',
          'db' => 'Illuminate\\Support\\Facades\\DB',
          'validator' => 'Illuminate\\Support\\Facades\\Validator',
          'str' => 'Illuminate\\Support\\Str',
          'rule' => 'Illuminate\\Validation\\Rule',
          'excel' => 'Maatwebsite\\Excel\\Facades\\Excel',
          'runtimeexception' => 'RuntimeException',
          'throwable' => 'Throwable',
        ),
         'className' => 'App\\Services\\ImportService',
         'functionName' => 'importStoredRow',
         'templatePhpDocNodes' => 
        array (
        ),
         'parent' => NULL,
         'typeAliasesMap' => 
        array (
        ),
         'bypassTypeAliases' => false,
         'constUses' => 
        array (
        ),
         'typeAliasClassName' => NULL,
         'traitData' => NULL,
      )),
      '49431015e844d32921c6edd7c197b018' => 
      \PHPStan\Analyser\IntermediaryNameScope::__set_state(array(
         'namespace' => 'App\\Services',
         'uses' => 
        array (
          'importentity' => 'App\\Enums\\ImportEntity',
          'importrowstatus' => 'App\\Enums\\ImportRowStatus',
          'importstatus' => 'App\\Enums\\ImportStatus',
          'pricelisttype' => 'App\\Enums\\PriceListType',
          'importvalidationexception' => 'App\\Exceptions\\ImportValidationException',
          'catalogrowsimport' => 'App\\Imports\\CatalogRowsImport',
          'importcatalogjob' => 'App\\Jobs\\ImportCatalogJob',
          'category' => 'App\\Models\\Category',
          'importbatch' => 'App\\Models\\ImportBatch',
          'importrow' => 'App\\Models\\ImportRow',
          'pricelist' => 'App\\Models\\PriceList',
          'pricelistitem' => 'App\\Models\\PriceListItem',
          'product' => 'App\\Models\\Product',
          'stocklevel' => 'App\\Models\\StockLevel',
          'supplier' => 'App\\Models\\Supplier',
          'user' => 'App\\Models\\User',
          'warehouse' => 'App\\Models\\Warehouse',
          'importrepositoryinterface' => 'App\\Repositories\\Contracts\\ImportRepositoryInterface',
          'lengthawarepaginator' => 'Illuminate\\Contracts\\Pagination\\LengthAwarePaginator',
          'uploadedfile' => 'Illuminate\\Http\\UploadedFile',
          'collection' => 'Illuminate\\Support\\Collection',
          'cache' => 'Illuminate\\Support\\Facades\\Cache',
          'db' => 'Illuminate\\Support\\Facades\\DB',
          'validator' => 'Illuminate\\Support\\Facades\\Validator',
          'str' => 'Illuminate\\Support\\Str',
          'rule' => 'Illuminate\\Validation\\Rule',
          'excel' => 'Maatwebsite\\Excel\\Facades\\Excel',
          'runtimeexception' => 'RuntimeException',
          'throwable' => 'Throwable',
        ),
         'className' => 'App\\Services\\ImportService',
         'functionName' => 'importCategory',
         'templatePhpDocNodes' => 
        array (
        ),
         'parent' => NULL,
         'typeAliasesMap' => 
        array (
        ),
         'bypassTypeAliases' => false,
         'constUses' => 
        array (
        ),
         'typeAliasClassName' => NULL,
         'traitData' => NULL,
      )),
      '9895ac3e3508b17259afb98f40bbfae4' => 
      \PHPStan\Analyser\IntermediaryNameScope::__set_state(array(
         'namespace' => 'App\\Services',
         'uses' => 
        array (
          'importentity' => 'App\\Enums\\ImportEntity',
          'importrowstatus' => 'App\\Enums\\ImportRowStatus',
          'importstatus' => 'App\\Enums\\ImportStatus',
          'pricelisttype' => 'App\\Enums\\PriceListType',
          'importvalidationexception' => 'App\\Exceptions\\ImportValidationException',
          'catalogrowsimport' => 'App\\Imports\\CatalogRowsImport',
          'importcatalogjob' => 'App\\Jobs\\ImportCatalogJob',
          'category' => 'App\\Models\\Category',
          'importbatch' => 'App\\Models\\ImportBatch',
          'importrow' => 'App\\Models\\ImportRow',
          'pricelist' => 'App\\Models\\PriceList',
          'pricelistitem' => 'App\\Models\\PriceListItem',
          'product' => 'App\\Models\\Product',
          'stocklevel' => 'App\\Models\\StockLevel',
          'supplier' => 'App\\Models\\Supplier',
          'user' => 'App\\Models\\User',
          'warehouse' => 'App\\Models\\Warehouse',
          'importrepositoryinterface' => 'App\\Repositories\\Contracts\\ImportRepositoryInterface',
          'lengthawarepaginator' => 'Illuminate\\Contracts\\Pagination\\LengthAwarePaginator',
          'uploadedfile' => 'Illuminate\\Http\\UploadedFile',
          'collection' => 'Illuminate\\Support\\Collection',
          'cache' => 'Illuminate\\Support\\Facades\\Cache',
          'db' => 'Illuminate\\Support\\Facades\\DB',
          'validator' => 'Illuminate\\Support\\Facades\\Validator',
          'str' => 'Illuminate\\Support\\Str',
          'rule' => 'Illuminate\\Validation\\Rule',
          'excel' => 'Maatwebsite\\Excel\\Facades\\Excel',
          'runtimeexception' => 'RuntimeException',
          'throwable' => 'Throwable',
        ),
         'className' => 'App\\Services\\ImportService',
         'functionName' => 'importProduct',
         'templatePhpDocNodes' => 
        array (
        ),
         'parent' => NULL,
         'typeAliasesMap' => 
        array (
        ),
         'bypassTypeAliases' => false,
         'constUses' => 
        array (
        ),
         'typeAliasClassName' => NULL,
         'traitData' => NULL,
      )),
      '06de1a7c5e10fa6ab4d4334a5694004e' => 
      \PHPStan\Analyser\IntermediaryNameScope::__set_state(array(
         'namespace' => 'App\\Services',
         'uses' => 
        array (
          'importentity' => 'App\\Enums\\ImportEntity',
          'importrowstatus' => 'App\\Enums\\ImportRowStatus',
          'importstatus' => 'App\\Enums\\ImportStatus',
          'pricelisttype' => 'App\\Enums\\PriceListType',
          'importvalidationexception' => 'App\\Exceptions\\ImportValidationException',
          'catalogrowsimport' => 'App\\Imports\\CatalogRowsImport',
          'importcatalogjob' => 'App\\Jobs\\ImportCatalogJob',
          'category' => 'App\\Models\\Category',
          'importbatch' => 'App\\Models\\ImportBatch',
          'importrow' => 'App\\Models\\ImportRow',
          'pricelist' => 'App\\Models\\PriceList',
          'pricelistitem' => 'App\\Models\\PriceListItem',
          'product' => 'App\\Models\\Product',
          'stocklevel' => 'App\\Models\\StockLevel',
          'supplier' => 'App\\Models\\Supplier',
          'user' => 'App\\Models\\User',
          'warehouse' => 'App\\Models\\Warehouse',
          'importrepositoryinterface' => 'App\\Repositories\\Contracts\\ImportRepositoryInterface',
          'lengthawarepaginator' => 'Illuminate\\Contracts\\Pagination\\LengthAwarePaginator',
          'uploadedfile' => 'Illuminate\\Http\\UploadedFile',
          'collection' => 'Illuminate\\Support\\Collection',
          'cache' => 'Illuminate\\Support\\Facades\\Cache',
          'db' => 'Illuminate\\Support\\Facades\\DB',
          'validator' => 'Illuminate\\Support\\Facades\\Validator',
          'str' => 'Illuminate\\Support\\Str',
          'rule' => 'Illuminate\\Validation\\Rule',
          'excel' => 'Maatwebsite\\Excel\\Facades\\Excel',
          'runtimeexception' => 'RuntimeException',
          'throwable' => 'Throwable',
        ),
         'className' => 'App\\Services\\ImportService',
         'functionName' => 'importWarehouse',
         'templatePhpDocNodes' => 
        array (
        ),
         'parent' => NULL,
         'typeAliasesMap' => 
        array (
        ),
         'bypassTypeAliases' => false,
         'constUses' => 
        array (
        ),
         'typeAliasClassName' => NULL,
         'traitData' => NULL,
      )),
      '8ae24dfc0aeb4ba0553cf17b8ab6b62c' => 
      \PHPStan\Analyser\IntermediaryNameScope::__set_state(array(
         'namespace' => 'App\\Services',
         'uses' => 
        array (
          'importentity' => 'App\\Enums\\ImportEntity',
          'importrowstatus' => 'App\\Enums\\ImportRowStatus',
          'importstatus' => 'App\\Enums\\ImportStatus',
          'pricelisttype' => 'App\\Enums\\PriceListType',
          'importvalidationexception' => 'App\\Exceptions\\ImportValidationException',
          'catalogrowsimport' => 'App\\Imports\\CatalogRowsImport',
          'importcatalogjob' => 'App\\Jobs\\ImportCatalogJob',
          'category' => 'App\\Models\\Category',
          'importbatch' => 'App\\Models\\ImportBatch',
          'importrow' => 'App\\Models\\ImportRow',
          'pricelist' => 'App\\Models\\PriceList',
          'pricelistitem' => 'App\\Models\\PriceListItem',
          'product' => 'App\\Models\\Product',
          'stocklevel' => 'App\\Models\\StockLevel',
          'supplier' => 'App\\Models\\Supplier',
          'user' => 'App\\Models\\User',
          'warehouse' => 'App\\Models\\Warehouse',
          'importrepositoryinterface' => 'App\\Repositories\\Contracts\\ImportRepositoryInterface',
          'lengthawarepaginator' => 'Illuminate\\Contracts\\Pagination\\LengthAwarePaginator',
          'uploadedfile' => 'Illuminate\\Http\\UploadedFile',
          'collection' => 'Illuminate\\Support\\Collection',
          'cache' => 'Illuminate\\Support\\Facades\\Cache',
          'db' => 'Illuminate\\Support\\Facades\\DB',
          'validator' => 'Illuminate\\Support\\Facades\\Validator',
          'str' => 'Illuminate\\Support\\Str',
          'rule' => 'Illuminate\\Validation\\Rule',
          'excel' => 'Maatwebsite\\Excel\\Facades\\Excel',
          'runtimeexception' => 'RuntimeException',
          'throwable' => 'Throwable',
        ),
         'className' => 'App\\Services\\ImportService',
         'functionName' => 'importSupplier',
         'templatePhpDocNodes' => 
        array (
        ),
         'parent' => NULL,
         'typeAliasesMap' => 
        array (
        ),
         'bypassTypeAliases' => false,
         'constUses' => 
        array (
        ),
         'typeAliasClassName' => NULL,
         'traitData' => NULL,
      )),
      'ffd57c89ae1d7cef89536780a658fac4' => 
      \PHPStan\Analyser\IntermediaryNameScope::__set_state(array(
         'namespace' => 'App\\Services',
         'uses' => 
        array (
          'importentity' => 'App\\Enums\\ImportEntity',
          'importrowstatus' => 'App\\Enums\\ImportRowStatus',
          'importstatus' => 'App\\Enums\\ImportStatus',
          'pricelisttype' => 'App\\Enums\\PriceListType',
          'importvalidationexception' => 'App\\Exceptions\\ImportValidationException',
          'catalogrowsimport' => 'App\\Imports\\CatalogRowsImport',
          'importcatalogjob' => 'App\\Jobs\\ImportCatalogJob',
          'category' => 'App\\Models\\Category',
          'importbatch' => 'App\\Models\\ImportBatch',
          'importrow' => 'App\\Models\\ImportRow',
          'pricelist' => 'App\\Models\\PriceList',
          'pricelistitem' => 'App\\Models\\PriceListItem',
          'product' => 'App\\Models\\Product',
          'stocklevel' => 'App\\Models\\StockLevel',
          'supplier' => 'App\\Models\\Supplier',
          'user' => 'App\\Models\\User',
          'warehouse' => 'App\\Models\\Warehouse',
          'importrepositoryinterface' => 'App\\Repositories\\Contracts\\ImportRepositoryInterface',
          'lengthawarepaginator' => 'Illuminate\\Contracts\\Pagination\\LengthAwarePaginator',
          'uploadedfile' => 'Illuminate\\Http\\UploadedFile',
          'collection' => 'Illuminate\\Support\\Collection',
          'cache' => 'Illuminate\\Support\\Facades\\Cache',
          'db' => 'Illuminate\\Support\\Facades\\DB',
          'validator' => 'Illuminate\\Support\\Facades\\Validator',
          'str' => 'Illuminate\\Support\\Str',
          'rule' => 'Illuminate\\Validation\\Rule',
          'excel' => 'Maatwebsite\\Excel\\Facades\\Excel',
          'runtimeexception' => 'RuntimeException',
          'throwable' => 'Throwable',
        ),
         'className' => 'App\\Services\\ImportService',
         'functionName' => 'importPriceListItem',
         'templatePhpDocNodes' => 
        array (
        ),
         'parent' => NULL,
         'typeAliasesMap' => 
        array (
        ),
         'bypassTypeAliases' => false,
         'constUses' => 
        array (
        ),
         'typeAliasClassName' => NULL,
         'traitData' => NULL,
      )),
      '991d3a12f8bc3a7d40a387a99f8c1018' => 
      \PHPStan\Analyser\IntermediaryNameScope::__set_state(array(
         'namespace' => 'App\\Services',
         'uses' => 
        array (
          'importentity' => 'App\\Enums\\ImportEntity',
          'importrowstatus' => 'App\\Enums\\ImportRowStatus',
          'importstatus' => 'App\\Enums\\ImportStatus',
          'pricelisttype' => 'App\\Enums\\PriceListType',
          'importvalidationexception' => 'App\\Exceptions\\ImportValidationException',
          'catalogrowsimport' => 'App\\Imports\\CatalogRowsImport',
          'importcatalogjob' => 'App\\Jobs\\ImportCatalogJob',
          'category' => 'App\\Models\\Category',
          'importbatch' => 'App\\Models\\ImportBatch',
          'importrow' => 'App\\Models\\ImportRow',
          'pricelist' => 'App\\Models\\PriceList',
          'pricelistitem' => 'App\\Models\\PriceListItem',
          'product' => 'App\\Models\\Product',
          'stocklevel' => 'App\\Models\\StockLevel',
          'supplier' => 'App\\Models\\Supplier',
          'user' => 'App\\Models\\User',
          'warehouse' => 'App\\Models\\Warehouse',
          'importrepositoryinterface' => 'App\\Repositories\\Contracts\\ImportRepositoryInterface',
          'lengthawarepaginator' => 'Illuminate\\Contracts\\Pagination\\LengthAwarePaginator',
          'uploadedfile' => 'Illuminate\\Http\\UploadedFile',
          'collection' => 'Illuminate\\Support\\Collection',
          'cache' => 'Illuminate\\Support\\Facades\\Cache',
          'db' => 'Illuminate\\Support\\Facades\\DB',
          'validator' => 'Illuminate\\Support\\Facades\\Validator',
          'str' => 'Illuminate\\Support\\Str',
          'rule' => 'Illuminate\\Validation\\Rule',
          'excel' => 'Maatwebsite\\Excel\\Facades\\Excel',
          'runtimeexception' => 'RuntimeException',
          'throwable' => 'Throwable',
        ),
         'className' => 'App\\Services\\ImportService',
         'functionName' => 'importOpeningStock',
         'templatePhpDocNodes' => 
        array (
        ),
         'parent' => NULL,
         'typeAliasesMap' => 
        array (
        ),
         'bypassTypeAliases' => false,
         'constUses' => 
        array (
        ),
         'typeAliasClassName' => NULL,
         'traitData' => NULL,
      )),
      'cc0c3d78abd87bade817d510774dfb91' => 
      \PHPStan\Analyser\IntermediaryNameScope::__set_state(array(
         'namespace' => 'App\\Services',
         'uses' => 
        array (
          'importentity' => 'App\\Enums\\ImportEntity',
          'importrowstatus' => 'App\\Enums\\ImportRowStatus',
          'importstatus' => 'App\\Enums\\ImportStatus',
          'pricelisttype' => 'App\\Enums\\PriceListType',
          'importvalidationexception' => 'App\\Exceptions\\ImportValidationException',
          'catalogrowsimport' => 'App\\Imports\\CatalogRowsImport',
          'importcatalogjob' => 'App\\Jobs\\ImportCatalogJob',
          'category' => 'App\\Models\\Category',
          'importbatch' => 'App\\Models\\ImportBatch',
          'importrow' => 'App\\Models\\ImportRow',
          'pricelist' => 'App\\Models\\PriceList',
          'pricelistitem' => 'App\\Models\\PriceListItem',
          'product' => 'App\\Models\\Product',
          'stocklevel' => 'App\\Models\\StockLevel',
          'supplier' => 'App\\Models\\Supplier',
          'user' => 'App\\Models\\User',
          'warehouse' => 'App\\Models\\Warehouse',
          'importrepositoryinterface' => 'App\\Repositories\\Contracts\\ImportRepositoryInterface',
          'lengthawarepaginator' => 'Illuminate\\Contracts\\Pagination\\LengthAwarePaginator',
          'uploadedfile' => 'Illuminate\\Http\\UploadedFile',
          'collection' => 'Illuminate\\Support\\Collection',
          'cache' => 'Illuminate\\Support\\Facades\\Cache',
          'db' => 'Illuminate\\Support\\Facades\\DB',
          'validator' => 'Illuminate\\Support\\Facades\\Validator',
          'str' => 'Illuminate\\Support\\Str',
          'rule' => 'Illuminate\\Validation\\Rule',
          'excel' => 'Maatwebsite\\Excel\\Facades\\Excel',
          'runtimeexception' => 'RuntimeException',
          'throwable' => 'Throwable',
        ),
         'className' => 'App\\Services\\ImportService',
         'functionName' => 'validate',
         'templatePhpDocNodes' => 
        array (
        ),
         'parent' => NULL,
         'typeAliasesMap' => 
        array (
        ),
         'bypassTypeAliases' => false,
         'constUses' => 
        array (
        ),
         'typeAliasClassName' => NULL,
         'traitData' => NULL,
      )),
      '6fa8ab6ae8407eb8c08cbcd33a512acb' => 
      \PHPStan\Analyser\IntermediaryNameScope::__set_state(array(
         'namespace' => 'App\\Services',
         'uses' => 
        array (
          'importentity' => 'App\\Enums\\ImportEntity',
          'importrowstatus' => 'App\\Enums\\ImportRowStatus',
          'importstatus' => 'App\\Enums\\ImportStatus',
          'pricelisttype' => 'App\\Enums\\PriceListType',
          'importvalidationexception' => 'App\\Exceptions\\ImportValidationException',
          'catalogrowsimport' => 'App\\Imports\\CatalogRowsImport',
          'importcatalogjob' => 'App\\Jobs\\ImportCatalogJob',
          'category' => 'App\\Models\\Category',
          'importbatch' => 'App\\Models\\ImportBatch',
          'importrow' => 'App\\Models\\ImportRow',
          'pricelist' => 'App\\Models\\PriceList',
          'pricelistitem' => 'App\\Models\\PriceListItem',
          'product' => 'App\\Models\\Product',
          'stocklevel' => 'App\\Models\\StockLevel',
          'supplier' => 'App\\Models\\Supplier',
          'user' => 'App\\Models\\User',
          'warehouse' => 'App\\Models\\Warehouse',
          'importrepositoryinterface' => 'App\\Repositories\\Contracts\\ImportRepositoryInterface',
          'lengthawarepaginator' => 'Illuminate\\Contracts\\Pagination\\LengthAwarePaginator',
          'uploadedfile' => 'Illuminate\\Http\\UploadedFile',
          'collection' => 'Illuminate\\Support\\Collection',
          'cache' => 'Illuminate\\Support\\Facades\\Cache',
          'db' => 'Illuminate\\Support\\Facades\\DB',
          'validator' => 'Illuminate\\Support\\Facades\\Validator',
          'str' => 'Illuminate\\Support\\Str',
          'rule' => 'Illuminate\\Validation\\Rule',
          'excel' => 'Maatwebsite\\Excel\\Facades\\Excel',
          'runtimeexception' => 'RuntimeException',
          'throwable' => 'Throwable',
        ),
         'className' => 'App\\Services\\ImportService',
         'functionName' => 'resolveCategory',
         'templatePhpDocNodes' => 
        array (
        ),
         'parent' => NULL,
         'typeAliasesMap' => 
        array (
        ),
         'bypassTypeAliases' => false,
         'constUses' => 
        array (
        ),
         'typeAliasClassName' => NULL,
         'traitData' => NULL,
      )),
      '35a63cb5a46c2b6c5344137a95265a9e' => 
      \PHPStan\Analyser\IntermediaryNameScope::__set_state(array(
         'namespace' => 'App\\Services',
         'uses' => 
        array (
          'importentity' => 'App\\Enums\\ImportEntity',
          'importrowstatus' => 'App\\Enums\\ImportRowStatus',
          'importstatus' => 'App\\Enums\\ImportStatus',
          'pricelisttype' => 'App\\Enums\\PriceListType',
          'importvalidationexception' => 'App\\Exceptions\\ImportValidationException',
          'catalogrowsimport' => 'App\\Imports\\CatalogRowsImport',
          'importcatalogjob' => 'App\\Jobs\\ImportCatalogJob',
          'category' => 'App\\Models\\Category',
          'importbatch' => 'App\\Models\\ImportBatch',
          'importrow' => 'App\\Models\\ImportRow',
          'pricelist' => 'App\\Models\\PriceList',
          'pricelistitem' => 'App\\Models\\PriceListItem',
          'product' => 'App\\Models\\Product',
          'stocklevel' => 'App\\Models\\StockLevel',
          'supplier' => 'App\\Models\\Supplier',
          'user' => 'App\\Models\\User',
          'warehouse' => 'App\\Models\\Warehouse',
          'importrepositoryinterface' => 'App\\Repositories\\Contracts\\ImportRepositoryInterface',
          'lengthawarepaginator' => 'Illuminate\\Contracts\\Pagination\\LengthAwarePaginator',
          'uploadedfile' => 'Illuminate\\Http\\UploadedFile',
          'collection' => 'Illuminate\\Support\\Collection',
          'cache' => 'Illuminate\\Support\\Facades\\Cache',
          'db' => 'Illuminate\\Support\\Facades\\DB',
          'validator' => 'Illuminate\\Support\\Facades\\Validator',
          'str' => 'Illuminate\\Support\\Str',
          'rule' => 'Illuminate\\Validation\\Rule',
          'excel' => 'Maatwebsite\\Excel\\Facades\\Excel',
          'runtimeexception' => 'RuntimeException',
          'throwable' => 'Throwable',
        ),
         'className' => 'App\\Services\\ImportService',
         'functionName' => 'resolveSupplier',
         'templatePhpDocNodes' => 
        array (
        ),
         'parent' => NULL,
         'typeAliasesMap' => 
        array (
        ),
         'bypassTypeAliases' => false,
         'constUses' => 
        array (
        ),
         'typeAliasClassName' => NULL,
         'traitData' => NULL,
      )),
      'ccdea60a55b539a39aca610197fccca5' => 
      \PHPStan\Analyser\IntermediaryNameScope::__set_state(array(
         'namespace' => 'App\\Services',
         'uses' => 
        array (
          'importentity' => 'App\\Enums\\ImportEntity',
          'importrowstatus' => 'App\\Enums\\ImportRowStatus',
          'importstatus' => 'App\\Enums\\ImportStatus',
          'pricelisttype' => 'App\\Enums\\PriceListType',
          'importvalidationexception' => 'App\\Exceptions\\ImportValidationException',
          'catalogrowsimport' => 'App\\Imports\\CatalogRowsImport',
          'importcatalogjob' => 'App\\Jobs\\ImportCatalogJob',
          'category' => 'App\\Models\\Category',
          'importbatch' => 'App\\Models\\ImportBatch',
          'importrow' => 'App\\Models\\ImportRow',
          'pricelist' => 'App\\Models\\PriceList',
          'pricelistitem' => 'App\\Models\\PriceListItem',
          'product' => 'App\\Models\\Product',
          'stocklevel' => 'App\\Models\\StockLevel',
          'supplier' => 'App\\Models\\Supplier',
          'user' => 'App\\Models\\User',
          'warehouse' => 'App\\Models\\Warehouse',
          'importrepositoryinterface' => 'App\\Repositories\\Contracts\\ImportRepositoryInterface',
          'lengthawarepaginator' => 'Illuminate\\Contracts\\Pagination\\LengthAwarePaginator',
          'uploadedfile' => 'Illuminate\\Http\\UploadedFile',
          'collection' => 'Illuminate\\Support\\Collection',
          'cache' => 'Illuminate\\Support\\Facades\\Cache',
          'db' => 'Illuminate\\Support\\Facades\\DB',
          'validator' => 'Illuminate\\Support\\Facades\\Validator',
          'str' => 'Illuminate\\Support\\Str',
          'rule' => 'Illuminate\\Validation\\Rule',
          'excel' => 'Maatwebsite\\Excel\\Facades\\Excel',
          'runtimeexception' => 'RuntimeException',
          'throwable' => 'Throwable',
        ),
         'className' => 'App\\Services\\ImportService',
         'functionName' => 'booleanValue',
         'templatePhpDocNodes' => 
        array (
        ),
         'parent' => NULL,
         'typeAliasesMap' => 
        array (
        ),
         'bypassTypeAliases' => false,
         'constUses' => 
        array (
        ),
         'typeAliasClassName' => NULL,
         'traitData' => NULL,
      )),
      'd1bf0b7fea75fbad41509c9a34afc163' => 
      \PHPStan\Analyser\IntermediaryNameScope::__set_state(array(
         'namespace' => 'App\\Services',
         'uses' => 
        array (
          'importentity' => 'App\\Enums\\ImportEntity',
          'importrowstatus' => 'App\\Enums\\ImportRowStatus',
          'importstatus' => 'App\\Enums\\ImportStatus',
          'pricelisttype' => 'App\\Enums\\PriceListType',
          'importvalidationexception' => 'App\\Exceptions\\ImportValidationException',
          'catalogrowsimport' => 'App\\Imports\\CatalogRowsImport',
          'importcatalogjob' => 'App\\Jobs\\ImportCatalogJob',
          'category' => 'App\\Models\\Category',
          'importbatch' => 'App\\Models\\ImportBatch',
          'importrow' => 'App\\Models\\ImportRow',
          'pricelist' => 'App\\Models\\PriceList',
          'pricelistitem' => 'App\\Models\\PriceListItem',
          'product' => 'App\\Models\\Product',
          'stocklevel' => 'App\\Models\\StockLevel',
          'supplier' => 'App\\Models\\Supplier',
          'user' => 'App\\Models\\User',
          'warehouse' => 'App\\Models\\Warehouse',
          'importrepositoryinterface' => 'App\\Repositories\\Contracts\\ImportRepositoryInterface',
          'lengthawarepaginator' => 'Illuminate\\Contracts\\Pagination\\LengthAwarePaginator',
          'uploadedfile' => 'Illuminate\\Http\\UploadedFile',
          'collection' => 'Illuminate\\Support\\Collection',
          'cache' => 'Illuminate\\Support\\Facades\\Cache',
          'db' => 'Illuminate\\Support\\Facades\\DB',
          'validator' => 'Illuminate\\Support\\Facades\\Validator',
          'str' => 'Illuminate\\Support\\Str',
          'rule' => 'Illuminate\\Validation\\Rule',
          'excel' => 'Maatwebsite\\Excel\\Facades\\Excel',
          'runtimeexception' => 'RuntimeException',
          'throwable' => 'Throwable',
        ),
         'className' => 'App\\Services\\ImportService',
         'functionName' => 'normalizePayload',
         'templatePhpDocNodes' => 
        array (
        ),
         'parent' => NULL,
         'typeAliasesMap' => 
        array (
        ),
         'bypassTypeAliases' => false,
         'constUses' => 
        array (
        ),
         'typeAliasClassName' => NULL,
         'traitData' => NULL,
      )),
      '89588fed07349f63ee53964905570ed5' => 
      \PHPStan\Analyser\IntermediaryNameScope::__set_state(array(
         'namespace' => 'App\\Services',
         'uses' => 
        array (
          'importentity' => 'App\\Enums\\ImportEntity',
          'importrowstatus' => 'App\\Enums\\ImportRowStatus',
          'importstatus' => 'App\\Enums\\ImportStatus',
          'pricelisttype' => 'App\\Enums\\PriceListType',
          'importvalidationexception' => 'App\\Exceptions\\ImportValidationException',
          'catalogrowsimport' => 'App\\Imports\\CatalogRowsImport',
          'importcatalogjob' => 'App\\Jobs\\ImportCatalogJob',
          'category' => 'App\\Models\\Category',
          'importbatch' => 'App\\Models\\ImportBatch',
          'importrow' => 'App\\Models\\ImportRow',
          'pricelist' => 'App\\Models\\PriceList',
          'pricelistitem' => 'App\\Models\\PriceListItem',
          'product' => 'App\\Models\\Product',
          'stocklevel' => 'App\\Models\\StockLevel',
          'supplier' => 'App\\Models\\Supplier',
          'user' => 'App\\Models\\User',
          'warehouse' => 'App\\Models\\Warehouse',
          'importrepositoryinterface' => 'App\\Repositories\\Contracts\\ImportRepositoryInterface',
          'lengthawarepaginator' => 'Illuminate\\Contracts\\Pagination\\LengthAwarePaginator',
          'uploadedfile' => 'Illuminate\\Http\\UploadedFile',
          'collection' => 'Illuminate\\Support\\Collection',
          'cache' => 'Illuminate\\Support\\Facades\\Cache',
          'db' => 'Illuminate\\Support\\Facades\\DB',
          'validator' => 'Illuminate\\Support\\Facades\\Validator',
          'str' => 'Illuminate\\Support\\Str',
          'rule' => 'Illuminate\\Validation\\Rule',
          'excel' => 'Maatwebsite\\Excel\\Facades\\Excel',
          'runtimeexception' => 'RuntimeException',
          'throwable' => 'Throwable',
        ),
         'className' => 'App\\Services\\ImportService',
         'functionName' => 'recordFailedRow',
         'templatePhpDocNodes' => 
        array (
        ),
         'parent' => NULL,
         'typeAliasesMap' => 
        array (
        ),
         'bypassTypeAliases' => false,
         'constUses' => 
        array (
        ),
         'typeAliasClassName' => NULL,
         'traitData' => NULL,
      )),
      '9b9e864ae68095d41f01c16a07348c61' => 
      \PHPStan\Analyser\IntermediaryNameScope::__set_state(array(
         'namespace' => 'App\\Services',
         'uses' => 
        array (
          'importentity' => 'App\\Enums\\ImportEntity',
          'importrowstatus' => 'App\\Enums\\ImportRowStatus',
          'importstatus' => 'App\\Enums\\ImportStatus',
          'pricelisttype' => 'App\\Enums\\PriceListType',
          'importvalidationexception' => 'App\\Exceptions\\ImportValidationException',
          'catalogrowsimport' => 'App\\Imports\\CatalogRowsImport',
          'importcatalogjob' => 'App\\Jobs\\ImportCatalogJob',
          'category' => 'App\\Models\\Category',
          'importbatch' => 'App\\Models\\ImportBatch',
          'importrow' => 'App\\Models\\ImportRow',
          'pricelist' => 'App\\Models\\PriceList',
          'pricelistitem' => 'App\\Models\\PriceListItem',
          'product' => 'App\\Models\\Product',
          'stocklevel' => 'App\\Models\\StockLevel',
          'supplier' => 'App\\Models\\Supplier',
          'user' => 'App\\Models\\User',
          'warehouse' => 'App\\Models\\Warehouse',
          'importrepositoryinterface' => 'App\\Repositories\\Contracts\\ImportRepositoryInterface',
          'lengthawarepaginator' => 'Illuminate\\Contracts\\Pagination\\LengthAwarePaginator',
          'uploadedfile' => 'Illuminate\\Http\\UploadedFile',
          'collection' => 'Illuminate\\Support\\Collection',
          'cache' => 'Illuminate\\Support\\Facades\\Cache',
          'db' => 'Illuminate\\Support\\Facades\\DB',
          'validator' => 'Illuminate\\Support\\Facades\\Validator',
          'str' => 'Illuminate\\Support\\Str',
          'rule' => 'Illuminate\\Validation\\Rule',
          'excel' => 'Maatwebsite\\Excel\\Facades\\Excel',
          'runtimeexception' => 'RuntimeException',
          'throwable' => 'Throwable',
        ),
         'className' => 'App\\Services\\ImportService',
         'functionName' => 'refreshBatchCounts',
         'templatePhpDocNodes' => 
        array (
        ),
         'parent' => NULL,
         'typeAliasesMap' => 
        array (
        ),
         'bypassTypeAliases' => false,
         'constUses' => 
        array (
        ),
         'typeAliasClassName' => NULL,
         'traitData' => NULL,
      )),
      'ba6da052e0b1578bb0ce06e98027a741' => 
      \PHPStan\Analyser\IntermediaryNameScope::__set_state(array(
         'namespace' => 'App\\Services',
         'uses' => 
        array (
          'importentity' => 'App\\Enums\\ImportEntity',
          'importrowstatus' => 'App\\Enums\\ImportRowStatus',
          'importstatus' => 'App\\Enums\\ImportStatus',
          'pricelisttype' => 'App\\Enums\\PriceListType',
          'importvalidationexception' => 'App\\Exceptions\\ImportValidationException',
          'catalogrowsimport' => 'App\\Imports\\CatalogRowsImport',
          'importcatalogjob' => 'App\\Jobs\\ImportCatalogJob',
          'category' => 'App\\Models\\Category',
          'importbatch' => 'App\\Models\\ImportBatch',
          'importrow' => 'App\\Models\\ImportRow',
          'pricelist' => 'App\\Models\\PriceList',
          'pricelistitem' => 'App\\Models\\PriceListItem',
          'product' => 'App\\Models\\Product',
          'stocklevel' => 'App\\Models\\StockLevel',
          'supplier' => 'App\\Models\\Supplier',
          'user' => 'App\\Models\\User',
          'warehouse' => 'App\\Models\\Warehouse',
          'importrepositoryinterface' => 'App\\Repositories\\Contracts\\ImportRepositoryInterface',
          'lengthawarepaginator' => 'Illuminate\\Contracts\\Pagination\\LengthAwarePaginator',
          'uploadedfile' => 'Illuminate\\Http\\UploadedFile',
          'collection' => 'Illuminate\\Support\\Collection',
          'cache' => 'Illuminate\\Support\\Facades\\Cache',
          'db' => 'Illuminate\\Support\\Facades\\DB',
          'validator' => 'Illuminate\\Support\\Facades\\Validator',
          'str' => 'Illuminate\\Support\\Str',
          'rule' => 'Illuminate\\Validation\\Rule',
          'excel' => 'Maatwebsite\\Excel\\Facades\\Excel',
          'runtimeexception' => 'RuntimeException',
          'throwable' => 'Throwable',
        ),
         'className' => 'App\\Services\\ImportService',
         'functionName' => 'formatRowError',
         'templatePhpDocNodes' => 
        array (
        ),
         'parent' => NULL,
         'typeAliasesMap' => 
        array (
        ),
         'bypassTypeAliases' => false,
         'constUses' => 
        array (
        ),
         'typeAliasClassName' => NULL,
         'traitData' => NULL,
      )),
      '532177e9b7c656362b6f32da1021685d' => 
      \PHPStan\Analyser\IntermediaryNameScope::__set_state(array(
         'namespace' => 'App\\Services',
         'uses' => 
        array (
          'importentity' => 'App\\Enums\\ImportEntity',
          'importrowstatus' => 'App\\Enums\\ImportRowStatus',
          'importstatus' => 'App\\Enums\\ImportStatus',
          'pricelisttype' => 'App\\Enums\\PriceListType',
          'importvalidationexception' => 'App\\Exceptions\\ImportValidationException',
          'catalogrowsimport' => 'App\\Imports\\CatalogRowsImport',
          'importcatalogjob' => 'App\\Jobs\\ImportCatalogJob',
          'category' => 'App\\Models\\Category',
          'importbatch' => 'App\\Models\\ImportBatch',
          'importrow' => 'App\\Models\\ImportRow',
          'pricelist' => 'App\\Models\\PriceList',
          'pricelistitem' => 'App\\Models\\PriceListItem',
          'product' => 'App\\Models\\Product',
          'stocklevel' => 'App\\Models\\StockLevel',
          'supplier' => 'App\\Models\\Supplier',
          'user' => 'App\\Models\\User',
          'warehouse' => 'App\\Models\\Warehouse',
          'importrepositoryinterface' => 'App\\Repositories\\Contracts\\ImportRepositoryInterface',
          'lengthawarepaginator' => 'Illuminate\\Contracts\\Pagination\\LengthAwarePaginator',
          'uploadedfile' => 'Illuminate\\Http\\UploadedFile',
          'collection' => 'Illuminate\\Support\\Collection',
          'cache' => 'Illuminate\\Support\\Facades\\Cache',
          'db' => 'Illuminate\\Support\\Facades\\DB',
          'validator' => 'Illuminate\\Support\\Facades\\Validator',
          'str' => 'Illuminate\\Support\\Str',
          'rule' => 'Illuminate\\Validation\\Rule',
          'excel' => 'Maatwebsite\\Excel\\Facades\\Excel',
          'runtimeexception' => 'RuntimeException',
          'throwable' => 'Throwable',
        ),
         'className' => 'App\\Services\\ImportService',
         'functionName' => 'failRow',
         'templatePhpDocNodes' => 
        array (
        ),
         'parent' => NULL,
         'typeAliasesMap' => 
        array (
        ),
         'bypassTypeAliases' => false,
         'constUses' => 
        array (
        ),
         'typeAliasClassName' => NULL,
         'traitData' => NULL,
      )),
      'fa08ace9f826646acacf71b7969e386a' => 
      \PHPStan\Analyser\IntermediaryNameScope::__set_state(array(
         'namespace' => 'App\\Services',
         'uses' => 
        array (
          'importentity' => 'App\\Enums\\ImportEntity',
          'importrowstatus' => 'App\\Enums\\ImportRowStatus',
          'importstatus' => 'App\\Enums\\ImportStatus',
          'pricelisttype' => 'App\\Enums\\PriceListType',
          'importvalidationexception' => 'App\\Exceptions\\ImportValidationException',
          'catalogrowsimport' => 'App\\Imports\\CatalogRowsImport',
          'importcatalogjob' => 'App\\Jobs\\ImportCatalogJob',
          'category' => 'App\\Models\\Category',
          'importbatch' => 'App\\Models\\ImportBatch',
          'importrow' => 'App\\Models\\ImportRow',
          'pricelist' => 'App\\Models\\PriceList',
          'pricelistitem' => 'App\\Models\\PriceListItem',
          'product' => 'App\\Models\\Product',
          'stocklevel' => 'App\\Models\\StockLevel',
          'supplier' => 'App\\Models\\Supplier',
          'user' => 'App\\Models\\User',
          'warehouse' => 'App\\Models\\Warehouse',
          'importrepositoryinterface' => 'App\\Repositories\\Contracts\\ImportRepositoryInterface',
          'lengthawarepaginator' => 'Illuminate\\Contracts\\Pagination\\LengthAwarePaginator',
          'uploadedfile' => 'Illuminate\\Http\\UploadedFile',
          'collection' => 'Illuminate\\Support\\Collection',
          'cache' => 'Illuminate\\Support\\Facades\\Cache',
          'db' => 'Illuminate\\Support\\Facades\\DB',
          'validator' => 'Illuminate\\Support\\Facades\\Validator',
          'str' => 'Illuminate\\Support\\Str',
          'rule' => 'Illuminate\\Validation\\Rule',
          'excel' => 'Maatwebsite\\Excel\\Facades\\Excel',
          'runtimeexception' => 'RuntimeException',
          'throwable' => 'Throwable',
        ),
         'className' => 'App\\Services\\ImportService',
         'functionName' => 'flushCatalogCache',
         'templatePhpDocNodes' => 
        array (
        ),
         'parent' => NULL,
         'typeAliasesMap' => 
        array (
        ),
         'bypassTypeAliases' => false,
         'constUses' => 
        array (
        ),
         'typeAliasClassName' => NULL,
         'traitData' => NULL,
      )),
    ),
    1 => 
    array (
      '/var/www/html/app/Services/ImportService.php' => '4cec514bc745ecc303b4d55cba5a8bffa63a6fc446e64df868751331d5603c1c',
    ),
  ),
));