@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('stylefafa.css') }}">
@endsection
@section('content')
    @include('partials.sidebar-lihat-kategori')
    <div class="konten">
        <h1><span class="material-symbols-outlined" id="back-kategori">
                arrow_back_ios
            </span>Tambah Buku ke Kategori Fiksi</h1>
        <table>
            <thead>
                <tr>
                    <th>ISBN</th>
                    <th>Judul Buku</th>
                    <th>Kategori</th>
                    <th>Lihat</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($buku as $item)
                    <tr>
                        <td>{{ $item->isbn }}</td>
                        <td style="max-width: 150px">{{ $item->judul }}</td>
                        <td>{{ $item->kategori->nama_kategori ?? '-' }}</td>
                        <td>
                            <form
                                action="{{ route('kategori.updateKategoriBuku', ['kategori_id' => $kategori->id_kategori, 'buku_id' => $item->id]) }}"
                                method="POST" style="display:inline;">
                                @csrf
                                <button type="submit" class="lihat-btn">+</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <script>
            document.getElementById('back-kategori').addEventListener('click', function () {
                window.location.href = 'HalamanBukuFiksi.html';
            });
        </script>
    </div>
@endsection