<?php

namespace App\Http\Controllers;

use App\Models\Anggota;
use Illuminate\Http\Request;

class AnggotaController extends Controller
{
    public function index()
    {
        $anggota = Anggota::all();
        foreach ($anggota as $a) {
            $a->jumlah_peminjaman_aktif = $a->peminjaman()->where('status', 'Sedang Dipinjam')->count();
        }
        return view('anggota.index', compact('anggota'));
    }

    public function create()
    {
        return view('anggota.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nim' => 'required|unique:anggota',
            'nama' => 'required',
            'email' => 'required|email',
            'alamat' => 'required',
            'telepon' => 'required',
            'kota' => 'required',
        ]);

        Anggota::create($request->all());
        return redirect()->route('anggota.index')->with('success', 'Anggota berhasil ditambahkan.');
    }

    public function show($id)
    {
        $anggota = Anggota::findOrFail($id);
        $peminjaman = $anggota->peminjaman()->with('buku')->get();
        return view('anggota.show', compact('anggota', 'peminjaman'));
    }

    public function edit($id)
    {
        $anggota = Anggota::findOrFail($id);
        return view('anggota.edit', compact('anggota'));
    }

    public function update(Request $request, $id)
    {
        $anggota = Anggota::findOrFail($id);

        $request->validate([
            'nama' => 'required',
            'email' => 'required|email',
            'alamat' => 'required',
            'telepon' => 'required',
            'kota' => 'required',
        ]);

        $anggota->update($request->all());
        return redirect()->route('anggota.index')->with('success', 'Anggota berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $anggota = Anggota::findOrFail($id);
        $masihDipinjam = $anggota->peminjaman()->where('status', 'Sedang Dipinjam')->exists();
        if ($masihDipinjam) {
            return redirect()->route('anggota.index')->with('error', 'Anggota tidak dapat dihapus karena masih memiliki peminjaman aktif.');
        }
        $anggota->delete();
        return redirect()->route('anggota.index')->with('success', 'Anggota berhasil dihapus.');
    }
}
