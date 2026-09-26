@extends('layouts.app')

@section('title', 'Data Pelanggan')

@section('content')
    <x-toolbar title="Data Pelanggan" :create="route('customers.create')" label="Tambah Pelanggan" search-placeholder="Cari nama pelanggan..." />

    <x-table :headers="['No', 'Nama', 'No HP', 'Alamat', 'Aksi']">
        @forelse ($customers as $customer)
            <tr>
                <td class="px-4 py-3">{{ $customers->firstItem() + $loop->index }}</td>
                <td class="px-4 py-3 font-medium text-slate-800">{{ $customer->nama }}</td>
                <td class="px-4 py-3">{{ $customer->no_hp }}</td>
                <td class="px-4 py-3">{{ $customer->alamat ?? '-' }}</td>
                <td class="px-4 py-3">
                    <x-actions :edit="route('customers.edit', $customer)" :delete="route('customers.destroy', $customer)" :name="$customer->nama" />
                </td>
            </tr>
        @empty
            <tr><td colspan="5" class="px-4 py-8 text-center text-slate-400">Belum ada data pelanggan.</td></tr>
        @endforelse
    </x-table>

    <div class="mt-4">{{ $customers->links() }}</div>
@endsection