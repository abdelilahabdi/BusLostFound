@extends('layouts.app')

@section('title', 'BusLost&Found - Accueil')

@section('content')
    <section
        class="relative left-1/2 w-screen -translate-x-1/2 overflow-hidden bg-gradient-to-br from-blue-600 via-blue-700 to-blue-900">
        <div class="absolute inset-0">
            <img src="{{ asset('images/ui/home/hero-bus.jpg') }}" alt="Intérieur d'un bus en circulation"
                class="h-full w-full object-cover">
            <div class="absolute inset-0 bg-gradient-to-b from-blue-700/88 via-blue-700/90 to-blue-900/93"></div>
        </div>
        <div class="pointer-events-none absolute -left-24 top-10 h-64 w-64 rounded-full bg-cyan-300/20 blur-3xl"></div>
        <div class="pointer-events-none absolute -right-20 bottom-4 h-80 w-80 rounded-full bg-blue-300/20 blur-3xl"></div>

        <div
            class="relative mx-auto flex min-h-[72vh] w-full max-w-6xl flex-col items-center justify-center px-4 py-16 text-center sm:min-h-[76vh] sm:px-6 sm:py-20 lg:px-8 lg:py-24">
            <p
                class="mx-auto inline-flex items-center gap-2 rounded-full border border-white/25 bg-white/10 px-5 py-2 text-sm font-medium text-blue-50 backdrop-blur-sm">
                <svg class="h-4 w-4 text-amber-200" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                    <path
                        d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.538 1.118l-2.8-2.034a1 1 0 00-1.176 0l-2.8 2.034c-.783.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.363-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81H7.03a1 1 0 00.951-.69l1.07-3.292z" />
                </svg>
                Plateforme de confiance pour retrouver vos objets
            </p>

            <h1 class="mx-auto mt-7 max-w-5xl text-4xl font-extrabold tracking-tight text-white sm:text-6xl lg:text-7xl">
                Retrouvez vos objets
                <span class="mt-2 block text-amber-200">perdus dans les bus</span>
            </h1>

            <p class="mx-auto mt-7 max-w-4xl text-lg leading-8 text-blue-100 sm:text-2xl sm:leading-10">
                BusLost&Found centralise toutes les annonces d'objets perdus et trouvés dans le transport urbain.
                Gagnez du temps et retrouvez vos biens facilement.
            </p>

            <div class="mt-10 flex flex-col items-center justify-center gap-4 sm:flex-row">
                <a href="{{ route('announcements.create', ['type' => 'lost']) }}"
                    class="inline-flex w-full min-w-64 items-center justify-center rounded-2xl bg-white px-8 py-4 text-base font-semibold text-blue-700 shadow-[0_18px_35px_rgba(15,23,42,0.22)] transition hover:bg-blue-50 sm:w-auto">
                    <svg class="mr-2 h-5 w-5" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                        <circle cx="11" cy="11" r="6.5" stroke="currentColor" stroke-width="2"></circle>
                        <path d="M16 16L20 20" stroke="currentColor" stroke-width="2" stroke-linecap="round"></path>
                    </svg>
                    Déclarer un objet perdu
                </a>
                <a href="{{ route('announcements.create', ['type' => 'found']) }}"
                    class="inline-flex w-full min-w-64 items-center justify-center rounded-2xl border border-white/30 bg-white/10 px-8 py-4 text-base font-semibold text-white backdrop-blur-sm transition hover:bg-white/20 sm:w-auto">
                    <svg class="mr-2 h-5 w-5" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                        <path d="M12 5V19" stroke="currentColor" stroke-width="2" stroke-linecap="round"></path>
                        <path d="M5 12H19" stroke="currentColor" stroke-width="2" stroke-linecap="round"></path>
                    </svg>
                    Déclarer un objet trouvé
                </a>
            </div>
        </div>
    </section>

    <section class="mt-20">
        <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-3">
            <figure class="overflow-hidden rounded-3xl shadow-[0_14px_35px_rgba(15,23,42,0.12)]">
                <img src="{{ asset('images/ui/home/strip-1.jpg') }}" alt="Bus urbain dans une station"
                    class="h-48 w-full object-cover sm:h-56">
            </figure>
            <figure class="overflow-hidden rounded-3xl shadow-[0_14px_35px_rgba(15,23,42,0.12)]">
                <img src="{{ asset('images/ui/home/strip-2.jpg') }}" alt="Arrêt de bus éclairé"
                    class="h-48 w-full object-cover sm:h-56">
            </figure>
            <figure class="overflow-hidden rounded-3xl shadow-[0_14px_35px_rgba(15,23,42,0.12)] sm:col-span-2 lg:col-span-1">
                <img src="{{ asset('images/ui/home/strip-3.jpg') }}" alt="Passagers dans un bus"
                    class="h-48 w-full object-cover sm:h-56">
            </figure>
        </div>

        <div class="mx-auto mt-16 max-w-4xl text-center">
            <h2 class="text-3xl font-bold tracking-tight text-slate-900 sm:text-4xl lg:text-5xl">Comment ça fonctionne ?</h2>
            <p class="mt-4 text-lg text-slate-600">
                Un processus simple en 4 étapes pour retrouver ou restituer un objet
            </p>
        </div>

        <div class="mt-10 grid gap-6 lg:grid-cols-2">
            <article
                class="rounded-[2rem] border border-blue-200 bg-gradient-to-br from-blue-50 via-blue-50 to-blue-100/75 p-8 shadow-[0_16px_40px_rgba(15,23,42,0.08)] sm:p-10">
                <div
                    class="inline-flex h-16 w-16 items-center justify-center rounded-2xl bg-gradient-to-br from-blue-500 to-blue-700 text-white shadow-md shadow-blue-700/25">
                    <svg class="h-8 w-8" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                        <circle cx="11" cy="11" r="6.5" stroke="currentColor" stroke-width="2"></circle>
                        <path d="M16 16L20 20" stroke="currentColor" stroke-width="2" stroke-linecap="round"></path>
                    </svg>
                </div>

                <h3 class="mt-6 text-2xl font-bold tracking-tight text-slate-900 sm:text-4xl">Vous avez perdu un objet ?</h3>

                <ol class="mt-7 space-y-5">
                    <li class="flex items-start gap-3">
                        <span
                            class="mt-0.5 inline-flex h-10 w-10 shrink-0 items-center justify-center rounded-full bg-blue-600 text-lg font-bold text-white">1</span>
                        <p class="text-lg leading-8 text-slate-700">Créez un compte gratuitement</p>
                    </li>
                    <li class="flex items-start gap-3">
                        <span
                            class="mt-0.5 inline-flex h-10 w-10 shrink-0 items-center justify-center rounded-full bg-blue-600 text-lg font-bold text-white">2</span>
                        <p class="text-lg leading-8 text-slate-700">
                            Déclarez votre objet perdu avec tous les détails
                        </p>
                    </li>
                    <li class="flex items-start gap-3">
                        <span
                            class="mt-0.5 inline-flex h-10 w-10 shrink-0 items-center justify-center rounded-full bg-blue-600 text-lg font-bold text-white">3</span>
                        <p class="text-lg leading-8 text-slate-700">
                            Recevez des notifications si quelqu'un trouve un objet correspondant
                        </p>
                    </li>
                    <li class="flex items-start gap-3">
                        <span
                            class="mt-0.5 inline-flex h-10 w-10 shrink-0 items-center justify-center rounded-full bg-blue-600 text-lg font-bold text-white">4</span>
                        <p class="text-lg leading-8 text-slate-700">
                            Contactez la personne de manière sécurisée pour récupérer votre bien
                        </p>
                    </li>
                </ol>
            </article>

            <article
                class="rounded-[2rem] border border-emerald-200 bg-gradient-to-br from-emerald-50 via-emerald-50 to-emerald-100/75 p-8 shadow-[0_16px_40px_rgba(15,23,42,0.08)] sm:p-10">
                <div
                    class="inline-flex h-16 w-16 items-center justify-center rounded-2xl bg-gradient-to-br from-emerald-500 to-emerald-700 text-white shadow-md shadow-emerald-700/25">
                    <svg class="h-8 w-8" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                        <path d="M12 5V19" stroke="currentColor" stroke-width="2" stroke-linecap="round"></path>
                        <path d="M5 12H19" stroke="currentColor" stroke-width="2" stroke-linecap="round"></path>
                    </svg>
                </div>

                <h3 class="mt-6 text-2xl font-bold tracking-tight text-slate-900 sm:text-4xl">Vous avez trouvé un objet ?</h3>

                <ol class="mt-7 space-y-5">
                    <li class="flex items-start gap-3">
                        <span
                            class="mt-0.5 inline-flex h-10 w-10 shrink-0 items-center justify-center rounded-full bg-emerald-600 text-lg font-bold text-white">1</span>
                        <p class="text-lg leading-8 text-slate-700">Créez un compte ou connectez-vous</p>
                    </li>
                    <li class="flex items-start gap-3">
                        <span
                            class="mt-0.5 inline-flex h-10 w-10 shrink-0 items-center justify-center rounded-full bg-emerald-600 text-lg font-bold text-white">2</span>
                        <p class="text-lg leading-8 text-slate-700">
                            Publiez une annonce avec la description de l'objet trouvé
                        </p>
                    </li>
                    <li class="flex items-start gap-3">
                        <span
                            class="mt-0.5 inline-flex h-10 w-10 shrink-0 items-center justify-center rounded-full bg-emerald-600 text-lg font-bold text-white">3</span>
                        <p class="text-lg leading-8 text-slate-700">Attendez qu'une personne vous contacte</p>
                    </li>
                    <li class="flex items-start gap-3">
                        <span
                            class="mt-0.5 inline-flex h-10 w-10 shrink-0 items-center justify-center rounded-full bg-emerald-600 text-lg font-bold text-white">4</span>
                        <p class="text-lg leading-8 text-slate-700">
                            Vérifiez l'identité du propriétaire et restituez l'objet
                        </p>
                    </li>
                </ol>
            </article>
        </div>
    </section>

    <section class="mt-20">
        <div class="mx-auto max-w-4xl text-center">
            <h2 class="text-3xl font-bold tracking-tight text-slate-900 sm:text-4xl lg:text-5xl">Pourquoi choisir BusLost&Found ?</h2>
            <p class="mt-4 text-lg text-slate-600">
                Une plateforme conçue pour vous faire gagner du temps et retrouver vos objets en toute confiance
            </p>
        </div>

        <div class="mt-10 grid gap-6 lg:grid-cols-3">
            <article
                class="rounded-3xl border border-slate-200 bg-white p-8 text-center shadow-[0_16px_40px_rgba(15,23,42,0.08)]">
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
                    Toutes les annonces d'objets perdus et trouvés au même endroit. Plus besoin de contacter chaque
                    station séparément.
                </p>
            </article>

            <article
                class="rounded-3xl border border-slate-200 bg-white p-8 text-center shadow-[0_16px_40px_rgba(15,23,42,0.08)]">
                <div
                    class="mx-auto inline-flex h-20 w-20 items-center justify-center rounded-2xl bg-gradient-to-br from-cyan-500 to-sky-700 text-white shadow-md shadow-sky-700/20">
                    <svg class="h-10 w-10" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                        <circle cx="12" cy="12" r="8" stroke="currentColor" stroke-width="1.8" />
                        <path d="M12 8V12L15 14" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"
                            stroke-linejoin="round" />
                    </svg>
                </div>
                <h3 class="mt-6 text-2xl font-bold text-slate-900">Gain de temps</h3>
                <p class="mt-4 text-lg leading-8 text-slate-600">
                    Recherche rapide avec filtres avancés par catégorie, ligne de bus, date et localisation.
                </p>
            </article>

            <article
                class="rounded-3xl border border-slate-200 bg-white p-8 text-center shadow-[0_16px_40px_rgba(15,23,42,0.08)]">
                <div
                    class="mx-auto inline-flex h-20 w-20 items-center justify-center rounded-2xl bg-gradient-to-br from-emerald-500 to-emerald-700 text-white shadow-md shadow-emerald-700/20">
                    <svg class="h-10 w-10" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                        <path d="M12 3L5 6V11C5 15.418 7.985 19.455 12 21C16.015 19.455 19 15.418 19 11V6L12 3Z"
                            stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </div>
                <h3 class="mt-6 text-2xl font-bold text-slate-900">Sécurité</h3>
                <p class="mt-4 text-lg leading-8 text-slate-600">
                    Messagerie interne sécurisée, modération des annonces et vérification d'identité pour éviter les
                    fraudes.
                </p>
            </article>
        </div>
    </section>

    <section class="relative left-1/2 mt-24 w-screen -translate-x-1/2 px-4 sm:px-6 lg:px-8">
        <div
            class="mx-auto max-w-[88rem] rounded-[2.5rem] border border-slate-200 bg-slate-100 p-8 shadow-sm sm:p-12 lg:p-16">
            <div class="grid gap-12 lg:grid-cols-[0.9fr_1.1fr] lg:items-start lg:gap-14 xl:grid-cols-[0.85fr_1.15fr]">
                <div>
                    <h2 class="text-4xl font-extrabold leading-tight tracking-tight text-slate-900 sm:text-5xl">
                        Une communauté active<br class="hidden sm:block"> pour vous aider
                    </h2>
                    <p class="mt-6 text-lg leading-9 text-slate-600 sm:text-xl sm:leading-10 lg:text-[2.05rem] lg:leading-[3.15rem]">
                        Des milliers d'utilisateurs utilisent BusLost&Found chaque jour pour retrouver leurs objets perdus ou
                        aider d'autres personnes.
                    </p>

                    <div class="mt-10 grid gap-5 sm:grid-cols-2">
                        <article class="rounded-3xl border border-slate-200 bg-white p-8 shadow-[0_8px_22px_rgba(15,23,42,0.07)]">
                            <p class="text-5xl font-black tracking-tight text-blue-600 sm:text-6xl">2,500+</p>
                            <p class="mt-3 text-2xl font-semibold text-slate-800">Objets retrouvés</p>
                        </article>
                        <article class="rounded-3xl border border-slate-200 bg-white p-8 shadow-[0_8px_22px_rgba(15,23,42,0.07)]">
                            <p class="text-5xl font-black tracking-tight text-emerald-600 sm:text-6xl">5,000+</p>
                            <p class="mt-3 text-2xl font-semibold text-slate-800">Utilisateurs actifs</p>
                        </article>
                        <article class="rounded-3xl border border-slate-200 bg-white p-8 shadow-[0_8px_22px_rgba(15,23,42,0.07)]">
                            <p class="text-5xl font-black tracking-tight text-violet-600 sm:text-6xl">85%</p>
                            <p class="mt-3 text-2xl font-semibold text-slate-800">Taux de réussite</p>
                        </article>
                        <article class="rounded-3xl border border-slate-200 bg-white p-8 shadow-[0_8px_22px_rgba(15,23,42,0.07)]">
                            <p class="text-5xl font-black tracking-tight text-orange-600 sm:text-6xl">24h</p>
                            <p class="mt-3 text-2xl font-semibold text-slate-800">Temps moyen</p>
                        </article>
                    </div>
                </div>

                <div class="space-y-5 lg:pl-2">
                    <article class="relative overflow-hidden rounded-3xl shadow-[0_16px_40px_rgba(15,23,42,0.2)]">
                        <img src="{{ asset('images/ui/home/community-main.jpg') }}" alt="Bus urbain dans la nuit"
                            class="aspect-[16/10] w-full object-cover sm:aspect-[5/3] lg:aspect-[4/3]">
                        <div class="absolute inset-0 bg-gradient-to-t from-slate-900/75 via-slate-900/15 to-transparent"></div>
                        <div class="absolute bottom-0 left-0 right-0 p-6">
                            <div class="inline-flex items-center gap-3 rounded-2xl bg-white/15 px-4 py-3 backdrop-blur-sm">
                                <span class="inline-flex h-9 w-9 items-center justify-center rounded-xl bg-white/20 text-white">
                                    <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                                        <path d="M8 16H5V9a7 7 0 1114 0v7h-3" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round" />
                                        <path d="M8 16a3 3 0 003 3h2a3 3 0 003-3" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                </span>
                                <div>
                                    <p class="text-[0.72rem] font-medium uppercase tracking-[0.18em] text-blue-100">Transport urbain</p>
                                    <p class="text-lg font-semibold text-white sm:text-2xl">Couverture complète du réseau</p>
                                </div>
                            </div>
                        </div>
                    </article>

                    <div class="grid gap-5 sm:grid-cols-2">
                        <figure class="overflow-hidden rounded-3xl shadow-[0_14px_32px_rgba(15,23,42,0.16)]">
                            <img src="{{ asset('images/ui/home/community-small-1.jpg') }}" alt="Bus au coucher du soleil"
                                class="aspect-[16/10] w-full object-cover">
                        </figure>
                        <figure class="overflow-hidden rounded-3xl shadow-[0_14px_32px_rgba(15,23,42,0.16)]">
                            <img src="{{ asset('images/ui/home/community-small-2.jpg') }}" alt="Bus dans une avenue urbaine"
                                class="aspect-[16/10] w-full object-cover">
                        </figure>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section
        class="relative left-1/2 mt-32 mb-1 w-screen -translate-x-1/2 overflow-hidden bg-gradient-to-br from-blue-600 via-blue-700 to-blue-900 sm:mt-36">
        <div class="absolute inset-0">
            <img src="{{ asset('images/ui/home/hero-bus.jpg') }}" alt="Bus en arrière-plan"
                class="h-full w-full object-cover opacity-15">
            <div class="absolute inset-0 bg-gradient-to-br from-blue-600/88 via-blue-700/90 to-blue-900/94"></div>
        </div>
        <div class="pointer-events-none absolute -left-20 top-6 h-64 w-64 rounded-full bg-blue-300/20 blur-3xl"></div>
        <div class="pointer-events-none absolute -right-16 bottom-0 h-64 w-64 rounded-full bg-cyan-300/20 blur-3xl"></div>

        <div
            class="relative mx-auto flex min-h-[48vh] w-full max-w-6xl flex-col items-center justify-center px-4 pb-12 pt-20 text-center sm:px-6 sm:pb-14 sm:pt-24 lg:px-8 lg:pb-16 lg:pt-28">
            <h2 class="text-4xl font-extrabold tracking-tight text-white sm:text-5xl lg:text-7xl">
                Prêt à retrouver vos objets perdus ?
            </h2>
            <p class="mx-auto mt-6 max-w-4xl text-lg leading-8 text-blue-100 sm:text-2xl sm:leading-10">
                Rejoignez notre communauté et augmentez vos chances de récupérer vos biens.
            </p>

            <div class="mt-10 flex justify-center">
                @guest
                    <a href="{{ route('register') }}"
                        class="inline-flex items-center justify-center gap-2 rounded-2xl bg-white px-8 py-4 text-lg font-semibold text-blue-700 shadow-[0_18px_35px_rgba(15,23,42,0.22)] transition hover:bg-blue-50 sm:text-xl">
                        <svg class="h-6 w-6" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                            <path
                                d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l.68 2.094a1 1 0 00.95.69h2.201c.969 0 1.371 1.24.588 1.81l-1.781 1.294a1 1 0 00-.364 1.118l.68 2.094c.3.922-.755 1.688-1.539 1.119L10.588 12.9a1 1 0 00-1.176 0l-1.78 1.295c-.784.57-1.838-.197-1.54-1.119l.68-2.094a1 1 0 00-.363-1.118L4.628 7.52c-.783-.57-.38-1.81.588-1.81h2.202a1 1 0 00.95-.69l.68-2.094z" />
                        </svg>
                        Créer un compte gratuitement
                    </a>
                @else
                    <a href="{{ route('dashboard') }}"
                        class="inline-flex items-center justify-center rounded-2xl bg-white px-8 py-4 text-lg font-semibold text-blue-700 shadow-[0_18px_35px_rgba(15,23,42,0.22)] transition hover:bg-blue-50 sm:text-xl">
                        Accéder à mon tableau de bord
                    </a>
                @endguest
            </div>
        </div>
    </section>
@endsection
