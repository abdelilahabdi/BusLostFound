@extends('layouts.app')

@section('title', 'BusLost&Found - Mes annonces')

@section('content')
    <section class="rounded-3xl bg-slate-50/70 p-6 ring-1 ring-slate-200 sm:p-10">
        <div class="mx-auto max-w-5xl">
            <div class="flex flex-wrap items-start justify-between gap-4">
                <div class="max-w-3xl">
                    <h1 class="text-3xl font-bold tracking-tight text-slate-900 sm:text-5xl">Mes annonces</h1>
                    <p class="mt-3 text-base text-slate-600 sm:text-lg">
                        Gerez vos publications en un seul endroit.
                    </p>
                </div>

                <a href="{{ route('announcements.create') }}"
                    class="inline-flex items-center rounded-2xl bg-blue-600 px-5 py-3 text-sm font-semibold text-white shadow-sm hover:bg-blue-700">
                    + Nouvelle annonce
                </a>
            </div>
        </div>
    </section>

    <section class="mt-8 rounded-3xl border border-slate-200 bg-white p-6 shadow-[0_10px_30px_rgba(15,23,42,0.06)] sm:p-8">
        <div class="flex flex-wrap items-center justify-between gap-3">
            <h2 class="text-xl font-semibold text-slate-900">Vos publications</h2>
            <p class="inline-flex items-center rounded-full bg-slate-100 px-3 py-1 text-sm font-semibold text-slate-700">
                {{ $announcements->count() }} annonce{{ $announcements->count() > 1 ? 's' : '' }}
            </p>
        </div>

        @if ($announcements->isEmpty())
            <section class="mt-6 rounded-3xl border border-slate-200 bg-white p-10 text-center shadow-[0_8px_24px_rgba(15,23,42,0.05)]">
                <div class="mx-auto inline-flex h-14 w-14 items-center justify-center rounded-2xl bg-slate-100 text-slate-500">
                    <svg class="h-7 w-7" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                        <path d="M4 7.5A2.5 2.5 0 016.5 5h11A2.5 2.5 0 0120 7.5v9a2.5 2.5 0 01-2.5 2.5h-11A2.5 2.5 0 014 16.5v-9z"
                            stroke="currentColor" stroke-width="1.8" />
                        <path d="M8 9.5h8M8 13h5" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" />
                    </svg>
                </div>
                <h2 class="mt-5 text-xl font-semibold text-slate-900">Vous n'avez pas encore publié d'annonce</h2>
                <p class="mt-2 text-sm text-slate-600 sm:text-base">
                    Cliquez sur « Nouvelle annonce » pour ajouter votre première annonce.
                </p>
            </section>
        @else
            <section class="mt-6 grid gap-5 md:grid-cols-2">
                @foreach ($announcements as $announcement)
                    <article class="flex h-full flex-col rounded-3xl border border-slate-200 bg-white p-6 shadow-[0_8px_24px_rgba(15,23,42,0.05)]">
                        <div class="flex items-start justify-between gap-3">
                            <h2 class="text-lg font-bold leading-6 text-slate-900">
                                {{ $announcement->title }}
                            </h2>
                            <div class="flex flex-col items-end gap-1.5">
                                <span class="rounded-full px-2.5 py-1 text-xs font-semibold uppercase {{ $announcement->type === 'lost' ? 'bg-red-100 text-red-600' : 'bg-emerald-100 text-emerald-600' }}">
                                    {{ $announcement->type === 'lost' ? 'Perdu' : 'Trouvé' }}
                                </span>
                                <span class="rounded-full px-2.5 py-1 text-xs font-semibold uppercase {{ $announcement->status === 'active' ? 'bg-teal-100 text-teal-700' : 'bg-slate-100 text-slate-700' }}">
                                    {{ $announcement->status === 'active' ? 'Active' : 'Résolue' }}
                                </span>
                            </div>
                        </div>

                        <div class="mt-4 space-y-2 text-sm text-slate-600">
                            <p><span class="font-medium text-slate-700">Catégorie:</span> {{ $announcement->category->name }}</p>
                            <p><span class="font-medium text-slate-700">Lieu:</span> {{ $announcement->location }}</p>
                            <p><span class="font-medium text-slate-700">Date:</span> {{ $announcement->event_date?->format('d/m/Y') }}</p>
                        </div>

                        <div class="mt-5 flex flex-wrap items-center gap-2 border-t border-slate-100 pt-4">
                            <a href="{{ route('announcements.show', $announcement) }}" class="inline-flex h-10 items-center justify-center rounded-2xl bg-blue-600 px-4 text-sm font-semibold text-white hover:bg-blue-700">
                                Voir les détails
                            </a>

                            <a href="{{ route('announcements.edit', $announcement) }}" class="inline-flex h-10 items-center justify-center rounded-2xl border border-slate-300 px-4 text-sm font-semibold text-slate-700 hover:bg-slate-100">
                                Modifier
                            </a>

                            @if ($announcement->status !== 'resolved')
                                <form method="POST" action="{{ route('announcements.resolve', $announcement) }}" class="inline-flex">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="inline-flex h-10 items-center justify-center rounded-2xl border border-teal-300 bg-teal-50 px-4 text-sm font-semibold text-teal-700 hover:bg-teal-100">
                                        Marquer comme résolue
                                    </button>
                                </form>
                            @endif

                            <form method="POST" action="{{ route('announcements.destroy', $announcement) }}" onsubmit="return confirm('Confirmer la suppression de cette annonce ?');" class="inline-flex">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="inline-flex h-10 items-center justify-center rounded-2xl border border-red-200 bg-red-50 px-4 text-sm font-semibold text-red-700 hover:bg-red-100">
                                    Supprimer
                                </button>
                            </form>
                        </div>
                    </article>
                @endforeach
            </section>

            <div class="mt-8 rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3">
                {{ $announcements->links() }}
            </div>
        @endif
    </section>
@endsection
