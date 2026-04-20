@extends('layouts.admin-dashboard')

@section('title', 'BusLost&Found - Admin Annonces')

@section('admin-page-title', 'Moderation des annonces')
@section('admin-page-subtitle', 'Consultez et gérez les publications de la plateforme.')
@section('admin-page-actions')
    <a href="{{ route('admin.dashboard') }}" class="inline-flex h-10 items-center justify-center rounded-2xl border border-slate-300 bg-white px-4 text-sm font-semibold text-slate-700 transition hover:bg-slate-100">
        Retour au tableau de bord
    </a>
@endsection

@section('admin-content')
    @php
        $totalAnnouncements = method_exists($announcements, 'total') ? $announcements->total() : $announcements->count();
        $announcementsCollection = method_exists($announcements, 'getCollection') ? $announcements->getCollection() : collect($announcements);
        $activeAnnouncementsOnPage = $announcementsCollection->where('status', 'active')->count();
        $resolvedAnnouncementsOnPage = $announcementsCollection->where('status', 'resolved')->count();
    @endphp

    <section class="grid gap-4 sm:grid-cols-3">
        <article class="rounded-3xl border border-slate-200 bg-white p-5 shadow-[0_8px_24px_rgba(15,23,42,0.05)]">
            <p class="text-xs font-semibold uppercase tracking-wide text-slate-500">Total annonces</p>
            <p class="mt-2 text-3xl font-bold tracking-tight text-slate-900">{{ $totalAnnouncements }}</p>
        </article>
        <article class="rounded-3xl border border-slate-200 bg-white p-5 shadow-[0_8px_24px_rgba(15,23,42,0.05)]">
            <p class="text-xs font-semibold uppercase tracking-wide text-slate-500">Actives (cette page)</p>
            <p class="mt-2 text-3xl font-bold tracking-tight text-emerald-700">{{ $activeAnnouncementsOnPage }}</p>
        </article>
        <article class="rounded-3xl border border-slate-200 bg-white p-5 shadow-[0_8px_24px_rgba(15,23,42,0.05)]">
            <p class="text-xs font-semibold uppercase tracking-wide text-slate-500">R&eacute;solues (cette page)</p>
            <p class="mt-2 text-3xl font-bold tracking-tight text-slate-700">{{ $resolvedAnnouncementsOnPage }}</p>
        </article>
    </section>

    @if ($announcements->isEmpty())
        <section class="rounded-3xl border border-slate-200 bg-white p-10 text-center shadow-[0_10px_30px_rgba(15,23,42,0.06)]">
            <div class="mx-auto inline-flex h-14 w-14 items-center justify-center rounded-2xl bg-slate-100 text-slate-500">
                <svg class="h-7 w-7" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                    <path d="M8 9h8M8 13h5M6 4h12a2 2 0 012 2v12l-4-2-4 2-4-2-4 2V6a2 2 0 012-2z" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
            </div>
            <h2 class="mt-5 text-xl font-semibold text-slate-900">Aucune annonce disponible</h2>
            <p class="mt-2 text-sm text-slate-600">
                Les annonces appara&icirc;tront ici quand elles seront publi&eacute;es.
            </p>
        </section>
    @else
        <section class="overflow-hidden rounded-3xl border border-slate-200 bg-white shadow-[0_10px_30px_rgba(15,23,42,0.06)]">
            <div class="border-b border-slate-200 px-5 py-4 sm:px-6">
                <h2 class="text-lg font-semibold text-slate-900">Liste des annonces</h2>
                <p class="mt-1 text-sm text-slate-600">
                    Mettez &agrave; jour le statut des annonces et supprimez les contenus non conformes.
                </p>
            </div>

            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-slate-200">
                    <thead class="bg-slate-50/80">
                        <tr>
                            <th class="px-5 py-3 text-left text-xs font-semibold uppercase tracking-wide text-slate-500">Titre</th>
                            <th class="px-5 py-3 text-left text-xs font-semibold uppercase tracking-wide text-slate-500">Type</th>
                            <th class="px-5 py-3 text-left text-xs font-semibold uppercase tracking-wide text-slate-500">Cat&eacute;gorie</th>
                            <th class="px-5 py-3 text-left text-xs font-semibold uppercase tracking-wide text-slate-500">Lieu</th>
                            <th class="px-5 py-3 text-left text-xs font-semibold uppercase tracking-wide text-slate-500">Date</th>
                            <th class="px-5 py-3 text-left text-xs font-semibold uppercase tracking-wide text-slate-500">Statut</th>
                            <th class="px-5 py-3 text-left text-xs font-semibold uppercase tracking-wide text-slate-500">Publi&eacute; par</th>
                            <th class="px-5 py-3 text-left text-xs font-semibold uppercase tracking-wide text-slate-500">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 bg-white">
                        @foreach ($announcements as $announcement)
                            <tr class="align-middle transition hover:bg-slate-50/60">
                                <td class="px-5 py-4 text-sm font-semibold text-slate-900">{{ $announcement->title }}</td>
                                <td class="px-5 py-4 text-sm">
                                    @if ($announcement->type === 'lost')
                                        <span class="inline-flex items-center rounded-full border border-red-200 bg-red-100 px-2.5 py-1 text-xs font-semibold text-red-700">
                                            Perdu
                                        </span>
                                    @else
                                        <span class="inline-flex items-center rounded-full border border-emerald-200 bg-emerald-100 px-2.5 py-1 text-xs font-semibold text-emerald-700">
                                            Trouv&eacute;
                                        </span>
                                    @endif
                                </td>
                                <td class="px-5 py-4 text-sm text-slate-700">{{ $announcement->category->name }}</td>
                                <td class="px-5 py-4 text-sm text-slate-700">{{ $announcement->location }}</td>
                                <td class="px-5 py-4 text-sm text-slate-700">{{ $announcement->event_date?->format('d/m/Y') }}</td>
                                <td class="px-5 py-4 text-sm">
                                    @if ($announcement->status === 'active')
                                        <span class="inline-flex items-center rounded-full border border-emerald-200 bg-emerald-100 px-2.5 py-1 text-xs font-semibold text-emerald-700">
                                            Active
                                        </span>
                                    @else
                                        <span class="inline-flex items-center rounded-full border border-slate-200 bg-slate-100 px-2.5 py-1 text-xs font-semibold text-slate-700">
                                            R&eacute;solue
                                        </span>
                                    @endif
                                </td>
                                <td class="px-5 py-4 text-sm text-slate-700">{{ $announcement->user->name }}</td>
                                <td class="px-5 py-4 text-sm">
                                    <div class="flex flex-wrap gap-2">
                                        <a href="{{ route('announcements.show', $announcement) }}" class="inline-flex h-9 items-center justify-center rounded-2xl border border-slate-300 bg-white px-3.5 text-xs font-semibold text-slate-700 transition hover:bg-slate-100">
                                            Voir
                                        </a>

                                        <form method="POST" action="{{ route('admin.announcements.status', $announcement) }}">
                                            @csrf
                                            @method('PATCH')
                                            <input type="hidden" name="status" value="active">
                                            <button type="submit" class="inline-flex h-9 items-center justify-center rounded-2xl border border-emerald-300 bg-emerald-50 px-3.5 text-xs font-semibold text-emerald-700 transition hover:bg-emerald-100">
                                                Marquer active
                                            </button>
                                        </form>

                                        <form method="POST" action="{{ route('admin.announcements.status', $announcement) }}">
                                            @csrf
                                            @method('PATCH')
                                            <input type="hidden" name="status" value="resolved">
                                            <button type="submit" class="inline-flex h-9 items-center justify-center rounded-2xl border border-slate-300 bg-slate-100 px-3.5 text-xs font-semibold text-slate-700 transition hover:bg-slate-200">
                                                Marquer r&eacute;solue
                                            </button>
                                        </form>

                                        <form method="POST" action="{{ route('admin.announcements.destroy', $announcement) }}" onsubmit="return confirm('Confirmer la suppression de cette annonce ?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="inline-flex h-9 items-center justify-center rounded-2xl border border-red-300 bg-red-50 px-3.5 text-xs font-semibold text-red-700 transition hover:bg-red-100">
                                                Supprimer
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </section>

        <div class="rounded-3xl border border-slate-200 bg-white px-4 py-3 shadow-[0_8px_24px_rgba(15,23,42,0.05)]">
            {{ $announcements->links() }}
        </div>
    @endif
@endsection
