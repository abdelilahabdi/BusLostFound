@extends('layouts.app')

@section('title', 'BusLost&Found - Admin Utilisateurs')

@section('content')
    <section class="rounded-xl bg-white p-8 shadow-sm ring-1 ring-slate-200 sm:p-10">
        <div class="flex flex-wrap items-center justify-between gap-3">
            <div>
                <h1 class="text-2xl font-bold text-slate-900 sm:text-3xl">Gestion des utilisateurs</h1>
                <p class="mt-2 text-sm text-slate-600 sm:text-base">
                    Consultez les comptes et activez/desactivez les utilisateurs.
                </p>
            </div>

            <a href="{{ route('admin.dashboard') }}" class="inline-flex items-center rounded-md border border-slate-300 px-4 py-2 text-sm font-semibold text-slate-700 hover:bg-slate-100">
                Retour au tableau de bord admin
            </a>
        </div>
    </section>

    @if ($users->isEmpty())
        <section class="mt-6 rounded-xl bg-white p-8 text-center shadow-sm ring-1 ring-slate-200">
            <h2 class="text-lg font-semibold text-slate-900">Aucun utilisateur trouve</h2>
            <p class="mt-2 text-sm text-slate-600">Les utilisateurs apparaitront ici des qu'ils seront inscrits.</p>
        </section>
    @else
        <section class="mt-6 overflow-hidden rounded-xl bg-white shadow-sm ring-1 ring-slate-200">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-slate-200">
                    <thead class="bg-slate-50">
                        <tr>
                            <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wide text-slate-600">Nom</th>
                            <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wide text-slate-600">Email</th>
                            <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wide text-slate-600">Telephone</th>
                            <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wide text-slate-600">Role</th>
                            <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wide text-slate-600">Statut</th>
                            <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wide text-slate-600">Annonces</th>
                            <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wide text-slate-600">Action</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 bg-white">
                        @foreach ($users as $user)
                            <tr>
                                <td class="px-4 py-3 text-sm font-medium text-slate-900">{{ $user->name }}</td>
                                <td class="px-4 py-3 text-sm text-slate-700">{{ $user->email }}</td>
                                <td class="px-4 py-3 text-sm text-slate-700">{{ $user->phone ?: '-' }}</td>
                                <td class="px-4 py-3 text-sm text-slate-700">{{ $user->role }}</td>
                                <td class="px-4 py-3 text-sm">
                                    @if ($user->is_active)
                                        <span class="rounded-full bg-emerald-100 px-2.5 py-1 text-xs font-semibold text-emerald-800">
                                            Actif
                                        </span>
                                    @else
                                        <span class="rounded-full bg-red-100 px-2.5 py-1 text-xs font-semibold text-red-800">
                                            Inactif
                                        </span>
                                    @endif
                                </td>
                                <td class="px-4 py-3 text-sm text-slate-700">{{ $user->announcements_count }}</td>
                                <td class="px-4 py-3 text-sm">
                                    @if (auth()->id() === $user->id)
                                        <span class="text-slate-400">Compte actuel</span>
                                    @else
                                        <form method="POST" action="{{ route('admin.users.toggle-active', $user) }}">
                                            @csrf
                                            @method('PATCH')

                                            @if ($user->is_active)
                                                <button type="submit" class="inline-flex items-center rounded-md border border-red-300 bg-red-50 px-3 py-1.5 text-xs font-semibold text-red-700 hover:bg-red-100">
                                                    Desactiver
                                                </button>
                                            @else
                                                <button type="submit" class="inline-flex items-center rounded-md border border-emerald-300 bg-emerald-50 px-3 py-1.5 text-xs font-semibold text-emerald-700 hover:bg-emerald-100">
                                                    Activer
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

        <div class="mt-6">
            {{ $users->links() }}
        </div>
    @endif
@endsection
