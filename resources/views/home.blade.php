@extends('layouts.app')

@section('title', 'BusLost&Found - Accueil')

@section('content')
    <section class="rounded-xl bg-white p-8 shadow-sm ring-1 ring-slate-200 sm:p-12">
        <h1 class="max-w-3xl text-3xl font-bold tracking-tight text-slate-900 sm:text-4xl">
            La plateforme simple pour d&eacute;clarer et retrouver les objets perdus dans les bus urbains
        </h1>

        <p class="mt-4 max-w-2xl text-base leading-7 text-slate-600">
            BusLost&Found centralise les annonces d'objets perdus et trouv&eacute;s pour aider les passagers
            &agrave; retrouver leurs affaires rapidement, en toute confiance.
        </p>

        <div class="mt-8 flex flex-col gap-3 sm:flex-row">
            <a href="#" class="inline-flex items-center justify-center rounded-md bg-slate-900 px-5 py-3 text-sm font-semibold text-white hover:bg-slate-700">
                D&eacute;clarer un objet perdu
            </a>
            <a href="#" class="inline-flex items-center justify-center rounded-md border border-slate-300 bg-white px-5 py-3 text-sm font-semibold text-slate-700 hover:bg-slate-100">
                D&eacute;clarer un objet trouv&eacute;
            </a>
        </div>
    </section>

    <section class="mt-10">
        <h2 class="text-2xl font-bold text-slate-900">Comment &ccedil;a marche ?</h2>

        <div class="mt-6 grid gap-4 md:grid-cols-3">
            <article class="rounded-lg bg-white p-6 shadow-sm ring-1 ring-slate-200">
                <p class="text-sm font-semibold text-slate-500">&Eacute;tape 1</p>
                <h3 class="mt-2 text-lg font-semibold text-slate-900">Publier une annonce</h3>
                <p class="mt-2 text-sm leading-6 text-slate-600">
                    D&eacute;crivez l'objet perdu ou trouv&eacute; avec des informations claires.
                </p>
            </article>

            <article class="rounded-lg bg-white p-6 shadow-sm ring-1 ring-slate-200">
                <p class="text-sm font-semibold text-slate-500">&Eacute;tape 2</p>
                <h3 class="mt-2 text-lg font-semibold text-slate-900">Rechercher facilement</h3>
                <p class="mt-2 text-sm leading-6 text-slate-600">
                    Consultez les annonces avec des filtres simples pour gagner du temps.
                </p>
            </article>

            <article class="rounded-lg bg-white p-6 shadow-sm ring-1 ring-slate-200">
                <p class="text-sm font-semibold text-slate-500">&Eacute;tape 3</p>
                <h3 class="mt-2 text-lg font-semibold text-slate-900">Contacter en s&eacute;curit&eacute;</h3>
                <p class="mt-2 text-sm leading-6 text-slate-600">
                    &Eacute;changez via la plateforme pour organiser la r&eacute;cup&eacute;ration de l'objet.
                </p>
            </article>
        </div>
    </section>

    <section class="mt-10 mb-2">
        <h2 class="text-2xl font-bold text-slate-900">Nos avantages</h2>

        <div class="mt-6 grid gap-4 md:grid-cols-3">
            <article class="rounded-lg bg-white p-6 shadow-sm ring-1 ring-slate-200">
                <h3 class="text-lg font-semibold text-slate-900">Centralisation des annonces</h3>
                <p class="mt-2 text-sm leading-6 text-slate-600">
                    Toutes les d&eacute;clarations sont regroup&eacute;es dans un seul espace.
                </p>
            </article>

            <article class="rounded-lg bg-white p-6 shadow-sm ring-1 ring-slate-200">
                <h3 class="text-lg font-semibold text-slate-900">Gain de temps</h3>
                <p class="mt-2 text-sm leading-6 text-slate-600">
                    Recherche rapide et navigation claire pour agir sans perdre de temps.
                </p>
            </article>

            <article class="rounded-lg bg-white p-6 shadow-sm ring-1 ring-slate-200">
                <h3 class="text-lg font-semibold text-slate-900">Fiabilit&eacute; et s&eacute;curit&eacute;</h3>
                <p class="mt-2 text-sm leading-6 text-slate-600">
                    La plateforme met l'accent sur des &eacute;changes responsables et s&eacute;curis&eacute;s.
                </p>
            </article>
        </div>
    </section>
@endsection
