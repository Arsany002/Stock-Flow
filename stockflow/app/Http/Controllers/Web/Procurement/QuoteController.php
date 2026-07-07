<?php

namespace App\Http\Controllers\Web\Procurement;

use App\Http\Controllers\Controller;
use App\Http\Requests\Procurement\PriceQuoteRequest;
use App\Http\Requests\Procurement\StoreQuoteRequest;
use App\Models\Quote;
use App\Services\CatalogService;
use App\Services\PurchaseOrderService;
use App\Services\QuoteService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Inertia\Response;

class QuoteController extends Controller
{
    public function __construct(
        private readonly QuoteService $quotes,
        private readonly PurchaseOrderService $purchaseOrders,
        private readonly CatalogService $catalog,
    ) {}

    public function index(): Response
    {
        $user = Auth::user();
        $businessAccount = $user->businessAccount;

        $quotes = $this->quotes->listForViewer($user, $businessAccount)->through(fn (Quote $quote) => [
            'id' => $quote->id,
            'status' => $quote->status->value,
            'status_label' => $quote->status->label(),
            'total' => $quote->total,
            'expires_at' => $quote->expires_at,
            'created_at' => $quote->created_at,
        ]);

        return Inertia::render('Procurement/Quotes/Index', [
            'quotes' => $quotes,
        ]);
    }

    public function create(): Response
    {
        $this->authorize('create', Quote::class);

        return Inertia::render('Procurement/Quotes/Create', [
            'products' => collect($this->catalog->listProducts(1000)->items())->map->only(['id', 'name', 'sku']),
        ]);
    }

    public function store(StoreQuoteRequest $request): RedirectResponse
    {
        $businessAccount = Auth::user()->businessAccount;
        abort_if($businessAccount === null, 403, 'No business account is linked to this user.');

        $quote = $this->quotes->request($businessAccount, $request->validated('lines'));

        return redirect()->route('procurement.quotes.show', $quote)
            ->with('flash.success', 'RFQ submitted — awaiting pricing.');
    }

    public function show(Quote $quote): Response
    {
        $this->authorize('view', $quote);

        $quote->load(['items.product', 'businessAccount', 'purchaseOrders']);
        $user = Auth::user();

        return Inertia::render('Procurement/Quotes/Show', [
            'quote' => [
                'id' => $quote->id,
                'status' => $quote->status->value,
                'status_label' => $quote->status->label(),
                'subtotal' => $quote->subtotal,
                'tax' => $quote->tax,
                'total' => $quote->total,
                'expires_at' => $quote->expires_at,
                'is_expired' => $this->quotes->isExpired($quote),
                'business_account' => $quote->businessAccount->only(['id', 'company_name']),
                'items' => $quote->items->map(fn ($item) => [
                    'id' => $item->id,
                    'product' => $item->product->only(['id', 'name', 'sku']),
                    'quantity' => $item->quantity,
                    'unit_price' => $item->unit_price,
                ]),
                'purchase_orders' => $quote->purchaseOrders->map(fn ($po) => [
                    'id' => $po->id,
                    'status' => $po->status->value,
                ]),
            ],
            'canPrice' => $user->can('price', $quote),
            'canAccept' => $user->can('accept', $quote),
            'canReject' => $user->can('reject', $quote),
        ]);
    }

    public function priceCreate(Quote $quote): Response
    {
        $this->authorize('price', $quote);

        $quote->load('items.product');

        return Inertia::render('Procurement/Quotes/Price', [
            'quote' => [
                'id' => $quote->id,
                'status' => $quote->status->value,
                'items' => $quote->items->map(fn ($item) => [
                    'id' => $item->id,
                    'product' => $item->product->only(['id', 'name', 'sku']),
                    'quantity' => $item->quantity,
                    'suggested_unit_price' => $this->quotes->suggestedTierPrice($item->product_id, $item->quantity),
                ]),
            ],
        ]);
    }

    public function priceStore(PriceQuoteRequest $request, Quote $quote): RedirectResponse
    {
        $this->quotes->price($quote, $request->validated('prices'));

        return redirect()->route('procurement.quotes.show', $quote)
            ->with('flash.success', 'Quote priced and sent to the buyer.');
    }

    public function accept(Quote $quote): RedirectResponse
    {
        $this->authorize('accept', $quote);

        $purchaseOrder = $this->purchaseOrders->createFromQuote($quote, Auth::user());

        return redirect()->route('procurement.purchase-orders.show', $purchaseOrder)
            ->with('flash.success', 'Quote accepted — purchase order created and awaiting approval.');
    }

    public function reject(Quote $quote): RedirectResponse
    {
        $this->authorize('reject', $quote);

        $this->quotes->reject($quote);

        return redirect()->route('procurement.quotes.show', $quote)
            ->with('flash.success', 'Quote rejected.');
    }
}
