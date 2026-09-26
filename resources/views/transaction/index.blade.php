@extends('layouts.app')

@section('title', 'Data Transaksi')

@section('content')
    @php
        $badge = [
            'selesai'     => 'bg-emerald-100 text-emerald-700',
            'berlangsung' => 'bg-amber-100 text-amber-700',
        ];
    @endphp

    <x-toolbar title="Data Transaksi" :create="route('transactions.create')" label="Tambah Transaksi" search-placeholder="Cari nama pelanggan..." />

    <x-table :headers="['No', 'Nama', 'Jenis', 'PS', 'Paket', 'Tanggal', 'Total Harga', 'Status', 'Aksi']">
        @forelse ($transactions as $t)
            <tr>
                <td class="px-4 py-3">{{ $transactions->firstItem() + $loop->index }}</td>
                <td class="px-4 py-3 font-medium text-slate-800">
                    {{ $t->customer?->nama ?? $t->nama_tamu ?: 'Tamu' }}
                </td>
                <td class="px-4 py-3">
                    <span class="rounded-full px-3 py-1 text-xs font-medium {{ $t->jenis_transaksi === 'bawa_pulang' ? 'bg-purple-100 text-purple-700' : 'bg-sky-100 text-sky-700' }}">
                        {{ $t->jenis_transaksi === 'bawa_pulang' ? 'Bawa Pulang' : 'Main di Tempat' }}
                    </span>
                </td>
                <td class="px-4 py-3">{{ $t->unit->nama }}</td>
                <td class="px-4 py-3">{{ $t->package->nama_paket }}</td>
                <td class="px-4 py-3">{{ $t->tanggal->format('Y-m-d') }}</td>
                <td class="px-4 py-3">Rp {{ number_format($t->total_harga, 0, ',', '.') }}</td>
                <td class="px-4 py-3"><x-badge :status="$t->status" :map="$badge" /></td>
                <td class="px-4 py-3">
                    <x-actions :edit="route('transactions.edit', $t)" :delete="route('transactions.destroy', $t)" :name="'transaksi ' . ($t->customer?->nama ?? $t->nama_tamu ?: 'Tamu')" />
                </td>
            </tr>
        @empty
            <tr><td colspan="9" class="px-4 py-8 text-center text-slate-400">Belum ada transaksi.</td></tr>
        @endforelse
    </x-table>

    <div class="mt-4">{{ $transactions->links() }}</div>
@endsection