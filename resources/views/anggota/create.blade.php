@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('styleale.css') }}">
@endsection
@section('content')
    @include('partials.sidebar-tambah-anggota')
    <main class="konten">
        <h1><span>Tambah Anggota Baru</span></h1>
        <form class="form" action="{{ route('anggota.store') }}" method="POST">
            @csrf
            @include('anggota._form', ['anggota' => null])
            <div class="tombol">
                <button type="reset" class="batal">Batal</button>
                <button type="submit" class="simpan">Simpan</button>
            </div>
        </form>
        <img class="decorationimg" src="{{ asset('yellowflower.svg') }}" />
    </main>
@endsection