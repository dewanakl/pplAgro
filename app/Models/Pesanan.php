<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pesanan extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'tanggal_pesanan',
        'jumlah_pesanan',
        'harga_pesanan',
        'keterangan',
        'dibuat',
        'terbayar',
        'diproses',
        'terkirim',
        'selesai',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
