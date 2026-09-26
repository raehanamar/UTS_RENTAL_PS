<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    protected $fillable = ['nama', 'jenis', 'harga_per_jam', 'status'];
}