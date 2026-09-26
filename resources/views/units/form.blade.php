@extends('layouts.app')

@section('title', $unit->exists ? 'Edit PlayStation' : 'Tambah PlayStation')

@section('content')
    <div class="mx-auto max-w-xl">
        <h1 class="text-2xl font-bold text-slate-800">{{ $unit->exists ? 'Edit PlayStation' : 'Tambah PlayStation' }}</h1>
        <p class="mb-6 text-sm text-slate-500">{{ $unit->exists ? 'Ubah data PlayStation' : 'Masukkan data PlayStation baru' }}</p>

        <form method="POST" action="{{ $unit->exists ? route('units.update', $unit) : route('units.store') }}"
              class="space-y-4 rounded-xl border border-slate-200 bg-white p-6">
            @csrf
            @if ($unit->exists) @method('PUT') @endif

            <x-field label="Nama PS" name="nama" :value="$unit->nama" placeholder="Contoh: PS 5" />
            <x-select label="Jenis" name="jenis" :options="['PS3', 'PS4', 'PS5']" :selected="$unit->jenis" placeholder="Pilih jenis" />
            <x-field label="Harga per Jam" name="harga_per_jam" type="number" :value="$unit->harga_per_jam" placeholder="Contoh: 10000" />
            <x-select label="Status" name="status" :options="['tersedia', 'digunakan', 'rusak']" :selected="$unit->status ?? 'tersedia'" />

            <div class="flex gap-3 pt-2">
                <a href="{{ route('units.index') }}" class="rounded-lg bg-slate-100 px-4 py-2 text-sm font-medium text-slate-600 hover:bg-slate-200">Batal</a>
                <button type="submit" class="rounded-lg bg-indigo-600 px-4 py-2 text-sm font-medium text-white hover:bg-indigo-500">
                    {{ $unit->exists ? 'Update' : 'Simpan' }}
                </button>
            </div>
        </form>
    </div>
@endsection