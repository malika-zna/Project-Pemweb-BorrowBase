@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('style.css') }}">
@endsection
@section('content')
    @include('partials.sidebar-daftar-buku')
    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif
    <div class="konten">
        <h1><a href="{{ route('buku.index') }}"><span class="material-symbols-outlined">arrow_back_ios</span>Detail Buku</a>
        </h1>
        <div class="umum-buku">
            <div class="cover">
                @if($buku->sampul)
                    <img src="{{ asset('storage/' . $buku->sampul) }}" alt="Sampul Buku" width="100%">
                @else
                    <img src="{{ asset('storage/cover-none.png') }}" alt="Sampul Buku" width="100%">
                @endif
            </div>
            <div class="teks">
                <h1>{{ $buku->judul }}</h1>
                <p>{{ $buku->deskripsi }}</p>
            </div>
        </div>
        <div class="detail-buku">
            <table>
                <tr>
                    <td>ISBN</td>
                    <td>{{ $buku->isbn }}</td>
                </tr>
                <tr>
                    <td>Tersedia</td>
                    <td>{{ $buku->jumlah_tersedia }}</td>
                </tr>
                <tr>
                    <td>Dipinjam</td>
                    <td>{{ $buku->jumlah_dipinjam }}</td>
                </tr>
                <tr>
                    <td>Bahasa</td>
                    <td>{{ $buku->bahasa ?? '-' }}</td>
                </tr>
                <tr>
                    <td>Kategori</td>
                    <td><button>{{ $buku->kategori->nama_kategori ?? '-' }}</button></td>
                </tr>
            </table>
            <table class="tabel-2">
                <tr>
                    <td>Penerbit</td>
                    <td>{{ $buku->penerbit }}</td>
                </tr>
                <tr>
                    <td>Penulis</td>
                    <td>{{ $buku->penulis }}</td>
                </tr>
            </table>
        </div>
        <div class="tombol">
            <form id="form-hapus" action="{{ route('buku.destroy', $buku->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <button class="bt-hapus" type="button" onclick="showModal()">Hapus</button>
            </form>
            <button class="bt-edit" onclick="window.location.href='{{ route('buku.edit', $buku->id) }}'">Edit</button>
        </div>
        <div id="jendela-konfirmasi">
            <div class="dialog">
                <h2>Yakin ingin menghapus buku ini?</h2>
                <p>Data yang dihapus tidak dapat dikembalikan.</p>
                <button class="batal" onclick="hideModal()">Batal</button>
                <button class="hapus" onclick="submitHapus()">Hapus</button>
            </div>
        </div>
        <script>
            function showModal() {
                document.getElementById('jendela-konfirmasi').style.display = 'flex';
            }
            function hideModal() {
                document.getElementById('jendela-konfirmasi').style.display = 'none';
            }
            function submitHapus() {
                document.getElementById('form-hapus').submit();
            }
        </script>
    </div>
@endsection