<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index(Request $request)
    {
        $customers = Customer::query()
            ->when($request->q, fn ($q, $v) => $q->where('nama', 'like', "%{$v}%"))
            ->latest()->paginate(10)->withQueryString();

        return view('customer.index', compact('customers'));
    }

    public function create()
    {
        return view('customer.form', ['customer' => new Customer()]);
    }

    public function store(Request $request)
    {
        Customer::create($this->validated($request));

        return redirect()->route('customers.index')->with('success', 'Pelanggan berhasil ditambahkan.');
    }

    public function edit(Customer $customer)
    {
        return view('customer.form', compact('customer'));
    }

    public function update(Request $request, Customer $customer)
    {
        $customer->update($this->validated($request));

        return redirect()->route('customers.index')->with('success', 'Pelanggan berhasil diperbarui.');
    }

    public function destroy(Customer $customer)
    {
        $customer->delete();

        return back()->with('success', 'Pelanggan berhasil dihapus.');
    }

    private function validated(Request $request): array
    {
        return $request->validate([
            'nama'   => ['required', 'string', 'max:100'],
            'no_hp'  => ['required', 'string', 'max:20'],
            'alamat' => ['nullable', 'string', 'max:255'],
        ]);
    }
}