<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Transaction extends Model
{
    protected function casts(): array
    {
        return [
            'tanggal' => 'date',
        ];
    }

    protected $fillable = [
    'customer_id', 'unit_id', 'package_id', 'jenis_transaksi',
    'nama_tamu', 'tanggal', 'total_harga', 'status',
    ];
    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }

    public function unit(): BelongsTo
    {
        return $this->belongsTo(Unit::class);
    }

    public function package(): BelongsTo
    {
        return $this->belongsTo(Package::class);
    }
}