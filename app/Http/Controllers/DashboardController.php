<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Transaction;
use App\Models\Unit;

class DashboardController extends Controller
{
    public function index()
    {
        return view('dashboard', [
            'totalUnit'      => Unit::count(),
            'totalPelanggan' => Customer::count(),
            'totalPaket'     => \App\Models\Package::count(),
            'totalTransaksi' => Transaction::count(),
            'units'          => Unit::orderBy('nama')->get(),
            'orangBermain' => Transaction::with(['customer', 'unit', 'package'])
                ->where('status', 'berlangsung')
                ->latest('tanggal')
                ->get(),
        ]);
    }
}