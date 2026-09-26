@props(['label', 'value', 'icon'])

<div class="flex items-center gap-4 rounded-xl border border-slate-200 bg-white p-5">
    <div class="flex h-12 w-12 items-center justify-center rounded-full bg-indigo-100 text-2xl">{{ $icon }}</div>
    <div>
        <p class="text-sm text-slate-500">{{ $label }}</p>
        <p class="text-2xl font-bold text-slate-800">{{ $value }}</p>
    </div>
</div>