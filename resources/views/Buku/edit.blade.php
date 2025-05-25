@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('style.css') }}">
@endsection
@section('content')
    @include('partials.sidebar-daftar-buku')
    <div class="konten">
        <h1><a href="{{ route('buku.show', $buku->id) }}"><span
                    class="material-symbols-outlined">arrow_back_ios</span>Edit Buku</a></h1>
        @if ($errors->any())
            <div class="alert alert-danger">
                <strong>Gagal menyimpan perubahan!</strong>
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
        <form class="form" action="{{ route('buku.update', $buku->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            @include('buku._form', ['buku' => $buku])
            <div class="tombol">
                <button class="bt-kembali" onclick="window.location.href='{{ route('buku.index') }}'"
                    type="button">Kembali</button>
                <button class="bt-edit" type="submit">Simpan</button>
            </div>
        </form>
    </div>
@endsection