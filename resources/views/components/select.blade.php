@props(['label', 'name', 'options', 'selected' => null, 'placeholder' => null])

@php
    $options = $options instanceof \Illuminate\Support\Collection ? $options->toArray() : $options;
    $isList = is_array($options) && array_is_list($options);
@endphp

<div>
    <label for="{{ $name }}" class="mb-1 block text-sm font-medium text-slate-600">{{ $label }}</label>

    <select id="{{ $name }}" name="{{ $name }}"
            class="w-full rounded-lg border border-slate-300 bg-white px-3 py-2 text-slate-800 focus:border-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-200">
        @if ($placeholder)
            <option value="">{{ $placeholder }}</option>
        @endif

        @foreach ($options as $key => $text)
            @php $value = $isList ? $text : $key; @endphp
            <option value="{{ $value }}" @selected(old($name, $selected) == $value)>{{ $text }}</option>
        @endforeach
    </select>

    @error($name)
        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
    @enderror
</div>