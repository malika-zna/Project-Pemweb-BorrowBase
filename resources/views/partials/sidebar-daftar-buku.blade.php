{{-- resources/views/partials/sidebar.blade.php --}}
<div class="panel-samping">
    <div class="navbar">
        <div class="nav logo">
            <img src="{{ asset('logo.svg') }}" alt="Logo">
        </div>
        <div class="nav beranda">
            <a href="{{ route('beranda') }}">
                <span class="material-symbols-outlined">
                    home
                </span>
                <p>Beranda</p>
            </a>
        </div>
        <div class="nav {{ request()->routeIs('buku.*') ? 'nav-aktif' : '' }} buku">
            <a href="{{ route(name: 'buku.index') }}">
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
        <div class="nav pinjam">
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
        <h1><a href="{{ route('beranda') }}"><span class="material-symbols-outlined">arrow_back_ios</span>Buku</a></h1>
        <div class="menu">
            <p class="sidebar-aktif">
                <a href="{{ route('buku.index') }}">
                    <span class="material-symbols-outlined">book_2</span>Daftar Buku
                </a>
            </p>
            <p>
                <a href="{{ route('buku.create') }}">
                    <span class="material-symbols-outlined">add_circle</span>Tambah Buku
                </a>
            </p>
        </div>
    </div>
</div>