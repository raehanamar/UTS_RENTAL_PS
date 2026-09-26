@props(['label', 'name', 'type' => 'text', 'value' => null, 'placeholder' => null])

<div>
    <label for="{{ $name }}" class="mb-1 block text-sm font-medium text-slate-600">{{ $label }}</label>

    @if ($type === 'textarea')
        <textarea id="{{ $name }}" name="{{ $name }}" rows="3" placeholder="{{ $placeholder }}"
                  {{ $attributes->merge(['class' => 'w-full rounded-lg border border-slate-300 px-3 py-2 text-slate-800 placeholder-slate-400 focus:border-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-200']) }}>{{ old($name, $value) }}</textarea>
    @else
        <input type="{{ $type }}" id="{{ $name }}" name="{{ $name }}" value="{{ old($name, $value) }}" placeholder="{{ $placeholder }}"
               {{ $attributes->merge(['class' => 'w-full rounded-lg border border-slate-300 px-3 py-2 text-slate-800 placeholder-slate-400 focus:border-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-200']) }}>
    @endif

    @error($name)
        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
    @enderror
</div>