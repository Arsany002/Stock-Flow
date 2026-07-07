<?php

namespace App\Http\Controllers\Web\Catalog;

use App\Http\Controllers\Controller;
use App\Http\Requests\Catalog\StoreProductRequest;
use App\Http\Requests\Catalog\UpdateProductRequest;
use App\Models\Product;
use App\Services\CatalogService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class ProductController extends Controller
{
    public function __construct(private readonly CatalogService $catalog) {}

    public function index(Request $request): Response
    {
        $this->authorize('viewAny', Product::class);

        $search = $request->string('search')->toString() ?: null;
        $categoryId = $request->string('category_id')->toString() ?: null;

        $products = $this->catalog->listProducts(15, [
            'search' => $search,
            'category_id' => $categoryId,
        ])->through(fn (Product $product) => [
            'id' => $product->id,
            'sku' => $product->sku,
            'name' => $product->name,
            'category' => $product->category?->name,
            'is_active' => $product->is_active,
        ]);

        return Inertia::render('Catalog/Products/Index', [
            'products' => $products,
            'filters' => ['search' => $search, 'category_id' => $categoryId],
            'categories' => $this->catalog->listCategoriesFlat()->map->only(['id', 'name']),
        ]);
    }

    public function create(): Response
    {
        $this->authorize('create', Product::class);

        return Inertia::render('Catalog/Products/Create', [
            'categories' => $this->catalog->listCategoriesFlat()->map->only(['id', 'name']),
            'suppliers' => $this->catalog->listSuppliersFlat()->map->only(['id', 'name']),
        ]);
    }

    public function store(StoreProductRequest $request): RedirectResponse
    {
        $product = $this->catalog->createProduct($request->validated());

        return redirect()
            ->route('catalog.products.show', $product)
            ->with('flash.success', "Product \"{$product->name}\" created.");
    }

    public function show(Product $product): Response
    {
        $this->authorize('view', $product);

        $product = $this->catalog->findProductWithRelations($product->id);

        return Inertia::render('Catalog/Products/Show', [
            'product' => [
                'id' => $product->id,
                'sku' => $product->sku,
                'name' => $product->name,
                'description' => $product->description,
                'is_active' => $product->is_active,
                'category' => $product->category?->only(['id', 'name']),
                'supplier' => $product->supplier?->only(['id', 'name']),
                'price_list_items' => $product->priceListItems->map(fn ($item) => [
                    'id' => $item->id,
                    'price_list' => $item->priceList->only(['id', 'name']),
                    'unit_price' => $item->unit_price,
                    'min_qty' => $item->min_qty,
                ]),
            ],
        ]);
    }

    public function edit(Product $product): Response
    {
        $this->authorize('update', $product);

        return Inertia::render('Catalog/Products/Edit', [
            'product' => $product->only(['id', 'category_id', 'supplier_id', 'sku', 'name', 'description', 'is_active']),
            'categories' => $this->catalog->listCategoriesFlat()->map->only(['id', 'name']),
            'suppliers' => $this->catalog->listSuppliersFlat()->map->only(['id', 'name']),
        ]);
    }

    public function update(UpdateProductRequest $request, Product $product): RedirectResponse
    {
        $product = $this->catalog->updateProduct($product, $request->validated());

        return redirect()
            ->route('catalog.products.show', $product)
            ->with('flash.success', "Product \"{$product->name}\" updated.");
    }

    public function destroy(Product $product): RedirectResponse
    {
        $this->authorize('delete', $product);

        $this->catalog->deleteProduct($product);

        return redirect()
            ->route('catalog.products.index')
            ->with('flash.success', 'Product deleted.');
    }
}
