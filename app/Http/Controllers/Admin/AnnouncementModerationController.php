<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Announcement;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AnnouncementModerationController extends Controller
{
    /**
     * Display a paginated list of announcements for moderation.
     */
    public function index(): View
    {
        $announcements = Announcement::query()
            ->with([
                'user:id,name',
                'category:id,name',
            ])
            ->latest()
            ->paginate(10);

        return view('admin.announcements.index', [
            'announcements' => $announcements,
        ]);
    }

    /**
     * Update announcement status (active or resolved).
     */
    public function updateStatus(Request $request, Announcement $announcement): RedirectResponse
    {
        $validated = $request->validate([
            'status' => ['required', 'in:active,resolved'],
        ]);

        $announcement->update([
            'status' => $validated['status'],
        ]);

        return redirect()
            ->route('admin.announcements.index')
            ->with('success', 'Statut de l\'annonce mis a jour avec succes.');
    }

    /**
     * Delete an announcement.
     */
    public function destroy(Announcement $announcement): RedirectResponse
    {
        $announcement->delete();

        return redirect()
            ->route('admin.announcements.index')
            ->with('success', 'Annonce supprimee avec succes.');
    }
}
