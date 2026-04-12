@extends('layouts.app')

@section('title', 'BusLost&Found - Modifier annonce')

@section('content')
    <section class="rounded-xl bg-white p-8 shadow-sm ring-1 ring-slate-200 sm:p-10">
        <h1 class="text-2xl font-bold text-slate-900 sm:text-3xl">Modifier mon annonce</h1>
        <p class="mt-3 text-sm text-slate-600 sm:text-base">
            Mettez a jour les informations de votre annonce.
        </p>

        <form method="POST" action="{{ route('announcements.update', $announcement) }}" class="mt-8 space-y-6">
            @csrf
            @method('PUT')

            @include('announcements.partials.form-fields', ['categories' => $categories, 'announcement' => $announcement])

            <div class="flex flex-wrap items-center gap-3">
                <button
                    type="submit"
                    class="inline-flex items-center rounded-md bg-slate-900 px-4 py-2 text-sm font-semibold text-white hover:bg-slate-700"
                >
                    Enregistrer les modifications
                </button>

                <a href="{{ route('announcements.my') }}" class="inline-flex items-center rounded-md border border-slate-300 px-4 py-2 text-sm font-semibold text-slate-700 hover:bg-slate-100">
                    Annuler
                </a>
            </div>
        </form>
    </section>
@endsection
