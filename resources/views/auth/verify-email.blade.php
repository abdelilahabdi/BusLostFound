<x-guest-layout>
    <div class="space-y-7 sm:space-y-8">
        <div class="text-center">
            <div class="mx-auto inline-flex h-16 w-16 items-center justify-center rounded-2xl bg-blue-100 text-blue-600 ring-1 ring-blue-200/70">
                <svg class="h-7 w-7" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                    <path d="M4 7.5A2.5 2.5 0 016.5 5h11A2.5 2.5 0 0120 7.5v9a2.5 2.5 0 01-2.5 2.5h-11A2.5 2.5 0 014 16.5v-9z" stroke="currentColor" stroke-width="1.8" />
                    <path d="M7 10.5l3.2 2.4a3 3 0 003.6 0L17 10.5" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
            </div>
            <h1 class="mt-5 text-2xl font-bold tracking-tight text-slate-900 sm:text-3xl">V&eacute;rification de l'e-mail</h1>
            <p class="mx-auto mt-2 max-w-md text-sm text-slate-600">
                Merci pour votre inscription. V&eacute;rifiez votre adresse e-mail via le lien que nous venons de vous envoyer.
                Si vous ne l'avez pas re&ccedil;u, vous pouvez demander un nouvel envoi.
            </p>
        </div>

        @if (session('status') == 'verification-link-sent')
            <div class="rounded-2xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm font-medium text-emerald-700">
                Un nouveau lien de v&eacute;rification a &eacute;t&eacute; envoy&eacute; &agrave; votre adresse e-mail.
            </div>
        @endif

        <div class="flex flex-wrap items-center justify-between gap-3 pt-1.5">
            <form method="POST" action="{{ route('verification.send') }}">
                @csrf

                <button type="submit" class="inline-flex h-11 items-center justify-center rounded-2xl bg-blue-600 px-5 text-sm font-semibold text-white shadow-[0_8px_18px_rgba(37,99,235,0.22)] transition hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-300 focus:ring-offset-2">
                    Renvoyer l'e-mail de v&eacute;rification
                </button>
            </form>

            <form method="POST" action="{{ route('logout') }}">
                @csrf

                <button type="submit" class="text-sm font-medium text-slate-600 underline-offset-4 transition hover:text-slate-900 hover:underline focus:outline-none focus:ring-2 focus:ring-blue-300 focus:ring-offset-2 rounded-md">
                    D&eacute;connexion
                </button>
            </form>
        </div>
    </div>
</x-guest-layout>
