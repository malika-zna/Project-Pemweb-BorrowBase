@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('stylefafa.css') }}">
@endsection
@section('content')
    @include('partials.sidebar-lihat-kategori')
    <div class="konten">
        <h1>Kategori Buku</h1>

        @foreach ($kategori as $item)
            <div class="category-section">
                <div class="category-header">
                    <h2>{{ $item->nama_kategori }}</h2>
                    <a href="{{ route('kategori.edit', $item->id_kategori) }}" class="edit-icon">&#9998;</a>
                </div>
                <div class="book-item-container" data-kategori="{{ strtolower($item->nama_kategori) }}"
                    data-id="{{ $item->id_kategori }}">
                    <div class="book-details">
                        <p>{{ $item->deskripsi }}</p>
                    </div>
                    <div class="book-placeholder"></div>
                </div>
            </div>
        @endforeach

        <script>
            document.querySelectorAll('.book-item-container').forEach(function (box) {
                box.style.cursor = 'pointer';
                box.addEventListener('click', function () {
                    const id = box.getAttribute('data-id');
                    window.location.href = '/kategori/' + id;
                });
            });
        </script>
    </div>
@endsection