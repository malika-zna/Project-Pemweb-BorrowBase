<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Models\Buku;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    public function index()
    {
        $kategori = Kategori::all();
        return view('kategori.index', compact('kategori'));
    }

    public function create()
    {
        return view('kategori.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_kategori' => 'required|unique:kategori,nama_kategori',
            'deskripsi' => 'nullable'
        ]);

        Kategori::create($request->all());
        return redirect()->route('kategori.index')->with('success', 'Kategori berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $kategori = Kategori::findOrFail($id);
        return view('kategori.edit', compact('kategori'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_kategori' => 'required|unique:kategori,nama_kategori,' . $id . ',id_kategori',
            'deskripsi' => 'nullable'
        ]);

        $kategori = Kategori::findOrFail($id);
        $kategori->update($request->all());

        return redirect()->route('kategori.index')->with('success', 'Kategori berhasil diperbarui.');
    }

    public function show($id)
    {
        $kategori = Kategori::findOrFail($id);
        $buku = Buku::where('id_kategori', $id)->get();
        return view('kategori.detail', compact('kategori', 'buku'));
    }

    public function addBuku($id)
    {
        $kategori = Kategori::findOrFail($id);
        // Ambil buku yang kategorinya BUKAN kategori ini
        $buku = Buku::where('id_kategori', '!=', $id)->get();
        return view('kategori.add', compact('kategori', 'buku'));
    }

    public function updateKategoriBuku($kategori_id, $buku_id)
    {
        $buku = Buku::findOrFail($buku_id);
        $buku->id_kategori = $kategori_id;
        $buku->save();

        return redirect()->route('kategori.addBuku', ['id' => $kategori_id])->with('success', 'Kategori buku berhasil diubah.');
    }

    public function showBuku($kategori_id, $buku_id)
    {
        $kategori = Kategori::findOrFail($kategori_id);
        $buku = Buku::findOrFail($buku_id);
        return view('kategori.book', compact('kategori', 'buku'));
    }

    public function hapusBukuDariKategori($kategori_id, $buku_id)
    {
        $buku = Buku::findOrFail($buku_id);
        $buku->id_kategori = null;
        $buku->save();
        return redirect()->route('kategori.show', $kategori_id)->with('success', 'Buku berhasil dihapus dari kategori.');
    }

    public function delete()
    {
        $kategori = Kategori::all();
        return view('kategori.delete', compact('kategori'));
    }

    public function destroy($id)
    {
        $kategori = Kategori::findOrFail($id);
        $kategori->delete();
        return redirect()->route('kategori.index')->with('success', 'Kategori berhasil dihapus.');
    }
}
