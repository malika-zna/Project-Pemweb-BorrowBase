@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('stylecan.css') }}">
@endsection
@section('content')
    @include('partials.sidebar-tambah-akun')
    <div class="konten">
        <h1>Tambah Akun Baru</h1>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form class="form" action="{{ route('admin.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="isian">
                <label>Nama Depan</label>
                <input type="text" name="ndepan" placeholder="Mega" required>
            </div>
            <div class="isian">
                <label>Nama Belakang</label>
                <input type="text" name="nbelakang" placeholder="Chan" required>
            </div>
            <div class="isian">
                <label>Kontak</label>
                <input type="text" name="kontak" placeholder="08xxx" required>
            </div>
            <div class="isian">
                <label>Foto</label>
                <div class="up-file-container" style="display: flex; width: 800px;">
                    <button class="up-file" type="button" onclick="document.getElementById('sampul').click();">
                        <span class="material-symbols-outlined" style="vertical-align: middle;">upload</span>
                        Pilih Foto
                    </button>
                    <input id="file-name" type="text" value="Belum memilih file" readonly>
                    <input id="sampul" name="sampul" type="file" style="display: none;"
                        onchange="document.getElementById('file-name').value = this.files[0]?.name || 'Belum memilih file';">
                </div>
            </div>
            <div class="isian">
                <label>Email</label>
                <input type="email" name="email" placeholder="borrow@base.com" required>
            </div>
            <div class="isian">
                <label>Password</label>
                <input type="password" name="password" required>
            </div>
            <div class="isian">
                <label>Konfirmasi Password</label>
                <input type="password" name="password_confirmation" required>
            </div>
            <div class="tombol">
                <button type="button" class="btn-batal"
                    onclick="window.location.href='{{ route('admin.index') }}'">Batal</button>
                <button type="submit" class="btn-simpan">Simpan</button>
            </div>
        </form>
    </div>
@endsection
