<?php

namespace App\Http\Controllers\Web\Catalog;

use App\Enums\PermissionName;
use App\Http\Controllers\Controller;
use App\Http\Requests\Catalog\StoreSupplierRequest;
use App\Models\Supplier;
use App\Models\User;
use App\Services\CatalogService;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Inertia\Response;

/**
 * Suppliers have no dedicated PRD permission or Policy — gated under
 * `product.manage` (route middleware + StoreSupplierRequest), the same
 * roles that manage the product catalog itself.
 */
class SupplierController extends Controller
{
    public function __construct(private readonly CatalogService $catalog) {}

    public function index(): Response
    {
        $suppliers = $this->catalog->listSuppliers(15)->through(fn (Supplier $supplier) => [
            'id' => $supplier->id,
            'name' => $supplier->name,
            'email' => $supplier->email,
            'phone' => $supplier->phone,
            'is_active' => $supplier->is_active,
        ]);

        return Inertia::render('Catalog/Suppliers/Index', [
            'suppliers' => $suppliers,
        ]);
    }

    public function store(StoreSupplierRequest $request): RedirectResponse
    {
        $supplier = $this->catalog->createSupplier($request->validated());

        return redirect()
            ->route('catalog.suppliers.index')
            ->with('flash.success', "Supplier \"{$supplier->name}\" created.");
    }

    public function destroy(Supplier $supplier): RedirectResponse
    {
        /** @var User $user */
        $user = Auth::user();

        if (! $user->isAbleTo(PermissionName::ProductManage->value)) {
            throw new AuthorizationException;
        }

        $this->catalog->deleteSupplier($supplier);

        return redirect()
            ->route('catalog.suppliers.index')
            ->with('flash.success', 'Supplier deleted.');
    }
}
