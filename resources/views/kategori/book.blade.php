@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('stylefafa.css') }}">
@endsection
@section('content')
    @include('partials.sidebar-lihat-kategori')
    <div class="konten">
        <h1>
            <span class="material-symbols-outlined" id="back-kategori">
                arrow_back_ios
            </span>
            Judul Buku Kategori {{ $kategori->nama_kategori }}
        </h1>
        <div class="detail-kategori">
            <div class="book-card">
                <p>{{ $buku->judul }}</p>
            </div>


            <div class="description-box">
                <p>{{ $buku->deskripsi }}</p>
            </div>


        </div>
        <!-- <a href="#" class="delete-button">
                <span class="material-symbols-outlined">
                    delete
                </span> <span>Hapus Buku dari Kategori {{ $kategori->nama_kategori }}</span>
            </a>

            <script>
                document.getElementById('back-kategori').addEventListener('click', function () {
                    window.location.href = 'HalamanBukuFiksi.html';
                });
            </script> -->

        <form
            action="{{ route('kategori.book.remove', ['kategori_id' => $kategori->id_kategori, 'buku_id' => $buku->id_buku ?? $buku->id]) }}"
            method="POST">
            @csrf
            <button type="submit" class="delete-button" onclick="return confirm('Hapus buku dari kategori?')">
                <span class="material-symbols-outlined">delete</span>
                <span>Hapus Buku dari Kategori {{ $kategori->nama_kategori }}</span>
            </button>
        </form>
    </div>

    <script>
        document.getElementById('back-kategori').addEventListener('click', function () {
            window.location.href = '{{ route('kategori.show', ['kategori' => $kategori->id_kategori]) }}';
        });
    </script>
@endsection