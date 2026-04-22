<x-guest-layout>
    <div class="space-y-7 sm:space-y-8">
        <div class="text-center">
            <div class="mx-auto inline-flex h-16 w-16 items-center justify-center rounded-2xl bg-blue-100 text-blue-600 ring-1 ring-blue-200/70">
                <svg class="h-7 w-7" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                    <path d="M8 11V8a4 4 0 118 0v3M7 11h10a1 1 0 011 1v7a1 1 0 01-1 1H7a1 1 0 01-1-1v-7a1 1 0 011-1z"
                        stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
            </div>
            <h1 class="mt-5 text-2xl font-bold tracking-tight text-slate-900 sm:text-3xl">Confirmer votre mot de passe</h1>
            <p class="mx-auto mt-2 max-w-sm text-sm text-slate-600">
                Cette zone est sécurisée. Merci de confirmer votre mot de passe pour continuer.
            </p>
        </div>

        <form method="POST" action="{{ route('password.confirm') }}" class="space-y-5 sm:space-y-6">
            @csrf

            <div>
                <x-input-label for="password" class="mb-1.5 text-sm font-semibold text-slate-700" :value="'Mot de passe'" />
                <x-text-input id="password" class="block w-full rounded-2xl border-slate-300 px-4 py-2.5 text-sm text-slate-800 shadow-sm focus:border-blue-500 focus:ring-blue-100"
                    type="password"
                    name="password"
                    required autocomplete="current-password" />
                <x-input-error :messages="$errors->get('password')" class="mt-2 text-xs font-medium text-red-600" />
            </div>

            <div class="flex justify-end pt-1.5">
                <button type="submit" class="inline-flex h-11 items-center justify-center rounded-2xl bg-blue-600 px-5 text-sm font-semibold text-white shadow-[0_8px_18px_rgba(37,99,235,0.22)] transition hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-300 focus:ring-offset-2">
                    Confirmer
                </button>
            </div>
        </form>
    </div>
</x-guest-layout>
