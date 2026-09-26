<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Dashboard') - MBG PLAYSTATION</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>
<body class="flex min-h-screen bg-slate-100">

    @php
        $menus = [
            ['label' => 'Dashboard',     'icon' => '🏠', 'route' => 'dashboard',        'match' => 'dashboard'],
            ['label' => 'PlayStation',   'icon' => '🎮', 'route' => 'units.index',       'match' => 'units.*'],
            ['label' => 'Pelanggan',     'icon' => '👤', 'route' => 'customers.index',   'match' => 'customers.*'],
            ['label' => 'Paket Rental',  'icon' => '📦', 'route' => 'packages.index',    'match' => 'packages.*'],
            ['label' => 'Transaksi',     'icon' => '🧾', 'route' => 'transactions.index','match' => 'transactions.*'],
        ];
    @endphp

    {{-- Sidebar --}}
    <aside class="flex w-64 shrink-0 flex-col bg-slate-900 text-slate-100">
        <div class="border-b border-slate-800 px-5 py-5">
            <p class="text-lg font-bold text-white">🎮 MBG PLAYSTATION</p>
        </div>

        <div class="flex items-center gap-3 border-b border-slate-800 px-5 py-4">
            <div class="flex h-9 w-9 items-center justify-center rounded-full bg-indigo-600 font-bold">A</div>
            <div>
                <p class="text-sm font-medium">Admin</p>
                <p class="text-xs text-emerald-400">● Online</p>
            </div>
        </div>

        <nav class="flex-1 space-y-1 px-3 py-4">
            @foreach ($menus as $menu)
                <a href="{{ route($menu['route']) }}"
                   class="flex items-center gap-3 rounded-lg px-3 py-2 text-sm font-medium {{ request()->routeIs($menu['match']) ? 'bg-indigo-600 text-white' : 'text-slate-300 hover:bg-slate-800' }}">
                    <span>{{ $menu['icon'] }}</span> {{ $menu['label'] }}
                </a>
            @endforeach
        </nav>
    </aside>

    {{-- Konten --}}
    <div class="flex-1">
        <header class="flex items-center justify-end border-b border-slate-200 bg-white px-8 py-4">
            <span class="text-sm font-medium text-slate-600">👤 Admin</span>
        </header>

        <main class="p-8">
            @if (session('success'))
                <div class="mb-6 rounded-lg border border-emerald-300 bg-emerald-50 px-4 py-3 text-emerald-700">
                    {{ session('success') }}
                </div>
            @endif

            @yield('content')
        </main>
    </div>

</body>
</html>