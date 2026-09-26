@extends('layouts.app')

@section('title', $transaction->exists ? 'Edit Transaksi' : 'Tambah Transaksi')

@section('content')
    <div class="mx-auto max-w-xl">
        <h1 class="text-2xl font-bold text-slate-800">{{ $transaction->exists ? 'Edit Transaksi' : 'Tambah Transaksi' }}</h1>
        <p class="mb-6 text-sm text-slate-500">Masukkan data transaksi baru</p>

        <form method="POST" action="{{ $transaction->exists ? route('transactions.update', $transaction) : route('transactions.store') }}"
              class="space-y-4 rounded-xl border border-slate-200 bg-white p-6">
            @csrf
            @if ($transaction->exists) @method('PUT') @endif

            <x-select label="Nama Pelanggan" name="customer_id" :options="$customers" :selected="$transaction->customer_id" placeholder="Pilih pelanggan" />
            <x-select label="PS" name="unit_id" :options="$units" :selected="$transaction->unit_id" placeholder="Pilih PS" />
            <x-select label="Paket" name="package_id" :options="$packages" :selected="$transaction->package_id" placeholder="Pilih paket" />
            <x-field label="Tanggal" name="tanggal" type="date" :value="$transaction->tanggal?->format('Y-m-d')" />

            @if ($transaction->exists)
                <x-select label="Status" name="status" :options="['berlangsung', 'selesai']" :selected="$transaction->status" />
            @endif

            <div class="flex gap-3 pt-2">
                <a href="{{ route('transactions.index') }}" class="rounded-lg bg-slate-100 px-4 py-2 text-sm font-medium text-slate-600 hover:bg-slate-200">Batal</a>
                <button type="submit" class="rounded-lg bg-indigo-600 px-4 py-2 text-sm font-medium text-white hover:bg-indigo-500">
                    {{ $transaction->exists ? 'Update' : 'Simpan' }}
                </button>
            </div>
        </form>
    </div>
@endsection