@extends('layouts.app')

@section('title', 'BusLost&Found - Detail annonce')

@section('content')
    <section class="rounded-xl bg-white p-8 shadow-sm ring-1 ring-slate-200 sm:p-10">
        <div class="flex flex-wrap items-start justify-between gap-3">
            <h1 class="text-2xl font-bold text-slate-900 sm:text-3xl">
                {{ $announcement->title }}
            </h1>

            <div class="flex items-center gap-2">
                <span class="rounded-full bg-slate-100 px-2.5 py-1 text-xs font-semibold uppercase text-slate-700">
                    {{ $announcement->type === 'lost' ? 'Perdu' : 'Trouve' }}
                </span>
                <span class="rounded-full px-2.5 py-1 text-xs font-semibold uppercase {{ $announcement->status === 'active' ? 'bg-emerald-100 text-emerald-800' : 'bg-slate-100 text-slate-700' }}">
                    {{ $announcement->status === 'active' ? 'Active' : 'Resolue' }}
                </span>
            </div>
        </div>

        <div class="mt-6 space-y-3 text-sm text-slate-700 sm:text-base">
            <p><span class="font-semibold">Categorie:</span> {{ $announcement->category->name }}</p>
            <p><span class="font-semibold">Lieu:</span> {{ $announcement->location }}</p>
            <p><span class="font-semibold">Date de l'evenement:</span> {{ $announcement->event_date?->format('d/m/Y') }}</p>
            <p><span class="font-semibold">Publie par:</span> {{ $announcement->user->name }}</p>

            @if ($announcement->bus_line)
                <p><span class="font-semibold">Ligne de bus:</span> {{ $announcement->bus_line }}</p>
            @endif

            @if ($announcement->stop_name)
                <p><span class="font-semibold">Arret:</span> {{ $announcement->stop_name }}</p>
            @endif
        </div>

        <div class="mt-6">
            <h2 class="text-lg font-semibold text-slate-900">Description complete</h2>
            <p class="mt-2 whitespace-pre-line text-sm leading-7 text-slate-700 sm:text-base">
                {{ $announcement->description }}
            </p>
        </div>

        @auth
            @if (auth()->id() !== $announcement->user_id)
                <div class="mt-8 rounded-lg border border-slate-200 bg-slate-50 p-5">
                    <h2 class="text-lg font-semibold text-slate-900">Contacter le proprietaire</h2>
                    <p class="mt-2 text-sm text-slate-600">
                        Envoyez un message simple au proprietaire de cette annonce.
                    </p>

                    <form method="POST" action="{{ route('announcements.messages.store', $announcement) }}" class="mt-4 space-y-4">
                        @csrf

                        <div>
                            <label for="body" class="mb-1 block text-sm font-medium text-slate-700">
                                Votre message
                            </label>
                            <textarea
                                id="body"
                                name="body"
                                rows="4"
                                maxlength="2000"
                                required
                                class="w-full rounded-md border border-slate-300 px-3 py-2 text-sm text-slate-800 shadow-sm focus:border-slate-500 focus:outline-none focus:ring-2 focus:ring-slate-200"
                            >{{ old('body') }}</textarea>
                            @error('body')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <button type="submit" class="inline-flex items-center rounded-md bg-slate-900 px-4 py-2 text-sm font-semibold text-white hover:bg-slate-700">
                            Envoyer le message
                        </button>
                    </form>
                </div>

                <div class="mt-8 rounded-lg border border-slate-200 bg-slate-50 p-5">
                    <h2 class="text-lg font-semibold text-slate-900">Signaler cette annonce</h2>
                    <p class="mt-2 text-sm text-slate-600">
                        Si cette annonce vous semble inappropriee, expliquez la raison ci-dessous.
                    </p>

                    <form method="POST" action="{{ route('announcements.reports.store', $announcement) }}" class="mt-4 space-y-4">
                        @csrf

                        <div>
                            <label for="reason" class="mb-1 block text-sm font-medium text-slate-700">
                                Raison du signalement
                            </label>
                            <textarea
                                id="reason"
                                name="reason"
                                rows="4"
                                maxlength="1000"
                                required
                                class="w-full rounded-md border border-slate-300 px-3 py-2 text-sm text-slate-800 shadow-sm focus:border-slate-500 focus:outline-none focus:ring-2 focus:ring-slate-200"
                            >{{ old('reason') }}</textarea>
                            @error('reason')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <button type="submit" class="inline-flex items-center rounded-md bg-red-600 px-4 py-2 text-sm font-semibold text-white hover:bg-red-700">
                            Envoyer le signalement
                        </button>
                    </form>
                </div>
            @endif
        @endauth

        <div class="mt-8 flex flex-wrap gap-3">
            <a href="{{ route('announcements.index') }}" class="inline-flex items-center rounded-md border border-slate-300 px-4 py-2 text-sm font-semibold text-slate-700 hover:bg-slate-100">
                Retour aux annonces
            </a>

            @auth
                <a href="{{ route('announcements.create') }}" class="inline-flex items-center rounded-md bg-slate-900 px-4 py-2 text-sm font-semibold text-white hover:bg-slate-700">
                    Publier une annonce
                </a>
            @endauth
        </div>
    </section>
@endsection
