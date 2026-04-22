<header class="sticky top-0 z-50 border-b border-slate-200 bg-white/95 backdrop-blur shadow-[0_1px_3px_rgba(15,23,42,0.05)]">
    <nav class="mx-auto w-full max-w-[1440px] px-3 sm:px-8 lg:px-12" aria-label="Navigation principale">
        <div class="flex flex-wrap items-center gap-x-3 gap-y-2.5 py-3 sm:gap-x-4 sm:py-4">
            <a href="{{ route('home') }}"
                class="inline-flex shrink-0 items-center gap-2 text-lg font-extrabold tracking-tight text-blue-600 sm:gap-2.5 sm:text-2xl">
                <svg class="h-6 w-6 sm:h-8 sm:w-8" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                    <path d="M7 16H5.5C4.672 16 4 15.328 4 14.5V8.5C4 5.462 6.462 3 9.5 3H14.5C17.538 3 20 5.462 20 8.5V14.5C20 15.328 19.328 16 18.5 16H17"
                        stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" />
                    <path d="M4 10H20" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" />
                    <path d="M7 16V19" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" />
                    <path d="M17 16V19" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" />
                    <circle cx="8" cy="13" r="1.1" fill="currentColor" />
                    <circle cx="16" cy="13" r="1.1" fill="currentColor" />
                </svg>
                <span>BusLost&Found</span>
            </a>

            @auth
                @php
                    $unreadMessagesCount = \App\Models\Message::query()
                        ->where('receiver_id', auth()->id())
                        ->where('is_read', false)
                        ->count();
                @endphp
            @endauth

            <ul class="flex w-full flex-wrap items-center justify-end gap-x-1 gap-y-2 text-sm font-medium sm:ml-auto sm:w-auto sm:gap-x-2.5 sm:gap-y-0 sm:text-base">
                @auth
                    <li>
                        <a href="{{ route('home') }}"
                            class="rounded-xl px-3 py-2 text-slate-700 transition hover:bg-slate-100 hover:text-slate-900 {{ request()->routeIs('home') ? 'bg-blue-50 text-blue-700' : '' }}">
                            Accueil
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('announcements.index') }}"
                            class="rounded-xl px-3 py-2 text-slate-700 transition hover:bg-slate-100 hover:text-slate-900 {{ request()->routeIs('announcements.*') ? 'bg-blue-50 text-blue-700' : '' }}">
                            Rechercher
                        </a>
                    </li>
                    @if (auth()->user()->role === 'admin')
                        <li>
                            <a href="{{ route('admin.dashboard') }}"
                                class="rounded-xl px-3 py-2 text-slate-700 transition hover:bg-slate-100 hover:text-slate-900 {{ request()->routeIs('admin.*') ? 'bg-blue-50 text-blue-700' : '' }}">
                                Admin
                            </a>
                        </li>
                    @endif
                    <li>
                        <a href="{{ route('dashboard') }}"
                            class="rounded-xl px-3 py-2 text-slate-700 transition hover:bg-slate-100 hover:text-slate-900 {{ request()->routeIs('dashboard') ? 'bg-blue-50 text-blue-700' : '' }}">
                            Tableau de bord
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('messages.index') }}"
                            class="inline-flex items-center gap-2 rounded-xl px-3 py-2 text-slate-700 transition hover:bg-slate-100 hover:text-slate-900 {{ request()->routeIs('messages.*') ? 'bg-blue-50 text-blue-700' : '' }}">
                            Messages
                            @if ($unreadMessagesCount > 0)
                                <span
                                    class="inline-flex min-w-5 items-center justify-center rounded-full bg-blue-100 px-1.5 py-0.5 text-xs font-semibold text-blue-700">
                                    {{ $unreadMessagesCount > 99 ? '99+' : $unreadMessagesCount }}
                                </span>
                            @endif
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('profile.edit') }}"
                            class="rounded-xl px-3 py-2 text-slate-700 transition hover:bg-slate-100 hover:text-slate-900 {{ request()->routeIs('profile.*') ? 'bg-blue-50 text-blue-700' : '' }}">
                            Profil
                        </a>
                    </li>
                    <li>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit"
                                class="rounded-2xl px-4 py-2 text-slate-700 transition hover:bg-slate-100 hover:text-slate-900">
                                Déconnexion
                            </button>
                        </form>
                    </li>
                @else
                    <li>
                        <a href="{{ route('announcements.index') }}"
                            class="rounded-xl px-3 py-2 text-slate-700 transition hover:bg-slate-100 hover:text-slate-900 {{ request()->routeIs('announcements.*') ? 'bg-blue-50 text-blue-700' : '' }}">
                            Rechercher
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('login') }}"
                            class="rounded-xl px-3 py-2 text-slate-700 transition hover:bg-slate-100 hover:text-slate-900 {{ request()->routeIs('login') ? 'bg-blue-50 text-blue-700' : '' }}">
                            Connexion
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('register') }}"
                            class="rounded-2xl bg-blue-600 px-7 py-2.5 text-white shadow-[0_8px_16px_rgba(37,99,235,0.22)] transition hover:bg-blue-700 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-blue-300">
                            S'inscrire
                        </a>
                    </li>
                @endauth
            </ul>
        </div>
    </nav>
</header>
