@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('stylecan.css') }}">
@endsection
@section('content')
    @include('partials.sidebar-akun-saya')
    <div class="konten">
        <h1>Profil Saya</h1>
        <div class="profil-container">
            <div class="profil-kiri">
                <div class="profil-foto">
                    <img class="profil-tengah" id="foto-profil"
                        src="{{ $user->foto ? asset('uploads/foto/' . $user->foto) : asset('uploads/foto/default-user.png') }}"
                        alt="Foto Profil">
                    <form id="form-foto" method="POST" action="{{ route('admin.profile.updateFoto') }}"
                        enctype="multipart/form-data" style="display:none;">
                        @csrf
                        <input type="file" name="foto" id="input-foto" accept="image/*"
                            onchange="document.getElementById('form-foto').submit();">
                    </form>
                    <div class="camera-icon">
                        <span class="material-symbols-outlined">photo_camera</span>
                    </div>
                </div>

                <div class="form-kolom informasi-section">
                    <h3>Informasi</h3>
                    <label>Posisi</label>
                    @csrf
                    <form id="form-jabatan" method="POST" action="{{ route('admin.profile.update') }}">
                        @csrf
                        <div class="form-barang">
                            <select name="jabatan" id="jabatan" class="form-select">
                                <option value="">Pilih Jabatan</option>
                                <option value="Ketua Departemen" {{ (old('jabatan', $user->jabatan ?? '') == 'Ketua Departemen') ? 'selected' : '' }}>Ketua Departemen</option>
                                <option value="Wakil Dekan" {{ (old('jabatan', $user->jabatan ?? '') == 'Wakil Dekan') ? 'selected' : '' }}>Wakil Dekan</option>
                                <option value="Ketua Prodi" {{ (old('jabatan', $user->jabatan ?? '') == 'Ketua Prodi') ? 'selected' : '' }}>Ketua Prodi</option>
                                <option value="Sekretaris Departemen" {{ (old('jabatan', $user->jabatan ?? '') == 'Sekretaris Departemen') ? 'selected' : '' }}>Sekretaris Departemen</option>
                                <option value="Staf Ahli" {{ (old('jabatan', $user->jabatan ?? '') == 'Staf Ahli') ? 'selected' : '' }}>Staf Ahli</option>
                            </select>
                        </div>
                    </form>

                    <script>
                        document.querySelector('.camera-icon').addEventListener('click', function () {
                            document.getElementById('input-foto').click();
                        });
                        document.getElementById('jabatan').addEventListener('change', function () {
                            document.getElementById('form-jabatan').submit();
                        });
                    </script>
                    <label>Tahun</label>
                    <form id="form-tahun" method="POST" action="{{ route('admin.profile.updateTahun') }}">
                        @csrf
                        <div class="form-barang">
                            <input type="number" name="tahun" id="tahun" value="{{ $user->tahun ?? '' }}" placeholder="2015"
                                min="1900" max="2099">
                            <span class="material-symbols-outlined">edit</span>
                        </div>
                    </form>
                    <script>
                        document.getElementById('tahun').addEventListener('change', function () {
                            const tahun = this.value;
                            fetch("{{ route('admin.profile.updateTahun') }}", {
                                method: "POST",
                                headers: {
                                    "Content-Type": "application/json",
                                    "X-CSRF-TOKEN": "{{ csrf_token() }}"
                                },
                                body: JSON.stringify({ tahun: tahun })
                            })
                                .then(response => response.json())
                                .then(data => {
                                    // Optional: tampilkan notifikasi sukses/gagal
                                    // alert(data.message);
                                });
                        });

                        document.getElementById('tahun').addEventListener('keydown', function (e) {
                            if (e.key === 'Enter') {
                                e.preventDefault(); // Mencegah submit form dan reload halaman
                                this.blur(); // Optional: trigger blur agar AJAX tetap jalan jika pakai event blur
                            }
                        });

                        document.getElementById('tahun').addEventListener('change', function () {
                            const tahun = this.value;
                            fetch("{{ route('admin.profile.updateTahun') }}", {
                                method: "POST",
                                headers: {
                                    "Content-Type": "application/json",
                                    "X-CSRF-TOKEN": "{{ csrf_token() }}"
                                },
                                body: JSON.stringify({ tahun: tahun })
                            })
                                .then(response => response.json())
                                .then(data => {
                                    // Optional: tampilkan notifikasi sukses/gagal
                                    // alert(data.message);
                                });
                        });
                    </script>
                </div>
            </div>

            <div class="profil-kanan">
                <div class="form-kolom">
                    <h3>Identitas</h3>
                    <label>Nama Depan</label>
                    <div class="form-barang">
                        <input type="text" id="ndepan" value="{{ $user->ndepan ?? '' }}">
                        <span class="material-symbols-outlined">edit</span>
                    </div>
                    <label>Nama Belakang</label>
                    <div class="form-barang">
                        <input type="text" id="nbelakang" value="{{ $user->nbelakang ?? '' }}">
                        <span class="material-symbols-outlined">edit</span>
                    </div>
                    <label>Nomor Kontak</label>
                    <div class="form-barang">
                        <input type="text" id="kontak" value="{{ $user->kontak ?? '' }}">
                        <span class="material-symbols-outlined">edit</span>
                    </div>
                </div>

                <div class="form-kolom">
                    <h3>Keamanan</h3>
                    <label>Email</label>
                    <div class="form-barang">
                        <input type="email" id="email" value="{{ $user->email ?? '' }}">
                        <span class="material-symbols-outlined">edit</span>
                    </div>
                    <label>Password</label>
                    <div class="form-barang">
                        <input type="password" id="password" value="********" placeholder="********">
                        <span class="material-symbols-outlined">edit</span>
                    </div>
                </div>

                <script>
                    function updateNama(field, value) {
                        fetch("{{ route('admin.profile.updateNama') }}", {
                            method: "POST",
                            headers: {
                                "Content-Type": "application/json",
                                "X-CSRF-TOKEN": "{{ csrf_token() }}"
                            },
                            body: JSON.stringify({ field: field, value: value })
                        })
                            .then(response => response.json())
                            .then(data => {
                                // Optional: tampilkan notifikasi sukses/gagal
                                // alert(data.message);
                            });
                    }

                    document.getElementById('ndepan').addEventListener('change', function () {
                        updateNama('ndepan', this.value);
                    });
                    document.getElementById('nbelakang').addEventListener('change', function () {
                        updateNama('nbelakang', this.value);
                    });

                    // Cegah submit/reload saat enter
                    ['ndepan', 'nbelakang'].forEach(function (id) {
                        document.getElementById(id).addEventListener('keydown', function (e) {
                            if (e.key === 'Enter') {
                                e.preventDefault();
                                this.blur();
                            }
                        });
                    });

                    document.getElementById('kontak').addEventListener('change', function () {
                        updateNama('kontak', this.value);
                    });
                    document.getElementById('kontak').addEventListener('keydown', function (e) {
                        if (e.key === 'Enter') {
                            e.preventDefault();
                            this.blur();
                        }
                    });

                    document.getElementById('email').addEventListener('change', function () {
                        updateNama('email', this.value);
                    });
                    document.getElementById('email').addEventListener('keydown', function (e) {
                        if (e.key === 'Enter') {
                            e.preventDefault();
                            this.blur();
                        }
                    });

                    document.getElementById('password').addEventListener('change', function () {
                        // Prompt konfirmasi sebelum update password
                        if (confirm('Yakin ingin mengganti password?')) {
                            updateNama('password', this.value);
                            // Setelah update, kosongkan field agar tidak menampilkan password baru
                            this.value = '********';
                        } else {
                            this.value = '********';
                        }
                    });
                    document.getElementById('password').addEventListener('keydown', function (e) {
                        if (e.key === 'Enter') {
                            e.preventDefault();
                            this.blur();
                        }
                    });
                </script>
            </div>
        </div>

        <div class="aksi-btn" style="display: flex; gap: 12px; margin-top: 24px;">
            <!-- Tombol Hapus Akun -->
            <form method="POST" action="{{ route('admin.profile.destroy') }}"
                onsubmit="return confirm('Yakin ingin menghapus akun ini secara permanen?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="del-btn">
                    <span class="material-symbols-outlined">delete</span>
                </button>
            </form>
            <!-- Tombol Logout -->
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="logout-btn">
                    <span class="material-symbols-outlined">logout</span>
                </button>
            </form>
        </div>
    </div>

    <div class="popup-keluar" id="popupKeluar">
        <div class="popup-box">
            <h4>Keluar dari akun</h4>
            <p>Apakah anda yakin ingin keluar dari akun anda? Anda akan diminta untuk membuat akun baru jika keluar dari
                akun ini!</p>
            <div class="popup-aksi">
                <button onclick="tutupPopup()">Tidak</button>
                <button>iya</button>
            </div>
        </div>
    </div>

    <script>
        function toggleDropdown() {
            const list = document.getElementById("dropdown-list");
            const icon = document.getElementById("dropdown-icon");
            list.style.display = list.style.display === "block" ? "none" : "block";
            icon.textContent = list.style.display === "block" ? "keyboard_arrow_up" : "keyboard_arrow_down";
        }

        function pilihJabatan(el) {
            document.getElementById("selected-jabatan").textContent = el.textContent;
            document.getElementById("dropdown-list").style.display = "none";
            document.getElementById("dropdown-icon").textContent = "keyboard_arrow_down";
        }
    </script>

    <script>
        function tampilPopup() {
            document.getElementById("popupKeluar").style.display = "flex";
        }

        function tutupPopup() {
            document.getElementById("popupKeluar").style.display = "none";
        }
    </script>
    </div>
@endsection