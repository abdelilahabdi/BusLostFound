@extends('layouts.app')

@section('title', 'BusLost&Found - Mes messages')

@section('content')
    <section class="rounded-xl bg-white p-8 shadow-sm ring-1 ring-slate-200 sm:p-10">
        <div class="flex flex-wrap items-center justify-between gap-3">
            <div>
                <h1 class="text-2xl font-bold text-slate-900 sm:text-3xl">Mes messages</h1>
                <p class="mt-2 text-sm text-slate-600 sm:text-base">
                    Retrouvez ici vos messages envoyes et recus.
                </p>
            </div>

            <a href="{{ route('dashboard') }}" class="inline-flex items-center rounded-md border border-slate-300 px-4 py-2 text-sm font-semibold text-slate-700 hover:bg-slate-100">
                Retour au tableau de bord
            </a>
        </div>
    </section>

    @if ($messages->isEmpty())
        <section class="mt-6 rounded-xl bg-white p-8 text-center shadow-sm ring-1 ring-slate-200">
            <h2 class="text-lg font-semibold text-slate-900">Aucun message pour le moment</h2>
            <p class="mt-2 text-sm text-slate-600">
                Vos messages apparaitront ici apres vos premiers echanges.
            </p>
        </section>
    @else
        <section class="mt-6 overflow-hidden rounded-xl bg-white shadow-sm ring-1 ring-slate-200">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-slate-200">
                    <thead class="bg-slate-50">
                        <tr>
                            <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wide text-slate-600">Annonce</th>
                            <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wide text-slate-600">Expediteur</th>
                            <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wide text-slate-600">Destinataire</th>
                            <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wide text-slate-600">Message</th>
                            <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wide text-slate-600">Date</th>
                            <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wide text-slate-600">Etat</th>
                            <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wide text-slate-600">Action</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 bg-white">
                        @foreach ($messages as $message)
                            <tr>
                                <td class="px-4 py-3 text-sm font-medium text-slate-900">
                                    {{ $message->announcement->title }}
                                </td>
                                <td class="px-4 py-3 text-sm text-slate-700">
                                    {{ $message->sender->name }}
                                </td>
                                <td class="px-4 py-3 text-sm text-slate-700">
                                    {{ $message->receiver->name }}
                                </td>
                                <td class="px-4 py-3 text-sm text-slate-700">
                                    {{ \Illuminate\Support\Str::limit($message->body, 80) }}
                                </td>
                                <td class="px-4 py-3 text-sm text-slate-700">
                                    {{ $message->created_at?->format('d/m/Y H:i') }}
                                </td>
                                <td class="px-4 py-3 text-sm">
                                    @if ($message->is_read)
                                        <span class="rounded-full bg-emerald-100 px-2.5 py-1 text-xs font-semibold text-emerald-800">
                                            Lu
                                        </span>
                                    @else
                                        <span class="rounded-full bg-amber-100 px-2.5 py-1 text-xs font-semibold text-amber-800">
                                            Non lu
                                        </span>
                                    @endif
                                </td>
                                <td class="px-4 py-3 text-sm">
                                    <a href="{{ route('announcements.show', $message->announcement) }}" class="inline-flex items-center rounded-md border border-slate-300 px-3 py-1.5 text-xs font-semibold text-slate-700 hover:bg-slate-100">
                                        Voir annonce
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </section>

        <div class="mt-6">
            {{ $messages->links() }}
        </div>
    @endif
@endsection
