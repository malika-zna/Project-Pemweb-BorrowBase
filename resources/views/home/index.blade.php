@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('styleberanda.css') }}">
@endsection
@section('content')
    @include('partials.sidebar-beranda')
    <div class="konten">
        <div class="sapaan">
            <div class="teks">
                <h1>Selamat Datang,</h1>
                <h1><span>{{ auth()->user()->ndepan }} {{ auth()->user()->nbelakang }}</span>!</h1>
                <p>{{ $hariTanggal }}</p>
            </div>
            <img src="deer.svg" alt="">
        </div>
        <div class="today">
            <div class="deadline">
                <span class="material-symbols-outlined">
                    alarm
                </span>
                <h2><span>{{ $jatuhTempoHariIni }}</span> Buku jatuh tempo hari ini!</h2>
            </div>
            <div class="dipinjam">
                <img src="buku-ungu.svg" alt="">
                <h2><span>{{ $bukuDipinjamHariIni }}</span> Buku dipinjam hari ini</h2>
            </div>
            <div class="ditambahkan">
                <img src="buku-hitam.svg" alt="">
                <h2><span>{{ $bukuBaruHariIni }}</span> Buku baru ditambahkan</h2>
            </div>
            <div class="member-baru">
                <img src="anggota-hitam.svg" alt="">
                <h2><span>{{ $anggotaBaruHariIni }}</span> Anggota baru hari ini</h2>
            </div>
        </div>
        <div class="peminjaman-terbaru">
            <h2>Peminjaman Terbaru</h2>
            <div class="table-wrapper">
                <table>
                    <tr>
                        <th>ID Anggota</th>
                        <th>Nama</th>
                        <th>Judul Buku</th>
                        <th>Tanggal Peminjaman</th>
                    </tr>
                    @foreach ($peminjamanTerbaru as $item)
                        <tr>
                            <td>{{ $item->anggota->id ?? '-' }}</td>
                            <td>{{ $item->anggota->nama ?? '-' }}</td>
                            <td>{{ $item->buku->judul ?? '-' }}</td>
                            <td>{{ $item->tanggal_pinjam ?? '-'}}</td>
                        </tr>
                    @endforeach
                </table>
                <button class="bt-detail-terbaru"
                    onclick="window.location.href='{{ route('peminjaman.index', ['sort' => 'terbaru']) }}'">Lihat
                    Detail</button>
            </div>
        </div>
    </div>
@endsection