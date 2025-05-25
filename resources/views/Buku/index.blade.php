@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('style.css') }}">
@endsection
@section('content')
    @include('partials.sidebar-daftar-buku')
    <div class="konten">
        <h1>Daftar Buku</h1>

        <form class="kolom-input-container" method="GET" action="{{ route('buku.index') }}">
            <div class="search-wrapper">
                <input class="kolom-input" type="search" name="q" placeholder="Cari judul buku" value="{{ request('q') }}">
                <span class="material-symbols-outlined search-icon">search</span>
            </div>
            <div class="select-wrapper">
                <select class="kolom-input" name="kategori">
                    <option value="">Semua Kategori</option>
                    @foreach ($kategoriList as $kategori)
                        <option value="{{ $kategori->id_kategori }}" {{ request('kategori') == $kategori->id_kategori ? 'selected' : '' }}>
                            {{ $kategori->nama_kategori }}
                        </option>
                    @endforeach
                </select>
                <span class="material-symbols-outlined select-arrow">arrow_drop_down</span>
            </div>
            <script>
                document.querySelector('.kolom-input[name="kategori"]').addEventListener('change', function () {
                    this.form.submit();
                });
            </script>
        </form>
        <table class="daftar">
            <tr class="judul">
                <th>ISBN</th>
                <th>Judul Buku</th>
                <th>Kategori</th>
                <th>Tersedia</th>
                <th>Dipinjam</th>
                <th>Lihat</th>
            </tr>
            @foreach ($buku as $item)
                <tr>
                    <td>
                        <p>{{ $item->isbn }}</p>
                    </td>
                    <td>
                        <p>{{ $item->judul }}</p>
                    </td>
                    <td>
                        <p>{{ $item->kategori->nama_kategori ?? '-' }}</p>
                    </td>
                    <td>
                        <p>{{ $item->jumlah_tersedia }}</p>
                    </td>
                    <td>
                        <p>{{ $item->jumlah_dipinjam }}</p>
                    </td>
                    <td><button onclick="window.location.href='{{ route('buku.show', $item->id) }}'">Detail</button></td>
                </tr>
            @endforeach
        </table>
    </div>
@endsection