<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Requests\Api\V1\ListQuotesRequest;
use App\Http\Requests\Api\V1\StoreQuoteRequest;
use App\Http\Resources\Api\V1\QuoteResource;
use App\Services\QuoteService;
use Illuminate\Http\JsonResponse;

class QuoteController extends ApiController
{
    public function __construct(private readonly QuoteService $quotes) {}

    public function index(ListQuotesRequest $request): JsonResponse
    {
        $validated = $request->validated();
        $user = $request->user();
        $businessAccount = $user->businessAccount;

        $quotes = $this->quotes->listForViewer(
            $user,
            $businessAccount,
            (int) ($validated['per_page'] ?? 15),
        );

        $quotes->getCollection()->load(['businessAccount', 'items.product', 'purchaseOrders']);

        return $this->paginated($quotes, QuoteResource::class, $request);
    }

    public function store(StoreQuoteRequest $request): JsonResponse
    {
        $quote = $this->quotes->request(
            $request->user()->businessAccount,
            $request->validated('lines'),
        );

        $quote->load(['businessAccount', 'items.product', 'purchaseOrders']);

        return $this->resource(new QuoteResource($quote), $request, 201);
    }
}
