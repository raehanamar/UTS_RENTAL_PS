@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
    <h1 class="text-2xl font-bold text-slate-800">Dashboard</h1>

    <div class="mb-8 grid gap-4 sm:grid-cols-2 lg:grid-cols-4">
        <x-stat-card label="Total PS" :value="$totalUnit" icon="🎮" />
        <x-stat-card label="Pelanggan" :value="$totalPelanggan" icon="👤" />
        <x-stat-card label="Paket" :value="$totalPaket" icon="🕹️" />
        <x-stat-card label="Transaksi" :value="$totalTransaksi" icon="🧾" />
    </div>

    <div>
        {{-- PS yang tersedia --}}
        <div>
            <h2 class="mb-3 font-bold text-slate-800">PS yang Tersedia</h2>
            <div class="grid grid-cols-2 gap-3 sm:grid-cols-3">
                @foreach ($units as $unit)
                    <div class="rounded-xl border border-slate-200 bg-white p-4 text-center">
                        <p class="text-3xl">🎮</p>
                        <p class="mt-1 text-sm font-medium text-slate-800">{{ $unit->nama }}</p>
                        <p class="text-xs {{ $unit->status === 'tersedia' ? 'text-emerald-600' : 'text-slate-400' }}">
                            {{ $unit->status === 'tersedia' ? '● Tersedia' : ucfirst($unit->status) }}
                        </p>
                    </div>
                @endforeach
            </div>
        </div>

    </div>

    <div class="mt-6">
        <h2 class="mb-3 font-bold text-slate-800">Orang yang Sedang Bermain</h2>
        <x-table :headers="['Nama', 'PS', 'Paket', 'Status']">
            @forelse ($orangBermain as $t)
                <tr>
                    <td class="px-4 py-3">{{ $t->customer->nama }}</td>
                    <td class="px-4 py-3">{{ $t->unit->nama }}</td>
                    <td class="px-4 py-3">{{ $t->package->nama_paket }}</td>
                    <td class="px-4 py-3">
                        <span class="rounded-full bg-emerald-100 px-2 py-1 text-xs font-medium text-emerald-700">
                            {{ ucfirst($t->status) }}
                        </span>
                    </td>
                </tr>
            @empty
                <tr><td colspan="4" class="px-4 py-6 text-center text-slate-400">Belum ada orang yang sedang bermain.</td></tr>
            @endforelse
        </x-table>
    </div>
@endsection