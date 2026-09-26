<?php

namespace App\Http\Controllers;

use App\Models\Unit;
use Illuminate\Http\Request;

class UnitController extends Controller
{
    public function index(Request $request)
    {
        $units = Unit::query()
            ->when($request->q, fn ($q, $v) => $q->where('nama', 'like', "%{$v}%"))
            ->latest()->paginate(10)->withQueryString();

        return view('units.index', compact('units'));
    }

    public function create()
    {
        return view('units.form', ['unit' => new Unit()]);
    }

    public function store(Request $request)
    {
        Unit::create($this->validated($request));

        return redirect()->route('units.index')->with('success', 'PlayStation berhasil ditambahkan.');
    }

    public function edit(Unit $unit)
    {
        return view('units.form', compact('unit'));
    }

    public function update(Request $request, Unit $unit)
    {
        $unit->update($this->validated($request));

        return redirect()->route('units.index')->with('success', 'PlayStation berhasil diperbarui.');
    }

    public function destroy(Unit $unit)
    {
        $unit->delete();

        return back()->with('success', 'PlayStation berhasil dihapus.');
    }

    private function validated(Request $request): array
    {
        return $request->validate([
            'nama'          => ['required', 'string', 'max:100'],
            'jenis'         => ['required', 'in:PS3,PS4,PS5'],
            'harga_per_jam' => ['required', 'integer', 'min:0'],
            'status'        => ['required', 'in:tersedia,digunakan,rusak'],
        ]);
    }
}