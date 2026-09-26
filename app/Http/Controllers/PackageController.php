<?php

namespace App\Http\Controllers;

use App\Models\Package;
use Illuminate\Http\Request;

class PackageController extends Controller
{
    public function index(Request $request)
    {
        $packages = Package::query()
            ->when($request->q, fn ($q, $v) => $q->where('nama_paket', 'like', "%{$v}%"))
            ->orderBy('durasi_jam')->paginate(10)->withQueryString();

        return view('packages.index', compact('packages'));
    }

    public function create()
    {
        return view('packages.form', ['package' => new Package()]);
    }

    public function store(Request $request)
    {
        Package::create($this->validated($request));

        return redirect()->route('packages.index')->with('success', 'Paket berhasil ditambahkan.');
    }

    public function edit(Package $package)
    {
        return view('packages.form', compact('package'));
    }

    public function update(Request $request, Package $package)
    {
        $package->update($this->validated($request));

        return redirect()->route('packages.index')->with('success', 'Paket berhasil diperbarui.');
    }

    public function destroy(Package $package)
    {
        $package->delete();

        return back()->with('success', 'Paket berhasil dihapus.');
    }

    private function validated(Request $request): array
    {
        return $request->validate([
            'nama_paket' => ['required', 'string', 'max:100'],
            'durasi_jam' => ['required', 'integer', 'min:1', 'max:255'],
            'harga'      => ['required', 'integer', 'min:0'],
            'keterangan' => ['nullable', 'string', 'max:100'],
        ]);
    }
}