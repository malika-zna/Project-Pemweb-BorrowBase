@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('style-peminjaman.css') }}">
@endsection
@section('content')
    @include('partials.sidebar-buat-peminjaman')
    <div class="konten">
        <h1><span>Edit Peminjaman</span></h1>
        <form class="form" action="{{ route('peminjaman.update', $peminjaman->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="isian">
                <label>Nama Anggota</label>
                <input type="text" value="{{ $peminjaman->anggota->nama }}" readonly>
            </div>
            <div class="isian">
                <label>Judul Buku</label>
                <input type="text" value="{{ $peminjaman->buku->judul }}" readonly>
            </div>
            <div class="isian">
                <label>Tanggal Pinjam</label>
                <input type="date" name="tanggal_pinjam" value="{{ $peminjaman->tanggal_pinjam }}" readonly>
            </div>
            <div class="isian">
                <label>Tanggal Kembali</label>
                <input type="date" name="tanggal_kembali" value="{{ $peminjaman->tanggal_kembali }}">
            </div>
            <div class="isian">
                <label>Jumlah Buku</label>
                <input type="number" name="kuantitas" min="1" value="{{ $peminjaman->kuantitas }}" readonly>
            </div>
            <div class="isian">
                <label>Status</label>
                <select name="status">
                    <option value="Sedang Dipinjam" {{ $peminjaman->status == 'Sedang Dipinjam' ? 'selected' : '' }}>Sedang
                        Dipinjam</option>
                    <option value="Selesai" {{ $peminjaman->status == 'Selesai' ? 'selected' : '' }}>Selesai</option>
                </select>
            </div>
            <div class="isian">
                <label>Catatan</label>
                <textarea name="catatan">{{ $peminjaman->catatan }}</textarea>
            </div>
            <div class="tombol">
                <button class="bt-kembali" onclick="window.location.href='{{ route('peminjaman.index') }}'"
                    type="button">Batal</button>
                <button type="submit" class="bt-edit">Simpan</button>
            </div>
        </form>
    </div>
@endsection