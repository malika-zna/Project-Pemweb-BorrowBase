<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Anggota extends Model
{
    protected $table = 'anggota';
    // protected $primaryKey = 'nim';
    // public $incrementing = false;
    // protected $keyType = 'string';
    public $timestamps = true;

    protected $fillable = [
        'nim',
        'nama',
        'email',
        'alamat',
        'telepon',
        'kota'
    ];

    public function peminjaman()
    {
        return $this->hasMany(Peminjaman::class, 'anggota_id');
    }
}
