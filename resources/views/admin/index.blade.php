@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('stylecan.css') }}">
@endsection
@section('content')
    @include('partials.sidebar-daftar-akun')
    <div class="konten">
        <h1>Daftar Akun</h1>
        <div class="cari-akun">
            <span class="material-symbols-outlined">search</span>
            <input type="text" id="cari-nama-akun" placeholder="Cari Nama Akun" />
        </div>
        <table class="tabel-akun">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Kontak</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $index => $user)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td class="nama-akun">{{ $user->ndepan }} {{ $user->nbelakang }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->kontak ?? '-' }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <script>
            document.getElementById('cari-nama-akun').addEventListener('keyup', function () {
                var keyword = this.value.toLowerCase();
                document.querySelectorAll('.tabel-akun tbody tr').forEach(function (row) {
                    var nama = row.querySelector('.nama-akun').textContent.toLowerCase();
                    row.style.display = nama.includes(keyword) ? '' : 'none';
                });
            });
        </script>
    </div>
@endsection