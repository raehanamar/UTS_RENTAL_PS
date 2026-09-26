@props(['title', 'subtitle' => null, 'create', 'label'])

<div class="mb-6 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
    <div>
        <h1 class="text-2xl font-bold text-slate-800">{{ $title }}</h1>
        @if ($subtitle)
            <p class="text-sm text-slate-500">{{ $subtitle }}</p>
        @endif
    </div>

    <a href="{{ $create }}" class="rounded-lg bg-indigo-600 px-4 py-2 text-center text-sm font-medium text-white hover:bg-indigo-500">
        + {{ $label }}
    </a>
</div>