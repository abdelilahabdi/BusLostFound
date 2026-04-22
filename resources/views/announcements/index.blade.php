@extends('layouts.app')

@section('title', 'BusLost&Found - Annonces')

@section('content')
    <section class="rounded-3xl bg-slate-50/70 p-6 ring-1 ring-slate-200 sm:p-10">
        <div class="mx-auto max-w-5xl">
            <div class="flex flex-wrap items-start justify-between gap-4">
                <div class="max-w-3xl">
                    <h1 class="text-3xl font-bold tracking-tight text-slate-900 sm:text-5xl">Rechercher un objet</h1>
                    <p class="mt-3 text-base text-slate-600 sm:text-lg">
                        Retrouvez rapidement un objet perdu ou trouvé parmi les annonces publiées.
                    </p>
                </div>

                @auth
                    <a href="{{ route('announcements.create') }}" class="inline-flex items-center rounded-2xl bg-slate-900 px-4 py-2 text-sm font-semibold text-white hover:bg-slate-700">
                        Nouvelle annonce
                    </a>
                @endauth
            </div>

            <form method="GET" action="{{ route('announcements.index') }}" class="mt-8 space-y-4">
                <div class="rounded-3xl border border-slate-200 bg-white p-4 shadow-[0_8px_24px_rgba(15,23,42,0.06)] sm:p-5">
                    <label for="q" class="sr-only">Mot-cle (titre ou description)</label>
                    <div class="flex flex-col gap-3 sm:flex-row sm:items-center">
                        <div class="relative flex-1">
                            <span class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-4 text-blue-600">
                                <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                                    <circle cx="11" cy="11" r="7" stroke="currentColor" stroke-width="2"></circle>
                                    <path d="M20 20L16.65 16.65" stroke="currentColor" stroke-width="2" stroke-linecap="round"></path>
                                </svg>
                            </span>
                            <input
                                id="q"
                                name="q"
                                type="text"
                                value="{{ $filters['q'] ?? '' }}"
                                placeholder="Ex: portefeuille, telephone..."
                                class="block w-full rounded-2xl border-slate-300 bg-white py-3 pl-12 pr-4 text-slate-900 placeholder:text-slate-400 focus:border-blue-500 focus:ring-blue-500"
                            >
                        </div>
                        <button
                            type="submit"
                            class="inline-flex items-center justify-center rounded-2xl bg-blue-600 px-5 py-3 text-sm font-semibold text-white hover:bg-blue-700"
                        >
                            Rechercher
                        </button>
                    </div>
                </div>

                <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-[0_10px_30px_rgba(15,23,42,0.06)] sm:p-7">
                    <h2 class="text-lg font-bold text-slate-900">Filtres</h2>

                    <div class="mt-5 grid gap-4 md:grid-cols-2 xl:grid-cols-3">
                        <div>
                            <label for="category_id" class="block text-sm font-semibold text-slate-700">Categorie</label>
                            <select
                                id="category_id"
                                name="category_id"
                                class="mt-1 block h-12 w-full rounded-2xl border-slate-300 bg-white px-4 text-slate-900 focus:border-blue-500 focus:ring-blue-500"
                            >
                                <option value="">Toutes les categories</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}" @selected((string) ($filters['category_id'] ?? '') === (string) $category->id)>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label for="type" class="block text-sm font-semibold text-slate-700">Type</label>
                            <select
                                id="type"
                                name="type"
                                class="mt-1 block h-12 w-full rounded-2xl border-slate-300 bg-white px-4 text-slate-900 focus:border-blue-500 focus:ring-blue-500"
                            >
                                <option value="">Tous</option>
                                <option value="lost" @selected(($filters['type'] ?? '') === 'lost')>Perdu</option>
                                <option value="found" @selected(($filters['type'] ?? '') === 'found')>Trouve</option>
                            </select>
                        </div>

                        <div>
                            <label for="status" class="block text-sm font-semibold text-slate-700">Statut</label>
                            <select
                                id="status"
                                name="status"
                                class="mt-1 block h-12 w-full rounded-2xl border-slate-300 bg-white px-4 text-slate-900 focus:border-blue-500 focus:ring-blue-500"
                            >
                                <option value="">Tous</option>
                                <option value="active" @selected(($filters['status'] ?? '') === 'active')>Active</option>
                                <option value="resolved" @selected(($filters['status'] ?? '') === 'resolved')>Resolue</option>
                            </select>
                        </div>

                        <div>
                            <label for="location" class="block text-sm font-semibold text-slate-700">Lieu</label>
                            <input
                                id="location"
                                name="location"
                                type="text"
                                value="{{ $filters['location'] ?? '' }}"
                                placeholder="Ex: Gare routiere"
                                class="mt-1 block h-12 w-full rounded-2xl border-slate-300 bg-white px-4 text-slate-900 placeholder:text-slate-400 focus:border-blue-500 focus:ring-blue-500"
                            >
                        </div>

                        <div>
                            <label for="event_date" class="block text-sm font-semibold text-slate-700">Date de l'evenement</label>
                            <input
                                id="event_date"
                                name="event_date"
                                type="date"
                                value="{{ $filters['event_date'] ?? '' }}"
                                class="mt-1 block h-12 w-full rounded-2xl border-slate-300 bg-white px-4 text-slate-900 focus:border-blue-500 focus:ring-blue-500"
                            >
                        </div>
                    </div>

                    <div class="mt-6 flex flex-wrap items-center gap-3 border-t border-slate-100 pt-5">
                        <button
                            type="submit"
                            class="inline-flex items-center rounded-2xl bg-blue-600 px-5 py-2.5 text-sm font-semibold text-white hover:bg-blue-700"
                        >
                            Rechercher
                        </button>

                        <a href="{{ route('announcements.index') }}" class="inline-flex items-center rounded-2xl px-3 py-2 text-sm font-semibold text-blue-600 hover:bg-blue-50">
                            Reinitialiser
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </section>

    @if ($announcements->isEmpty())
        <section class="mt-8 rounded-3xl border border-slate-200 bg-white p-10 text-center shadow-[0_10px_30px_rgba(15,23,42,0.06)]">
            <div class="mx-auto inline-flex h-14 w-14 items-center justify-center rounded-2xl bg-slate-100 text-slate-500">
                <svg class="h-7 w-7" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                    <circle cx="11" cy="11" r="7" stroke="currentColor" stroke-width="1.8"></circle>
                    <path d="M20 20L16.7 16.7" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"></path>
                </svg>
            </div>
            <h2 class="mt-5 text-xl font-semibold text-slate-900">Aucune annonce pour le moment</h2>
            <p class="mt-2 text-sm text-slate-600 sm:text-base">
                Les annonces apparaitront ici des qu'elles seront publiees.
            </p>
        </section>
    @else
        <div class="mt-8 flex flex-wrap items-center justify-between gap-3">
            <p class="inline-flex items-center rounded-full bg-slate-100 px-3 py-1.5 text-sm font-semibold text-slate-700">
                {{ $announcements->total() }} résultat{{ $announcements->total() > 1 ? 's' : '' }}
            </p>

            @if (($filters['q'] ?? '') !== '')
                <p class="text-sm text-slate-500">
                    Recherche: <span class="font-medium text-slate-700">{{ $filters['q'] }}</span>
                </p>
            @endif
        </div>

        <section class="mt-4 grid gap-5 md:grid-cols-2 lg:grid-cols-3">
            @foreach ($announcements as $announcement)
                <article class="flex h-full flex-col rounded-3xl border border-slate-200 bg-white p-6 shadow-[0_10px_30px_rgba(15,23,42,0.06)]">
                    <div class="flex items-start justify-between gap-3">
                        <h2 class="text-lg font-bold leading-6 text-slate-900">
                            {{ $announcement->title }}
                        </h2>
                        <span class="inline-flex rounded-full px-3 py-1 text-xs font-semibold uppercase {{ $announcement->type === 'lost' ? 'bg-red-100 text-red-600' : 'bg-emerald-100 text-emerald-600' }}">
                            {{ $announcement->type === 'lost' ? 'Perdu' : 'Trouve' }}
                        </span>
                    </div>

                    <p class="mt-4 text-sm leading-6 text-slate-600">
                        {{ \Illuminate\Support\Str::limit($announcement->description, 120) }}
                    </p>

                    <ul class="mt-4 space-y-2.5 text-sm text-slate-700">
                        <li class="flex items-center gap-2.5">
                            <svg class="h-4 w-4 text-slate-500" viewBox="0 0 20 20" fill="none" aria-hidden="true">
                                <path d="M3.5 5.5h13m-11.5 3h10m-8.5 3h7" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" />
                            </svg>
                            <span><span class="font-medium">Categorie:</span> {{ $announcement->category->name }}</span>
                        </li>
                        <li class="flex items-center gap-2.5">
                            <svg class="h-4 w-4 text-slate-500" viewBox="0 0 20 20" fill="none" aria-hidden="true">
                                <path d="M10 17s5-4.25 5-8a5 5 0 10-10 0c0 3.75 5 8 5 8z" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" />
                                <circle cx="10" cy="9" r="1.7" stroke="currentColor" stroke-width="1.6" />
                            </svg>
                            <span><span class="font-medium">Lieu:</span> {{ $announcement->location }}</span>
                        </li>
                        <li class="flex items-center gap-2.5">
                            <svg class="h-4 w-4 text-slate-500" viewBox="0 0 20 20" fill="none" aria-hidden="true">
                                <circle cx="10" cy="10" r="6.5" stroke="currentColor" stroke-width="1.6" />
                                <path d="M10 6.5v3.8l2.4 1.4" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                            <span><span class="font-medium">Date:</span> {{ $announcement->event_date?->format('d/m/Y') }}</span>
                        </li>
                    </ul>

                    <div class="mt-4">
                        <span class="inline-flex rounded-full bg-slate-100 px-3 py-1 text-xs font-semibold {{ $announcement->status === 'active' ? 'text-emerald-700' : 'text-slate-600' }}">
                            {{ $announcement->status === 'active' ? 'Active' : 'Resolue' }}
                        </span>
                    </div>

                    <div class="mt-5 flex items-center justify-between gap-3 border-t border-slate-100 pt-4">
                        <p class="text-sm text-slate-600">
                            <span class="font-medium text-slate-700">Publie par:</span> {{ $announcement->user->name }}
                        </p>

                        <a href="{{ route('announcements.show', $announcement) }}" class="inline-flex items-center rounded-2xl bg-blue-600 px-4 py-2 text-sm font-semibold text-white hover:bg-blue-700">
                            Voir les details
                        </a>
                    </div>
                </article>
            @endforeach
        </section>

        <div class="mt-8 rounded-2xl border border-slate-200 bg-white px-4 py-3 shadow-sm">
            {{ $announcements->links() }}
        </div>
    @endif
@endsection
