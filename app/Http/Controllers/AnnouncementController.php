<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class AnnouncementController extends Controller
{
    /**
     * Display the connected user's announcements.
     */
    public function myAnnouncements(Request $request): View
    {
        $announcements = $request->user()
            ->announcements()
            ->with('category:id,name')
            ->latest()
            ->paginate(10);

        return view('announcements.my-announcements', [
            'announcements' => $announcements,
        ]);
    }

    /**
     * Display a paginated list of announcements.
     */
    public function index(Request $request): View
    {
        $filters = $request->validate([
            'q' => ['nullable', 'string', 'max:255'],
            'category_id' => ['nullable', 'integer', 'exists:categories,id'],
            'type' => ['nullable', 'in:lost,found'],
            'status' => ['nullable', 'in:active,resolved'],
            'location' => ['nullable', 'string', 'max:255'],
            'event_date' => ['nullable', 'date'],
        ]);

        $query = Announcement::with([
            'user:id,name',
            'category:id,name',
        ]);

        if (!empty($filters['q'])) {
            $keyword = $filters['q'];

            $query->where(function ($subQuery) use ($keyword) {
                $subQuery->where('title', 'like', '%' . $keyword . '%')
                    ->orWhere('description', 'like', '%' . $keyword . '%');
            });
        }

        if (!empty($filters['category_id'])) {
            $query->where('category_id', $filters['category_id']);
        }

        if (!empty($filters['type'])) {
            $query->where('type', $filters['type']);
        }

        if (!empty($filters['status'])) {
            $query->where('status', $filters['status']);
        }

        if (!empty($filters['location'])) {
            $query->where('location', 'like', '%' . $filters['location'] . '%');
        }

        if (!empty($filters['event_date'])) {
            $query->whereDate('event_date', $filters['event_date']);
        }

        $announcements = $query->latest()->paginate(9)->withQueryString();
        $categories = Category::orderBy('name')->get(['id', 'name']);

        return view('announcements.index', [
            'announcements' => $announcements,
            'categories' => $categories,
            'filters' => $filters,
        ]);
    }

    /**
     * Display a single announcement.
     */
    public function show(Announcement $announcement): View
    {
        $announcement->loadMissing([
            'user:id,name',
            'category:id,name',
        ]);

        return view('announcements.show', [
            'announcement' => $announcement,
        ]);
    }

    /**
     * Show the form to create a new announcement.
     */
    public function create(): View
    {
        $categories = Category::orderBy('name')->get();

        return view('announcements.create', [
            'categories' => $categories,
        ]);
    }

    /**
     * Store a new announcement in the database.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $this->validateAnnouncement($request);

        $validated['status'] = 'active';

        $request->user()->announcements()->create($validated);

        return redirect()->route('dashboard')->with('success', 'Annonce creee avec succes.');
    }

    /**
     * Show the form to edit an existing announcement.
     */
    public function edit(Announcement $announcement): View
    {
        $this->ensureOwner($announcement);

        $categories = Category::orderBy('name')->get();

        return view('announcements.edit', [
            'announcement' => $announcement,
            'categories' => $categories,
        ]);
    }

    /**
     * Update an existing announcement.
     */
    public function update(Request $request, Announcement $announcement): RedirectResponse
    {
        $this->ensureOwner($announcement);

        $announcement->update($this->validateAnnouncement($request));

        return redirect()->route('announcements.my')->with('success', 'Annonce mise a jour avec succes.');
    }

    /**
     * Delete an existing announcement.
     */
    public function destroy(Announcement $announcement): RedirectResponse
    {
        $this->ensureOwner($announcement);

        $announcement->delete();

        return redirect()->route('announcements.my')->with('success', 'Annonce supprimee avec succes.');
    }

    /**
     * Mark an announcement as resolved.
     */
    public function markResolved(Announcement $announcement): RedirectResponse
    {
        $this->ensureOwner($announcement);

        $announcement->update([
            'status' => 'resolved',
        ]);

        return redirect()->route('announcements.my')->with('success', 'Annonce marquee comme resolue.');
    }

    /**
     * Validate announcement data for create and update actions.
     *
     * @return array<string, mixed>
     */
    private function validateAnnouncement(Request $request): array
    {
        return $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'category_id' => ['required', 'exists:categories,id'],
            'type' => ['required', 'in:lost,found'],
            'location' => ['required', 'string', 'max:255'],
            'bus_line' => ['nullable', 'string', 'max:255'],
            'stop_name' => ['nullable', 'string', 'max:255'],
            'event_date' => ['required', 'date'],
        ]);
    }

    /**
     * Ensure the connected user owns the given announcement.
     */
    private function ensureOwner(Announcement $announcement): void
    {
        if (auth()->id() !== $announcement->user_id) {
            abort(403);
        }
    }
}
