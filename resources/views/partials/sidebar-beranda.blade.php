<div class="panel-samping">
    <div class="navbar">
        <div class="nav logo">
            <img src="{{ asset('logo.svg') }}" alt="Logo">
        </div>
        <div class="nav {{ request()->routeIs('beranda') ? 'nav-aktif' : '' }} beranda">
            <a href="{{ route('beranda') }}">
                <span class="material-symbols-outlined">
                    home
                </span>
                <p>Beranda</p>
            </a>
        </div>
        <div class="nav buku">
            <a href="{{ route('buku.index') }}">
                <span class="material-symbols-outlined">book_2</span>
                <p>Buku</p>
            </a>
        </div>
        <div class="nav kategori">
            <a href="{{ route('kategori.index') }}">
                <span class="material-symbols-outlined">grid_view</span>
                <p>Kategori</p>
            </a>
        </div>
        <div class="nav {{ request()->routeIs('peminjaman.*') ? 'nav-aktif' : '' }} pinjam">
            <a href="{{ route(name: 'peminjaman.index') }}">
                <span class="material-symbols-outlined">note_add</span>
                <p>Pinjam</p>
            </a>
        </div>
        <div class="nav anggota">
            <a href="{{ route('anggota.create') }}">
                <span class="material-symbols-outlined">groups</span>
                <p>Anggota</p>
            </a>
        </div>
        <div class="nav admin">
            <a href="{{ route('admin.profile') }}">
                <span class="material-symbols-outlined">person</span>
                <p>Admin</p>
            </a>
        </div>
    </div>
    <div class="sidebar-menu">
        <h1>Beranda</h1>
        <div class="menu">
            <div class="profil">
                <div class="img-container">
                    <img src="{{ auth()->user()->foto ? asset('uploads/foto/' . auth()->user()->foto) : asset('uploads/foto/default-user.png') }}" alt="">
                </div>
                <div class="identitas">
                    <p class="nama">Malika Zahro</p>
                    <p class="email">borrow@base.com</p>
                    <button class="bt-prof" onclick="window.location.href='{{ route('admin.profile') }}'">Lihat Profil</button>
                </div>
            </div>
            <div class="statistik">
                <div class="baris">
                    <div class="stat-menu kiri total-buku">
                        <img src="buku-oren.svg" alt="">
                        <h2>Total Buku</h2>
                        <p>{{ $totalBuku }}</p>
                        <button class="bt-detail-b" onclick="window.location.href='{{ route('buku.index') }}'">Lihat Buku</button>
                    </div>
                    <div class="stat-menu buku-dipinjam">
                        <img src="buku-pink.svg" alt="">
                        <h2>Buku Dipinjam</h2>
                        <p>{{ $bukuDipinjam }}</p>
                    </div>
                </div>
                <div class="baris baris2">
                    <div class="stat-menu kiri buku-tersedia">
                        <img src="buku-biru.svg" alt="">
                        <h2>Buku Tersedia</h2>
                        <p>{{ $bukuTersedia }}</p>
                    </div>
                    <div class="stat-menu total-anggota">
                        <img src="anggota.svg" alt="">
                        <h2>Total Anggota</h2>
                        <p>{{ $totalAnggota }}</p>
                        <button class="bt-detail-a" onclick="window.location.href='{{ route('anggota.index') }}'">Lihat Anggota</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>