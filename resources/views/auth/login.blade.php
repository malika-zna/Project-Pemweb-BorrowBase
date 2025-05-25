@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('stylelogin.css') }}">
@endsection
@section('content')
    <div class="kartu">
        <div class="fox">
            <img src="fox.svg" alt="">
        </div>
        <div class="auth-container">
            <div class="atas">
                <img src="logo.svg" alt="logo">
                <p>Masuk dengan akunmu</p>
            </div>
            @if(session('success'))
                <div class="alert-success">{{ session('success') }}</div>
            @endif
            <form method="POST" action="{{ route('login') }}">

                @csrf
                <div class="isian">
                    <label for="email">Email</label>
                    <input type="email" name="email" value="{{ old('email') }}" required autofocus>
                    @error('email') <span class="error">{{ $message }}</span> @enderror
                </div>

                <div class="isian">
                    <label for="password">Password</label>
                    <input type="password" name="password" required>
                    @error('password') <span class="error">{{ $message }}</span> @enderror
                </div>

                <div class="tombol">
                    <button type="submit" class="bt-masuk">Login</button>
                    <p>Belum punya akun? <a href="{{ route('register') }}">Daftar di sini</a></p>
                </div>
            </form>
        </div>

    </div>
@endsection