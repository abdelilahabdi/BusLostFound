<x-guest-layout>
    <div class="space-y-7 sm:space-y-8">
        <div class="text-center">
            <div class="mx-auto inline-flex h-16 w-16 items-center justify-center rounded-2xl bg-blue-100 text-blue-600 ring-1 ring-blue-200/70">
                <svg class="h-7 w-7" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                    <path d="M7 16H5.5C4.672 16 4 15.328 4 14.5V8.5C4 5.462 6.462 3 9.5 3H14.5C17.538 3 20 5.462 20 8.5V14.5C20 15.328 19.328 16 18.5 16H17"
                        stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" />
                    <path d="M4 10H20" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" />
                    <circle cx="8" cy="13" r="1.1" fill="currentColor" />
                    <circle cx="16" cy="13" r="1.1" fill="currentColor" />
                </svg>
            </div>
            <h1 class="mt-5 text-2xl font-bold tracking-tight text-slate-900 sm:text-3xl">Nouveau mot de passe</h1>
            <p class="mx-auto mt-2 max-w-sm text-sm text-slate-600">
                Choisissez un nouveau mot de passe sécurisé pour votre compte.
            </p>
        </div>

        <form method="POST" action="{{ route('password.store') }}" class="space-y-5 sm:space-y-6">
            @csrf

            <input type="hidden" name="token" value="{{ $request->route('token') }}">

            <div>
                <x-input-label for="email" class="mb-1.5 text-sm font-semibold text-slate-700" :value="'Adresse e-mail'" />
                <x-text-input id="email" class="block w-full rounded-2xl border-slate-300 px-4 py-2.5 text-sm text-slate-800 shadow-sm focus:border-blue-500 focus:ring-blue-100" type="email" name="email" :value="old('email', $request->email)" required autofocus autocomplete="username" />
                <x-input-error :messages="$errors->get('email')" class="mt-2 text-xs font-medium text-red-600" />
            </div>

            <div>
                <x-input-label for="password" class="mb-1.5 text-sm font-semibold text-slate-700" :value="'Mot de passe'" />
                <x-text-input id="password" class="block w-full rounded-2xl border-slate-300 px-4 py-2.5 text-sm text-slate-800 shadow-sm focus:border-blue-500 focus:ring-blue-100" type="password" name="password" required autocomplete="new-password" />
                <x-input-error :messages="$errors->get('password')" class="mt-2 text-xs font-medium text-red-600" />
            </div>

            <div>
                <x-input-label for="password_confirmation" class="mb-1.5 text-sm font-semibold text-slate-700" :value="'Confirmer le mot de passe'" />
                <x-text-input id="password_confirmation" class="block w-full rounded-2xl border-slate-300 px-4 py-2.5 text-sm text-slate-800 shadow-sm focus:border-blue-500 focus:ring-blue-100"
                    type="password"
                    name="password_confirmation" required autocomplete="new-password" />
                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2 text-xs font-medium text-red-600" />
            </div>

            <div class="flex justify-end pt-1.5">
                <button type="submit" class="inline-flex h-11 items-center justify-center rounded-2xl bg-blue-600 px-5 text-sm font-semibold text-white shadow-[0_8px_18px_rgba(37,99,235,0.22)] transition hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-300 focus:ring-offset-2">
                    Réinitialiser le mot de passe
                </button>
            </div>
        </form>
    </div>
</x-guest-layout>
