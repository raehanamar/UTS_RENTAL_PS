<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Transaction extends Model
{
    protected $fillable = ['customer_id', 'unit_id', 'package_id', 'tanggal', 'total_harga', 'status'];

    protected $casts = [
        'tanggal' => 'date',
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