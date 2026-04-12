<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;

class DashboardController extends Controller
{
    /**
     * Display the authenticated user's dashboard.
     */
    public function index(Request $request): View
    {
        $user = $request->user();

        $totalAnnouncements = $user->announcements()->count();
        $totalActiveAnnouncements = $user->announcements()->where('status', 'active')->count();
        $totalResolvedAnnouncements = $user->announcements()->where('status', 'resolved')->count();

        $latestAnnouncements = $user->announcements()
            ->latest()
            ->take(5)
            ->get(['id', 'title', 'type', 'status', 'event_date']);

        return view('dashboard', [
            'totalAnnouncements' => $totalAnnouncements,
            'totalActiveAnnouncements' => $totalActiveAnnouncements,
            'totalResolvedAnnouncements' => $totalResolvedAnnouncements,
            'latestAnnouncements' => $latestAnnouncements,
        ]);
    }
}
