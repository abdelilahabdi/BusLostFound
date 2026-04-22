<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'BusLost&Found - Administration')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-slate-100 text-slate-800">
    <div class="border-b border-slate-800 bg-slate-950 text-slate-200 lg:hidden">
        <div class="p-5 sm:p-6">
            <a href="{{ route('admin.dashboard') }}" class="inline-flex items-center gap-2 text-lg font-bold text-white">
                <svg class="h-6 w-6 text-blue-400" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                    <path d="M4 7.5A2.5 2.5 0 016.5 5h11A2.5 2.5 0 0120 7.5v9a2.5 2.5 0 01-2.5 2.5h-11A2.5 2.5 0 014 16.5v-9z" stroke="currentColor" stroke-width="1.8" />
                    <path d="M8 10h8M8 13h5" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" />
                </svg>
                BusLost&Found Admin
            </a>

            <div class="mt-6 rounded-2xl border border-slate-800 bg-slate-900/70 p-4">
                <p class="text-xs font-semibold uppercase tracking-wide text-slate-400">Administrateur</p>
                <p class="mt-1 text-sm font-semibold text-white">{{ auth()->user()->name }}</p>
                <p class="mt-1 text-xs text-slate-400">{{ auth()->user()->email }}</p>
            </div>

            <nav class="mt-8 space-y-1.5" aria-label="Navigation administrateur mobile">
                <a
                    href="{{ route('admin.dashboard') }}"
                    class="flex items-center rounded-2xl px-3 py-2.5 text-sm font-semibold transition {{ request()->routeIs('admin.dashboard') ? 'bg-blue-600 text-white' : 'text-slate-300 hover:bg-slate-900 hover:text-white' }}"
                >
                    Tableau de bord
                </a>
                <a
                    href="{{ route('admin.users.index') }}"
                    class="flex items-center rounded-2xl px-3 py-2.5 text-sm font-semibold transition {{ request()->routeIs('admin.users.*') ? 'bg-teal-600 text-white' : 'text-slate-300 hover:bg-slate-900 hover:text-white' }}"
                >
                    Utilisateurs
                </a>
                <a
                    href="{{ route('admin.announcements.index') }}"
                    class="flex items-center rounded-2xl px-3 py-2.5 text-sm font-semibold transition {{ request()->routeIs('admin.announcements.*') ? 'bg-teal-600 text-white' : 'text-slate-300 hover:bg-slate-900 hover:text-white' }}"
                >
                    Annonces
                </a>
                <a
                    href="{{ route('admin.reports.index') }}"
                    class="flex items-center rounded-2xl px-3 py-2.5 text-sm font-semibold transition {{ request()->routeIs('admin.reports.*') ? 'bg-teal-600 text-white' : 'text-slate-300 hover:bg-slate-900 hover:text-white' }}"
                >
                    Signalements
                </a>
                <a
                    href="{{ route('home') }}"
                    class="flex items-center rounded-2xl px-3 py-2.5 text-sm font-semibold text-slate-300 transition hover:bg-slate-900 hover:text-white"
                >
                    Retour au site
                </a>
            </nav>

            <form method="POST" action="{{ route('logout') }}" class="mt-8">
                @csrf
                <button
                    type="submit"
                    class="inline-flex h-11 w-full items-center justify-center rounded-2xl border border-red-500/40 bg-red-500/10 px-4 text-sm font-semibold text-red-300 transition hover:bg-red-500/20 hover:text-red-200"
                >
                    Déconnexion
                </button>
            </form>
        </div>
    </div>

    <aside class="hidden lg:fixed lg:inset-y-0 lg:left-0 lg:z-40 lg:flex lg:w-72 lg:flex-col lg:overflow-y-auto lg:border-r lg:border-slate-800 lg:bg-slate-950 lg:text-slate-200">
        <div class="flex min-h-full flex-col p-6">
            <a href="{{ route('admin.dashboard') }}" class="inline-flex items-center gap-2 text-lg font-bold text-white">
                <svg class="h-6 w-6 text-blue-400" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                    <path d="M4 7.5A2.5 2.5 0 016.5 5h11A2.5 2.5 0 0120 7.5v9a2.5 2.5 0 01-2.5 2.5h-11A2.5 2.5 0 014 16.5v-9z" stroke="currentColor" stroke-width="1.8" />
                    <path d="M8 10h8M8 13h5" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" />
                </svg>
                BusLost&Found Admin
            </a>

            <div class="mt-6 rounded-2xl border border-slate-800 bg-slate-900/70 p-4">
                <p class="text-xs font-semibold uppercase tracking-wide text-slate-400">Administrateur</p>
                <p class="mt-1 text-sm font-semibold text-white">{{ auth()->user()->name }}</p>
                <p class="mt-1 text-xs text-slate-400">{{ auth()->user()->email }}</p>
            </div>

            <nav class="mt-8 space-y-1.5" aria-label="Navigation administrateur">
                <a
                    href="{{ route('admin.dashboard') }}"
                    class="flex items-center rounded-2xl px-3 py-2.5 text-sm font-semibold transition {{ request()->routeIs('admin.dashboard') ? 'bg-blue-600 text-white' : 'text-slate-300 hover:bg-slate-900 hover:text-white' }}"
                >
                    Tableau de bord
                </a>
                <a
                    href="{{ route('admin.users.index') }}"
                    class="flex items-center rounded-2xl px-3 py-2.5 text-sm font-semibold transition {{ request()->routeIs('admin.users.*') ? 'bg-teal-600 text-white' : 'text-slate-300 hover:bg-slate-900 hover:text-white' }}"
                >
                    Utilisateurs
                </a>
                <a
                    href="{{ route('admin.announcements.index') }}"
                    class="flex items-center rounded-2xl px-3 py-2.5 text-sm font-semibold transition {{ request()->routeIs('admin.announcements.*') ? 'bg-teal-600 text-white' : 'text-slate-300 hover:bg-slate-900 hover:text-white' }}"
                >
                    Annonces
                </a>
                <a
                    href="{{ route('admin.reports.index') }}"
                    class="flex items-center rounded-2xl px-3 py-2.5 text-sm font-semibold transition {{ request()->routeIs('admin.reports.*') ? 'bg-teal-600 text-white' : 'text-slate-300 hover:bg-slate-900 hover:text-white' }}"
                >
                    Signalements
                </a>
                <a
                    href="{{ route('home') }}"
                    class="flex items-center rounded-2xl px-3 py-2.5 text-sm font-semibold text-slate-300 transition hover:bg-slate-900 hover:text-white"
                >
                    Retour au site
                </a>
            </nav>

            <form method="POST" action="{{ route('logout') }}" class="mt-8 pt-6 lg:mt-auto">
                @csrf
                <button
                    type="submit"
                    class="inline-flex h-11 w-full items-center justify-center rounded-2xl border border-red-500/40 bg-red-500/10 px-4 text-sm font-semibold text-red-300 transition hover:bg-red-500/20 hover:text-red-200"
                >
                    Déconnexion
                </button>
            </form>
        </div>
    </aside>

    <div class="min-h-screen lg:pl-72">
        <header class="border-b border-slate-200 bg-white/90 backdrop-blur">
            <div class="mx-auto w-full max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
                <div class="flex flex-wrap items-start justify-between gap-4">
                    <div class="max-w-3xl">
                        <p class="text-xs font-semibold uppercase tracking-wide text-slate-500">Gestion</p>
                        <h1 class="mt-1 text-2xl font-bold tracking-tight text-slate-900 sm:text-3xl">
                            @yield('admin-page-title', 'Tableau de bord administrateur')
                        </h1>
                        <p class="mt-2 text-sm text-slate-600 sm:text-base">
                            @yield('admin-page-subtitle', 'Vue d\'ensemble des activités de la plateforme.')
                        </p>
                    </div>

                    <div class="flex flex-wrap items-center gap-2">
                        @yield('admin-page-actions')
                    </div>
                </div>
            </div>
        </header>

        <main class="px-4 py-6 sm:px-6 lg:px-8">
            <div class="mx-auto w-full max-w-7xl space-y-6">
                @if (session('success'))
                    <div class="rounded-2xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm text-emerald-700">
                        {{ session('success') }}
                    </div>
                @endif

                @if (session('error'))
                    <div class="rounded-2xl border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-700">
                        {{ session('error') }}
                    </div>
                @endif

                @if (session('status'))
                    <div class="rounded-2xl border border-sky-200 bg-sky-50 px-4 py-3 text-sm text-sky-700">
                        {{ session('status') }}
                    </div>
                @endif

                @if ($errors->any())
                    <div class="rounded-2xl border border-amber-200 bg-amber-50 px-4 py-3 text-sm text-amber-800">
                        <p class="font-semibold">Veuillez corriger les erreurs suivantes :</p>
                        <ul class="mt-2 list-disc pl-5">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @yield('admin-content')
            </div>
        </main>
    </div>
</body>
</html>
