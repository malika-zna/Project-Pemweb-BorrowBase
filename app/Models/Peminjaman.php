<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Peminjaman extends Model
{
    protected $table = 'peminjaman';
    public $timestamps = false;

    protected $fillable = [
        'anggota_id',
        'id_buku',
        'tanggal_pinjam',
        'tanggal_kembali',
        'status',
        'catatan',
        'kuantitas'
    ];

    public function anggota()
    {
        return $this->belongsTo(Anggota::class, 'anggota_id');
    }

    public function buku()
    {
        return $this->belongsTo(Buku::class, 'id_buku');
    }
}
