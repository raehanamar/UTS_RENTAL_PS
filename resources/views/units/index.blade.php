@extends('layouts.app')

@section('title', 'Data PlayStation')

@section('content')
    @php
        $badge = [
            'tersedia'  => 'bg-emerald-100 text-emerald-700',
            'digunakan' => 'bg-amber-100 text-amber-700',
            'rusak'     => 'bg-red-100 text-red-700',
        ];
    @endphp

    <x-toolbar title="Data PlayStation" subtitle="Kelola data PlayStation" :create="route('units.create')" label="Tambah PS" search-placeholder="Cari nama PS..." />

    <x-table :headers="['No', 'Nama PS', 'Jenis', 'Harga/Jam', 'Status', 'Aksi']">
        @forelse ($units as $unit)
            <tr>
                <td class="px-4 py-3">{{ $units->firstItem() + $loop->index }}</td>
                <td class="px-4 py-3 font-medium text-slate-800">{{ $unit->nama }}</td>
                <td class="px-4 py-3">{{ $unit->jenis }}</td>
                <td class="px-4 py-3">Rp {{ number_format($unit->harga_per_jam, 0, ',', '.') }}</td>
                <td class="px-4 py-3"><x-badge :status="$unit->status" :map="$badge" /></td>
                <td class="px-4 py-3">
                    <x-actions :edit="route('units.edit', $unit)" :delete="route('units.destroy', $unit)" :name="$unit->nama" />
                </td>
            </tr>
        @empty
            <tr><td colspan="6" class="px-4 py-8 text-center text-slate-400">Belum ada data PS.</td></tr>
        @endforelse
    </x-table>

    <div class="mt-4">{{ $units->links() }}</div>
@endsection