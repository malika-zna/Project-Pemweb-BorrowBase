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
    {{ $kategori->nama_kategori }}
    </h1>
    <div class="wadah-pencarian">
    <span class="material-symbols-outlined search-icon">search</span>
    <input type="text" class="kotak-pencarian" placeholder="Cari Buku" />
    </div>

    <div class="daftar-buku">
    @foreach ($buku as $item)
    <div class="kartu-buku">
      <div class="isi-buku">
      <div>{{ $item->judul }}</div>
      </div>
      <button class="tombol-lihat"
      onclick="window.location.href='{{ route('kategori.book', ['kategori_id' => $kategori->id_kategori, 'buku_id' => $item->id_buku ?? $item->id]) }}'">
      Lihat Buku
      </button>
    </div>
    @endforeach
    </div>

    <button class="tombol-tambah"
    onclick="window.location.href='{{ route('kategori.addBuku', ['id' => $kategori->id_kategori]) }}'">+</button>

    <script>
    // Ambil elemen input, daftar buku, dan ikon search
    const input = document.querySelector('.kotak-pencarian');
    const daftarBuku = document.querySelectorAll('.kartu-buku');
    const searchIcon = document.querySelector('.search-icon');

    function filterBuku() {
      const keyword = input.value.toLowerCase();
      daftarBuku.forEach(function (buku) {
      const text = buku.innerText.toLowerCase();
      if (text.includes(keyword)) {
        buku.style.display = '';
      } else {
        buku.style.display = 'none';
      }
      });
    }

    input.addEventListener('input', filterBuku);

    searchIcon.addEventListener('click', function () {
      input.focus();
      filterBuku();
    });
    </script>

    <script>
    document.getElementById('back-kategori').addEventListener('click', function () {
      window.location.href = 'HalamanKategoriBuku.html';
    });
    </script>

    <script>
    document.getElementById('back-kategori').addEventListener('click', function () {
      window.location.href = '{{ route('kategori.index') }}';
    });
    </script>

  @endsection