@extends('layouts.admin-dashboard')

@section('title', 'BusLost&Found - Admin Dashboard')

@section('admin-page-title', 'Tableau de bord administrateur')
@section('admin-page-subtitle', 'Vue d\'ensemble des activites, des annonces et de la moderation.')
@section('admin-page-actions')
    <a href="{{ route('admin.announcements.index') }}" class="inline-flex h-10 items-center justify-center rounded-2xl bg-blue-600 px-4 text-sm font-semibold text-white transition hover:bg-blue-700">
        Moderer les annonces
    </a>
    <a href="{{ route('admin.reports.index') }}" class="inline-flex h-10 items-center justify-center rounded-2xl border border-amber-300 bg-amber-50 px-4 text-sm font-semibold text-amber-700 transition hover:bg-amber-100">
        Voir les signalements
    </a>
@endsection

@section('admin-content')
    <section class="rounded-3xl border border-slate-200 bg-white p-6 shadow-[0_10px_30px_rgba(15,23,42,0.06)] sm:p-8">
        <p class="text-sm text-slate-600 sm:text-base">
            Bienvenue <span class="font-semibold text-slate-900">{{ $admin->name }}</span>. Cette page est reservee aux administrateurs.
        </p>

        <div class="mt-5 flex flex-wrap gap-3">
            <a href="{{ route('admin.users.index') }}" class="inline-flex h-11 items-center justify-center rounded-2xl border border-slate-300 bg-white px-5 text-sm font-semibold text-slate-700 transition hover:bg-slate-100">
                Gerer les utilisateurs
            </a>
            <a href="{{ route('home') }}" class="inline-flex h-11 items-center justify-center rounded-2xl border border-slate-300 bg-white px-5 text-sm font-semibold text-slate-700 transition hover:bg-slate-100">
                Retour au site
            </a>
        </div>
    </section>

    <section class="grid gap-5 md:grid-cols-2 xl:grid-cols-4">
        <article class="rounded-3xl border border-slate-200 bg-white p-6 shadow-[0_8px_24px_rgba(15,23,42,0.05)]">
            <div class="inline-flex h-10 w-10 items-center justify-center rounded-2xl bg-blue-100 text-blue-700">
                <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                    <path d="M16 19v-1a4 4 0 00-4-4H7a4 4 0 00-4 4v1" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" />
                    <circle cx="9.5" cy="7" r="3" stroke="currentColor" stroke-width="1.8" />
                    <path d="M22 19v-1a4 4 0 00-3-3.87" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" />
                    <path d="M16 3.13a3 3 0 010 5.74" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" />
                </svg>
            </div>
            <p class="mt-4 text-sm font-medium text-slate-500">Total utilisateurs</p>
            <p class="mt-2 text-3xl font-bold tracking-tight text-slate-900">{{ $totalUsers }}</p>
        </article>

        <article class="rounded-3xl border border-slate-200 bg-white p-6 shadow-[0_8px_24px_rgba(15,23,42,0.05)]">
            <div class="inline-flex h-10 w-10 items-center justify-center rounded-2xl bg-teal-100 text-teal-700">
                <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                    <path d="M8 9h8M8 13h5M6 4h12a2 2 0 012 2v12l-4-2-4 2-4-2-4 2V6a2 2 0 012-2z" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
            </div>
            <p class="mt-4 text-sm font-medium text-slate-500">Total annonces</p>
            <p class="mt-2 text-3xl font-bold tracking-tight text-slate-900">{{ $totalAnnouncements }}</p>
        </article>

        <article class="rounded-3xl border border-slate-200 bg-white p-6 shadow-[0_8px_24px_rgba(15,23,42,0.05)]">
            <div class="inline-flex h-10 w-10 items-center justify-center rounded-2xl bg-emerald-100 text-emerald-700">
                <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                    <path d="M20 7L9 18l-5-5" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
            </div>
            <p class="mt-4 text-sm font-medium text-slate-500">Annonces actives</p>
            <p class="mt-2 text-3xl font-bold tracking-tight text-emerald-700">{{ $totalActiveAnnouncements }}</p>
        </article>

        <article class="rounded-3xl border border-slate-200 bg-white p-6 shadow-[0_8px_24px_rgba(15,23,42,0.05)]">
            <div class="inline-flex h-10 w-10 items-center justify-center rounded-2xl bg-amber-100 text-amber-700">
                <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                    <path d="M12 9v4M12 17h.01M10.29 3.86L1.82 18a2 2 0 001.73 3h16.9A2 2 0 0022.18 18l-8.47-14.14a2 2 0 00-3.42 0z" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
            </div>
            <p class="mt-4 text-sm font-medium text-slate-500">Annonces resolues</p>
            <p class="mt-2 text-3xl font-bold tracking-tight text-slate-700">{{ $totalResolvedAnnouncements }}</p>
        </article>
    </section>

    <section class="grid gap-6 xl:grid-cols-2">
        <article class="rounded-3xl border border-slate-200 bg-white p-6 shadow-[0_10px_30px_rgba(15,23,42,0.06)] sm:p-8">
            <h2 class="text-xl font-bold text-slate-900">Statistiques mensuelles</h2>
            <p class="mt-2 text-sm text-slate-600">
                Resume du mois en cours.
            </p>

            <div class="mt-5 grid gap-4 sm:grid-cols-2">
                <article class="rounded-2xl border border-slate-200 bg-slate-50 p-5">
                    <p class="text-sm font-medium text-slate-500">Total annonces ce mois</p>
                    <p class="mt-2 text-3xl font-bold tracking-tight text-slate-900">{{ $announcementsThisMonth }}</p>
                </article>
                <article class="rounded-2xl border border-slate-200 bg-slate-50 p-5">
                    <p class="text-sm font-medium text-slate-500">Annonces resolues ce mois</p>
                    <p class="mt-2 text-3xl font-bold tracking-tight text-slate-900">{{ $resolvedAnnouncementsThisMonth }}</p>
                </article>
            </div>
        </article>

        <article class="rounded-3xl border border-slate-200 bg-white p-6 shadow-[0_10px_30px_rgba(15,23,42,0.06)] sm:p-8">
            <h2 class="text-xl font-bold text-slate-900">Statistiques annuelles</h2>
            <p class="mt-2 text-sm text-slate-600">
                Resume de l'annee {{ $currentYear }}.
            </p>

            <div class="mt-5 grid gap-4 sm:grid-cols-2">
                <article class="rounded-2xl border border-slate-200 bg-slate-50 p-5">
                    <p class="text-sm font-medium text-slate-500">Total annonces cette annee</p>
                    <p class="mt-2 text-3xl font-bold tracking-tight text-slate-900">{{ $announcementsThisYear }}</p>
                </article>
                <article class="rounded-2xl border border-slate-200 bg-slate-50 p-5">
                    <p class="text-sm font-medium text-slate-500">Annonces resolues cette annee</p>
                    <p class="mt-2 text-3xl font-bold tracking-tight text-slate-900">{{ $resolvedAnnouncementsThisYear }}</p>
                </article>
            </div>
        </article>
    </section>

    <section class="rounded-3xl border border-slate-200 bg-white p-6 shadow-[0_10px_30px_rgba(15,23,42,0.06)] sm:p-8">
        <h2 class="text-xl font-bold text-slate-900">Annonces par mois ({{ $currentYear }})</h2>
        <p class="mt-2 text-sm text-slate-600">
            Tableau simple des annonces publiees et resolues.
        </p>

        <div class="mt-5 overflow-x-auto rounded-2xl border border-slate-200">
            <table class="min-w-full divide-y divide-slate-200 bg-white">
                <thead class="bg-slate-50/80">
                    <tr>
                        <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wide text-slate-600 sm:px-5">Mois</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wide text-slate-600 sm:px-5">Total annonces</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wide text-slate-600 sm:px-5">Annonces resolues</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 bg-white">
                    @foreach ($monthlyBreakdown as $row)
                        <tr>
                            <td class="px-4 py-3 text-sm font-semibold text-slate-900 sm:px-5">{{ $row['month_label'] }}</td>
                            <td class="px-4 py-3 text-sm text-slate-700 sm:px-5">{{ $row['total'] }}</td>
                            <td class="px-4 py-3 text-sm text-slate-700 sm:px-5">{{ $row['resolved'] }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </section>
@endsection
