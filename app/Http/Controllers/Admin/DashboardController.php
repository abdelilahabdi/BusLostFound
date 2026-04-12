<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Announcement;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\View\View;

class DashboardController extends Controller
{
    /**
     * Display the admin dashboard.
     */
    public function index(Request $request): View
    {
        $now = now();
        $currentYear = (int) $now->year;
        $currentMonth = (int) $now->month;

        $announcementsThisMonth = Announcement::query()
            ->whereYear('created_at', $currentYear)
            ->whereMonth('created_at', $currentMonth)
            ->count();

        $resolvedAnnouncementsThisMonth = Announcement::query()
            ->whereYear('created_at', $currentYear)
            ->whereMonth('created_at', $currentMonth)
            ->where('status', 'resolved')
            ->count();

        $announcementsThisYear = Announcement::query()
            ->whereYear('created_at', $currentYear)
            ->count();

        $resolvedAnnouncementsThisYear = Announcement::query()
            ->whereYear('created_at', $currentYear)
            ->where('status', 'resolved')
            ->count();

        $monthlyBreakdown = $this->buildMonthlyBreakdown($currentYear);

        return view('admin.dashboard', [
            'admin' => $request->user(),
            'currentYear' => $currentYear,
            'totalUsers' => User::count(),
            'totalAnnouncements' => Announcement::count(),
            'totalActiveAnnouncements' => Announcement::where('status', 'active')->count(),
            'totalResolvedAnnouncements' => Announcement::where('status', 'resolved')->count(),
            'announcementsThisMonth' => $announcementsThisMonth,
            'resolvedAnnouncementsThisMonth' => $resolvedAnnouncementsThisMonth,
            'announcementsThisYear' => $announcementsThisYear,
            'resolvedAnnouncementsThisYear' => $resolvedAnnouncementsThisYear,
            'monthlyBreakdown' => $monthlyBreakdown,
        ]);
    }

    /**
     * Build a simple month-by-month summary for a given year.
     *
     * @return Collection<int, array<string, int|string>>
     */
    private function buildMonthlyBreakdown(int $year): Collection
    {
        $monthLabels = [
            1 => 'Janvier',
            2 => 'Fevrier',
            3 => 'Mars',
            4 => 'Avril',
            5 => 'Mai',
            6 => 'Juin',
            7 => 'Juillet',
            8 => 'Aout',
            9 => 'Septembre',
            10 => 'Octobre',
            11 => 'Novembre',
            12 => 'Decembre',
        ];

        $announcements = Announcement::query()
            ->whereYear('created_at', $year)
            ->get(['status', 'created_at'])
            ->groupBy(function (Announcement $announcement): int {
                return (int) $announcement->created_at->format('n');
            });

        return collect(range(1, 12))->map(function (int $month) use ($announcements, $monthLabels): array {
            $items = $announcements->get($month, collect());

            return [
                'month_label' => $monthLabels[$month],
                'total' => $items->count(),
                'resolved' => $items->where('status', 'resolved')->count(),
            ];
        });
    }
}
