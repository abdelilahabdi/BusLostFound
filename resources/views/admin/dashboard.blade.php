@extends('layouts.app')

@section('title', 'BusLost&Found - Admin Dashboard')

@section('content')
    <section class="rounded-xl bg-white p-8 shadow-sm ring-1 ring-slate-200 sm:p-10">
        <h1 class="text-2xl font-bold text-slate-900 sm:text-3xl">
            Tableau de bord administrateur
        </h1>

        <p class="mt-3 text-sm text-slate-600 sm:text-base">
            Bienvenue {{ $admin->name }}. Cette page est reservee aux administrateurs.
        </p>

        <div class="mt-6 flex flex-wrap gap-3">
            <a href="{{ route('admin.announcements.index') }}" class="inline-flex items-center rounded-md bg-slate-900 px-4 py-2 text-sm font-semibold text-white hover:bg-slate-700">
                Moderer les annonces
            </a>

            <a href="{{ route('admin.reports.index') }}" class="inline-flex items-center rounded-md bg-slate-900 px-4 py-2 text-sm font-semibold text-white hover:bg-slate-700">
                Voir les signalements
            </a>

            <a href="{{ route('admin.users.index') }}" class="inline-flex items-center rounded-md bg-slate-900 px-4 py-2 text-sm font-semibold text-white hover:bg-slate-700">
                Gerer les utilisateurs
            </a>
        </div>
    </section>

    <section class="mt-6 grid gap-4 md:grid-cols-2 lg:grid-cols-4">
        <article class="rounded-xl bg-white p-6 shadow-sm ring-1 ring-slate-200">
            <p class="text-sm font-medium text-slate-500">Total utilisateurs</p>
            <p class="mt-2 text-3xl font-bold text-slate-900">{{ $totalUsers }}</p>
        </article>

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

    <section class="mt-6">
        <h2 class="text-xl font-bold text-slate-900">Statistiques mensuelles</h2>
        <p class="mt-2 text-sm text-slate-600">
            Resume du mois en cours.
        </p>

        <div class="mt-4 grid gap-4 md:grid-cols-2">
            <article class="rounded-xl bg-white p-6 shadow-sm ring-1 ring-slate-200">
                <p class="text-sm font-medium text-slate-500">Total annonces ce mois</p>
                <p class="mt-2 text-3xl font-bold text-slate-900">{{ $announcementsThisMonth }}</p>
            </article>

            <article class="rounded-xl bg-white p-6 shadow-sm ring-1 ring-slate-200">
                <p class="text-sm font-medium text-slate-500">Annonces resolues ce mois</p>
                <p class="mt-2 text-3xl font-bold text-slate-900">{{ $resolvedAnnouncementsThisMonth }}</p>
            </article>
        </div>
    </section>

    <section class="mt-6">
        <h2 class="text-xl font-bold text-slate-900">Statistiques annuelles</h2>
        <p class="mt-2 text-sm text-slate-600">
            Resume de l'annee {{ $currentYear }}.
        </p>

        <div class="mt-4 grid gap-4 md:grid-cols-2">
            <article class="rounded-xl bg-white p-6 shadow-sm ring-1 ring-slate-200">
                <p class="text-sm font-medium text-slate-500">Total annonces cette annee</p>
                <p class="mt-2 text-3xl font-bold text-slate-900">{{ $announcementsThisYear }}</p>
            </article>

            <article class="rounded-xl bg-white p-6 shadow-sm ring-1 ring-slate-200">
                <p class="text-sm font-medium text-slate-500">Annonces resolues cette annee</p>
                <p class="mt-2 text-3xl font-bold text-slate-900">{{ $resolvedAnnouncementsThisYear }}</p>
            </article>
        </div>
    </section>

    <section class="mt-6 rounded-xl bg-white p-6 shadow-sm ring-1 ring-slate-200">
        <h2 class="text-xl font-bold text-slate-900">Annonces par mois ({{ $currentYear }})</h2>
        <p class="mt-2 text-sm text-slate-600">
            Tableau simple des annonces publiees et resolues.
        </p>

        <div class="mt-4 overflow-x-auto">
            <table class="min-w-full divide-y divide-slate-200">
                <thead class="bg-slate-50">
                    <tr>
                        <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wide text-slate-600">Mois</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wide text-slate-600">Total annonces</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wide text-slate-600">Annonces resolues</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 bg-white">
                    @foreach ($monthlyBreakdown as $row)
                        <tr>
                            <td class="px-4 py-3 text-sm font-medium text-slate-900">{{ $row['month_label'] }}</td>
                            <td class="px-4 py-3 text-sm text-slate-700">{{ $row['total'] }}</td>
                            <td class="px-4 py-3 text-sm text-slate-700">{{ $row['resolved'] }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </section>
@endsection
