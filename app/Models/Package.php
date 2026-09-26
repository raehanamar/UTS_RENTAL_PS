<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    protected $fillable = ['nama_paket', 'durasi_jam', 'harga', 'keterangan'];
}