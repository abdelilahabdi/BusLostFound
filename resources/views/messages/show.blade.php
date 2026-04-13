@extends('layouts.app')

@section('title', 'BusLost&Found - Conversation')

@section('content')
    <section class="rounded-xl bg-white p-8 shadow-sm ring-1 ring-slate-200 sm:p-10">
        <div class="flex flex-wrap items-start justify-between gap-3">
            <div>
                <h1 class="text-2xl font-bold text-slate-900 sm:text-3xl">Conversation</h1>
                <p class="mt-2 text-sm text-slate-600 sm:text-base">
                    Participant: <span class="font-semibold text-slate-800">{{ $participant->name }}</span>
                </p>
                <p class="mt-1 text-sm text-slate-600 sm:text-base">
                    Annonce: <span class="font-semibold text-slate-800">{{ $announcement->title }}</span>
                </p>
            </div>

            <div class="flex flex-wrap items-center gap-2">
                <a href="{{ route('messages.index') }}" class="inline-flex items-center rounded-md border border-slate-300 px-4 py-2 text-sm font-semibold text-slate-700 hover:bg-slate-100">
                    Retour aux conversations
                </a>
                <a href="{{ route('announcements.show', $announcement) }}" class="inline-flex items-center rounded-md border border-slate-300 px-4 py-2 text-sm font-semibold text-slate-700 hover:bg-slate-100">
                    Voir l'annonce
                </a>
            </div>
        </div>
    </section>

    <section class="mt-6 rounded-xl bg-white p-6 shadow-sm ring-1 ring-slate-200 sm:p-8">
        <div class="mb-4">
            <h2 class="text-lg font-semibold text-slate-900">Historique des messages</h2>
            <p class="mt-1 text-sm text-slate-600">
                Les messages sont affiches du plus ancien au plus recent.
            </p>
        </div>

        @if ($messages->isEmpty())
            <p class="text-sm text-slate-600">
                Aucun message dans cette conversation.
            </p>
        @else
            <div class="space-y-5">
                @foreach ($messages as $message)
                    @php
                        $isSentByAuthUser = $message->sender_id === auth()->id();
                    @endphp

                    <div class="flex {{ $isSentByAuthUser ? 'justify-end' : 'justify-start' }}">
                        <article class="w-full max-w-3xl rounded-xl px-4 py-3 shadow-sm ring-1 {{ $isSentByAuthUser ? 'bg-slate-900 text-white ring-slate-900' : 'bg-slate-50 text-slate-900 ring-slate-200' }}">
                            <p class="flex flex-wrap items-center gap-2 text-xs font-semibold {{ $isSentByAuthUser ? 'text-slate-200' : 'text-slate-600' }}">
                                <span>{{ $isSentByAuthUser ? 'Vous' : $participant->name }}</span>
                                <span class="rounded-full px-2 py-0.5 {{ $isSentByAuthUser ? 'bg-slate-700 text-slate-100' : 'bg-slate-200 text-slate-700' }}">
                                    {{ $isSentByAuthUser ? 'Envoye' : 'Recu' }}
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

    <section class="mt-6 rounded-xl bg-white p-6 shadow-sm ring-1 ring-slate-200 sm:p-8">
        <h2 class="text-lg font-semibold text-slate-900">Repondre</h2>
        <p class="mt-1 text-sm text-slate-600">
            Envoyez votre reponse a {{ $participant->name }}.
        </p>

        <form method="POST" action="{{ route('announcements.messages.store', $announcement) }}" class="mt-4 space-y-4">
            @csrf

            <input type="hidden" name="participant_id" value="{{ $participant->id }}">

            <div>
                <label for="body" class="mb-1 block text-sm font-medium text-slate-700">
                    Votre message
                </label>
                <textarea
                    id="body"
                    name="body"
                    rows="5"
                    maxlength="2000"
                    required
                    class="w-full rounded-md border border-slate-300 px-3 py-2 text-sm text-slate-800 shadow-sm focus:border-slate-500 focus:outline-none focus:ring-2 focus:ring-slate-200"
                >{{ old('body') }}</textarea>
                @error('body')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
                @error('participant_id')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <button type="submit" class="inline-flex items-center rounded-md bg-slate-900 px-4 py-2 text-sm font-semibold text-white hover:bg-slate-700">
                Repondre
            </button>
        </form>
    </section>
@endsection
