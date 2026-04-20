@extends('layouts.app')

@section('title', 'BusLost&Found - Nouvelle annonce')

@section('content')
    <section class="rounded-3xl bg-slate-50/70 p-6 ring-1 ring-slate-200 sm:p-10">
        <div class="mx-auto max-w-5xl">
            <h1 class="text-3xl font-bold tracking-tight text-slate-900 sm:text-5xl">Publier une annonce</h1>
            <p class="mt-3 text-base text-slate-600 sm:text-lg">
                Renseignez les informations utiles pour d&eacute;clarer un objet perdu ou trouv&eacute;.
            </p>
        </div>
    </section>

    <section class="mt-8 rounded-3xl border border-slate-200 bg-white p-6 shadow-[0_10px_30px_rgba(15,23,42,0.06)] sm:p-8">
        <form method="POST" action="{{ route('announcements.store') }}" class="space-y-8">
            @csrf
            @include('announcements.partials.form-fields', ['categories' => $categories, 'announcement' => null])

            <p class="rounded-2xl border border-blue-100 bg-blue-50 px-4 py-3 text-sm text-blue-700">
                Le statut de l'annonce sera automatiquement d&eacute;fini sur &laquo; active &raquo;.
            </p>

            <div class="flex flex-wrap items-center gap-3 border-t border-slate-100 pt-6">
                <button
                    type="submit"
                    class="inline-flex h-11 items-center justify-center rounded-2xl bg-blue-600 px-5 text-sm font-semibold text-white shadow-sm transition hover:bg-blue-700 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-blue-300"
                >
                    Enregistrer l'annonce
                </button>

                <a href="{{ route('dashboard') }}" class="inline-flex h-11 items-center justify-center rounded-2xl border border-slate-300 bg-white px-5 text-sm font-semibold text-slate-700 transition hover:bg-slate-100 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-slate-300">
                    Annuler
                </a>
            </div>
        </form>
    </section>
@endsection
