<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Buku;
use App\Models\Kategori;

class BukuController extends Controller
{
    public function index(Request $request)
    {
        $kategoriList = Kategori::all();
        $query = Buku::with('kategori');

        if ($request->filled('kategori')) {
            $query->where('id_kategori', $request->kategori);
        }

        if ($request->filled('q')) {
            $query->where('judul', 'like', '%' . $request->q . '%');
        }

        $buku = $query->get();

        return view('buku.index', compact('buku', 'kategoriList'));
    }

    public function show($id)
    {
        $buku = Buku::with('kategori')->findOrFail($id);
        return view('buku.detail', compact('buku'));
    }

    public function create()
    {
        $kategoriList = Kategori::all();
        return view('buku.tambah', compact('kategoriList'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'isbn' => 'required|unique:buku,isbn|max:15',
            'judul' => 'required',
            'id_kategori' => 'nullable',
            'bahasa' => 'nullable',
            'penulis' => 'required',
            'penerbit' => 'required',
            'jumlah' => 'required|integer|min:1',
            'status' => 'required',
            'deskripsi' => 'required',
            'sampul' => 'nullable|file|image|max:2048'
        ]);

        if ($request->hasFile('sampul')) {
            $path = $request->file('sampul')->store('sampul', 'public');
            $validated['sampul'] = $path;
        }

        $validated['jumlah_tersedia'] = $validated['jumlah'];
        $validated['jumlah_dipinjam'] = 0;

        Buku::create($validated);

        return redirect()->route('buku.index')->with('success', 'Buku berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $buku = Buku::findOrFail($id);
        $kategoriList = Kategori::all();
        return view('buku.edit', compact('buku', 'kategoriList'));
    }

    public function update(Request $request, $id)
    {
        $buku = Buku::findOrFail($id);

        $validated = $request->validate([
            'isbn' => 'required|max:15|unique:buku,isbn,' . $buku->isbn . ',isbn',
            'judul' => 'required',
            'id_kategori' => 'nullable',
            'bahasa' => 'nullable',
            'penulis' => 'required',
            'penerbit' => 'required',
            'jumlah' => 'required|integer|min:1',
            'status' => 'required',
            'deskripsi' => 'required',
            'sampul' => 'nullable|file|image|max:2048'
        ]);

        if ($request->hasFile('sampul')) {
            $path = $request->file('sampul')->store('sampul', 'public');
            $validated['sampul'] = $path;
        }

        $validated['jumlah_tersedia'] = $validated['jumlah'] - $buku->jumlah_dipinjam;

        $buku->update($validated);

        return redirect()->route('buku.show', $buku->id)->with('success', 'Data buku berhasil diperbarui.');
    }

    public function destroy($id)
    {
        try {
            $buku = Buku::findOrFail($id);
            $buku->delete();
            return redirect()->route('buku.index')->with('success', 'Buku berhasil dihapus.');
        } catch (\Illuminate\Database\QueryException $e) {
            // Cek kode error 23000 (integrity constraint violation)
            return redirect()->route('buku.show', $id)
                ->with('error', 'Buku tidak dapat dihapus karena masih memiliki data peminjaman.');
        }
    }
}
