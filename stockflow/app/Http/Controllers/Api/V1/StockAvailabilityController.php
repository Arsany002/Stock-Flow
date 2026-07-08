<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Requests\Api\V1\StockAvailabilityRequest;
use App\Http\Resources\Api\V1\StockAvailabilityResource;
use App\Services\StockService;

class StockAvailabilityController extends ApiController
{
    public function __construct(private readonly StockService $stock) {}

    public function __invoke(StockAvailabilityRequest $request)
    {
        $validated = $request->validated();

        $levels = $this->stock->listLevels((int) ($validated['per_page'] ?? 15), [
            'product_id' => $validated['product_id'] ?? null,
            'warehouse_id' => $validated['warehouse_id'] ?? null,
        ]);

        return $this->paginated($levels, StockAvailabilityResource::class, $request);
    }
}
