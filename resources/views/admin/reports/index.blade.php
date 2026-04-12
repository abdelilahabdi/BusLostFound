@extends('layouts.app')

@section('title', 'BusLost&Found - Admin Signalements')

@section('content')
    <section class="rounded-xl bg-white p-8 shadow-sm ring-1 ring-slate-200 sm:p-10">
        <div class="flex flex-wrap items-center justify-between gap-3">
            <div>
                <h1 class="text-2xl font-bold text-slate-900 sm:text-3xl">Gestion des signalements</h1>
                <p class="mt-2 text-sm text-slate-600 sm:text-base">
                    Consultez les signalements des utilisateurs et marquez-les comme examines.
                </p>
            </div>

            <a href="{{ route('admin.dashboard') }}" class="inline-flex items-center rounded-md border border-slate-300 px-4 py-2 text-sm font-semibold text-slate-700 hover:bg-slate-100">
                Retour au tableau de bord admin
            </a>
        </div>
    </section>

    @if ($reports->isEmpty())
        <section class="mt-6 rounded-xl bg-white p-8 text-center shadow-sm ring-1 ring-slate-200">
            <h2 class="text-lg font-semibold text-slate-900">Aucun signalement trouve</h2>
            <p class="mt-2 text-sm text-slate-600">Les signalements apparaitront ici quand des utilisateurs en enverront.</p>
        </section>
    @else
        <section class="mt-6 overflow-hidden rounded-xl bg-white shadow-sm ring-1 ring-slate-200">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-slate-200">
                    <thead class="bg-slate-50">
                        <tr>
                            <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wide text-slate-600">ID</th>
                            <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wide text-slate-600">Annonce</th>
                            <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wide text-slate-600">Signale par</th>
                            <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wide text-slate-600">Raison</th>
                            <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wide text-slate-600">Statut</th>
                            <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wide text-slate-600">Date</th>
                            <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wide text-slate-600">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 bg-white">
                        @foreach ($reports as $report)
                            <tr>
                                <td class="px-4 py-3 text-sm text-slate-700">#{{ $report->id }}</td>
                                <td class="px-4 py-3 text-sm font-medium text-slate-900">
                                    {{ $report->announcement->title }}
                                </td>
                                <td class="px-4 py-3 text-sm text-slate-700">
                                    {{ $report->user->name }}
                                </td>
                                <td class="px-4 py-3 text-sm text-slate-700">
                                    <p class="max-w-lg whitespace-pre-line break-words">{{ $report->reason }}</p>
                                </td>
                                <td class="px-4 py-3 text-sm">
                                    @if ($report->status === 'pending')
                                        <span class="rounded-full bg-amber-100 px-2.5 py-1 text-xs font-semibold text-amber-800">
                                            En attente
                                        </span>
                                    @else
                                        <span class="rounded-full bg-emerald-100 px-2.5 py-1 text-xs font-semibold text-emerald-800">
                                            Examine
                                        </span>
                                    @endif
                                </td>
                                <td class="px-4 py-3 text-sm text-slate-700">
                                    {{ $report->created_at?->format('d/m/Y H:i') }}
                                </td>
                                <td class="px-4 py-3 text-sm">
                                    <div class="flex flex-wrap gap-2">
                                        <a href="{{ route('announcements.show', $report->announcement) }}" class="inline-flex items-center rounded-md border border-slate-300 px-3 py-1.5 text-xs font-semibold text-slate-700 hover:bg-slate-100">
                                            Voir annonce
                                        </a>

                                        @if ($report->status === 'pending')
                                            <form method="POST" action="{{ route('admin.reports.review', $report) }}">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit" class="inline-flex items-center rounded-md border border-emerald-300 bg-emerald-50 px-3 py-1.5 text-xs font-semibold text-emerald-700 hover:bg-emerald-100">
                                                    Marquer comme examine
                                                </button>
                                            </form>
                                        @else
                                            <span class="inline-flex items-center rounded-md border border-slate-200 bg-slate-100 px-3 py-1.5 text-xs font-semibold text-slate-500">
                                                Deja examine
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

        <div class="mt-6">
            {{ $reports->links() }}
        </div>
    @endif
@endsection
