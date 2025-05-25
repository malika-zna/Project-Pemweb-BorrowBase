@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('style-peminjaman.css') }}">
@endsection
@section('content')
    @include('partials.sidebar-buat-peminjaman')
    <div class="konten">
        <h1>Tambah Peminjaman</h1>
        <form class="form" action="{{ route('peminjaman.store') }}" method="POST">
            @csrf
            <div class="isian">
                <label>Nama Anggota</label>
                <select name="anggota_id" required>
                    @foreach ($anggotaList as $anggota)
                        <option value="{{ $anggota->id }}">{{ $anggota->nama }}</option>
                    @endforeach
                </select>
            </div>
            <div class="isian">
                <label>Judul Buku</label>
                <select name="id_buku" required>
                    @foreach ($bukuList as $buku)
                        <option value="{{ $buku->id }}">{{ $buku->judul }}</option>
                    @endforeach
                </select>
            </div>
            <div class="isian">
                <label>Tanggal Pinjam</label>
                <input type="date" name="tanggal_pinjam" required>
            </div>
            <div class="isian">
                <label>Tanggal Kembali</label>
                <input type="date" name="tanggal_kembali" required>
            </div>
            <div class="isian">
                <label>Status</label>
                <select name="status" required>
                    <option value="Sedang Dipinjam">Sedang Dipinjam</option>
                    <option value="Selesai">Selesai</option>
                </select>
            </div>
            <div class="isian">
                <label>Jumlah Buku</label>
                <input type="number" name="kuantitas" min="1" value="1" required>
            </div>
            <div class="isian">
                <label>Catatan</label>
                <textarea name="catatan"></textarea>
            </div>
            <div class="tombol">
                <button class="bt-kembali" onclick="window.location.href='{{ route('peminjaman.index') }}'"
                    type="button">Kembali</button>
                <button type="submit" class="bt-tambah">Simpan</button>
            </div>
        </form>
    </div>
@endsection