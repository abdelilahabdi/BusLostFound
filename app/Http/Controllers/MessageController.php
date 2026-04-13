<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use App\Models\Message;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Illuminate\View\View;

class MessageController extends Controller
{
    /**
     * Display messages involving the authenticated user.
     */
    public function index(Request $request): View
    {
        $user = $request->user();

        $unreadConversationKeys = Message::query()
            ->where('receiver_id', $user->id)
            ->where('is_read', false)
            ->get(['announcement_id', 'sender_id', 'receiver_id'])
            ->map(function (Message $message): string {
                return $this->buildConversationKey(
                    $message->announcement_id,
                    $message->sender_id,
                    $message->receiver_id
                );
            })
            ->unique()
            ->flip();

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
            ->get();

        $groupedConversations = $messages
            ->groupBy(function (Message $message): string {
                return $this->buildConversationKey(
                    $message->announcement_id,
                    $message->sender_id,
                    $message->receiver_id
                );
            })
            ->map(function (Collection $conversationMessages, string $conversationKey) use ($user, $unreadConversationKeys): array {
                $lastMessage = $conversationMessages
                    ->sortByDesc('created_at')
                    ->first();

                $otherParticipant = $lastMessage->sender_id === $user->id
                    ? $lastMessage->receiver
                    : $lastMessage->sender;

                return [
                    'conversation_key' => $conversationKey,
                    'announcement' => $lastMessage->announcement,
                    'participant' => $otherParticipant,
                    'last_message' => $lastMessage,
                    'last_message_date' => $lastMessage->created_at,
                    'has_unread' => $unreadConversationKeys->has($conversationKey),
                ];
            })
            ->sortByDesc('last_message_date')
            ->values();

        $perPage = 10;
        $currentPage = LengthAwarePaginator::resolveCurrentPage();
        $currentPageItems = $groupedConversations
            ->slice(($currentPage - 1) * $perPage, $perPage)
            ->values();

        $conversations = new LengthAwarePaginator(
            $currentPageItems,
            $groupedConversations->count(),
            $perPage,
            $currentPage,
            [
                'path' => $request->url(),
                'query' => $request->query(),
            ]
        );

        return view('messages.index', [
            'conversations' => $conversations,
        ]);
    }

    /**
     * Display a single conversation thread.
     */
    public function show(Request $request, Announcement $announcement, User $participant): View
    {
        $user = $request->user();

        if ($participant->id === $user->id) {
            abort(403);
        }

        $conversationExists = Message::query()
            ->where('announcement_id', $announcement->id)
            ->where(function ($query) use ($user, $participant) {
                $query->where(function ($subQuery) use ($user, $participant) {
                    $subQuery->where('sender_id', $user->id)
                        ->where('receiver_id', $participant->id);
                })->orWhere(function ($subQuery) use ($user, $participant) {
                    $subQuery->where('sender_id', $participant->id)
                        ->where('receiver_id', $user->id);
                });
            })
            ->exists();

        if (! $conversationExists) {
            abort(404);
        }

        Message::query()
            ->where('announcement_id', $announcement->id)
            ->where('sender_id', $participant->id)
            ->where('receiver_id', $user->id)
            ->where('is_read', false)
            ->update(['is_read' => true]);

        $messages = Message::query()
            ->with([
                'sender:id,name',
                'receiver:id,name',
            ])
            ->where('announcement_id', $announcement->id)
            ->where(function ($query) use ($user, $participant) {
                $query->where(function ($subQuery) use ($user, $participant) {
                    $subQuery->where('sender_id', $user->id)
                        ->where('receiver_id', $participant->id);
                })->orWhere(function ($subQuery) use ($user, $participant) {
                    $subQuery->where('sender_id', $participant->id)
                        ->where('receiver_id', $user->id);
                });
            })
            ->orderBy('created_at')
            ->get();

        return view('messages.show', [
            'announcement' => $announcement,
            'participant' => $participant,
            'messages' => $messages,
        ]);
    }

    /**
     * Build a stable key for a conversation.
     */
    private function buildConversationKey(int $announcementId, int $firstUserId, int $secondUserId): string
    {
        $participantIds = [$firstUserId, $secondUserId];
        sort($participantIds);

        return $announcementId . '-' . $participantIds[0] . '-' . $participantIds[1];
    }

    /**
     * Store a new message for an announcement owner.
     */
    public function store(Request $request, Announcement $announcement): RedirectResponse
    {
        $validated = $request->validate([
            'body' => ['required', 'string', 'max:2000'],
            'participant_id' => ['nullable', 'integer', 'exists:users,id'],
        ]);

        $senderId = $request->user()->id;
        $participantId = $validated['participant_id'] ?? null;

        if ($participantId !== null) {
            if ($senderId === $participantId) {
                return redirect()
                    ->back()
                    ->with('error', 'Vous ne pouvez pas envoyer un message a vous-meme.');
            }

            $conversationExists = Message::query()
                ->where('announcement_id', $announcement->id)
                ->where(function ($query) use ($senderId, $participantId) {
                    $query->where(function ($subQuery) use ($senderId, $participantId) {
                        $subQuery->where('sender_id', $senderId)
                            ->where('receiver_id', $participantId);
                    })->orWhere(function ($subQuery) use ($senderId, $participantId) {
                        $subQuery->where('sender_id', $participantId)
                            ->where('receiver_id', $senderId);
                    });
                })
                ->exists();

            if (! $conversationExists) {
                return redirect()
                    ->route('messages.index')
                    ->with('error', 'Conversation introuvable.');
            }

            $announcement->messages()->create([
                'sender_id' => $senderId,
                'receiver_id' => $participantId,
                'body' => $validated['body'],
                'is_read' => false,
            ]);

            return redirect()
                ->route('messages.show', [
                    'announcement' => $announcement->id,
                    'participant' => $participantId,
                ])
                ->with('success', 'Message envoye avec succes.');
        }

        if ($senderId === $announcement->user_id) {
            return redirect()
                ->route('announcements.show', $announcement)
                ->with('error', 'Vous ne pouvez pas envoyer un message a votre propre annonce.');
        }

        $announcement->messages()->create([
            'sender_id' => $senderId,
            'receiver_id' => $announcement->user_id,
            'body' => $validated['body'],
            'is_read' => false,
        ]);

        return redirect()
            ->route('announcements.show', $announcement)
            ->with('success', 'Message envoye avec succes.');
    }
}
