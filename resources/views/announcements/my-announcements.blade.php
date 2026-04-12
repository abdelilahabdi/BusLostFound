@extends('layouts.app')

@section('title', 'BusLost&Found - Mes annonces')

@section('content')
    <section class="rounded-xl bg-white p-8 shadow-sm ring-1 ring-slate-200 sm:p-10">
        <div class="flex flex-wrap items-center justify-between gap-3">
            <div>
                <h1 class="text-2xl font-bold text-slate-900 sm:text-3xl">Mes annonces</h1>
                <p class="mt-2 text-sm text-slate-600 sm:text-base">
                    Retrouvez ici toutes vos annonces et gerer leur statut.
                </p>
            </div>

            <a href="{{ route('announcements.create') }}" class="inline-flex items-center rounded-md bg-slate-900 px-4 py-2 text-sm font-semibold text-white hover:bg-slate-700">
                Nouvelle annonce
            </a>
        </div>
    </section>

    @if ($announcements->isEmpty())
        <section class="mt-6 rounded-xl bg-white p-8 text-center shadow-sm ring-1 ring-slate-200">
            <h2 class="text-lg font-semibold text-slate-900">Vous n'avez pas encore publie d'annonce</h2>
            <p class="mt-2 text-sm text-slate-600">
                Cliquez sur "Nouvelle annonce" pour ajouter votre premiere annonce.
            </p>
        </section>
    @else
        <section class="mt-6 grid gap-4 md:grid-cols-2">
            @foreach ($announcements as $announcement)
                <article class="rounded-xl bg-white p-5 shadow-sm ring-1 ring-slate-200">
                    <div class="flex items-start justify-between gap-2">
                        <h2 class="text-lg font-semibold text-slate-900">
                            {{ $announcement->title }}
                        </h2>
                        <span class="rounded-full px-2.5 py-1 text-xs font-semibold uppercase {{ $announcement->status === 'active' ? 'bg-emerald-100 text-emerald-800' : 'bg-slate-100 text-slate-700' }}">
                            {{ $announcement->status === 'active' ? 'Active' : 'Resolue' }}
                        </span>
                    </div>

                    <div class="mt-3 space-y-1 text-sm text-slate-600">
                        <p><span class="font-medium text-slate-700">Type:</span> {{ $announcement->type === 'lost' ? 'Perdu' : 'Trouve' }}</p>
                        <p><span class="font-medium text-slate-700">Categorie:</span> {{ $announcement->category->name }}</p>
                        <p><span class="font-medium text-slate-700">Lieu:</span> {{ $announcement->location }}</p>
                        <p><span class="font-medium text-slate-700">Date:</span> {{ $announcement->event_date?->format('d/m/Y') }}</p>
                    </div>

                    <div class="mt-4 flex flex-wrap items-center gap-2">
                        <a href="{{ route('announcements.show', $announcement) }}" class="inline-flex items-center rounded-md border border-slate-300 px-3 py-1.5 text-sm font-semibold text-slate-700 hover:bg-slate-100">
                            Voir
                        </a>

                        <a href="{{ route('announcements.edit', $announcement) }}" class="inline-flex items-center rounded-md border border-slate-300 px-3 py-1.5 text-sm font-semibold text-slate-700 hover:bg-slate-100">
                            Modifier
                        </a>

                        @if ($announcement->status !== 'resolved')
                            <form method="POST" action="{{ route('announcements.resolve', $announcement) }}">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="inline-flex items-center rounded-md border border-emerald-300 bg-emerald-50 px-3 py-1.5 text-sm font-semibold text-emerald-700 hover:bg-emerald-100">
                                    Marquer resolue
                                </button>
                            </form>
                        @endif

                        <form method="POST" action="{{ route('announcements.destroy', $announcement) }}" onsubmit="return confirm('Confirmer la suppression de cette annonce ?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="inline-flex items-center rounded-md border border-red-300 bg-red-50 px-3 py-1.5 text-sm font-semibold text-red-700 hover:bg-red-100">
                                Supprimer
                            </button>
                        </form>
                    </div>
                </article>
            @endforeach
        </section>

        <div class="mt-6">
            {{ $announcements->links() }}
        </div>
    @endif
@endsection
