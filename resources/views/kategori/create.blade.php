@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('stylefafa.css') }}">
@endsection
@section('content')
    @include('partials.sidebar-tambah-kategori')
    <div class="konten">
        <h1>Tambah Kategori</h1>
        <div class="form-kategori">
            <form action="{{ route('kategori.store') }}" method="POST">
                @csrf
                <label for="kategori">Nama Kategori</label>
                <input type="text" name="nama_kategori" id="kategori" class="input-kategori"
                    placeholder="Masukkan Nama Kategori" required>

                <label for="deskripsi">Deskripsi</label>
                <textarea name="deskripsi" id="deskripsi" class="input-kategori"
                    placeholder="Deskripsi singkat..."></textarea>

                <div class="tombol-aksi">
                    <button type="submit" class="btn-edit">Tambah</button>
                    <button type="button" class="btn-cancel"
                        onclick="window.location.href='{{ route('kategori.index') }}'">Cancel</button>
                </div>
            </form>
        </div>
    </div>
@endsection