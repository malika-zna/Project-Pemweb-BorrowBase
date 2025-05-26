@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('styleale.css') }}">
@endsection
@section('content')
    @include('partials.sidebar-lihat-anggota')
    <main class="konten">
        <h1>Lihat Data Anggota</h1>
        <div class="search-wrapper">
            <div class="search-input-container">
                <input type="search" placeholder="Cari Anggota" class="kolom-input" />
                <span class="material-symbols-outlined search-icon">search</span>
            </div>
            <img class="groupflower" src="{{ asset('groupflower.svg') }}" />
        </div>
        <table class="daftar">
            <tr class="judul">
                <th>ID Anggota</th>
                <th>Nama Lengkap</th>
                <th>Daftar Buku</th>
                <th>Aksi</th>
            </tr>
            @foreach($anggota as $a)
                <tr>
                    <td><a href="{{ route('anggota.show', $a->id) }}">{{ $a->id }}</a></td>
                    <td class="rata-kiri"><a href="{{ route('anggota.show', $a->id) }}">{{ $a->nama }}</a></td>
                    <td><a href="{{ route('anggota.show', $a->id) }}"><button class="lihat-daftar">Lihat Daftar</button></a>
                    </td>
                    <td>
                        <a href="{{ route('anggota.edit', $a->id) }}"><button class="edit">Edit</button></a>
                        <form id="formHapus-{{ $a->id }}" action="{{ route('anggota.destroy', $a->id) }}" method="POST"
                            style="display:inline-block">
                            @csrf
                            @method('DELETE')
                            <button type="button" class="hapus"
                                onclick="tampilkanKonfirmasi({{ $a->id }}, {{ $a->jumlah_peminjaman_aktif }})">Hapus</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </table>
        <img class="decorationimg" src="{{ asset('yellowflower.svg') }}" />
    </main>
    <div id="popupKonfirmasi" class="pop-up-window-hapus" style="display:none;">
        <div class="buram"></div>
        <div class="basic-dialog">
            <div class="text-content">
                <div class="title-description">
                    <h2 class="headline">Hapus Anggota?</h2>
                    <p class="supporting-text">Data anggota akan dihapus secara permanen.</p>
                </div>
            </div>
            <div class="actions">
                <div class="actions2">
                    <div class="secondary-button" onclick="sembunyikanKonfirmasi()">
                        <div class="state-layer"><span class="label-text">Batal</span></div>
                    </div>
                    <div class="primary-button" onclick="submitFormHapus()">
                        <div class="state-layer"><span class="label-text2">Hapus</span></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="popupInfo" class="pop-up-window-hapus" style="display:none;">
        <div class="basic-dialog">
            <div class="text-content">
                <div class="title-description">
                    <h2 class="headline">Data tidak dapat dihapus!</h2>
                    <p class="supporting-text">Anggota masih memiliki peminjaman aktif.</p>
                </div>
            </div>
            <div class="actions">
                <div class="actions2">
                    <div class="primary-button" onclick="submitFormHapus()">
                        <div class="state-layer"><span class="label-text2">Oke</span></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        let formIdHapus = null;
        let jumlahPeminjamanAktif = 0;

        function tampilkanKonfirmasi(id, jumlahAktif) {
            formIdHapus = 'formHapus-' + id;
            jumlahPeminjamanAktif = jumlahAktif;
            if (jumlahPeminjamanAktif > 0) {
                document.getElementById('popupInfo').style.display = 'flex';
            } else {
                document.getElementById('popupKonfirmasi').style.display = 'flex';
            }
        }

        function sembunyikanKonfirmasi() {
            document.getElementById('popupKonfirmasi').style.display = 'none';
            formIdHapus = null;
        }

        function sembunyikanInfo() {
            document.getElementById('popupInfo').style.display = 'none';
            formIdHapus = null;
        }

        function submitFormHapus() {
            if (formIdHapus) {
                document.getElementById(formIdHapus).submit();
            }
        }
    </script>

@endsection
