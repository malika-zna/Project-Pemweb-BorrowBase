@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('styleregist.css') }}">
@endsection
@section('content')
    <div class="kartu">
        <div class="fox">
            <img src="fox.svg" alt="">
        </div>
        <div class="auth-container">
            <div class="atas">
                <img src="logo.svg" alt="logo">
                <p>Daftarkan akun baru</p>
            </div>

            <form method="POST" action="{{ route('register') }}">
                @csrf

                <div class="isian">
                    <label for="email">Email</label>
                    <input type="email" name="email" value="{{ old('email') }}" placeholder="borrow@base.com" required>
                    @error('email') <span class="error">{{ $message }}</span> @enderror
                </div>

                <div class="isian">
                    <label for="ndepan">Nama Depan</label>
                    <input name="ndepan" type="text" value="{{ old('ndepan') }}" placeholder="Malika" required>
                        @error('ndepan') <span class="error">{{ $message }}</span> @enderror
                    <!-- <input type="text" name="name" value="{{ old('name') }}" required>
                        @error('name') <span class="error">{{ $message }}</span> @enderror -->
                </div>

                <div class="isian">
                    <label for="nbelakang">Nama Belakang</label>
                    <input name="nbelakang" type="text" value="{{ old('nbelakang') }}" placeholder="Zahro" required>
                        @error('nbelakang') <span class="error">{{ $message }}</span> @enderror
                    <!-- <input type="text" name="name" value="{{ old('name') }}" required>
                        @error('name') <span class="error">{{ $message }}</span> @enderror -->
                </div>

                <!-- <div class="isian">
                        <label for="name">Nama</label>
                        <input type="text" name="name" value="{{ old('name') }}" required>
                        @error('name') <span class="error">{{ $message }}</span> @enderror
                    </div> -->

                <div class="isian">
                    <label for="kontak">Kontak</label>
                    <input name="kontak" type="tel" placeholder="088877776666" value="{{ old('kontak') }}" required>
                </div>

                <div class="isian">
                    <label for="password">Password</label>
                    <div class="input-pass">
                        <input name="password" type="password" placeholder="xxxxxx" required>
                        <span class="material-symbols-outlined">
                            lock
                        </span>
                    </div>
                    @error('password') <span class="error">{{ $message }}</span> @enderror
                </div>

                <div class="isian">
                    <label for="password_confirmation">Konfirmasi Password</label>

                    <div class="input-pass">
                        <input type="password" name="password_confirmation" placeholder="xxxxxx" required>
                        <span class="material-symbols-outlined">
                            lock
                        </span>
                    </div>
                </div>

                <div class="tombol">
                    <button type="submit" class="bt-daftar">Daftar</button>
                    <p>Sudah punya akun? <a href="{{ route('login') }}">Masuk</a></p>
                </div>
            </form>
            <!-- <form class="form" action="">
                <div class="isian">
                    <label for="email">Email</label>
                    <input name="email" type="email" placeholder="borrow@base.com">
                </div>
                <div class="isian">
                    <label for="ndepan">Nama Depan</label>
                    <input name="ndepan" type="text" placeholder="Malika">
                </div>
                <div class="isian">
                    <label for="nbelakang">Nama Belakang</label>
                    <input name="nbelakang" type="text" placeholder="Zahro">
                </div>
                <div class="isian">
                    <label for="kontak">Kontak</label>
                    <input name="kontak" type="tel" placeholder="088877776666">
                </div>
                <div class="isian">
                    <label for="pass">Password</label>
                    <div class="input-pass">
                        <input name="pass" type="password" placeholder="xxxxxx">
                        <span class="material-symbols-outlined">
                            lock
                        </span>
                    </div>
                </div>
                <div class="isian">
                    <label for="pass-ulang">Ulangi Password</label>
                    <div class="input-pass">
                        <input name="pass-ulang" type="password" placeholder="xxxxxx">
                        <span class="material-symbols-outlined">
                            lock
                        </span>
                    </div>
                </div>
                <div class="tombol">
                    <button class="bt-daftar">Daftar</button>
                    <p>Sudah punya akun? <a href="tes-login.html">Masuk</a></p>
                </div>
            </form> -->
        </div>
    </div>
    <!-- <div class="auth-container">
            <h1>Register</h1>
            <form method="POST" action="{{ route('register') }}">
                @csrf
                <div class="isian">
                    <label for="name">Nama</label>
                    <input type="text" name="name" value="{{ old('name') }}" required>
                    @error('name') <span class="error">{{ $message }}</span> @enderror
                </div>

                <div class="isian">
                    <label for="email">Email</label>
                    <input type="email" name="email" value="{{ old('email') }}" required>
                    @error('email') <span class="error">{{ $message }}</span> @enderror
                </div>

                <div class="isian">
                    <label for="password">Password</label>
                    <input type="password" name="password" required>
                    @error('password') <span class="error">{{ $message }}</span> @enderror
                </div>

                <div class="isian">
                    <label for="password_confirmation">Konfirmasi Password</label>
                    <input type="password" name="password_confirmation" required>
                </div>

                <button type="submit" class="btn-submit">Daftar</button>
                <p>Sudah punya akun? <a href="{{ route('login') }}">Login di sini</a></p>
            </form>
        </div> -->
@endsection