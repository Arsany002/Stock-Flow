<?php

namespace App\Http\Controllers\Web\Admin;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use App\Models\User;
use App\Services\AuditService;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class AuditLogController extends Controller
{
    /**
     * The fixed set of event names this codebase ever records (see
     * requirement #2 / the *::record() call sites in StockService,
     * PurchaseOrderService, PaymentService, RoleAssignmentService,
     * RolePermissionService). Hardcoded instead of a DISTINCT query so the
     * filter dropdown always lists every possible event, even ones that
     * haven't happened yet, without scanning the table on every page load.
     */
    private const EVENTS = [
        'stock.adjusted',
        'po.approved',
        'po.rejected',
        'payment.settled',
        'user.roles_updated',
        'role.permissions_updated',
        'security.rate_limit_blocked',
    ];

    public function __construct(private readonly AuditService $audit) {}

    public function index(Request $request): Response
    {
        $filters = [
            'event' => $request->string('event')->toString() ?: null,
            'causer_id' => $request->string('causer_id')->toString() ?: null,
            'date_from' => $request->string('date_from')->toString() ?: null,
            'date_to' => $request->string('date_to')->toString() ?: null,
        ];

        $logs = $this->audit->listAll(20, $filters)->through(fn (ActivityLog $log) => [
            'id' => $log->id,
            'event' => $log->event,
            'causer' => $log->causer?->only(['id', 'name']),
            'subject_type' => $log->subject_type,
            'subject_id' => $log->subject_id,
            'properties' => $log->properties,
            'created_at' => $log->created_at,
        ]);

        return Inertia::render('Admin/AuditLog/Index', [
            'logs' => $logs,
            'filters' => $filters,
            'events' => self::EVENTS,
            'users' => User::query()->orderBy('name')->get(['id', 'name']),
        ]);
    }
}
