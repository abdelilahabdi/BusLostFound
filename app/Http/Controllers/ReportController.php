<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    /**
     * Store a new report for an announcement.
     */
    public function store(Request $request, Announcement $announcement): RedirectResponse
    {
        if ($request->user()->id === $announcement->user_id) {
            return redirect()
                ->route('announcements.show', $announcement)
                ->with('error', 'Vous ne pouvez pas signaler votre propre annonce.');
        }

        $validated = $request->validate([
            'reason' => ['required', 'string', 'max:1000'],
        ]);

        $announcement->reports()->create([
            'user_id' => $request->user()->id,
            'reason' => $validated['reason'],
            'status' => 'pending',
        ]);

        return redirect()
            ->route('announcements.show', $announcement)
            ->with('success', 'Signalement envoye avec succes.');
    }
}
