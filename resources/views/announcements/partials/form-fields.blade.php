@php
    $announcement = $announcement ?? null;
    $selectedType = old('type', $announcement?->type ?? request('type') ?? 'lost');
@endphp

<div class="space-y-7">
    <section class="rounded-2xl border border-slate-200 bg-slate-50/70 p-5 sm:p-6">
        <h2 class="text-sm font-semibold uppercase tracking-wide text-slate-900">Informations principales</h2>
        <p class="mt-1 text-sm text-slate-600">Renseignez les d&eacute;tails essentiels de votre annonce.</p>

        <div class="mt-5 grid gap-5 md:grid-cols-2">
            <div class="md:col-span-2">
                <label for="title" class="block text-sm font-semibold text-slate-700">Titre</label>
                <input
                    id="title"
                    name="title"
                    type="text"
                    value="{{ old('title', $announcement?->title) }}"
                    required
                    maxlength="255"
                    class="mt-1 block h-12 w-full rounded-2xl border-slate-300 bg-white px-4 text-slate-900 focus:border-blue-500 focus:ring-blue-500"
                >
                @error('title')
                    <p class="mt-2 inline-flex items-center rounded-xl bg-red-50 px-3 py-1.5 text-xs font-semibold text-red-700">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="category_id" class="block text-sm font-semibold text-slate-700">Cat&eacute;gorie</label>
                <select
                    id="category_id"
                    name="category_id"
                    required
                    class="mt-1 block h-12 w-full rounded-2xl border-slate-300 bg-white px-4 text-slate-900 focus:border-blue-500 focus:ring-blue-500"
                >
                    <option value="">S&eacute;lectionnez une cat&eacute;gorie</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" @selected((string) old('category_id', $announcement?->category_id) === (string) $category->id)>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
                @error('category_id')
                    <p class="mt-2 inline-flex items-center rounded-xl bg-red-50 px-3 py-1.5 text-xs font-semibold text-red-700">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <p class="block text-sm font-semibold text-slate-700">Type</p>
                <div class="mt-2 grid gap-3 sm:grid-cols-2">
                    <label class="inline-flex items-center gap-3 rounded-2xl border px-4 py-3 text-sm transition {{ $selectedType === 'lost' ? 'border-blue-400 bg-blue-50 text-blue-700 ring-2 ring-blue-100' : 'border-slate-300 bg-white text-slate-700 hover:border-slate-400' }}">
                        <input
                            type="radio"
                            name="type"
                            value="lost"
                            @checked($selectedType === 'lost')
                            class="h-4 w-4 border-slate-300 text-blue-600 focus:ring-blue-500"
                        >
                        Objet perdu
                    </label>

                    <label class="inline-flex items-center gap-3 rounded-2xl border px-4 py-3 text-sm transition {{ $selectedType === 'found' ? 'border-blue-400 bg-blue-50 text-blue-700 ring-2 ring-blue-100' : 'border-slate-300 bg-white text-slate-700 hover:border-slate-400' }}">
                        <input
                            type="radio"
                            name="type"
                            value="found"
                            @checked($selectedType === 'found')
                            class="h-4 w-4 border-slate-300 text-blue-600 focus:ring-blue-500"
                        >
                        Objet trouv&eacute;
                    </label>
                </div>
                @error('type')
                    <p class="mt-2 inline-flex items-center rounded-xl bg-red-50 px-3 py-1.5 text-xs font-semibold text-red-700">{{ $message }}</p>
                @enderror
            </div>

            <div class="md:col-span-2">
                <label for="description" class="block text-sm font-semibold text-slate-700">Description</label>
                <textarea
                    id="description"
                    name="description"
                    rows="5"
                    required
                    class="mt-1 block w-full rounded-2xl border-slate-300 bg-white px-4 py-3 text-slate-900 focus:border-blue-500 focus:ring-blue-500"
                >{{ old('description', $announcement?->description) }}</textarea>
                @error('description')
                    <p class="mt-2 inline-flex items-center rounded-xl bg-red-50 px-3 py-1.5 text-xs font-semibold text-red-700">{{ $message }}</p>
                @enderror
            </div>
        </div>
    </section>

    <section class="rounded-2xl border border-slate-200 bg-white p-5 sm:p-6">
        <h2 class="text-sm font-semibold uppercase tracking-wide text-slate-900">Localisation et contexte</h2>
        <p class="mt-1 text-sm text-slate-600">Ajoutez les informations de lieu et de date pour faciliter l'identification.</p>

        <div class="mt-5 grid gap-5 md:grid-cols-2">
            <div>
                <label for="location" class="block text-sm font-semibold text-slate-700">Lieu</label>
                <input
                    id="location"
                    name="location"
                    type="text"
                    value="{{ old('location', $announcement?->location) }}"
                    required
                    maxlength="255"
                    class="mt-1 block h-12 w-full rounded-2xl border-slate-300 bg-white px-4 text-slate-900 focus:border-blue-500 focus:ring-blue-500"
                >
                @error('location')
                    <p class="mt-2 inline-flex items-center rounded-xl bg-red-50 px-3 py-1.5 text-xs font-semibold text-red-700">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="event_date" class="block text-sm font-semibold text-slate-700">Date de l'&eacute;v&eacute;nement</label>
                <input
                    id="event_date"
                    name="event_date"
                    type="date"
                    value="{{ old('event_date', $announcement?->event_date?->format('Y-m-d')) }}"
                    required
                    class="mt-1 block h-12 w-full rounded-2xl border-slate-300 bg-white px-4 text-slate-900 focus:border-blue-500 focus:ring-blue-500"
                >
                @error('event_date')
                    <p class="mt-2 inline-flex items-center rounded-xl bg-red-50 px-3 py-1.5 text-xs font-semibold text-red-700">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="bus_line" class="block text-sm font-semibold text-slate-700">Ligne de bus (optionnel)</label>
                <input
                    id="bus_line"
                    name="bus_line"
                    type="text"
                    value="{{ old('bus_line', $announcement?->bus_line) }}"
                    maxlength="255"
                    class="mt-1 block h-12 w-full rounded-2xl border-slate-300 bg-white px-4 text-slate-900 focus:border-blue-500 focus:ring-blue-500"
                >
                @error('bus_line')
                    <p class="mt-2 inline-flex items-center rounded-xl bg-red-50 px-3 py-1.5 text-xs font-semibold text-red-700">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="stop_name" class="block text-sm font-semibold text-slate-700">Arr&ecirc;t (optionnel)</label>
                <input
                    id="stop_name"
                    name="stop_name"
                    type="text"
                    value="{{ old('stop_name', $announcement?->stop_name) }}"
                    maxlength="255"
                    class="mt-1 block h-12 w-full rounded-2xl border-slate-300 bg-white px-4 text-slate-900 focus:border-blue-500 focus:ring-blue-500"
                >
                @error('stop_name')
                    <p class="mt-2 inline-flex items-center rounded-xl bg-red-50 px-3 py-1.5 text-xs font-semibold text-red-700">{{ $message }}</p>
                @enderror
            </div>
        </div>
    </section>
</div>
