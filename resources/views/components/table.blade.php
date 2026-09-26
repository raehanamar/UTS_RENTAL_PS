@props(['headers'])

<div class="overflow-x-auto rounded-xl border border-slate-200 bg-white">
    <table class="w-full text-left text-sm">
        <thead class="bg-slate-50 text-slate-500">
            <tr>
                @foreach ($headers as $header)
                    <th class="px-4 py-3 font-medium">{{ $header }}</th>
                @endforeach
            </tr>
        </thead>
        <tbody class="divide-y divide-slate-100">
            {{ $slot }}
        </tbody>
    </table>
</div>