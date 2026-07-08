<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

abstract class ApiController extends Controller
{
    protected function resource(JsonResource $resource, Request $request, int $status = 200, array $meta = []): JsonResponse
    {
        return response()->json([
            'data' => $resource->resolve($request),
            'meta' => $meta,
        ], $status);
    }

    /**
     * @param  class-string<JsonResource>  $resourceClass
     */
    protected function paginated(LengthAwarePaginator $paginator, string $resourceClass, Request $request): JsonResponse
    {
        return response()->json([
            'data' => $paginator->getCollection()
                ->map(fn ($item) => (new $resourceClass($item))->resolve($request))
                ->values(),
            'meta' => [
                'current_page' => $paginator->currentPage(),
                'from' => $paginator->firstItem(),
                'last_page' => $paginator->lastPage(),
                'per_page' => $paginator->perPage(),
                'to' => $paginator->lastItem(),
                'total' => $paginator->total(),
            ],
        ]);
    }
}
