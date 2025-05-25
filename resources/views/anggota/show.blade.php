@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('styleale.css') }}">
@endsection
@section('content')
    @include('partials.sidebar-lihat-anggota')
    <main class="konten">
        <h1>Detail Anggota</h1>
        <div class="detail-anggota-section">
            <div class="info-row">
                <p class="info-label">NIM</p>
                <p class="info-value">{{ $anggota->nim }}</p>
            </div>
            <div class="info-row">
                <p class="info-label">Nama</p>
                <p class="info-value">{{ $anggota->nama }}</p>
            </div>
            <div class="info-row">
                <p class="info-label">Email</p>
                <p class="info-value">{{ $anggota->email }}</p>
            </div>
            <div class="info-row">
                <p class="info-label">Alamat</p>
                <p class="info-value">{{ $anggota->alamat }}</p>
            </div>
            <div class="info-row">
                <p class="info-label">Telepon</p>
                <p class="info-value">{{ $anggota->telepon }}</p>
            </div>
            <div class="info-row">
                <p class="info-label">Kota</p>
                <p class="info-value">{{ $anggota->kota }}</p>
            </div>
        </div>
        <section>
            <h1 class="judul-section">Daftar Buku Dipinjam</h1>
            <table aria-label="Daftar Buku Dipinjam" class="daftar">
                <thead>
                    <tr class="judul">
                        <th scope="col">ISBN</th>
                        <th scope="col">Judul Buku</th>
                        <th scope="col">Kuantitas</th>
                        <th scope="col">Jatuh Tempo</th>
                        <th scope="col">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($peminjaman as $item)
                        <tr>
                            <td>{{ $item->buku->isbn ?? '-' }}</td>
                            <td style="text-align:left;">{{ $item->buku->judul ?? '-' }}</td>
                            <td><span class="jumlah-buku">{{ $item->kuantitas }}</span></td>
                            <td>{{ \Carbon\Carbon::parse($item->jatuh_tempo)->format('d/m/Y') }}</td>
                            <td>
                                @if($item->status == 'kembali')
                                    <span class="status-sudah">Sudah Kembali</span>
                                @elseif($item->status == 'terlambat')
                                    <span class="status-terlambat">Terlambat</span>
                                @else
                                    <span class="status-dipinjam">Dipinjam</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" style="text-align:center;">Belum ada peminjaman</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            <div style="padding-bottom: 50px;"></div>
        </section>
    </main>
@endsection