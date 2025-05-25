<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Buku extends Model
{
    public $timestamps = true;
    protected $table = 'buku';
    protected $primaryKey = 'id';
    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = [
        'isbn',
        'judul',
        'id_kategori',
        'bahasa',
        'penulis',
        'penerbit',
        'sampul',
        'jumlah',
        'jumlah_tersedia',
        'jumlah_dipinjam',
        'status',
        'deskripsi'
    ];

    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'id_kategori');
    }
}
