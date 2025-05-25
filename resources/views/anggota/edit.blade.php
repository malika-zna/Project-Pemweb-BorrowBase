@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('styleale.css') }}">
@endsection
@section('content')
    @include('partials.sidebar-lihat-anggota')
    <main class="konten">
        <div style="display: flex; align-items: center; gap: 2px; margin-bottom: 20px; margin-top: 20px;">
            <a href="{{ route('anggota.index') }}"
                style="text-decoration:none; color:inherit; display:inline-flex; align-items:center;">
                <span class="material-symbols-outlined" style="font-size: 20px;">arrow_back_ios</span>
            </a>
            <h1 style="margin: 0; display:inline;"><span>Edit Anggota</span></h1>
        </div>
        <form class="form" action="{{ route('anggota.update', $anggota->id) }}" method="POST">
            @csrf
            @method('PUT')
            @include('anggota._form', ['anggota' => $anggota])
            <div class="tombol">
                <button type="button" class="batal"
                    onclick="window.location.href='{{ route('anggota.index') }}'">Batal</button>
                <button type="submit" class="simpan">Simpan</button>
            </div>
        </form>
        <img class="decorationimg" src="{{ asset('yellowflower.svg') }}" />
    </main>
@endsection