@extends('layouts.admin-dashboard')

@section('title', 'BusLost&Found - Admin Signalements')

@section('admin-page-title', 'Gestion des signalements')
@section('admin-page-subtitle', 'Consultez et traitez les signalements des utilisateurs.')
@section('admin-page-actions')
    <a href="{{ route('admin.dashboard') }}" class="inline-flex h-10 items-center justify-center rounded-2xl border border-slate-300 bg-white px-4 text-sm font-semibold text-slate-700 transition hover:bg-slate-100">
        Retour au tableau de bord
    </a>
@endsection

@section('admin-content')
    @php
        $totalReports = method_exists($reports, 'total') ? $reports->total() : $reports->count();
        $reportsCollection = method_exists($reports, 'getCollection') ? $reports->getCollection() : collect($reports);
        $pendingReportsOnPage = $reportsCollection->where('status', 'pending')->count();
        $reviewedReportsOnPage = $reportsCollection->where('status', '!=', 'pending')->count();
    @endphp

    <section class="grid gap-4 sm:grid-cols-3">
        <article class="rounded-3xl border border-slate-200 bg-white p-5 shadow-[0_8px_24px_rgba(15,23,42,0.05)]">
            <p class="text-xs font-semibold uppercase tracking-wide text-slate-500">Total signalements</p>
            <p class="mt-2 text-3xl font-bold tracking-tight text-slate-900">{{ $totalReports }}</p>
        </article>
        <article class="rounded-3xl border border-slate-200 bg-white p-5 shadow-[0_8px_24px_rgba(15,23,42,0.05)]">
            <p class="text-xs font-semibold uppercase tracking-wide text-slate-500">En attente (cette page)</p>
            <p class="mt-2 text-3xl font-bold tracking-tight text-amber-700">{{ $pendingReportsOnPage }}</p>
        </article>
        <article class="rounded-3xl border border-slate-200 bg-white p-5 shadow-[0_8px_24px_rgba(15,23,42,0.05)]">
            <p class="text-xs font-semibold uppercase tracking-wide text-slate-500">Traités (cette page)</p>
            <p class="mt-2 text-3xl font-bold tracking-tight text-emerald-700">{{ $reviewedReportsOnPage }}</p>
        </article>
    </section>

    @if ($reports->isEmpty())
        <section class="rounded-3xl border border-slate-200 bg-white p-10 text-center shadow-[0_10px_30px_rgba(15,23,42,0.06)]">
            <div class="mx-auto inline-flex h-14 w-14 items-center justify-center rounded-2xl bg-slate-100 text-slate-500">
                <svg class="h-7 w-7" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                    <path d="M10.3 3.88l-8.2 14.2A2 2 0 003.82 21h16.36a2 2 0 001.72-2.92l-8.2-14.2a2 2 0 00-3.4 0z" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" />
                    <path d="M12 9v4M12 17h.01" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" />
                </svg>
            </div>
            <h2 class="mt-5 text-xl font-semibold text-slate-900">Aucun signalement trouvé</h2>
            <p class="mt-2 text-sm text-slate-600">
                Les signalements apparaîtront ici quand des utilisateurs en enverront.
            </p>
        </section>
    @else
        <section class="overflow-hidden rounded-3xl border border-slate-200 bg-white shadow-[0_10px_30px_rgba(15,23,42,0.06)]">
            <div class="border-b border-slate-200 px-5 py-4 sm:px-6">
                <h2 class="text-lg font-semibold text-slate-900">Liste des signalements</h2>
                <p class="mt-1 text-sm text-slate-600">
                    Analysez les signalements et marquez-les comme traités après vérification.
                </p>
            </div>

            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-slate-200">
                    <thead class="bg-slate-50/80">
                        <tr>
                            <th class="px-5 py-3 text-left text-xs font-semibold uppercase tracking-wide text-slate-500">ID</th>
                            <th class="px-5 py-3 text-left text-xs font-semibold uppercase tracking-wide text-slate-500">Annonce</th>
                            <th class="px-5 py-3 text-left text-xs font-semibold uppercase tracking-wide text-slate-500">Signalé par</th>
                            <th class="px-5 py-3 text-left text-xs font-semibold uppercase tracking-wide text-slate-500">Raison</th>
                            <th class="px-5 py-3 text-left text-xs font-semibold uppercase tracking-wide text-slate-500">Statut</th>
                            <th class="px-5 py-3 text-left text-xs font-semibold uppercase tracking-wide text-slate-500">Date</th>
                            <th class="px-5 py-3 text-left text-xs font-semibold uppercase tracking-wide text-slate-500">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 bg-white">
                        @foreach ($reports as $report)
                            <tr class="align-middle transition hover:bg-slate-50/60">
                                <td class="px-5 py-4 text-sm text-slate-700">
                                    <span class="inline-flex items-center rounded-full border border-slate-200 bg-slate-100 px-2.5 py-1 text-xs font-semibold text-slate-700">
                                        #{{ $report->id }}
                                    </span>
                                </td>
                                <td class="px-5 py-4 text-sm font-semibold text-slate-900">
                                    {{ $report->announcement->title }}
                                </td>
                                <td class="px-5 py-4 text-sm text-slate-700">
                                    {{ $report->user->name }}
                                </td>
                                <td class="px-5 py-4 text-sm text-slate-700">
                                    <p class="max-w-xl whitespace-pre-line break-words leading-6 text-slate-600">{{ $report->reason }}</p>
                                </td>
                                <td class="px-5 py-4 text-sm">
                                    @if ($report->status === 'pending')
                                        <span class="inline-flex items-center rounded-full border border-amber-200 bg-amber-100 px-2.5 py-1 text-xs font-semibold text-amber-800">
                                            Non traité
                                        </span>
                                    @else
                                        <span class="inline-flex items-center rounded-full border border-emerald-200 bg-emerald-100 px-2.5 py-1 text-xs font-semibold text-emerald-700">
                                            Traité
                                        </span>
                                    @endif
                                </td>
                                <td class="whitespace-nowrap px-5 py-4 text-sm text-slate-700">
                                    {{ $report->created_at?->format('d/m/Y H:i') }}
                                </td>
                                <td class="px-5 py-4 text-sm">
                                    <div class="flex flex-wrap gap-2">
                                        <a href="{{ route('announcements.show', $report->announcement) }}" class="inline-flex h-9 items-center justify-center rounded-2xl border border-slate-300 bg-slate-50 px-3.5 text-xs font-semibold text-slate-700 transition hover:bg-slate-100">
                                            Voir annonce
                                        </a>

                                        @if ($report->status === 'pending')
                                            <form method="POST" action="{{ route('admin.reports.review', $report) }}">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit" class="inline-flex h-9 items-center justify-center rounded-2xl border border-emerald-600 bg-emerald-600 px-3.5 text-xs font-semibold text-white transition hover:bg-emerald-700">
                                                    Marquer comme traité
                                                </button>
                                            </form>
                                        @else
                                            <span class="inline-flex h-9 items-center justify-center rounded-2xl border border-slate-200 bg-slate-100 px-3.5 text-xs font-semibold text-slate-500">
                                                Déjà traité
                                            </span>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </section>

        <div class="rounded-3xl border border-slate-200 bg-white px-4 py-3 shadow-[0_8px_24px_rgba(15,23,42,0.05)]">
            {{ $reports->links() }}
        </div>
    @endif
@endsection
