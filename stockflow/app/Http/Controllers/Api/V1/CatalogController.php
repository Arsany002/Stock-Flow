<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Requests\Api\V1\ListProductsRequest;
use App\Http\Resources\Api\V1\ProductResource;
use App\Services\CatalogService;

class CatalogController extends ApiController
{
    public function __construct(private readonly CatalogService $catalog) {}

    public function products(ListProductsRequest $request)
    {
        $validated = $request->validated();

        $products = $this->catalog->listProducts(
            perPage: (int) ($validated['per_page'] ?? 15),
            filters: [
                'search' => $validated['search'] ?? null,
                'category_id' => $validated['category_id'] ?? null,
            ],
        );

        return $this->paginated($products, ProductResource::class, $request);
    }
}
