@extends('layouts.app')

@section('title', $customer->exists ? 'Edit Pelanggan' : 'Tambah Pelanggan')

@section('content')
    <div class="mx-auto max-w-xl">
        <h1 class="text-2xl font-bold text-slate-800">{{ $customer->exists ? 'Edit Pelanggan' : 'Tambah Pelanggan' }}</h1>
        <p class="mb-6 text-sm text-slate-500">Masukkan data pelanggan</p>

        <form method="POST" action="{{ $customer->exists ? route('customers.update', $customer) : route('customers.store') }}"
              class="space-y-4 rounded-xl border border-slate-200 bg-white p-6">
            @csrf
            @if ($customer->exists) @method('PUT') @endif

            <x-field label="Nama" name="nama" :value="$customer->nama" placeholder="Contoh: Andi" />
            <x-field label="No HP" name="no_hp" :value="$customer->no_hp" placeholder="Contoh: 081234567890" />
            <x-field label="Alamat" name="alamat" type="textarea" :value="$customer->alamat" placeholder="Contoh: Samarinda" />

            <div class="flex gap-3 pt-2">
                <a href="{{ route('customers.index') }}" class="rounded-lg bg-slate-100 px-4 py-2 text-sm font-medium text-slate-600 hover:bg-slate-200">Batal</a>
                <button type="submit" class="rounded-lg bg-indigo-600 px-4 py-2 text-sm font-medium text-white hover:bg-indigo-500">Simpan</button>
            </div>
        </form>
    </div>
@endsection