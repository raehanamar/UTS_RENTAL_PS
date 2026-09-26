<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Dashboard') - MBG PLAYSTATION</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>
<body class="min-h-screen bg-slate-100">
 
    @php
        $menus = [
            ['label' => 'Dashboard',     'icon' => '', 'route' => 'dashboard',         'match' => 'dashboard'],
            ['label' => 'PlayStation',   'icon' => '🎮', 'route' => 'units.index',       'match' => 'units.*'],
            ['label' => 'Pelanggan',     'icon' => '👤', 'route' => 'customers.index',   'match' => 'customers.*'],
            ['label' => 'Paket Rental',  'icon' => '🕹️', 'route' => 'packages.index',    'match' => 'packages.*'],
            ['label' => 'Transaksi',     'icon' => '🧾', 'route' => 'transactions.index','match' => 'transactions.*'],
        ];
    @endphp
 
    {{-- Navbar atas --}}
    <header class="bg-slate-900 text-slate-100">
        <div class="mx-auto flex max-w-7xl flex-col gap-3 px-6 py-4 lg:flex-row lg:items-center lg:justify-between">
 
            <div class="flex items-center justify-between">
                <a href="{{ route('dashboard') }}" class="text-lg font-bold text-white">🎮 MBG PLAYSTATION</a>
 
                {{-- Info admin, tampil di kanan saat layar kecil --}}
                <div class="flex items-center gap-2 lg:hidden">
                    <div class="flex h-8 w-8 items-center justify-center rounded-full bg-indigo-600 text-sm font-bold">A</div>
                    <span class="text-sm text-slate-300">Admin</span>
                </div>
            </div>
 
            {{-- Menu navigasi --}}
            <nav class="flex flex-wrap gap-1">
                @foreach ($menus as $menu)
                    <a href="{{ route($menu['route']) }}"
                       class="flex items-center gap-2 rounded-lg px-3 py-2 text-sm font-medium {{ request()->routeIs($menu['match']) ? 'bg-indigo-600 text-white' : 'text-slate-300 hover:bg-slate-800' }}">
                        <span>{{ $menu['icon'] }}</span> {{ $menu['label'] }}
                    </a>
                @endforeach
            </nav>
 
            {{-- Info admin, tampil di kanan saat layar besar --}}
            <div class="hidden items-center gap-2 lg:flex">
                <div class="flex h-8 w-8 items-center justify-center rounded-full bg-indigo-600 text-sm font-bold">A</div>
                <div>
                    <p class="text-sm font-medium leading-tight">Admin</p>
                    <p class="text-xs leading-tight text-emerald-400">● Online</p>
                </div>
            </div>
        </div>
    </header>
 
    {{-- Konten --}}
    <main class="mx-auto max-w-7xl px-6 py-8">
        @if (session('success'))
            <div class="mb-6 rounded-lg border border-emerald-300 bg-emerald-50 px-4 py-3 text-emerald-700">
                {{ session('success') }}
            </div>
        @endif
 
        @yield('content')
    </main>
 
</body>
</html>