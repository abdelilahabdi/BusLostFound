@php
    $announcement = $announcement ?? null;
@endphp

<div class="grid gap-6 md:grid-cols-2">
    <div class="md:col-span-2">
        <label for="title" class="block text-sm font-medium text-slate-700">Titre</label>
        <input
            id="title"
            name="title"
            type="text"
            value="{{ old('title', $announcement?->title) }}"
            required
            maxlength="255"
            class="mt-1 block w-full rounded-md border-slate-300 text-slate-900 focus:border-slate-500 focus:ring-slate-500"
        >
        @error('title')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label for="category_id" class="block text-sm font-medium text-slate-700">Categorie</label>
        <select
            id="category_id"
            name="category_id"
            required
            class="mt-1 block w-full rounded-md border-slate-300 text-slate-900 focus:border-slate-500 focus:ring-slate-500"
        >
            <option value="">Selectionnez une categorie</option>
            @foreach ($categories as $category)
                <option value="{{ $category->id }}" @selected((string) old('category_id', $announcement?->category_id) === (string) $category->id)>
                    {{ $category->name }}
                </option>
            @endforeach
        </select>
        @error('category_id')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <p class="block text-sm font-medium text-slate-700">Type</p>
        <div class="mt-2 flex flex-wrap gap-4">
            <label class="inline-flex items-center gap-2 text-sm text-slate-700">
                <input
                    type="radio"
                    name="type"
                    value="lost"
                    @checked(old('type', $announcement?->type ?? 'lost') === 'lost')
                    class="border-slate-300 text-slate-900 focus:ring-slate-500"
                >
                Objet perdu
            </label>

            <label class="inline-flex items-center gap-2 text-sm text-slate-700">
                <input
                    type="radio"
                    name="type"
                    value="found"
                    @checked(old('type', $announcement?->type) === 'found')
                    class="border-slate-300 text-slate-900 focus:ring-slate-500"
                >
                Objet trouve
            </label>
        </div>
        @error('type')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <div class="md:col-span-2">
        <label for="description" class="block text-sm font-medium text-slate-700">Description</label>
        <textarea
            id="description"
            name="description"
            rows="5"
            required
            class="mt-1 block w-full rounded-md border-slate-300 text-slate-900 focus:border-slate-500 focus:ring-slate-500"
        >{{ old('description', $announcement?->description) }}</textarea>
        @error('description')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label for="location" class="block text-sm font-medium text-slate-700">Lieu</label>
        <input
            id="location"
            name="location"
            type="text"
            value="{{ old('location', $announcement?->location) }}"
            required
            maxlength="255"
            class="mt-1 block w-full rounded-md border-slate-300 text-slate-900 focus:border-slate-500 focus:ring-slate-500"
        >
        @error('location')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label for="event_date" class="block text-sm font-medium text-slate-700">Date de l'evenement</label>
        <input
            id="event_date"
            name="event_date"
            type="date"
            value="{{ old('event_date', $announcement?->event_date?->format('Y-m-d')) }}"
            required
            class="mt-1 block w-full rounded-md border-slate-300 text-slate-900 focus:border-slate-500 focus:ring-slate-500"
        >
        @error('event_date')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label for="bus_line" class="block text-sm font-medium text-slate-700">Ligne de bus (optionnel)</label>
        <input
            id="bus_line"
            name="bus_line"
            type="text"
            value="{{ old('bus_line', $announcement?->bus_line) }}"
            maxlength="255"
            class="mt-1 block w-full rounded-md border-slate-300 text-slate-900 focus:border-slate-500 focus:ring-slate-500"
        >
        @error('bus_line')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label for="stop_name" class="block text-sm font-medium text-slate-700">Arret (optionnel)</label>
        <input
            id="stop_name"
            name="stop_name"
            type="text"
            value="{{ old('stop_name', $announcement?->stop_name) }}"
            maxlength="255"
            class="mt-1 block w-full rounded-md border-slate-300 text-slate-900 focus:border-slate-500 focus:ring-slate-500"
        >
        @error('stop_name')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>
</div>
