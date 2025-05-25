@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('style.css') }}">
@endsection
@section('content')
    @include('partials.sidebar-tambah-buku')
    <div class="konten">
        <h1><a href="{{ route('buku.index') }}"><span class="material-symbols-outlined">arrow_back_ios</span>Tambah Buku</a>
        </h1>
        @if ($errors->any())
            <div class="alert alert-danger">
                <strong>Gagal menambahkan buku!</strong>
                @foreach ($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif
        <form class="form" action="{{ route('buku.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @include('buku._form', ['buku' => null])
            <div class="tombol">
                <button class="bt-kembali" onclick="window.location.href='{{ route('buku.index') }}'"
                    type="button">Kembali</button>
                <button class="bt-tambah" type="submit">Tambah</button>
            </div>
        </form>
    </div>
@endsection