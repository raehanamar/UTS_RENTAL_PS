<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Package;
use App\Models\Transaction;
use App\Models\Unit;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function index(Request $request)
    {
        $transactions = Transaction::with(['customer', 'unit', 'package'])
            ->when($request->q, fn ($q, $v) => $q->whereHas('customer', fn ($c) => $c->where('nama', 'like', "%{$v}%")))
            ->latest('tanggal')->paginate(10)->withQueryString();

        return view('transaction.index', compact('transactions'));
    }

    public function create()
    {
        return view('transaction.form', $this->formData(new Transaction(['tanggal' => now()])));
    }

    public function store(Request $request)
    {
        $data = $this->validated($request);
        $data['total_harga'] = Package::find($data['package_id'])->harga;

        Transaction::create($data);

        return redirect()->route('transactions.index')->with('success', 'Transaksi berhasil ditambahkan.');
    }

    public function edit(Transaction $transaction)
    {
        return view('transaction.form', $this->formData($transaction));
    }

    public function update(Request $request, Transaction $transaction)
    {
        $data = $this->validated($request);
        $data['total_harga'] = Package::find($data['package_id'])->harga;

        $transaction->update($data);

        return redirect()->route('transactions.index')->with('success', 'Transaksi berhasil diperbarui.');
    }

    public function destroy(Transaction $transaction)
    {
        $transaction->delete();

        return back()->with('success', 'Transaksi berhasil dihapus.');
    }

    private function formData(Transaction $transaction): array
    {
        return [
            'transaction' => $transaction,
            'customers'   => Customer::orderBy('nama')->pluck('nama', 'id'),
            'units'       => Unit::orderBy('nama')->pluck('nama', 'id'),
            'packages'    => Package::orderBy('durasi_jam')->get()->mapWithKeys(
                fn ($p) => [$p->id => "{$p->nama_paket} - Rp " . number_format($p->harga, 0, ',', '.')]
            ),
        ];
    }

    private function validated(Request $request): array
{
    $data = $request->validate([
        'jenis_transaksi' => ['required', 'in:main_ditempat,bawa_pulang'],
        'customer_id'     => ['nullable', 'required_if:jenis_transaksi,bawa_pulang', 'exists:customers,id'],
        'nama_tamu'       => ['nullable', 'string', 'max:100'],
        'unit_id'         => ['required', 'exists:units,id'],
        'package_id'      => ['required', 'exists:packages,id'],
        'tanggal'         => ['required', 'date'],
        'status'          => ['sometimes', 'required', 'in:berlangsung,selesai'],
    ]);

    // kalau main di tempat, pelanggan dikosongkan biar tidak ikut tersimpan
    if ($data['jenis_transaksi'] === 'main_ditempat') {
        $data['customer_id'] = null;
    } else {
        $data['nama_tamu'] = null;
    }

    return $data;
}
}