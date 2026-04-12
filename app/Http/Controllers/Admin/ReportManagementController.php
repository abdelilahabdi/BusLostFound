<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Report;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ReportManagementController extends Controller
{
    /**
     * Display a paginated list of reports.
     */
    public function index(): View
    {
        $reports = Report::query()
            ->with([
                'announcement:id,title',
                'user:id,name',
            ])
            ->latest()
            ->paginate(10);

        return view('admin.reports.index', [
            'reports' => $reports,
        ]);
    }

    /**
     * Mark a report as reviewed.
     */
    public function markReviewed(Report $report): RedirectResponse
    {
        $report->update([
            'status' => 'reviewed',
        ]);

        return redirect()
            ->route('admin.reports.index')
            ->with('success', 'Signalement marque comme examine.');
    }
}
