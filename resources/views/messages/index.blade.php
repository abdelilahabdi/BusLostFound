@extends('layouts.app')

@section('title', 'BusLost&Found - Mes conversations')

@section('content')
    <section class="rounded-xl bg-white p-8 shadow-sm ring-1 ring-slate-200 sm:p-10">
        <div class="flex flex-wrap items-center justify-between gap-3">
            <div>
                <h1 class="text-2xl font-bold text-slate-900 sm:text-3xl">Mes conversations</h1>
                <p class="mt-2 text-sm text-slate-600 sm:text-base">
                    Retrouvez ici vos echanges classes par annonce et par participant.
                </p>
            </div>

            <a href="{{ route('dashboard') }}" class="inline-flex items-center rounded-md border border-slate-300 px-4 py-2 text-sm font-semibold text-slate-700 hover:bg-slate-100">
                Retour au tableau de bord
            </a>
        </div>
    </section>

    @if ($conversations->isEmpty())
        <section class="mt-6 rounded-xl bg-white p-8 text-center shadow-sm ring-1 ring-slate-200">
            <h2 class="text-lg font-semibold text-slate-900">Aucune conversation pour le moment</h2>
            <p class="mt-2 text-sm text-slate-600">
                Vos conversations apparaitront ici apres vos premiers echanges.
            </p>
        </section>
    @else
        @php
            $unreadConversationsOnPage = collect($conversations->items())
                ->where('has_unread', true)
                ->count();
        @endphp

        <section class="mt-6 grid gap-3 sm:grid-cols-2">
            <article class="rounded-xl bg-white p-4 shadow-sm ring-1 ring-slate-200">
                <p class="text-xs font-semibold uppercase tracking-wide text-slate-500">Conversations</p>
                <p class="mt-1 text-2xl font-bold text-slate-900">{{ $conversations->total() }}</p>
            </article>
            <article class="rounded-xl bg-amber-50 p-4 shadow-sm ring-1 ring-amber-200">
                <p class="text-xs font-semibold uppercase tracking-wide text-amber-700">Conversations non lues (cette page)</p>
                <p class="mt-1 text-2xl font-bold text-amber-900">{{ $unreadConversationsOnPage }}</p>
            </article>
        </section>

        <section class="mt-6 overflow-hidden rounded-xl bg-white shadow-sm ring-1 ring-slate-200">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-slate-200">
                    <thead class="bg-slate-50">
                        <tr>
                            <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wide text-slate-600">Annonce</th>
                            <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wide text-slate-600">Participant</th>
                            <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wide text-slate-600">Dernier message</th>
                            <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wide text-slate-600">Date</th>
                            <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wide text-slate-600">Etat</th>
                            <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wide text-slate-600">Action</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 bg-white">
                        @foreach ($conversations as $conversation)
                            @php
                                $announcement = $conversation['announcement'];
                                $participant = $conversation['participant'];
                                $lastMessage = $conversation['last_message'];
                                $isUnreadConversation = $conversation['has_unread'];
                            @endphp
                            <tr class="{{ $isUnreadConversation ? 'bg-amber-50' : 'bg-white' }} hover:bg-slate-50">
                                <td class="px-4 py-3 text-sm font-medium {{ $isUnreadConversation ? 'text-slate-950' : 'text-slate-900' }}">
                                    {{ $announcement?->title ?? 'Annonce indisponible' }}
                                </td>
                                <td class="px-4 py-3 text-sm text-slate-700">
                                    {{ $participant?->name ?? 'Utilisateur indisponible' }}
                                </td>
                                <td class="px-4 py-3 text-sm {{ $isUnreadConversation ? 'font-semibold text-slate-900' : 'text-slate-700' }}">
                                    {{ \Illuminate\Support\Str::limit($lastMessage->body, 90) }}
                                </td>
                                <td class="px-4 py-3 text-sm text-slate-700">
                                    {{ $conversation['last_message_date']?->format('d/m/Y H:i') }}
                                </td>
                                <td class="px-4 py-3 text-sm">
                                    @if ($isUnreadConversation)
                                        <span class="rounded-full bg-amber-100 px-2.5 py-1 text-xs font-semibold text-amber-800">
                                            Non lu
                                        </span>
                                    @else
                                        <span class="rounded-full bg-emerald-100 px-2.5 py-1 text-xs font-semibold text-emerald-800">
                                            Lu
                                        </span>
                                    @endif
                                </td>
                                <td class="px-4 py-3 text-sm">
                                    @if ($announcement && $participant)
                                        <a href="{{ route('messages.show', ['announcement' => $announcement->id, 'participant' => $participant->id]) }}" class="inline-flex items-center rounded-md border border-slate-300 px-3 py-1.5 text-xs font-semibold text-slate-700 hover:bg-slate-100">
                                            Ouvrir la conversation
                                        </a>
                                    @else
                                        <span class="text-xs text-slate-500">Conversation indisponible</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </section>

        <div class="mt-6">
            {{ $conversations->links() }}
        </div>
    @endif
@endsection
