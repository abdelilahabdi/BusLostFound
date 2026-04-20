@extends('layouts.app')

@section('title', 'BusLost&Found - Mes conversations')

@section('content')
    <section class="rounded-3xl bg-slate-50/70 p-6 ring-1 ring-slate-200 sm:p-10">
        <div class="flex flex-wrap items-start justify-between gap-4">
            <div class="max-w-3xl">
                <h1 class="text-3xl font-bold tracking-tight text-slate-900 sm:text-5xl">Mes conversations</h1>
                <p class="mt-3 text-base text-slate-600 sm:text-lg">
                    Retrouvez ici vos &eacute;changes class&eacute;s par annonce et par participant.
                </p>
            </div>

            <a href="{{ route('dashboard') }}" class="inline-flex h-11 items-center justify-center rounded-2xl border border-slate-300 bg-white px-5 text-sm font-semibold text-slate-700 transition hover:bg-slate-100">
                Retour au tableau de bord
            </a>
        </div>
    </section>

    @if ($conversations->isEmpty())
        <section class="mt-8 rounded-3xl border border-slate-200 bg-white p-10 text-center shadow-[0_10px_30px_rgba(15,23,42,0.06)]">
            <div class="mx-auto inline-flex h-14 w-14 items-center justify-center rounded-2xl bg-slate-100 text-slate-500">
                <svg class="h-7 w-7" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                    <path d="M4 7.5A2.5 2.5 0 016.5 5h11A2.5 2.5 0 0120 7.5v9a2.5 2.5 0 01-2.5 2.5h-11A2.5 2.5 0 014 16.5v-9z"
                        stroke="currentColor" stroke-width="1.8" />
                    <path d="M8 10h8M8 13h5" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" />
                </svg>
            </div>
            <h2 class="mt-5 text-xl font-semibold text-slate-900">Aucune conversation</h2>
            <p class="mt-2 text-sm text-slate-600 sm:text-base">
                Vos conversations appara&icirc;tront ici apr&egrave;s vos premiers &eacute;changes.
            </p>
        </section>
    @else
        @php
            $unreadConversationsOnPage = collect($conversations->items())
                ->where('has_unread', true)
                ->count();
        @endphp

        <section class="mt-8 grid gap-4 sm:grid-cols-2">
            <article class="rounded-3xl border border-slate-200 bg-white p-5 shadow-[0_8px_24px_rgba(15,23,42,0.05)]">
                <p class="text-xs font-semibold uppercase tracking-wide text-slate-500">Conversations</p>
                <p class="mt-2 text-3xl font-bold tracking-tight text-slate-900">{{ $conversations->total() }}</p>
            </article>
            <article class="rounded-3xl border border-amber-200 bg-amber-50 p-5 shadow-[0_8px_24px_rgba(15,23,42,0.05)]">
                <p class="text-xs font-semibold uppercase tracking-wide text-amber-700">Conversations non lues (cette page)</p>
                <p class="mt-2 text-3xl font-bold tracking-tight text-amber-900">{{ $unreadConversationsOnPage }}</p>
            </article>
        </section>

        <section class="mt-6 overflow-hidden rounded-3xl border border-slate-200 bg-white shadow-[0_10px_30px_rgba(15,23,42,0.06)]">
            <div class="divide-y divide-slate-100">
                @foreach ($conversations as $conversation)
                    @php
                        $announcement = $conversation['announcement'];
                        $participant = $conversation['participant'];
                        $lastMessage = $conversation['last_message'];
                        $isUnreadConversation = $conversation['has_unread'];
                    @endphp

                    <article class="p-5 sm:p-6 {{ $isUnreadConversation ? 'bg-amber-50/60' : 'bg-white' }}">
                        <div class="flex flex-wrap items-start justify-between gap-3">
                            <div class="min-w-0 flex-1">
                                <p class="text-sm font-semibold {{ $isUnreadConversation ? 'text-slate-950' : 'text-slate-900' }}">
                                    {{ $announcement?->title ?? 'Annonce indisponible' }}
                                </p>
                                <p class="mt-1 text-sm text-slate-600">
                                    Avec {{ $participant?->name ?? 'Utilisateur indisponible' }}
                                </p>
                            </div>

                            <div class="flex items-center gap-2">
                                @if ($isUnreadConversation)
                                    <span class="rounded-full bg-amber-100 px-2.5 py-1 text-xs font-semibold text-amber-800">
                                        Non lu
                                    </span>
                                @else
                                    <span class="rounded-full bg-emerald-100 px-2.5 py-1 text-xs font-semibold text-emerald-800">
                                        Lu
                                    </span>
                                @endif
                                <span class="text-xs text-slate-500 sm:text-sm">
                                    {{ $conversation['last_message_date']?->format('d/m/Y H:i') }}
                                </span>
                            </div>
                        </div>

                        <p class="mt-3 text-sm leading-6 {{ $isUnreadConversation ? 'font-semibold text-slate-900' : 'text-slate-700' }}">
                            {{ \Illuminate\Support\Str::limit($lastMessage->body, 90) }}
                        </p>

                        <div class="mt-4 flex flex-wrap items-center justify-end gap-3">
                            @if ($announcement && $participant)
                                <a href="{{ route('messages.show', ['announcement' => $announcement->id, 'participant' => $participant->id]) }}" class="inline-flex h-10 items-center justify-center rounded-2xl bg-blue-600 px-4 text-sm font-semibold text-white hover:bg-blue-700">
                                    Ouvrir la conversation
                                </a>
                            @else
                                <span class="text-xs text-slate-500">Conversation indisponible</span>
                            @endif
                        </div>
                    </article>
                @endforeach
            </div>
        </section>

        <div class="mt-8 rounded-2xl border border-slate-200 bg-white px-4 py-3 shadow-sm">
            {{ $conversations->links() }}
        </div>
    @endif
@endsection
