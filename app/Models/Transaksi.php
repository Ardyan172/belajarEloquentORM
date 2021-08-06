<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;

    protected $table = 'transaksi';

    // property wajib jika menggunakan Eloquent ORM
    // column yang bisa diisi
    protected $fillable = ['namaTransaksi', 'totalBiaya', 'fotoTransaksi'];
}
