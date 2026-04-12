@extends('layouts.app')

@section('title', 'BusLost&Found - Tableau de bord')

@section('content')
    <section class="rounded-xl bg-white p-8 shadow-sm ring-1 ring-slate-200 sm:p-10">
        <h1 class="text-2xl font-bold text-slate-900 sm:text-3xl">
            Tableau de bord
        </h1>

        <p class="mt-3 text-sm text-slate-600 sm:text-base">
            Bienvenue {{ auth()->user()->name }}.
        </p>

        <div class="mt-6 flex flex-wrap gap-3">
            <a href="{{ route('announcements.create') }}" class="inline-flex items-center rounded-md bg-slate-900 px-4 py-2 text-sm font-semibold text-white hover:bg-slate-700">
                Nouvelle annonce
            </a>

            <a href="{{ route('announcements.my') }}" class="inline-flex items-center rounded-md bg-slate-900 px-4 py-2 text-sm font-semibold text-white hover:bg-slate-700">
                Mes annonces
            </a>

            <a href="{{ route('messages.index') }}" class="inline-flex items-center rounded-md bg-slate-900 px-4 py-2 text-sm font-semibold text-white hover:bg-slate-700">
                Mes messages
            </a>

            <a href="{{ route('home') }}" class="inline-flex items-center rounded-md bg-slate-900 px-4 py-2 text-sm font-semibold text-white hover:bg-slate-700">
                Retour a l'accueil
            </a>
        </div>
    </section>

    <section class="mt-6 grid gap-4 md:grid-cols-3">
        <article class="rounded-xl bg-white p-6 shadow-sm ring-1 ring-slate-200">
            <p class="text-sm font-medium text-slate-500">Total annonces</p>
            <p class="mt-2 text-3xl font-bold text-slate-900">{{ $totalAnnouncements }}</p>
        </article>

        <article class="rounded-xl bg-white p-6 shadow-sm ring-1 ring-slate-200">
            <p class="text-sm font-medium text-slate-500">Annonces actives</p>
            <p class="mt-2 text-3xl font-bold text-emerald-700">{{ $totalActiveAnnouncements }}</p>
        </article>

        <article class="rounded-xl bg-white p-6 shadow-sm ring-1 ring-slate-200">
            <p class="text-sm font-medium text-slate-500">Annonces resolues</p>
            <p class="mt-2 text-3xl font-bold text-slate-700">{{ $totalResolvedAnnouncements }}</p>
        </article>
    </section>

    <section class="mt-6 rounded-xl bg-white p-8 shadow-sm ring-1 ring-slate-200 sm:p-10">
        <h2 class="text-xl font-bold text-slate-900">Dernieres annonces</h2>

        @if ($latestAnnouncements->isEmpty())
            <div class="mt-4 rounded-lg border border-slate-200 bg-slate-50 p-5 text-center">
                <p class="text-sm text-slate-600">
                    Vous n'avez pas encore publie d'annonce.
                </p>
            </div>
        @else
            <div class="mt-4 space-y-3">
                @foreach ($latestAnnouncements as $announcement)
                    <article class="rounded-lg border border-slate-200 p-4">
                        <div class="flex flex-wrap items-center justify-between gap-2">
                            <h3 class="text-base font-semibold text-slate-900">
                                {{ $announcement->title }}
                            </h3>
                            <a href="{{ route('announcements.show', $announcement) }}" class="text-sm font-semibold text-slate-900 hover:text-slate-700">
                                Voir
                            </a>
                        </div>

                        <div class="mt-2 flex flex-wrap gap-4 text-sm text-slate-600">
                            <p><span class="font-medium text-slate-700">Type:</span> {{ $announcement->type === 'lost' ? 'Perdu' : 'Trouve' }}</p>
                            <p><span class="font-medium text-slate-700">Statut:</span> {{ $announcement->status === 'active' ? 'Active' : 'Resolue' }}</p>
                            <p><span class="font-medium text-slate-700">Date:</span> {{ $announcement->event_date?->format('d/m/Y') }}</p>
                        </div>
                    </article>
                @endforeach
            </div>
        @endif
    </section>
@endsection
