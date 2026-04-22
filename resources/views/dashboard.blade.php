@extends('layouts.app')

@section('title', 'BusLost&Found - Tableau de bord')

@section('content')
    <div class="relative left-1/2 w-[100dvw] -translate-x-1/2 overflow-x-hidden px-4 sm:px-6 lg:px-8">
        <div class="mx-auto w-full max-w-[90rem] space-y-10 lg:space-y-12">
            <section
                class="relative overflow-hidden rounded-[2.2rem] bg-gradient-to-br from-orange-500 via-rose-500 to-fuchsia-600 p-7 text-white shadow-[0_30px_70px_rgba(190,24,93,0.28)] sm:p-12 lg:p-14">
                <div class="pointer-events-none absolute -left-20 -top-20 h-64 w-64 rounded-full bg-white/20 blur-3xl"></div>
                <div class="pointer-events-none absolute -right-20 bottom-0 h-80 w-80 rounded-full bg-amber-200/20 blur-3xl"></div>

                <div class="relative">
                    <p
                        class="inline-flex items-center gap-2 rounded-full border border-white/35 bg-white/10 px-4 py-2 text-xs font-semibold uppercase tracking-[0.14em] text-white/95">
                        <svg class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                            <path
                                d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l.68 2.094a1 1 0 00.95.69h2.201c.969 0 1.371 1.24.588 1.81l-1.781 1.294a1 1 0 00-.364 1.118l.68 2.094c.3.922-.755 1.688-1.539 1.119L10.588 12.9a1 1 0 00-1.176 0l-1.78 1.295c-.784.57-1.838-.197-1.54-1.119l.68-2.094a1 1 0 00-.363-1.118L4.628 7.52c-.783-.57-.38-1.81.588-1.81h2.202a1 1 0 00.95-.69l.68-2.094z" />
                        </svg>
                        Espace personnel
                    </p>

                    <h1 class="mt-6 text-4xl font-black tracking-tight sm:text-5xl lg:text-6xl xl:text-7xl">
                        Tableau de bord
                    </h1>
                    <p class="mt-5 text-lg text-white/95 sm:text-2xl">
                        Bienvenue, {{ auth()->user()->name }} !
                    </p>
                    <p class="mt-2 max-w-3xl text-sm text-white/85 sm:text-base">
                        Suivez vos annonces, consultez vos messages et gérez vos actions importantes depuis un seul espace.
                    </p>

                    <div class="mt-10 grid gap-6 md:grid-cols-2 xl:grid-cols-3">
                        <article
                            class="overflow-hidden rounded-3xl border border-white/35 bg-white/95 text-slate-900 shadow-[0_18px_35px_rgba(15,23,42,0.18)]">
                            <figure class="h-44 w-full overflow-hidden sm:h-48 lg:h-52 xl:h-56">
                                <img src="{{ asset('images/ui/dashboard/stats/stat-1.jpg') }}" alt="Statistique total annonces"
                                    class="h-full w-full object-cover object-center">
                            </figure>
                            <div class="p-6 sm:p-7">
                                <span
                                    class="inline-flex h-11 w-11 items-center justify-center rounded-xl bg-blue-600 text-white shadow-md shadow-blue-600/25">
                                    <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                                        <path d="M4 6H20" stroke="currentColor" stroke-width="2" stroke-linecap="round" />
                                        <path d="M7 12H17" stroke="currentColor" stroke-width="2" stroke-linecap="round" />
                                        <path d="M10 18H14" stroke="currentColor" stroke-width="2" stroke-linecap="round" />
                                    </svg>
                                </span>
                                <p class="mt-5 text-4xl font-black tracking-tight sm:text-5xl">{{ $totalAnnouncements }}</p>
                                <p class="mt-2 text-sm font-semibold text-slate-600">Total annonces</p>
                            </div>
                        </article>

                        <article
                            class="overflow-hidden rounded-3xl border border-white/35 bg-white/95 text-slate-900 shadow-[0_18px_35px_rgba(15,23,42,0.18)]">
                            <figure class="h-44 w-full overflow-hidden sm:h-48 lg:h-52 xl:h-56">
                                <img src="{{ asset('images/ui/dashboard/stats/stat-2.jpg') }}" alt="Statistique annonces actives"
                                    class="h-full w-full object-cover object-center">
                            </figure>
                            <div class="p-6 sm:p-7">
                                <span
                                    class="inline-flex h-11 w-11 items-center justify-center rounded-xl bg-emerald-600 text-white shadow-md shadow-emerald-600/25">
                                    <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                                        <path d="M5 12L10 17L19 7" stroke="currentColor" stroke-width="2.4"
                                            stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                </span>
                                <p class="mt-5 text-4xl font-black tracking-tight text-emerald-700 sm:text-5xl">{{ $totalActiveAnnouncements }}</p>
                                <p class="mt-2 text-sm font-semibold text-slate-600">Annonces actives</p>
                            </div>
                        </article>

                        <article
                            class="overflow-hidden rounded-3xl border border-white/35 bg-white/95 text-slate-900 shadow-[0_18px_35px_rgba(15,23,42,0.18)]">
                            <figure class="h-44 w-full overflow-hidden sm:h-48 lg:h-52 xl:h-56">
                                <img src="{{ asset('images/ui/dashboard/stats/stat-3.jpg') }}" alt="Statistique annonces résolues"
                                    class="h-full w-full object-cover object-center">
                            </figure>
                            <div class="p-6 sm:p-7">
                                <span
                                    class="inline-flex h-11 w-11 items-center justify-center rounded-xl bg-slate-700 text-white shadow-md shadow-slate-700/25">
                                    <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                                        <path d="M6 12H18" stroke="currentColor" stroke-width="2" stroke-linecap="round" />
                                        <path d="M9 9L6 12L9 15" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                        <path d="M15 9L18 12L15 15" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                    </svg>
                                </span>
                                <p class="mt-5 text-4xl font-black tracking-tight text-slate-700 sm:text-5xl">{{ $totalResolvedAnnouncements }}</p>
                                <p class="mt-2 text-sm font-semibold text-slate-600">Annonces résolues</p>
                            </div>
                        </article>
                    </div>
                </div>
            </section>

            <section class="rounded-[2rem] border border-slate-200 bg-white p-7 shadow-[0_12px_32px_rgba(15,23,42,0.06)] sm:p-9 lg:p-10">
                <div class="flex flex-wrap items-end justify-between gap-4">
                    <div>
                        <h2 class="text-2xl font-bold tracking-tight text-slate-900 sm:text-3xl">Actions rapides</h2>
                        <p class="mt-1 text-sm text-slate-600 sm:text-base">
                            Accédez immédiatement aux fonctionnalités principales.
                        </p>
                    </div>
                </div>

                <div class="mt-7 grid gap-5 sm:grid-cols-2 xl:grid-cols-4">
                    <a href="{{ route('announcements.create') }}"
                        class="group flex h-20 items-center justify-between rounded-2xl bg-gradient-to-r from-blue-600 to-blue-700 px-6 text-sm font-semibold text-white shadow-[0_12px_26px_rgba(37,99,235,0.26)] transition hover:from-blue-700 hover:to-blue-800 sm:text-base">
                        Nouvelle annonce
                        <span class="inline-flex h-9 w-9 items-center justify-center rounded-full bg-white/20 transition group-hover:bg-white/30">+</span>
                    </a>
                    <a href="{{ route('announcements.my') }}"
                        class="group flex h-20 items-center justify-between rounded-2xl border border-slate-200 bg-slate-50 px-6 text-sm font-semibold text-slate-700 shadow-[0_8px_18px_rgba(15,23,42,0.06)] transition hover:bg-slate-100 sm:text-base">
                        Mes annonces
                        <span class="text-lg text-slate-400 transition group-hover:text-slate-600">→</span>
                    </a>
                    <a href="{{ route('messages.index') }}"
                        class="group flex h-20 items-center justify-between rounded-2xl border border-slate-200 bg-slate-50 px-6 text-sm font-semibold text-slate-700 shadow-[0_8px_18px_rgba(15,23,42,0.06)] transition hover:bg-slate-100 sm:text-base">
                        Mes messages
                        <span class="text-lg text-slate-400 transition group-hover:text-slate-600">→</span>
                    </a>
                    <a href="{{ route('home') }}"
                        class="group flex h-20 items-center justify-between rounded-2xl border border-slate-200 bg-slate-50 px-6 text-sm font-semibold text-slate-700 shadow-[0_8px_18px_rgba(15,23,42,0.06)] transition hover:bg-slate-100 sm:text-base">
                        Retour à l'accueil
                        <span class="text-lg text-slate-400 transition group-hover:text-slate-600">→</span>
                    </a>
                </div>
            </section>

            <section
                class="relative overflow-hidden rounded-[2rem] border border-slate-200 shadow-[0_16px_40px_rgba(15,23,42,0.1)]">
                <img src="{{ asset('images/ui/dashboard/banners/network-banner.jpg') }}" alt="Réseau de bus couvert"
                    class="absolute inset-0 h-full w-full object-cover">
                <div class="absolute inset-0 bg-gradient-to-r from-slate-950/80 via-blue-900/70 to-cyan-700/60"></div>

                <div class="relative flex flex-col gap-6 p-7 sm:p-12 lg:flex-row lg:items-end lg:justify-between">
                    <div class="max-w-3xl rounded-3xl border border-white/40 bg-white/90 p-5 text-slate-900 shadow-md sm:p-7">
                        <h2 class="text-2xl font-bold tracking-tight sm:text-3xl">Réseau de transport couvert</h2>
                        <p class="mt-3 text-sm text-slate-600 sm:text-base">
                            BusLost&Found relie les annonces de plusieurs lignes pour simplifier la recherche et la restitution.
                        </p>
                    </div>
                    <div
                        class="inline-flex items-center gap-4 self-start rounded-2xl border border-white/30 bg-white/10 px-6 py-5 text-white backdrop-blur-sm">
                        <p class="text-4xl font-black leading-none text-amber-300 sm:text-5xl">45+</p>
                        <p class="text-sm font-semibold uppercase tracking-[0.12em] text-blue-100">Lignes couvertes</p>
                    </div>
                </div>
            </section>

            <section class="grid gap-8 xl:grid-cols-[2fr_1fr]">
                <section class="rounded-[2rem] border border-slate-200 bg-white p-7 shadow-[0_12px_32px_rgba(15,23,42,0.06)] sm:p-9 lg:p-10">
                    <h2 class="text-2xl font-bold tracking-tight text-slate-900 sm:text-3xl">Mes dernières annonces</h2>
                    <p class="mt-3 text-sm text-slate-600">
                        Retrouvez vos publications les plus récentes.
                    </p>

                    @if ($latestAnnouncements->isEmpty())
                        <div class="mt-8 rounded-2xl border border-slate-200 bg-slate-50 p-8 text-center">
                            <p class="text-sm text-slate-600">
                                Vous n'avez pas encore publié d'annonce.
                            </p>
                        </div>
                    @else
                        <div class="mt-8 space-y-5">
                            @foreach ($latestAnnouncements as $announcement)
                                <article class="rounded-3xl border border-slate-200 bg-white p-5 shadow-[0_10px_22px_rgba(15,23,42,0.06)] sm:p-6">
                                    <div class="flex flex-col gap-5 sm:flex-row sm:items-start sm:justify-between">
                                        <div class="min-w-0 flex-1">
                                            <div class="flex items-start gap-4">
                                                <span
                                                    class="inline-flex h-12 w-12 shrink-0 items-center justify-center rounded-2xl {{ $announcement->type === 'lost' ? 'bg-amber-100 text-amber-700' : 'bg-blue-100 text-blue-700' }}">
                                                    <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                                                        <circle cx="11" cy="11" r="6.5" stroke="currentColor" stroke-width="2"></circle>
                                                        <path d="M16 16L20 20" stroke="currentColor" stroke-width="2" stroke-linecap="round"></path>
                                                    </svg>
                                                </span>
                                                <div class="min-w-0">
                                                    <h3 class="truncate text-base font-semibold text-slate-900 sm:text-lg lg:text-xl">
                                                        {{ $announcement->title }}
                                                    </h3>

                                                    <div class="mt-4 flex flex-wrap items-center gap-2.5 text-xs font-semibold">
                                                        <span class="inline-flex h-7 items-center rounded-full border border-slate-200 bg-slate-100 px-2.5 text-slate-700">
                                                            Type: {{ $announcement->type === 'lost' ? 'Perdu' : 'Trouvé' }}
                                                        </span>
                                                        <span class="inline-flex h-7 items-center rounded-full {{ $announcement->status === 'active' ? 'border border-emerald-200 bg-emerald-100 text-emerald-700' : 'border border-slate-200 bg-slate-100 text-slate-700' }} px-2.5">
                                                            Statut: {{ $announcement->status === 'active' ? 'Active' : 'Résolue' }}
                                                        </span>
                                                        <span class="inline-flex h-7 items-center rounded-full border border-blue-100 bg-blue-50 px-2.5 text-blue-700">
                                                            Date: {{ $announcement->event_date?->format('d/m/Y') }}
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <a href="{{ route('announcements.show', $announcement) }}"
                                            class="inline-flex h-11 shrink-0 items-center justify-center rounded-2xl border border-blue-200 bg-blue-50 px-5 text-sm font-semibold text-blue-700 transition hover:bg-blue-100">
                                            Voir
                                        </a>
                                    </div>
                                </article>
                            @endforeach
                        </div>
                    @endif
                </section>

                <aside class="space-y-6">
                    <article
                        class="overflow-hidden rounded-[2rem] border border-emerald-200 bg-gradient-to-br from-teal-400 via-cyan-500 to-emerald-500 text-white shadow-[0_16px_34px_rgba(13,148,136,0.28)]">
                        <img src="{{ asset('images/ui/dashboard/banners/conseils-header.jpg') }}" alt="Conseils utiles"
                            class="h-44 w-full object-cover">
                        <div class="p-7 sm:p-8">
                            <h3 class="text-2xl font-bold tracking-tight">Conseils utiles</h3>
                            <ul class="mt-5 space-y-4 text-sm font-medium text-white/95">
                                <li class="flex items-start gap-2.5">
                                    <span class="inline-flex h-5 w-5 shrink-0 items-center justify-center rounded-full bg-white/25">
                                        <svg class="h-3.5 w-3.5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                            <path fill-rule="evenodd"
                                                d="M16.704 5.29a1 1 0 010 1.42l-7.5 7.5a1 1 0 01-1.414 0l-3-3a1 1 0 111.414-1.42l2.293 2.294 6.793-6.794a1 1 0 011.414 0z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </span>
                                    Soyez précis dans vos descriptions
                                </li>
                                <li class="flex items-start gap-2.5">
                                    <span class="inline-flex h-5 w-5 shrink-0 items-center justify-center rounded-full bg-white/25">
                                        <svg class="h-3.5 w-3.5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                            <path fill-rule="evenodd"
                                                d="M16.704 5.29a1 1 0 010 1.42l-7.5 7.5a1 1 0 01-1.414 0l-3-3a1 1 0 111.414-1.42l2.293 2.294 6.793-6.794a1 1 0 011.414 0z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </span>
                                    Indiquez la ligne et l'arrêt de bus
                                </li>
                                <li class="flex items-start gap-2.5">
                                    <span class="inline-flex h-5 w-5 shrink-0 items-center justify-center rounded-full bg-white/25">
                                        <svg class="h-3.5 w-3.5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                            <path fill-rule="evenodd"
                                                d="M16.704 5.29a1 1 0 010 1.42l-7.5 7.5a1 1 0 01-1.414 0l-3-3a1 1 0 111.414-1.42l2.293 2.294 6.793-6.794a1 1 0 011.414 0z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </span>
                                    Vérifiez régulièrement vos messages
                                </li>
                                <li class="flex items-start gap-2.5">
                                    <span class="inline-flex h-5 w-5 shrink-0 items-center justify-center rounded-full bg-white/25">
                                        <svg class="h-3.5 w-3.5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                            <path fill-rule="evenodd"
                                                d="M16.704 5.29a1 1 0 010 1.42l-7.5 7.5a1 1 0 01-1.414 0l-3-3a1 1 0 111.414-1.42l2.293 2.294 6.793-6.794a1 1 0 011.414 0z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </span>
                                    Répondez rapidement aux contacts
                                </li>
                            </ul>
                            <a href="{{ route('home') }}"
                                class="mt-7 inline-flex h-12 items-center justify-center rounded-2xl bg-white px-6 text-sm font-semibold text-teal-700 shadow-[0_8px_18px_rgba(255,255,255,0.24)] transition hover:bg-teal-50">
                                Commencer la recherche
                            </a>
                        </div>
                    </article>

                    <article class="rounded-[2rem] border border-slate-200 bg-white p-7 shadow-[0_12px_28px_rgba(15,23,42,0.06)] sm:p-8">
                        <h3 class="text-2xl font-bold tracking-tight text-slate-900">Objets fréquemment perdus</h3>
                        <div class="mt-6 grid grid-cols-2 gap-4">
                            <figure class="relative overflow-hidden rounded-2xl">
                                <img src="{{ asset('images/ui/dashboard/categories/phone.jpg') }}" alt="Téléphones"
                                    class="h-28 w-full object-cover">
                                <figcaption class="absolute inset-x-0 bottom-0 bg-gradient-to-t from-slate-900/70 to-transparent px-3 py-2 text-xs font-semibold text-white">Téléphones</figcaption>
                            </figure>
                            <figure class="relative overflow-hidden rounded-2xl">
                                <img src="{{ asset('images/ui/dashboard/categories/wallet.jpg') }}" alt="Portefeuilles"
                                    class="h-28 w-full object-cover">
                                <figcaption class="absolute inset-x-0 bottom-0 bg-gradient-to-t from-slate-900/70 to-transparent px-3 py-2 text-xs font-semibold text-white">Portefeuilles</figcaption>
                            </figure>
                            <figure class="relative overflow-hidden rounded-2xl">
                                <img src="{{ asset('images/ui/dashboard/categories/bag.jpg') }}" alt="Sacs"
                                    class="h-28 w-full object-cover">
                                <figcaption class="absolute inset-x-0 bottom-0 bg-gradient-to-t from-slate-900/70 to-transparent px-3 py-2 text-xs font-semibold text-white">Sacs</figcaption>
                            </figure>
                            <figure class="relative overflow-hidden rounded-2xl">
                                <img src="{{ asset('images/ui/dashboard/categories/earbuds.jpg') }}" alt="Écouteurs"
                                    class="h-28 w-full object-cover">
                                <figcaption class="absolute inset-x-0 bottom-0 bg-gradient-to-t from-slate-900/70 to-transparent px-3 py-2 text-xs font-semibold text-white">Écouteurs</figcaption>
                            </figure>
                            <figure class="relative overflow-hidden rounded-2xl">
                                <img src="{{ asset('images/ui/dashboard/categories/keys.jpg') }}" alt="Clés"
                                    class="h-28 w-full object-cover">
                                <figcaption class="absolute inset-x-0 bottom-0 bg-gradient-to-t from-slate-900/70 to-transparent px-3 py-2 text-xs font-semibold text-white">Clés</figcaption>
                            </figure>
                            <figure class="relative overflow-hidden rounded-2xl">
                                <img src="{{ asset('images/ui/dashboard/categories/glasses.jpg') }}" alt="Lunettes"
                                    class="h-28 w-full object-cover">
                                <figcaption class="absolute inset-x-0 bottom-0 bg-gradient-to-t from-slate-900/70 to-transparent px-3 py-2 text-xs font-semibold text-white">Lunettes</figcaption>
                            </figure>
                        </div>
                    </article>
                </aside>
            </section>
        </div>
    </div>
@endsection
