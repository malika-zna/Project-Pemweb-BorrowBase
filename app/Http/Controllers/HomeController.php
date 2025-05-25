<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Buku;
use App\Models\Anggota;
use App\Models\Peminjaman;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        Carbon::setLocale('id');
        $hariTanggal = Carbon::now()->translatedFormat('l, d F Y');
        $totalBuku = Buku::sum('jumlah_dipinjam') + Buku::sum('jumlah_tersedia');
        $totalAnggota = Anggota::count();
        $bukuDipinjam = Buku::sum('jumlah_dipinjam');
        $bukuTersedia = Buku::sum('jumlah_tersedia');
        $peminjamanTerbaru = Peminjaman::with(['anggota', 'buku'])
            ->orderBy('tanggal_pinjam', 'desc')->limit(5)->get();

        $today = Carbon::today();

        // Buku jatuh tempo hari ini
        $jatuhTempoHariIni = Peminjaman::whereDate('tanggal_kembali', $today)->count();

        // Buku dipinjam hari ini (jumlah peminjaman hari ini, sum kuantitas)
        $bukuDipinjamHariIni = Peminjaman::whereDate('tanggal_pinjam', $today)->sum('kuantitas');

        // Buku baru ditambahkan hari ini
        $bukuBaruHariIni = Buku::whereDate('created_at', $today)->count();

        // Anggota baru hari ini
        $anggotaBaruHariIni = Anggota::whereDate('created_at', $today)->count();

        // Peminjaman terbaru (misal 5 terakhir)
        $peminjamanTerbaru = Peminjaman::with(['anggota', 'buku'])->orderByDesc('created_at')->take(5)->get();

        $hariTanggal = $today->translatedFormat('l, d F Y');

        return view('home.index', compact(
            'hariTanggal',
            'totalBuku',
            'totalAnggota',
            'bukuDipinjam',
            'bukuTersedia',
            'jatuhTempoHariIni',
            'bukuDipinjamHariIni',
            'bukuBaruHariIni',
            'anggotaBaruHariIni',
            'peminjamanTerbaru'
        ));
    }
}