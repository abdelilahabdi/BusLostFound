@extends('layouts.app')

@section('title', 'BusLost&Found - Admin Annonces')

@section('content')
    <section class="rounded-xl bg-white p-8 shadow-sm ring-1 ring-slate-200 sm:p-10">
        <div class="flex flex-wrap items-center justify-between gap-3">
            <div>
                <h1 class="text-2xl font-bold text-slate-900 sm:text-3xl">Moderation des annonces</h1>
                <p class="mt-2 text-sm text-slate-600 sm:text-base">
                    Consultez, mettez a jour le statut, ou supprimez les annonces.
                </p>
            </div>

            <a href="{{ route('admin.dashboard') }}" class="inline-flex items-center rounded-md border border-slate-300 px-4 py-2 text-sm font-semibold text-slate-700 hover:bg-slate-100">
                Retour au tableau de bord admin
            </a>
        </div>
    </section>

    @if ($announcements->isEmpty())
        <section class="mt-6 rounded-xl bg-white p-8 text-center shadow-sm ring-1 ring-slate-200">
            <h2 class="text-lg font-semibold text-slate-900">Aucune annonce disponible</h2>
            <p class="mt-2 text-sm text-slate-600">Les annonces apparaitront ici quand elles seront publiees.</p>
        </section>
    @else
        <section class="mt-6 overflow-hidden rounded-xl bg-white shadow-sm ring-1 ring-slate-200">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-slate-200">
                    <thead class="bg-slate-50">
                        <tr>
                            <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wide text-slate-600">Titre</th>
                            <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wide text-slate-600">Type</th>
                            <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wide text-slate-600">Categorie</th>
                            <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wide text-slate-600">Lieu</th>
                            <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wide text-slate-600">Date</th>
                            <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wide text-slate-600">Statut</th>
                            <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wide text-slate-600">Publie par</th>
                            <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wide text-slate-600">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 bg-white">
                        @foreach ($announcements as $announcement)
                            <tr>
                                <td class="px-4 py-3 text-sm font-medium text-slate-900">{{ $announcement->title }}</td>
                                <td class="px-4 py-3 text-sm text-slate-700">{{ $announcement->type === 'lost' ? 'Perdu' : 'Trouve' }}</td>
                                <td class="px-4 py-3 text-sm text-slate-700">{{ $announcement->category->name }}</td>
                                <td class="px-4 py-3 text-sm text-slate-700">{{ $announcement->location }}</td>
                                <td class="px-4 py-3 text-sm text-slate-700">{{ $announcement->event_date?->format('d/m/Y') }}</td>
                                <td class="px-4 py-3 text-sm">
                                    @if ($announcement->status === 'active')
                                        <span class="rounded-full bg-emerald-100 px-2.5 py-1 text-xs font-semibold text-emerald-800">Active</span>
                                    @else
                                        <span class="rounded-full bg-slate-100 px-2.5 py-1 text-xs font-semibold text-slate-700">Resolue</span>
                                    @endif
                                </td>
                                <td class="px-4 py-3 text-sm text-slate-700">{{ $announcement->user->name }}</td>
                                <td class="px-4 py-3 text-sm">
                                    <div class="flex flex-wrap gap-2">
                                        <a href="{{ route('announcements.show', $announcement) }}" class="inline-flex items-center rounded-md border border-slate-300 px-3 py-1.5 text-xs font-semibold text-slate-700 hover:bg-slate-100">
                                            Voir
                                        </a>

                                        <form method="POST" action="{{ route('admin.announcements.status', $announcement) }}">
                                            @csrf
                                            @method('PATCH')
                                            <input type="hidden" name="status" value="active">
                                            <button type="submit" class="inline-flex items-center rounded-md border border-emerald-300 bg-emerald-50 px-3 py-1.5 text-xs font-semibold text-emerald-700 hover:bg-emerald-100">
                                                Marquer active
                                            </button>
                                        </form>

                                        <form method="POST" action="{{ route('admin.announcements.status', $announcement) }}">
                                            @csrf
                                            @method('PATCH')
                                            <input type="hidden" name="status" value="resolved">
                                            <button type="submit" class="inline-flex items-center rounded-md border border-slate-300 bg-slate-100 px-3 py-1.5 text-xs font-semibold text-slate-700 hover:bg-slate-200">
                                                Marquer resolue
                                            </button>
                                        </form>

                                        <form method="POST" action="{{ route('admin.announcements.destroy', $announcement) }}" onsubmit="return confirm('Confirmer la suppression de cette annonce ?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="inline-flex items-center rounded-md border border-red-300 bg-red-50 px-3 py-1.5 text-xs font-semibold text-red-700 hover:bg-red-100">
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

        <div class="mt-6">
            {{ $announcements->links() }}
        </div>
    @endif
@endsection
