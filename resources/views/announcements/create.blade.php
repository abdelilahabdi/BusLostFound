@extends('layouts.app')

@section('title', 'BusLost&Found - Nouvelle annonce')

@section('content')
    <section class="rounded-xl bg-white p-8 shadow-sm ring-1 ring-slate-200 sm:p-10">
        <h1 class="text-2xl font-bold text-slate-900 sm:text-3xl">Publier une annonce</h1>
        <p class="mt-3 text-sm text-slate-600 sm:text-base">
            Remplissez ce formulaire pour declarer un objet perdu ou trouve.
        </p>

        <form method="POST" action="{{ route('announcements.store') }}" class="mt-8 space-y-6">
            @csrf
            @include('announcements.partials.form-fields', ['categories' => $categories, 'announcement' => null])

            <p class="text-sm text-slate-500">
                Le statut de l'annonce sera automatiquement defini sur "active".
            </p>

            <div class="flex flex-wrap items-center gap-3">
                <button
                    type="submit"
                    class="inline-flex items-center rounded-md bg-slate-900 px-4 py-2 text-sm font-semibold text-white hover:bg-slate-700"
                >
                    Enregistrer l'annonce
                </button>

                <a href="{{ route('dashboard') }}" class="inline-flex items-center rounded-md border border-slate-300 px-4 py-2 text-sm font-semibold text-slate-700 hover:bg-slate-100">
                    Annuler
                </a>
            </div>
        </form>
    </section>
@endsection
