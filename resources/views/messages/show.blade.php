@extends('layouts.app')

@section('title', 'BusLost&Found - Conversation')

@section('content')
    <section class="rounded-3xl bg-slate-50/70 p-6 ring-1 ring-slate-200 sm:p-10">
        <div class="flex flex-wrap items-start justify-between gap-4">
            <div class="max-w-3xl">
                <h1 class="text-3xl font-bold tracking-tight text-slate-900 sm:text-5xl">Conversation</h1>
                <p class="mt-3 text-base text-slate-600 sm:text-lg">
                    Échange avec <span class="font-semibold text-slate-800">{{ $participant->name }}</span>
                </p>
                <p class="mt-1 text-sm text-slate-500 sm:text-base">
                    Concernant l'annonce : <span class="font-semibold text-slate-700">{{ $announcement->title }}</span>
                </p>
            </div>

            <div class="flex flex-wrap items-center gap-2">
                <a href="{{ route('messages.index') }}" class="inline-flex h-11 items-center justify-center rounded-2xl border border-slate-300 bg-white px-4 text-sm font-semibold text-slate-700 transition hover:bg-slate-100">
                    Retour aux conversations
                </a>
                <a href="{{ route('announcements.show', $announcement) }}" class="inline-flex h-11 items-center justify-center rounded-2xl bg-blue-600 px-4 text-sm font-semibold text-white transition hover:bg-blue-700">
                    Voir l'annonce
                </a>
            </div>
        </div>
    </section>

    <section class="mt-8 rounded-3xl border border-slate-200 bg-white p-6 shadow-[0_10px_30px_rgba(15,23,42,0.06)] sm:p-8">
        <div class="flex flex-wrap items-center justify-between gap-3">
            <div>
                <h2 class="text-xl font-semibold text-slate-900">Historique des messages</h2>
                <p class="mt-1 text-sm text-slate-600">
                    Les messages sont affichés du plus ancien au plus récent.
                </p>
            </div>
            <p class="inline-flex items-center rounded-full bg-slate-100 px-3 py-1 text-sm font-semibold text-slate-700">
                {{ $messages->count() }} message{{ $messages->count() > 1 ? 's' : '' }}
            </p>
        </div>

        @if ($messages->isEmpty())
            <div class="mt-6 rounded-2xl border border-slate-200 bg-slate-50 p-6 text-center">
                <p class="text-sm text-slate-600">
                    Aucun message dans cette conversation.
                </p>
            </div>
        @else
            <div class="mt-6 space-y-4">
                @foreach ($messages as $message)
                    @php
                        $isSentByAuthUser = $message->sender_id === auth()->id();
                    @endphp

                    <div class="flex {{ $isSentByAuthUser ? 'justify-end' : 'justify-start' }}">
                        <article class="w-full max-w-3xl rounded-2xl px-4 py-3 shadow-sm ring-1 {{ $isSentByAuthUser ? 'bg-blue-600 text-white ring-blue-600' : 'bg-slate-50 text-slate-900 ring-slate-200' }}">
                            <p class="flex flex-wrap items-center gap-2 text-xs font-semibold {{ $isSentByAuthUser ? 'text-blue-100' : 'text-slate-600' }}">
                                <span>{{ $isSentByAuthUser ? 'Vous' : $participant->name }}</span>
                                <span class="rounded-full px-2 py-0.5 {{ $isSentByAuthUser ? 'bg-blue-500 text-white' : 'bg-slate-200 text-slate-700' }}">
                                    {{ $isSentByAuthUser ? 'Envoyé' : 'Reçu' }}
                                </span>
                                <span>Le {{ $message->created_at?->format('d/m/Y H:i') }}</span>
                            </p>
                            <p class="mt-3 whitespace-pre-line text-sm leading-6">
                                {{ $message->body }}
                            </p>
                        </article>
                    </div>
                @endforeach
            </div>
        @endif
    </section>

    <section class="mt-8 rounded-3xl border border-slate-200 bg-white p-6 shadow-[0_10px_30px_rgba(15,23,42,0.06)] sm:p-8">
        <h2 class="text-xl font-semibold text-slate-900">Répondre</h2>
        <p class="mt-1 text-sm text-slate-600">
            Envoyez votre réponse à {{ $participant->name }}.
        </p>

        <form method="POST" action="{{ route('announcements.messages.store', $announcement) }}" class="mt-5 space-y-5">
            @csrf

            <input type="hidden" name="participant_id" value="{{ $participant->id }}">

            <div>
                <label for="body" class="mb-1 block text-sm font-semibold text-slate-700">
                    Votre message
                </label>
                <textarea
                    id="body"
                    name="body"
                    rows="5"
                    maxlength="2000"
                    required
                    class="w-full rounded-2xl border border-slate-300 bg-white px-4 py-3 text-sm text-slate-800 shadow-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-100"
                >{{ old('body') }}</textarea>
                @error('body')
                    <p class="mt-2 inline-flex items-center rounded-xl bg-red-50 px-3 py-1.5 text-xs font-semibold text-red-700">{{ $message }}</p>
                @enderror
                @error('participant_id')
                    <p class="mt-2 inline-flex items-center rounded-xl bg-red-50 px-3 py-1.5 text-xs font-semibold text-red-700">{{ $message }}</p>
                @enderror
            </div>

            <button type="submit" class="inline-flex h-11 items-center justify-center rounded-2xl bg-blue-600 px-5 text-sm font-semibold text-white transition hover:bg-blue-700">
                Répondre
            </button>
        </form>
    </section>
@endsection
