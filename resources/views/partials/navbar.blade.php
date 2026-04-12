<header class="border-b border-slate-200 bg-white">
    <nav class="mx-auto w-full max-w-6xl px-4 sm:px-6 lg:px-8" aria-label="Navigation principale">
        <div class="flex flex-col gap-3 py-4 sm:h-16 sm:flex-row sm:items-center sm:justify-between sm:py-0">
            <a href="{{ route('home') }}" class="text-xl font-bold text-slate-900">
                BusLost&Found
            </a>

            <ul class="flex flex-wrap items-center gap-2 text-sm font-medium text-slate-700 sm:gap-4">
                <li>
                    <a href="{{ route('home') }}" class="rounded-md px-3 py-2 hover:bg-slate-100 hover:text-slate-900">
                        Accueil
                    </a>
                </li>
                <li>
                    <a href="{{ route('announcements.index') }}" class="rounded-md px-3 py-2 hover:bg-slate-100 hover:text-slate-900">
                        Annonces
                    </a>
                </li>
                @auth
                    @if (auth()->user()->role === 'admin')
                        <li>
                            <a href="{{ route('admin.dashboard') }}" class="rounded-md px-3 py-2 hover:bg-slate-100 hover:text-slate-900">
                                Admin
                            </a>
                        </li>
                    @endif
                    <li>
                        <a href="{{ route('dashboard') }}" class="rounded-md px-3 py-2 hover:bg-slate-100 hover:text-slate-900">
                            Tableau de bord
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('messages.index') }}" class="rounded-md px-3 py-2 hover:bg-slate-100 hover:text-slate-900">
                            Messages
                        </a>
                    </li>
                    <li>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="rounded-md bg-slate-900 px-3 py-2 text-white hover:bg-slate-700">
                                D&eacute;connexion
                            </button>
                        </form>
                    </li>
                @else
                    <li>
                        <a href="{{ route('login') }}" class="rounded-md px-3 py-2 hover:bg-slate-100 hover:text-slate-900">
                            Connexion
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('register') }}" class="rounded-md bg-slate-900 px-3 py-2 text-white hover:bg-slate-700">
                            Inscription
                        </a>
                    </li>
                @endauth
            </ul>
        </div>
    </nav>
</header>
