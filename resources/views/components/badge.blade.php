@props(['status', 'map'])

@php
    $style = $map[$status] ?? 'bg-slate-100 text-slate-600';
@endphp

<span class="rounded-full px-3 py-1 text-xs font-medium {{ $style }}">{{ ucfirst($status) }}</span>