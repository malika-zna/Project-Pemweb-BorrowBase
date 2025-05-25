@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('stylefafa.css') }}">
@endsection
@section('content')
    @include('partials.sidebar-lihat-kategori')
    <div class="konten">
        <h1>Edit Kategori</h1>
        <div class="form-kategori">
            <form action="{{ route('kategori.update', $kategori->id_kategori) }}" method="POST">
                @csrf
                @method('PUT')

                <label for="kategori">Kategori</label>
                <input type="text" name="nama_kategori" id="kategori" class="input-kategori"
                    value="{{ $kategori->nama_kategori }}" required>

                <label for="deskripsi">Deskripsi</label>
                <textarea name="deskripsi" id="deskripsi" class="input-kategori">{{ $kategori->deskripsi }}</textarea>

                <div class="tombol-aksi">
                    <button type="submit" class="btn-edit">Edit</button>
                    <button type="button" class="btn-cancel"
                        onclick="window.location.href='{{ route('kategori.index') }}'">Cancel</button>
                </div>
            </form>
        </div>
    </div>
@endsection