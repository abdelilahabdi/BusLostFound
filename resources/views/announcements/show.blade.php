@extends('layouts.app')

@section('title', 'BusLost&Found - Détail annonce')

@section('content')
    <section class="rounded-3xl bg-slate-50/70 p-6 ring-1 ring-slate-200 sm:p-10">
        <div class="grid gap-6 lg:grid-cols-3">
            <div class="space-y-6 lg:col-span-2">
                <article class="rounded-3xl border border-slate-200 bg-white p-6 shadow-[0_10px_30px_rgba(15,23,42,0.06)] sm:p-8">
                    <div class="flex flex-wrap items-start justify-between gap-3">
                        <h1 class="text-3xl font-bold tracking-tight text-slate-900 sm:text-4xl">
                            {{ $announcement->title }}
                        </h1>

                        <div class="flex flex-wrap items-center gap-2">
                            <span class="rounded-full px-3 py-1 text-xs font-semibold uppercase {{ $announcement->type === 'lost' ? 'bg-red-100 text-red-600' : 'bg-emerald-100 text-emerald-600' }}">
                                {{ $announcement->type === 'lost' ? 'Perdu' : 'Trouvé' }}
                            </span>
                            <span class="rounded-full px-3 py-1 text-xs font-semibold uppercase {{ $announcement->status === 'active' ? 'bg-teal-100 text-teal-700' : 'bg-slate-100 text-slate-700' }}">
                                {{ $announcement->status === 'active' ? 'Active' : 'Résolue' }}
                            </span>
                        </div>
                    </div>

                    <p class="mt-4 text-sm text-slate-600 sm:text-base">
                        Consultez les détails de cette annonce et contactez le propriétaire si besoin.
                    </p>
                    <p class="mt-1 text-sm text-slate-500">
                        Publiée par {{ $announcement->user->name }} le {{ $announcement->event_date?->format('d/m/Y') }}.
                    </p>
                </article>

                <article class="rounded-3xl border border-slate-200 bg-white p-6 shadow-[0_10px_30px_rgba(15,23,42,0.06)] sm:p-8">
                    <h2 class="text-xl font-semibold text-slate-900">Description complète</h2>
                    <p class="mt-4 whitespace-pre-line text-sm leading-7 text-slate-700 sm:text-base">
                        {{ $announcement->description }}
                    </p>
                </article>

                @auth
                    @if (auth()->id() !== $announcement->user_id)
                        <article class="rounded-3xl border border-slate-200 bg-white p-6 shadow-[0_10px_30px_rgba(15,23,42,0.06)]">
                            <h2 class="text-lg font-semibold text-slate-900">Contacter le propriétaire</h2>
                            <p class="mt-2 text-sm text-slate-600">
                                Envoyez un message simple au propriétaire de cette annonce.
                            </p>

                            <form method="POST" action="{{ route('announcements.messages.store', $announcement) }}" class="mt-5 space-y-5">
                                @csrf

                                <div>
                                    <label for="body" class="mb-1 block text-sm font-semibold text-slate-700">
                                        Votre message
                                    </label>
                                    <textarea
                                        id="body"
                                        name="body"
                                        rows="4"
                                        maxlength="2000"
                                        required
                                        class="w-full rounded-2xl border border-slate-300 bg-white px-4 py-3 text-sm leading-6 text-slate-800 shadow-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-100"
                                    >{{ old('body') }}</textarea>
                                    @error('body')
                                        <p class="mt-2 inline-flex items-center rounded-xl bg-red-50 px-3 py-1.5 text-xs font-semibold text-red-700">{{ $message }}</p>
                                    @enderror
                                </div>

                                <button type="submit" class="inline-flex h-11 items-center justify-center rounded-2xl bg-blue-600 px-5 text-sm font-semibold text-white transition hover:bg-blue-700 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-blue-300">
                                    Envoyer le message
                                </button>
                            </form>
                        </article>

                        <article class="rounded-3xl border border-red-100 bg-red-50/40 p-6 shadow-[0_10px_30px_rgba(15,23,42,0.06)]">
                            <h2 class="text-lg font-semibold text-slate-900">Signaler cette annonce</h2>
                            <p class="mt-2 text-sm text-slate-600">
                                Si cette annonce vous semble inappropriée, expliquez la raison ci-dessous.
                            </p>

                            <form method="POST" action="{{ route('announcements.reports.store', $announcement) }}" class="mt-5 space-y-5">
                                @csrf

                                <div>
                                    <label for="reason" class="mb-1 block text-sm font-semibold text-slate-700">
                                        Raison du signalement
                                    </label>
                                    <textarea
                                        id="reason"
                                        name="reason"
                                        rows="4"
                                        maxlength="1000"
                                        required
                                        class="w-full rounded-2xl border border-slate-300 bg-white px-4 py-3 text-sm leading-6 text-slate-800 shadow-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-100"
                                    >{{ old('reason') }}</textarea>
                                    @error('reason')
                                        <p class="mt-2 inline-flex items-center rounded-xl bg-red-50 px-3 py-1.5 text-xs font-semibold text-red-700">{{ $message }}</p>
                                    @enderror
                                </div>

                                <button type="submit" class="inline-flex h-11 items-center justify-center rounded-2xl bg-red-600 px-5 text-sm font-semibold text-white transition hover:bg-red-700 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-red-300">
                                    Envoyer le signalement
                                </button>
                            </form>
                        </article>
                    @endif
                @endauth
            </div>

            <aside class="space-y-6">
                <article class="rounded-3xl border border-slate-200 bg-white p-6 shadow-[0_10px_30px_rgba(15,23,42,0.06)]">
                    <h2 class="text-lg font-semibold text-slate-900">Informations de l'annonce</h2>

                    <ul class="mt-4 space-y-2.5 text-sm text-slate-700">
                        <li class="flex items-start gap-2.5 rounded-2xl bg-slate-50 px-3 py-2.5">
                            <svg class="mt-0.5 h-4 w-4 text-slate-500" viewBox="0 0 20 20" fill="none" aria-hidden="true">
                                <path d="M3.5 5.5h13m-11.5 3h10m-8.5 3h7" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" />
                            </svg>
                            <div>
                                <p class="text-xs font-semibold uppercase tracking-wide text-slate-500">Catégorie</p>
                                <p class="font-medium text-slate-800">{{ $announcement->category->name }}</p>
                            </div>
                        </li>
                        <li class="flex items-start gap-2.5 rounded-2xl bg-slate-50 px-3 py-2.5">
                            <svg class="mt-0.5 h-4 w-4 text-slate-500" viewBox="0 0 20 20" fill="none" aria-hidden="true">
                                <path d="M10 17s5-4.25 5-8a5 5 0 10-10 0c0 3.75 5 8 5 8z" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" />
                                <circle cx="10" cy="9" r="1.7" stroke="currentColor" stroke-width="1.6" />
                            </svg>
                            <div>
                                <p class="text-xs font-semibold uppercase tracking-wide text-slate-500">Lieu</p>
                                <p class="font-medium text-slate-800">{{ $announcement->location }}</p>
                            </div>
                        </li>
                        <li class="flex items-start gap-2.5 rounded-2xl bg-slate-50 px-3 py-2.5">
                            <svg class="mt-0.5 h-4 w-4 text-slate-500" viewBox="0 0 20 20" fill="none" aria-hidden="true">
                                <circle cx="10" cy="10" r="6.5" stroke="currentColor" stroke-width="1.6" />
                                <path d="M10 6.5v3.8l2.4 1.4" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                            <div>
                                <p class="text-xs font-semibold uppercase tracking-wide text-slate-500">Date de l'événement</p>
                                <p class="font-medium text-slate-800">{{ $announcement->event_date?->format('d/m/Y') }}</p>
                            </div>
                        </li>
                        <li class="flex items-start gap-2.5 rounded-2xl bg-slate-50 px-3 py-2.5">
                            <svg class="mt-0.5 h-4 w-4 text-slate-500" viewBox="0 0 20 20" fill="none" aria-hidden="true">
                                <circle cx="10" cy="6.5" r="3" stroke="currentColor" stroke-width="1.6" />
                                <path d="M4.5 16.5c.8-2.5 3-4 5.5-4s4.7 1.5 5.5 4" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" />
                            </svg>
                            <div>
                                <p class="text-xs font-semibold uppercase tracking-wide text-slate-500">Publié par</p>
                                <p class="font-medium text-slate-800">{{ $announcement->user->name }}</p>
                            </div>
                        </li>

                        @if ($announcement->bus_line)
                            <li class="flex items-start gap-2.5 rounded-2xl bg-slate-50 px-3 py-2.5">
                                <svg class="mt-0.5 h-4 w-4 text-slate-500" viewBox="0 0 20 20" fill="none" aria-hidden="true">
                                    <path d="M4.5 13.5h11M5.5 13.5V7a2 2 0 012-2h5a2 2 0 012 2v6.5M7 16v-1.5M13 16v-1.5" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                                <div>
                                    <p class="text-xs font-semibold uppercase tracking-wide text-slate-500">Ligne de bus</p>
                                    <p class="font-medium text-slate-800">{{ $announcement->bus_line }}</p>
                                </div>
                            </li>
                        @endif

                        @if ($announcement->stop_name)
                            <li class="flex items-start gap-2.5 rounded-2xl bg-slate-50 px-3 py-2.5">
                                <svg class="mt-0.5 h-4 w-4 text-slate-500" viewBox="0 0 20 20" fill="none" aria-hidden="true">
                                    <path d="M10 17s4.5-3.7 4.5-7A4.5 4.5 0 105.5 10c0 3.3 4.5 7 4.5 7z" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                                <div>
                                    <p class="text-xs font-semibold uppercase tracking-wide text-slate-500">Arrêt</p>
                                    <p class="font-medium text-slate-800">{{ $announcement->stop_name }}</p>
                                </div>
                            </li>
                        @endif
                    </ul>
                </article>

                <article class="rounded-3xl border border-slate-200 bg-white p-5 shadow-[0_10px_30px_rgba(15,23,42,0.06)]">
                    <h2 class="text-lg font-semibold text-slate-900">Actions rapides</h2>
                    <p class="mt-1 text-sm text-slate-600">Naviguez rapidement vers les actions utiles.</p>
                    <div class="mt-4 grid gap-3">
                        <a href="{{ route('announcements.index') }}" class="inline-flex h-11 items-center justify-center rounded-2xl border border-slate-300 px-4 text-sm font-semibold text-slate-700 transition hover:bg-slate-100">
                            Retour aux annonces
                        </a>

                        @auth
                            <a href="{{ route('announcements.create') }}" class="inline-flex h-11 items-center justify-center rounded-2xl bg-blue-600 px-4 text-sm font-semibold text-white transition hover:bg-blue-700">
                                Publier une annonce
                            </a>
                        @endauth
                    </div>
                </article>
            </aside>
        </div>
    </section>
@endsection
