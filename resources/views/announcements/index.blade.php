@extends('layouts.app')

@section('title', 'BusLost&Found - Annonces')

@section('content')
    <section class="rounded-xl bg-white p-8 shadow-sm ring-1 ring-slate-200 sm:p-10">
        <div class="flex flex-wrap items-center justify-between gap-3">
            <div>
                <h1 class="text-2xl font-bold text-slate-900 sm:text-3xl">Annonces</h1>
                <p class="mt-2 text-sm text-slate-600 sm:text-base">
                    Consultez les objets perdus et trouves publies sur la plateforme.
                </p>
            </div>

            @auth
                <a href="{{ route('announcements.create') }}" class="inline-flex items-center rounded-md bg-slate-900 px-4 py-2 text-sm font-semibold text-white hover:bg-slate-700">
                    Nouvelle annonce
                </a>
            @endauth
        </div>

        <form method="GET" action="{{ route('announcements.index') }}" class="mt-6 space-y-4 rounded-lg border border-slate-200 bg-slate-50 p-4">
            <div class="grid gap-4 md:grid-cols-2 lg:grid-cols-3">
                <div class="lg:col-span-3">
                    <label for="q" class="block text-sm font-medium text-slate-700">Mot-cle (titre ou description)</label>
                    <input
                        id="q"
                        name="q"
                        type="text"
                        value="{{ $filters['q'] ?? '' }}"
                        placeholder="Ex: portefeuille, telephone..."
                        class="mt-1 block w-full rounded-md border-slate-300 text-slate-900 focus:border-slate-500 focus:ring-slate-500"
                    >
                </div>

                <div>
                    <label for="category_id" class="block text-sm font-medium text-slate-700">Categorie</label>
                    <select
                        id="category_id"
                        name="category_id"
                        class="mt-1 block w-full rounded-md border-slate-300 text-slate-900 focus:border-slate-500 focus:ring-slate-500"
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
                    <label for="type" class="block text-sm font-medium text-slate-700">Type</label>
                    <select
                        id="type"
                        name="type"
                        class="mt-1 block w-full rounded-md border-slate-300 text-slate-900 focus:border-slate-500 focus:ring-slate-500"
                    >
                        <option value="">Tous</option>
                        <option value="lost" @selected(($filters['type'] ?? '') === 'lost')>Perdu</option>
                        <option value="found" @selected(($filters['type'] ?? '') === 'found')>Trouve</option>
                    </select>
                </div>

                <div>
                    <label for="status" class="block text-sm font-medium text-slate-700">Statut</label>
                    <select
                        id="status"
                        name="status"
                        class="mt-1 block w-full rounded-md border-slate-300 text-slate-900 focus:border-slate-500 focus:ring-slate-500"
                    >
                        <option value="">Tous</option>
                        <option value="active" @selected(($filters['status'] ?? '') === 'active')>Active</option>
                        <option value="resolved" @selected(($filters['status'] ?? '') === 'resolved')>Resolue</option>
                    </select>
                </div>

                <div>
                    <label for="location" class="block text-sm font-medium text-slate-700">Lieu</label>
                    <input
                        id="location"
                        name="location"
                        type="text"
                        value="{{ $filters['location'] ?? '' }}"
                        placeholder="Ex: Gare routiere"
                        class="mt-1 block w-full rounded-md border-slate-300 text-slate-900 focus:border-slate-500 focus:ring-slate-500"
                    >
                </div>

                <div>
                    <label for="event_date" class="block text-sm font-medium text-slate-700">Date de l'evenement</label>
                    <input
                        id="event_date"
                        name="event_date"
                        type="date"
                        value="{{ $filters['event_date'] ?? '' }}"
                        class="mt-1 block w-full rounded-md border-slate-300 text-slate-900 focus:border-slate-500 focus:ring-slate-500"
                    >
                </div>
            </div>

            <div class="flex flex-wrap items-center gap-3">
                <button
                    type="submit"
                    class="inline-flex items-center rounded-md bg-slate-900 px-4 py-2 text-sm font-semibold text-white hover:bg-slate-700"
                >
                    Rechercher
                </button>

                <a href="{{ route('announcements.index') }}" class="inline-flex items-center rounded-md border border-slate-300 px-4 py-2 text-sm font-semibold text-slate-700 hover:bg-slate-100">
                    Reinitialiser
                </a>
            </div>
        </form>
    </section>

    @if ($announcements->isEmpty())
        <section class="mt-6 rounded-xl bg-white p-8 text-center shadow-sm ring-1 ring-slate-200">
            <h2 class="text-lg font-semibold text-slate-900">Aucune annonce pour le moment</h2>
            <p class="mt-2 text-sm text-slate-600">
                Les annonces apparaitront ici des qu'elles seront publiees.
            </p>
        </section>
    @else
        <section class="mt-6 grid gap-4 md:grid-cols-2 lg:grid-cols-3">
            @foreach ($announcements as $announcement)
                <article class="rounded-xl bg-white p-5 shadow-sm ring-1 ring-slate-200">
                    <div class="flex items-start justify-between gap-2">
                        <h2 class="text-lg font-semibold text-slate-900">
                            {{ $announcement->title }}
                        </h2>
                        <span class="rounded-full bg-slate-100 px-2.5 py-1 text-xs font-semibold uppercase text-slate-700">
                            {{ $announcement->type === 'lost' ? 'Perdu' : 'Trouve' }}
                        </span>
                    </div>

                    <div class="mt-3 space-y-1 text-sm text-slate-600">
                        <p><span class="font-medium text-slate-700">Categorie:</span> {{ $announcement->category->name }}</p>
                        <p><span class="font-medium text-slate-700">Lieu:</span> {{ $announcement->location }}</p>
                        <p><span class="font-medium text-slate-700">Date:</span> {{ $announcement->event_date?->format('d/m/Y') }}</p>
                        <p>
                            <span class="font-medium text-slate-700">Statut:</span>
                            <span class="font-semibold {{ $announcement->status === 'active' ? 'text-emerald-700' : 'text-slate-700' }}">
                                {{ $announcement->status === 'active' ? 'Active' : 'Resolue' }}
                            </span>
                        </p>
                        <p><span class="font-medium text-slate-700">Publie par:</span> {{ $announcement->user->name }}</p>
                    </div>

                    <p class="mt-3 text-sm leading-6 text-slate-600">
                        {{ \Illuminate\Support\Str::limit($announcement->description, 120) }}
                    </p>

                    <a href="{{ route('announcements.show', $announcement) }}" class="mt-4 inline-flex items-center text-sm font-semibold text-slate-900 hover:text-slate-700">
                        Voir les details
                    </a>
                </article>
            @endforeach
        </section>

        <div class="mt-6">
            {{ $announcements->links() }}
        </div>
    @endif
@endsection
