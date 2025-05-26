@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('style-peminjaman.css') }}">
@endsection
@section('content')
    @include('partials.sidebar-status-peminjaman')
    <div class="konten">
        <h1>Status Peminjaman Buku</h1>

        <form method="GET" action="{{ route('peminjaman.index') }}" class="kolom-input-container">
            <div class="search-wrapper">
                <input class="kolom-input" type="search" name="q" placeholder="Cari buku atau anggota"
                    value="{{ request('q') }}">
                <span class="material-symbols-outlined search-icon">search</span>
            </div>
            <div class="select-wrapper">
                <select class="kolom-input" name="status">
                    <option value="">Semua Status</option>
                    <option value="Sedang Dipinjam" {{ request('status') == 'Sedang Dipinjam' ? 'selected' : '' }}>Sedang
                        Dipinjam</option>
                    <option value="Selesai" {{ request('status') == 'Selesai' ? 'selected' : '' }}>Selesai</option>
                </select>
                <span class="material-symbols-outlined select-arrow">arrow_drop_down</span>
            </div>
            <div class="select-wrapper">
                <select class="kolom-input" name="sort">
                    <option value="" {{ request('sort') == '' ? 'selected' : '' }}>Pilih Urutan</option>
                    <option value="terbaru" {{ request('sort') == 'terbaru' ? 'selected' : '' }}>Terbaru</option>
                    <option value="terlama" {{ request('sort') == 'terlama' ? 'selected' : '' }}>Terlama</option>
                </select>
                <span class="material-symbols-outlined select-arrow">arrow_drop_down</span>
            </div>
            <!-- <button type="submit" class="bt-tambah">Filter</button> -->
        </form>
        <script>
            document.querySelectorAll('.kolom-input-container select').forEach(function (select) {
                select.addEventListener('change', function () {
                    this.form.submit();
                });
            });
        </script>

        <!-- 
            <div class="tombol">
                <button onclick="window.location.href='{{ route('peminjaman.create') }}'" class="bt-tambah">Tambah
                    Peminjaman</button>
            </div> -->
        <table class="daftar">
            <tr class="judul">
                <th>Nama Anggota</th>
                <th>Judul Buku</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
            @foreach ($peminjaman as $item)
                <tr>
                    <td>{{ $item->anggota->nama ?? '-' }}</td>
                    <td>{{ optional($item->buku)->judul ?? '-' }}</td>
                    <td>
                        @php
                            $isTerlambat = $item->status == 'Sedang Dipinjam' && \Carbon\Carbon::parse($item->tanggal_kembali)->lt(\Carbon\Carbon::today());
                        @endphp
                        <p class="status 
                                        {{ $item->status == 'Selesai' ? 'status-selesai' : '' }}
                                        {{ $item->status == 'Sedang Dipinjam' ? 'status-dipinjam' : '' }}
                                        {{ $isTerlambat ? 'status-terlambat' : '' }}">
                            {{ $isTerlambat ? 'Terlambat' : $item->status }}
                        </p>
                    </td>
                    <td>
                        <button class="bt-edit" onclick="window.location.href='{{ route('peminjaman.edit', $item->id) }}'"><span
                                class="material-symbols-outlined">
                                edit
                            </span></button>
                        <form action="{{ route('peminjaman.destroy', $item->id) }}" method="POST" style="display:inline">
                            @csrf
                            @method('DELETE')
                            <button class="bt-hapus" onclick="return confirm('Yakin ingin menghapus?')"><span
                                    class="material-symbols-outlined">
                                    delete
                                </span></button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </table>
    </div>
@endsection
