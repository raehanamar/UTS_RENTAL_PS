@props(['title', 'subtitle' => null, 'create', 'label', 'searchPlaceholder' => 'Cari data...'])

<div class="mb-6 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
    <div>
        <h1 class="text-2xl font-bold text-slate-800">{{ $title }}</h1>
        @if ($subtitle)
            <p class="text-sm text-slate-500">{{ $subtitle }}</p>
        @endif
    </div>

    <div class="flex flex-col gap-2 sm:flex-row">
        <form method="GET" action="{{ url()->current() }}" class="flex gap-2">
            <label for="browse" class="sr-only">Browse data</label>
            <input id="browse" name="q" value="{{ request('q') }}" placeholder="{{ $searchPlaceholder }}"
                   class="w-full rounded-lg border border-slate-200 px-3 py-2 text-sm outline-none focus:border-indigo-500 sm:w-56">
            <button type="submit" class="rounded-lg bg-slate-800 px-4 py-2 text-sm font-medium text-white hover:bg-slate-700">Cari</button>
            @if (request('q'))
                <a href="{{ url()->current() }}" class="rounded-lg bg-slate-100 px-4 py-2 text-center text-sm font-medium text-slate-600 hover:bg-slate-200">Reset</a>
            @endif
        </form>
        <a href="{{ $create }}" class="rounded-lg bg-indigo-600 px-4 py-2 text-center text-sm font-medium text-white hover:bg-indigo-500">
            + {{ $label }}
        </a>
    </div>
</div>