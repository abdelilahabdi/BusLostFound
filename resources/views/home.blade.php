@extends('layouts.app')

@section('title', 'BusLost&Found - Accueil')

@section('content')
    <section
        class="relative overflow-hidden rounded-3xl bg-gradient-to-br from-blue-600 via-blue-700 to-blue-800 px-6 py-14 shadow-xl sm:px-10 sm:py-20 lg:px-14 lg:py-24">
        <div class="pointer-events-none absolute -left-24 top-8 h-64 w-64 rounded-full bg-blue-400/25 blur-3xl"></div>
        <div class="pointer-events-none absolute -right-16 bottom-0 h-72 w-72 rounded-full bg-cyan-300/20 blur-3xl"></div>

        <div class="relative mx-auto flex min-h-[62vh] max-w-4xl flex-col items-center justify-center text-center">
            <p
                class="inline-flex items-center gap-2 rounded-full border border-white/20 bg-white/10 px-4 py-2 text-sm font-medium text-blue-50 backdrop-blur-sm">
                <svg class="h-4 w-4 text-amber-200" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                    <path
                        d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.538 1.118l-2.8-2.034a1 1 0 00-1.176 0l-2.8 2.034c-.783.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.363-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81H7.03a1 1 0 00.951-.69l1.07-3.292z" />
                </svg>
                Plateforme de confiance pour retrouver vos objets
            </p>

            <h1 class="mt-7 text-4xl font-extrabold tracking-tight text-white sm:text-5xl lg:text-6xl">
                Retrouvez vos objets
                <span class="mt-2 block text-amber-200">perdus dans les bus</span>
            </h1>

            <p class="mt-7 max-w-3xl text-lg leading-8 text-blue-100">
                BusLost&amp;Found centralise les annonces d'objets perdus et trouv&eacute;s dans le transport urbain.
                Gagnez du temps et augmentez vos chances de retrouver vos biens rapidement.
            </p>

            <div class="mt-10 flex flex-col items-center gap-4 sm:flex-row">
                <a href="{{ route('announcements.create', ['type' => 'lost']) }}"
                    class="inline-flex min-w-64 items-center justify-center rounded-2xl bg-white px-7 py-3 text-base font-semibold text-blue-700 shadow-lg shadow-blue-900/15 transition hover:bg-blue-50">
                    D&eacute;clarer un objet perdu
                </a>
                <a href="{{ route('announcements.create', ['type' => 'found']) }}"
                    class="inline-flex min-w-64 items-center justify-center rounded-2xl border border-white/35 bg-white/10 px-7 py-3 text-base font-semibold text-white backdrop-blur-sm transition hover:bg-white/20">
                    D&eacute;clarer un objet trouv&eacute;
                </a>
            </div>
        </div>
    </section>

    <section class="mt-16">
        <div class="mx-auto max-w-4xl text-center">
            <h2 class="text-3xl font-bold tracking-tight text-slate-900 sm:text-4xl lg:text-5xl">Comment &ccedil;a fonctionne ?</h2>
            <p class="mt-4 text-lg text-slate-600">
                Un processus simple en 4 &eacute;tapes pour retrouver ou restituer un objet.
            </p>
        </div>

        <div class="mt-10 grid gap-6 lg:grid-cols-2">
            <article
                class="rounded-3xl border border-blue-100 bg-blue-50/70 p-8 shadow-[0_10px_30px_rgba(15,23,42,0.06)] sm:p-9">
                <div
                    class="inline-flex h-16 w-16 items-center justify-center rounded-2xl bg-gradient-to-br from-blue-500 to-blue-700 text-white shadow-md shadow-blue-700/25">
                    <svg class="h-8 w-8" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                        <circle cx="11" cy="11" r="6.5" stroke="currentColor" stroke-width="2"></circle>
                        <path d="M16 16L20 20" stroke="currentColor" stroke-width="2" stroke-linecap="round"></path>
                    </svg>
                </div>

                <h3 class="mt-6 text-2xl font-bold tracking-tight text-slate-900 sm:text-3xl">Vous avez perdu un objet ?</h3>

                <ol class="mt-7 space-y-5">
                    <li class="flex items-start gap-3">
                        <span
                            class="mt-0.5 inline-flex h-9 w-9 shrink-0 items-center justify-center rounded-full bg-blue-600 text-base font-bold text-white">1</span>
                        <p class="text-lg leading-8 text-slate-700">Cr&eacute;ez un compte gratuitement.</p>
                    </li>
                    <li class="flex items-start gap-3">
                        <span
                            class="mt-0.5 inline-flex h-9 w-9 shrink-0 items-center justify-center rounded-full bg-blue-600 text-base font-bold text-white">2</span>
                        <p class="text-lg leading-8 text-slate-700">
                            D&eacute;clarez votre objet perdu avec tous les d&eacute;tails utiles.
                        </p>
                    </li>
                    <li class="flex items-start gap-3">
                        <span
                            class="mt-0.5 inline-flex h-9 w-9 shrink-0 items-center justify-center rounded-full bg-blue-600 text-base font-bold text-white">3</span>
                        <p class="text-lg leading-8 text-slate-700">
                            Recevez des notifications en cas de correspondance.
                        </p>
                    </li>
                    <li class="flex items-start gap-3">
                        <span
                            class="mt-0.5 inline-flex h-9 w-9 shrink-0 items-center justify-center rounded-full bg-blue-600 text-base font-bold text-white">4</span>
                        <p class="text-lg leading-8 text-slate-700">
                            Contactez la personne en toute s&eacute;curit&eacute; pour r&eacute;cup&eacute;rer votre bien.
                        </p>
                    </li>
                </ol>
            </article>

            <article
                class="rounded-3xl border border-emerald-100 bg-emerald-50/70 p-8 shadow-[0_10px_30px_rgba(15,23,42,0.06)] sm:p-9">
                <div
                    class="inline-flex h-16 w-16 items-center justify-center rounded-2xl bg-gradient-to-br from-emerald-500 to-emerald-700 text-white shadow-md shadow-emerald-700/25">
                    <svg class="h-8 w-8" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                        <path d="M12 5V19" stroke="currentColor" stroke-width="2" stroke-linecap="round"></path>
                        <path d="M5 12H19" stroke="currentColor" stroke-width="2" stroke-linecap="round"></path>
                    </svg>
                </div>

                <h3 class="mt-6 text-2xl font-bold tracking-tight text-slate-900 sm:text-3xl">Vous avez trouv&eacute; un objet ?</h3>

                <ol class="mt-7 space-y-5">
                    <li class="flex items-start gap-3">
                        <span
                            class="mt-0.5 inline-flex h-9 w-9 shrink-0 items-center justify-center rounded-full bg-emerald-600 text-base font-bold text-white">1</span>
                        <p class="text-lg leading-8 text-slate-700">Cr&eacute;ez un compte ou connectez-vous.</p>
                    </li>
                    <li class="flex items-start gap-3">
                        <span
                            class="mt-0.5 inline-flex h-9 w-9 shrink-0 items-center justify-center rounded-full bg-emerald-600 text-base font-bold text-white">2</span>
                        <p class="text-lg leading-8 text-slate-700">
                            Publiez une annonce avec la description de l'objet trouv&eacute;.
                        </p>
                    </li>
                    <li class="flex items-start gap-3">
                        <span
                            class="mt-0.5 inline-flex h-9 w-9 shrink-0 items-center justify-center rounded-full bg-emerald-600 text-base font-bold text-white">3</span>
                        <p class="text-lg leading-8 text-slate-700">Attendez qu'une personne vous contacte.</p>
                    </li>
                    <li class="flex items-start gap-3">
                        <span
                            class="mt-0.5 inline-flex h-9 w-9 shrink-0 items-center justify-center rounded-full bg-emerald-600 text-base font-bold text-white">4</span>
                        <p class="text-lg leading-8 text-slate-700">
                            V&eacute;rifiez l'identit&eacute; du propri&eacute;taire avant de restituer l'objet.
                        </p>
                    </li>
                </ol>
            </article>
        </div>
    </section>

    <section class="mt-16">
        <div class="mx-auto max-w-4xl text-center">
            <h2 class="text-3xl font-bold tracking-tight text-slate-900 sm:text-4xl lg:text-5xl">Pourquoi choisir BusLost&amp;Found ?</h2>
            <p class="mt-4 text-lg text-slate-600">
                Une plateforme claire et fiable pour retrouver vos objets en toute confiance.
            </p>
        </div>

        <div class="mt-10 grid gap-6 md:grid-cols-2 xl:grid-cols-3">
            <article class="rounded-3xl border border-slate-200 bg-white p-8 text-center shadow-[0_10px_30px_rgba(15,23,42,0.06)]">
                <div
                    class="mx-auto inline-flex h-20 w-20 items-center justify-center rounded-2xl bg-gradient-to-br from-blue-500 to-blue-700 text-white shadow-md shadow-blue-700/20">
                    <svg class="h-10 w-10" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                        <path d="M12 3C9.239 3 7 5.239 7 8c0 3.866 5 10 5 10s5-6.134 5-10c0-2.761-2.239-5-5-5z"
                            stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" />
                        <circle cx="12" cy="8" r="2" stroke="currentColor" stroke-width="1.8" />
                    </svg>
                </div>
                <h3 class="mt-6 text-2xl font-bold text-slate-900">Centralisation</h3>
                <p class="mt-4 text-lg leading-8 text-slate-600">
                    Toutes les annonces d'objets perdus et trouv&eacute;s sont regroup&eacute;es au m&ecirc;me endroit.
                </p>
            </article>

            <article class="rounded-3xl border border-slate-200 bg-white p-8 text-center shadow-[0_10px_30px_rgba(15,23,42,0.06)]">
                <div
                    class="mx-auto inline-flex h-20 w-20 items-center justify-center rounded-2xl bg-gradient-to-br from-violet-500 to-purple-600 text-white shadow-md shadow-purple-700/20">
                    <svg class="h-10 w-10" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                        <circle cx="12" cy="12" r="8" stroke="currentColor" stroke-width="1.8" />
                        <path d="M12 8V12L15 14" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"
                            stroke-linejoin="round" />
                    </svg>
                </div>
                <h3 class="mt-6 text-2xl font-bold text-slate-900">Gain de temps</h3>
                <p class="mt-4 text-lg leading-8 text-slate-600">
                    Recherchez rapidement par cat&eacute;gorie, ligne de bus, date et localisation.
                </p>
            </article>

            <article
                class="rounded-3xl border border-slate-200 bg-white p-8 text-center shadow-[0_10px_30px_rgba(15,23,42,0.06)] md:col-span-2 xl:col-span-1">
                <div
                    class="mx-auto inline-flex h-20 w-20 items-center justify-center rounded-2xl bg-gradient-to-br from-emerald-500 to-emerald-700 text-white shadow-md shadow-emerald-700/20">
                    <svg class="h-10 w-10" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                        <path d="M12 3L5 6V11C5 15.418 7.985 19.455 12 21C16.015 19.455 19 15.418 19 11V6L12 3Z"
                            stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </div>
                <h3 class="mt-6 text-2xl font-bold text-slate-900">S&eacute;curit&eacute;</h3>
                <p class="mt-4 text-lg leading-8 text-slate-600">
                    Messagerie interne et mod&eacute;ration pour favoriser des &eacute;changes responsables.
                </p>
            </article>
        </div>
    </section>

    <section
        class="relative mt-16 mb-6 overflow-hidden rounded-3xl bg-gradient-to-br from-blue-600 via-blue-700 to-blue-800 px-6 py-16 shadow-xl sm:mb-8 sm:px-10 sm:py-20 lg:px-14">
        <div class="pointer-events-none absolute -left-20 top-6 h-60 w-60 rounded-full bg-blue-400/25 blur-3xl"></div>
        <div class="pointer-events-none absolute -right-16 bottom-0 h-64 w-64 rounded-full bg-cyan-300/20 blur-3xl"></div>

        <div class="relative mx-auto max-w-4xl text-center">
            <h2 class="text-3xl font-extrabold tracking-tight text-white sm:text-4xl lg:text-5xl">
                Pr&ecirc;t &agrave; retrouver vos objets perdus ?
            </h2>
            <p class="mx-auto mt-6 max-w-3xl text-lg leading-8 text-blue-100">
                Rejoignez la communaut&eacute; BusLost&amp;Found et augmentez vos chances de r&eacute;cup&eacute;rer vos biens.
            </p>

            <div class="mt-10 flex justify-center">
                @guest
                    <a href="{{ route('register') }}"
                        class="inline-flex items-center justify-center gap-2 rounded-2xl bg-white px-8 py-4 text-lg font-semibold text-blue-700 shadow-lg shadow-blue-900/15 transition hover:bg-blue-50 sm:text-xl">
                        <svg class="h-6 w-6" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                            <path
                                d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l.68 2.094a1 1 0 00.95.69h2.201c.969 0 1.371 1.24.588 1.81l-1.781 1.294a1 1 0 00-.364 1.118l.68 2.094c.3.922-.755 1.688-1.539 1.119L10.588 12.9a1 1 0 00-1.176 0l-1.78 1.295c-.784.57-1.838-.197-1.54-1.119l.68-2.094a1 1 0 00-.363-1.118L4.628 7.52c-.783-.57-.38-1.81.588-1.81h2.202a1 1 0 00.95-.69l.68-2.094z" />
                        </svg>
                        Cr&eacute;er un compte gratuitement
                    </a>
                @else
                    <a href="{{ route('dashboard') }}"
                        class="inline-flex items-center justify-center rounded-2xl bg-white px-8 py-4 text-lg font-semibold text-blue-700 shadow-lg shadow-blue-900/15 transition hover:bg-blue-50 sm:text-xl">
                        Acc&eacute;der &agrave; mon tableau de bord
                    </a>
                @endguest
            </div>
        </div>
    </section>
@endsection
