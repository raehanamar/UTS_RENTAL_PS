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

            {{-- Jenis Transaksi --}}
            <div>
                <label class="mb-1 block text-sm font-medium text-slate-600">Jenis Transaksi</label>
                <div class="flex gap-4">
                    <label class="flex items-center gap-2 text-sm text-slate-700">
                        <input type="radio" name="jenis_transaksi" value="main_ditempat" id="jt_tempat" onchange="toggleJenis()"
                               {{ old('jenis_transaksi', $transaction->jenis_transaksi ?? 'main_ditempat') === 'main_ditempat' ? 'checked' : '' }}>
                        Main di Tempat
                    </label>
                    <label class="flex items-center gap-2 text-sm text-slate-700">
                        <input type="radio" name="jenis_transaksi" value="bawa_pulang" id="jt_pulang" onchange="toggleJenis()"
                               {{ old('jenis_transaksi', $transaction->jenis_transaksi ?? '') === 'bawa_pulang' ? 'checked' : '' }}>
                        Bawa Pulang
                    </label>
                </div>
                @error('jenis_transaksi') <p class="mt-1 text-sm text-red-500">{{ $message }}</p> @enderror
            </div>

            {{-- Tampil hanya jika Bawa Pulang --}}
            <div id="wrap_customer">
                <x-select label="Nama Pelanggan" name="customer_id" :options="$customers" :selected="$transaction->customer_id" placeholder="Pilih pelanggan" />
            </div>

            {{-- Tampil hanya jika Main di Tempat --}}
            <div id="wrap_tamu">
                <x-field label="Nama (opsional)" name="nama_tamu" :value="$transaction->nama_tamu" placeholder="Boleh dikosongkan" />
            </div>

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

    <script>
        function toggleJenis() {
            const bawaPulang = document.getElementById('jt_pulang').checked;
            document.getElementById('wrap_customer').classList.toggle('hidden', !bawaPulang);
            document.getElementById('wrap_tamu').classList.toggle('hidden', bawaPulang);
        }
        toggleJenis(); // jalankan sekali saat halaman pertama dibuka
    </script>
@endsection