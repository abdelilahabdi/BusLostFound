@extends('layouts.app')

@section('title', 'BusLost&Found - Tableau de bord')

@section('content')
    <section class="rounded-3xl border border-slate-200 bg-white p-6 shadow-[0_10px_30px_rgba(15,23,42,0.06)] sm:p-9">
        <div class="max-w-3xl">
            <p class="inline-flex items-center rounded-full bg-blue-50 px-3 py-1 text-xs font-semibold uppercase tracking-wide text-blue-700">
                Espace personnel
            </p>
            <h1 class="mt-4 text-3xl font-bold tracking-tight text-slate-900 sm:text-4xl">
                Tableau de bord
            </h1>
            <p class="mt-3 text-base text-slate-700 sm:text-lg">
                Bienvenue <span class="font-semibold text-slate-900">{{ auth()->user()->name }}</span>.
            </p>
            <p class="mt-1 text-sm text-slate-600 sm:text-base">
                Suivez vos activit&eacute;s et acc&eacute;dez rapidement aux actions principales.
            </p>
        </div>

        <div class="mt-7 grid gap-3 sm:grid-cols-2 xl:grid-cols-4">
            <a href="{{ route('announcements.create') }}" class="inline-flex h-11 items-center justify-center rounded-2xl bg-blue-600 px-4 text-sm font-semibold text-white shadow-[0_8px_18px_rgba(37,99,235,0.22)] transition hover:bg-blue-700">
                Nouvelle annonce
            </a>
            <a href="{{ route('announcements.my') }}" class="inline-flex h-11 items-center justify-center rounded-2xl border border-slate-300 bg-slate-50 px-4 text-sm font-semibold text-slate-700 transition hover:bg-slate-100">
                Mes annonces
            </a>
            <a href="{{ route('messages.index') }}" class="inline-flex h-11 items-center justify-center rounded-2xl border border-slate-300 bg-slate-50 px-4 text-sm font-semibold text-slate-700 transition hover:bg-slate-100">
                Mes messages
            </a>
            <a href="{{ route('home') }}" class="inline-flex h-11 items-center justify-center rounded-2xl border border-slate-300 bg-slate-50 px-4 text-sm font-semibold text-slate-700 transition hover:bg-slate-100">
                Retour &agrave; l'accueil
            </a>
        </div>
    </section>

    <section class="mt-6 grid gap-4 md:grid-cols-3">
        <article class="rounded-3xl border border-slate-200 bg-white p-6 shadow-[0_8px_24px_rgba(15,23,42,0.05)] sm:p-7">
            <p class="text-xs font-semibold uppercase tracking-wide text-slate-500">Total annonces</p>
            <p class="mt-3 text-3xl font-bold tracking-tight text-slate-900">{{ $totalAnnouncements }}</p>
        </article>

        <article class="rounded-3xl border border-slate-200 bg-white p-6 shadow-[0_8px_24px_rgba(15,23,42,0.05)] sm:p-7">
            <p class="text-xs font-semibold uppercase tracking-wide text-slate-500">Annonces actives</p>
            <p class="mt-3 text-3xl font-bold tracking-tight text-emerald-700">{{ $totalActiveAnnouncements }}</p>
        </article>

        <article class="rounded-3xl border border-slate-200 bg-white p-6 shadow-[0_8px_24px_rgba(15,23,42,0.05)] sm:p-7">
            <p class="text-xs font-semibold uppercase tracking-wide text-slate-500">Annonces r&eacute;solues</p>
            <p class="mt-3 text-3xl font-bold tracking-tight text-slate-700">{{ $totalResolvedAnnouncements }}</p>
        </article>
    </section>

    <section class="mt-6 rounded-3xl border border-slate-200 bg-white p-6 shadow-[0_10px_30px_rgba(15,23,42,0.06)] sm:p-9">
        <h2 class="text-2xl font-bold tracking-tight text-slate-900 sm:text-3xl">Derni&egrave;res annonces</h2>
        <p class="mt-2 text-sm text-slate-600">
            Retrouvez vos publications les plus r&eacute;centes.
        </p>

        @if ($latestAnnouncements->isEmpty())
            <div class="mt-5 rounded-2xl border border-slate-200 bg-slate-50 p-6 text-center">
                <p class="text-sm text-slate-600">
                    Vous n'avez pas encore publi&eacute; d'annonce.
                </p>
            </div>
        @else
            <div class="mt-5 space-y-3.5">
                @foreach ($latestAnnouncements as $announcement)
                    <article class="rounded-2xl border border-slate-200 bg-white p-4 shadow-sm sm:p-5">
                        <div class="flex flex-wrap items-center justify-between gap-2">
                            <h3 class="text-base font-semibold text-slate-900">
                                {{ $announcement->title }}
                            </h3>
                            <a href="{{ route('announcements.show', $announcement) }}" class="inline-flex h-9 items-center justify-center rounded-2xl border border-blue-200 bg-blue-50 px-3.5 text-sm font-semibold text-blue-700 transition hover:bg-blue-100">
                                Voir
                            </a>
                        </div>

                        <div class="mt-3 flex flex-wrap items-center gap-2 text-xs font-semibold sm:mt-4">
                            <span class="inline-flex h-7 items-center rounded-full border border-slate-200 bg-slate-100 px-2.5 text-slate-700">
                                Type: {{ $announcement->type === 'lost' ? 'Perdu' : 'Trouv&eacute;' }}
                            </span>
                            <span class="inline-flex h-7 items-center rounded-full {{ $announcement->status === 'active' ? 'border border-emerald-200 bg-emerald-100 text-emerald-700' : 'border border-slate-200 bg-slate-100 text-slate-700' }} px-2.5">
                                Statut: {{ $announcement->status === 'active' ? 'Active' : 'R&eacute;solue' }}
                            </span>
                            <span class="inline-flex h-7 items-center rounded-full border border-blue-100 bg-blue-50 px-2.5 text-blue-700">
                                Date: {{ $announcement->event_date?->format('d/m/Y') }}
                            </span>
                        </div>
                    </article>
                @endforeach
            </div>
        @endif
    </section>
@endsection
