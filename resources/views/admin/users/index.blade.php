@extends('layouts.admin-dashboard')

@section('title', 'BusLost&Found - Admin Utilisateurs')

@section('admin-page-title', 'Gestion des utilisateurs')
@section('admin-page-subtitle', 'Consultez et gérez les comptes de la plateforme.')
@section('admin-page-actions')
    <a href="{{ route('admin.dashboard') }}" class="inline-flex h-10 items-center justify-center rounded-2xl border border-slate-300 bg-white px-4 text-sm font-semibold text-slate-700 transition hover:bg-slate-100">
        Retour au tableau de bord
    </a>
@endsection

@section('admin-content')
    @php
        $totalUsers = method_exists($users, 'total') ? $users->total() : $users->count();
    @endphp

    <section class="grid gap-4 sm:grid-cols-2">
        <article class="rounded-3xl border border-slate-200 bg-white p-5 shadow-[0_8px_24px_rgba(15,23,42,0.05)]">
            <p class="text-xs font-semibold uppercase tracking-wide text-slate-500">Total utilisateurs</p>
            <p class="mt-2 text-3xl font-bold tracking-tight text-slate-900">{{ $totalUsers }}</p>
        </article>
        <article class="rounded-3xl border border-slate-200 bg-white p-5 shadow-[0_8px_24px_rgba(15,23,42,0.05)]">
            <p class="text-xs font-semibold uppercase tracking-wide text-slate-500">Utilisateurs affichés</p>
            <p class="mt-2 text-3xl font-bold tracking-tight text-slate-900">{{ $users->count() }}</p>
        </article>
    </section>

    @if ($users->isEmpty())
        <section class="rounded-3xl border border-slate-200 bg-white p-10 text-center shadow-[0_10px_30px_rgba(15,23,42,0.06)]">
            <div class="mx-auto inline-flex h-14 w-14 items-center justify-center rounded-2xl bg-slate-100 text-slate-500">
                <svg class="h-7 w-7" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                    <path d="M16 19v-1a4 4 0 00-4-4H7a4 4 0 00-4 4v1" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" />
                    <circle cx="9.5" cy="7" r="3" stroke="currentColor" stroke-width="1.8" />
                    <path d="M22 19v-1a4 4 0 00-3-3.87" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" />
                    <path d="M16 3.13a3 3 0 010 5.74" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" />
                </svg>
            </div>
            <h2 class="mt-5 text-xl font-semibold text-slate-900">Aucun utilisateur trouvé</h2>
            <p class="mt-2 text-sm text-slate-600">
                Les utilisateurs apparaîtront ici dès qu'ils seront inscrits.
            </p>
        </section>
    @else
        <section class="overflow-hidden rounded-3xl border border-slate-200 bg-white shadow-[0_10px_30px_rgba(15,23,42,0.06)]">
            <div class="border-b border-slate-200 px-5 py-4 sm:px-6">
                <h2 class="text-lg font-semibold text-slate-900">Liste des comptes</h2>
                <p class="mt-1 text-sm text-slate-600">Activez ou désactivez les utilisateurs selon les besoins de modération.</p>
            </div>

            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-slate-200">
                    <thead class="bg-slate-50/80">
                        <tr>
                            <th class="px-5 py-3 text-left text-xs font-semibold uppercase tracking-wide text-slate-500">Nom</th>
                            <th class="px-5 py-3 text-left text-xs font-semibold uppercase tracking-wide text-slate-500">Email</th>
                            <th class="px-5 py-3 text-left text-xs font-semibold uppercase tracking-wide text-slate-500">Telephone</th>
                            <th class="px-5 py-3 text-left text-xs font-semibold uppercase tracking-wide text-slate-500">Role</th>
                            <th class="px-5 py-3 text-left text-xs font-semibold uppercase tracking-wide text-slate-500">Statut</th>
                            <th class="px-5 py-3 text-left text-xs font-semibold uppercase tracking-wide text-slate-500">Annonces</th>
                            <th class="px-5 py-3 text-left text-xs font-semibold uppercase tracking-wide text-slate-500">Action</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 bg-white">
                        @foreach ($users as $user)
                            <tr class="align-middle transition hover:bg-slate-50/60">
                                <td class="px-5 py-4 text-sm font-semibold text-slate-900">{{ $user->name }}</td>
                                <td class="px-5 py-4 text-sm text-slate-700">{{ $user->email }}</td>
                                <td class="px-5 py-4 text-sm text-slate-700">{{ $user->phone ?: '-' }}</td>
                                <td class="px-5 py-4 text-sm text-slate-700">
                                    <span class="inline-flex items-center rounded-full bg-slate-100 px-2.5 py-1 text-xs font-semibold text-slate-700">
                                        {{ $user->role }}
                                    </span>
                                </td>
                                <td class="px-5 py-4 text-sm">
                                    @if ($user->is_active)
                                        <span class="inline-flex items-center rounded-full border border-emerald-200 bg-emerald-100 px-2.5 py-1 text-xs font-semibold text-emerald-700">
                                            Actif
                                        </span>
                                    @else
                                        <span class="inline-flex items-center rounded-full border border-red-200 bg-red-100 px-2.5 py-1 text-xs font-semibold text-red-700">
                                            Inactif
                                        </span>
                                    @endif
                                </td>
                                <td class="px-5 py-4 text-sm text-slate-700">{{ $user->announcements_count }}</td>
                                <td class="px-5 py-4 text-sm">
                                    @if (auth()->id() === $user->id)
                                        <span class="inline-flex items-center rounded-full border border-slate-200 bg-slate-100 px-2.5 py-1 text-xs font-semibold text-slate-600">
                                            Compte actuel
                                        </span>
                                    @else
                                        <form method="POST" action="{{ route('admin.users.toggle-active', $user) }}">
                                            @csrf
                                            @method('PATCH')

                                            @if ($user->is_active)
                                                <button type="submit" class="inline-flex h-9 items-center justify-center rounded-2xl border border-red-300 bg-red-50 px-4 text-xs font-semibold text-red-700 transition hover:bg-red-100">
                                                    Désactiver
                                                </button>
                                            @else
                                                <button type="submit" class="inline-flex h-9 items-center justify-center rounded-2xl border border-emerald-300 bg-emerald-50 px-4 text-xs font-semibold text-emerald-700 transition hover:bg-emerald-100">
                                                    Réactiver
                                                </button>
                                            @endif
                                        </form>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </section>

        <div class="rounded-3xl border border-slate-200 bg-white px-4 py-3 shadow-[0_8px_24px_rgba(15,23,42,0.05)]">
            {{ $users->links() }}
        </div>
    @endif
@endsection
