<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use App\Models\Message;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class MessageController extends Controller
{
    /**
     * Display messages involving the authenticated user.
     */
    public function index(Request $request): View
    {
        $user = $request->user();

        Message::query()
            ->where('receiver_id', $user->id)
            ->where('is_read', false)
            ->update(['is_read' => true]);

        $messages = Message::query()
            ->with([
                'announcement:id,title',
                'sender:id,name',
                'receiver:id,name',
            ])
            ->where(function ($query) use ($user) {
                $query->where('sender_id', $user->id)
                    ->orWhere('receiver_id', $user->id);
            })
            ->latest()
            ->paginate(10);

        return view('messages.index', [
            'messages' => $messages,
        ]);
    }

    /**
     * Store a new message for an announcement owner.
     */
    public function store(Request $request, Announcement $announcement): RedirectResponse
    {
        if ($request->user()->id === $announcement->user_id) {
            return redirect()
                ->route('announcements.show', $announcement)
                ->with('error', 'Vous ne pouvez pas envoyer un message a votre propre annonce.');
        }

        $validated = $request->validate([
            'body' => ['required', 'string', 'max:2000'],
        ]);

        $announcement->messages()->create([
            'sender_id' => $request->user()->id,
            'receiver_id' => $announcement->user_id,
            'body' => $validated['body'],
            'is_read' => false,
        ]);

        return redirect()
            ->route('announcements.show', $announcement)
            ->with('success', 'Message envoye avec succes.');
    }
}
