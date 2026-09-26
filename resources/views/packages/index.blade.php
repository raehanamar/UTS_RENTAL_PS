@extends('layouts.app')

@section('title', 'Paket Rental')

@section('content')
    <x-toolbar title="Data Paket Rental" subtitle="Kelola data paket rental" :create="route('packages.create')" label="Tambah Paket" />

    <x-table :headers="['No', 'Nama Paket', 'Durasi (Jam)', 'Harga', 'Keterangan', 'Aksi']">
        @forelse ($packages as $package)
            <tr>
                <td class="px-4 py-3">{{ $packages->firstItem() + $loop->index }}</td>
                <td class="px-4 py-3 font-medium text-slate-800">{{ $package->nama_paket }}</td>
                <td class="px-4 py-3">{{ $package->durasi_jam }}</td>
                <td class="px-4 py-3">Rp {{ number_format($package->harga, 0, ',', '.') }}</td>
                <td class="px-4 py-3">{{ $package->keterangan ?? '-' }}</td>
                <td class="px-4 py-3">
                    <x-actions :edit="route('packages.edit', $package)" :delete="route('packages.destroy', $package)" :name="$package->nama_paket" />
                </td>
            </tr>
        @empty
            <tr><td colspan="6" class="px-4 py-8 text-center text-slate-400">Belum ada data paket.</td></tr>
        @endforelse
    </x-table>

    <div class="mt-4">{{ $packages->links() }}</div>
@endsection