@extends('layouts.app')

@section('title', $package->exists ? 'Edit Paket' : 'Tambah Paket')

@section('content')
    <div class="mx-auto max-w-xl">
        <h1 class="text-2xl font-bold text-slate-800">{{ $package->exists ? 'Edit Paket Rental' : 'Tambah Paket Rental' }}</h1>
        <p class="mb-6 text-sm text-slate-500">Masukkan data paket rental baru</p>

        <form method="POST" action="{{ $package->exists ? route('packages.update', $package) : route('packages.store') }}"
              class="space-y-4 rounded-xl border border-slate-200 bg-white p-6">
            @csrf
            @if ($package->exists) @method('PUT') @endif

            <x-field label="Nama Paket" name="nama_paket" :value="$package->nama_paket" placeholder="Contoh: Paket 3 Jam" />
            <x-field label="Durasi (Jam)" name="durasi_jam" type="number" :value="$package->durasi_jam" placeholder="Contoh: 3" />
            <x-field label="Harga" name="harga" type="number" :value="$package->harga" placeholder="Contoh: 25000" />
            <x-field label="Keterangan (opsional)" name="keterangan" :value="$package->keterangan" placeholder="Contoh: Paling populer" />

            <div class="flex gap-3 pt-2">
                <a href="{{ route('packages.index') }}" class="rounded-lg bg-slate-100 px-4 py-2 text-sm font-medium text-slate-600 hover:bg-slate-200">Batal</a>
                <button type="submit" class="rounded-lg bg-indigo-600 px-4 py-2 text-sm font-medium text-white hover:bg-indigo-500">Simpan</button>
            </div>
        </form>
    </div>
@endsection