@props(['edit', 'delete', 'name' => 'data ini'])

@php
    $modalId = 'del-' . Str::random(8);
@endphp

<div class="flex gap-2">
    <a href="{{ $edit }}" class="rounded-md bg-indigo-500/10 px-3 py-1 text-indigo-600 hover:bg-indigo-500/20">✏️</a>

    <button type="button" onclick="document.getElementById('{{ $modalId }}').classList.remove('hidden')"
            class="rounded-md bg-red-500/10 px-3 py-1 text-red-600 hover:bg-red-500/20">🗑️</button>

    {{-- Modal konfirmasi --}}
    <div id="{{ $modalId }}" class="fixed inset-0 z-50 hidden items-center justify-center bg-black/50">
        <div class="mx-4 w-full max-w-sm rounded-xl bg-white p-6 text-center shadow-xl">
            <div class="mx-auto mb-3 flex h-12 w-12 items-center justify-center rounded-full bg-red-100 text-2xl">🗑️</div>
            <h3 class="text-lg font-bold text-slate-800">Hapus Data?</h3>
            <p class="mt-1 text-sm text-slate-500">Apakah Anda yakin ingin menghapus {{ $name }}? Data yang sudah dihapus tidak dapat dikembalikan.</p>

            <div class="mt-5 flex gap-3">
                <button type="button" onclick="document.getElementById('{{ $modalId }}').classList.add('hidden')"
                        class="flex-1 rounded-lg bg-slate-100 px-4 py-2 text-sm font-medium text-slate-700 hover:bg-slate-200">Batal</button>

                <form method="POST" action="{{ $delete }}" class="flex-1">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="w-full rounded-lg bg-red-600 px-4 py-2 text-sm font-medium text-white hover:bg-red-500">Hapus</button>
                </form>
            </div>
        </div>
    </div>
</div>