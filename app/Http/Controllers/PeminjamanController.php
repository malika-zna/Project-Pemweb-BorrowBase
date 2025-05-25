<?php

namespace App\Http\Controllers;

use App\Models\Peminjaman;
use App\Models\Anggota;
use App\Models\Buku;
use Illuminate\Http\Request;

class PeminjamanController extends Controller
{
    public function index(Request $request)
    {
        $query = Peminjaman::with(['anggota', 'buku']);

        // 🔍 Filter pencarian berdasarkan nama anggota atau judul buku
        if ($request->has('q') && $request->q !== null) {
            $q = $request->q;
            $query->whereHas('anggota', function ($anggotaQuery) use ($q) {
                $anggotaQuery->where('nama', 'like', '%' . $q . '%');
            })->orWhereHas('buku', function ($bukuQuery) use ($q) {
                $bukuQuery->where('judul', 'like', '%' . $q . '%');
            });
        }

        // ✅ Filter berdasarkan status peminjaman
        if ($request->has('status') && $request->status !== null) {
            $query->where('status', $request->status);
        }

        // ⏳ Urutan: terbaru / terlama
        if ($request->filled('sort')) {
            if ($request->sort == 'terbaru') {
                $query->orderBy('tanggal_pinjam', 'desc');
            } elseif ($request->sort == 'terlama') {
                $query->orderBy('tanggal_pinjam', 'asc');
            }
        }
        // Jika sort kosong atau "Semua", tidak perlu orderBy, urutan default

        $peminjaman = $query->get();

        return view('peminjaman.index', compact('peminjaman'));
    }


    public function create()
    {
        $anggotaList = Anggota::all();
        $bukuList = Buku::all();
        return view('peminjaman.create', compact('anggotaList', 'bukuList'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'anggota_id' => 'required',
            'id_buku' => 'required',
            'tanggal_pinjam' => 'required|date',
            'tanggal_kembali' => 'required|date|after:tanggal_pinjam',
            'status' => 'required',
            'kuantitas' => 'required|integer|min:1',
            'catatan' => 'nullable'
        ]);

        $buku = Buku::findOrFail($request->id_buku);

        if ($buku->jumlah_tersedia < $request->kuantitas) {
            return back()->withErrors(['kuantitas' => 'Stok buku tidak mencukupi.'])->withInput();
        }

        // Buat peminjaman
        Peminjaman::create($request->all());

        // Kurangi jumlah tersedia dan tambah jumlah dipinjam
        $buku->jumlah_tersedia -= $request->kuantitas;
        $buku->jumlah_dipinjam += $request->kuantitas;
        $buku->save();

        return redirect()->route('peminjaman.index')->with('success', 'Peminjaman berhasil dibuat.');
    }


    public function edit($id)
    {
        $peminjaman = Peminjaman::findOrFail($id);
        $anggotaList = Anggota::all();
        $bukuList = Buku::all();
        return view('peminjaman.edit', compact('peminjaman', 'anggotaList', 'bukuList'));
    }

    public function update(Request $request, $id)
    {
        $peminjaman = Peminjaman::findOrFail($id);
        $buku = Buku::findOrFail($peminjaman->id_buku);

        $statusLama = $peminjaman->status;
        $statusBaru = $request->status;

        // Update jumlah buku jika status berubah
        if ($statusLama == 'Sedang Dipinjam' && $statusBaru == 'Selesai') {
            $buku->jumlah_tersedia += $peminjaman->kuantitas;
            $buku->jumlah_dipinjam -= $peminjaman->kuantitas;
            $buku->save();
        } elseif ($statusLama == 'Selesai' && $statusBaru == 'Sedang Dipinjam') {
            // Kembalikan jumlah tersedia jika status diubah kembali ke dipinjam
            if ($buku->jumlah_tersedia >= $peminjaman->kuantitas) {
                $buku->jumlah_tersedia -= $peminjaman->kuantitas;
                $buku->jumlah_dipinjam += $peminjaman->kuantitas;
                $buku->save();
            } else {
                return back()->withErrors(['status' => 'Stok buku tidak mencukupi untuk dipinjam kembali.'])->withInput();
            }
        }

        $peminjaman->update($request->all());

        return redirect()->route('peminjaman.index')->with('success', 'Data peminjaman berhasil diperbarui.');
    }


    public function destroy($id)
    {
        $peminjaman = Peminjaman::findOrFail($id);
        $peminjaman->delete();
        return redirect()->route('peminjaman.index')->with('success', 'Data peminjaman dihapus.');
    }
}
