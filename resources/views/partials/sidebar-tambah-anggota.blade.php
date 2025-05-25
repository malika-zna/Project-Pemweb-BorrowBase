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
        <div class="nav pinjam">
            <a href="{{ route(name: 'peminjaman.index') }}">
                <span class="material-symbols-outlined">note_add</span>
                <p>Pinjam</p>
            </a>
        </div>
        <div class="nav {{ request()->routeIs('anggota.*') ? 'nav-aktif' : '' }} anggota">
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
        <h1><a href="/"><span class="material-symbols-outlined">arrow_back_ios</span>Anggota</a></h1>
        <div class="menu">
            <p class="sidebar-aktif">
                <a href="{{ route('anggota.create') }}">
                    <span class="material-symbols-outlined">edit</span>Anggota Baru
                </a>
            </p>
            <p>
                <a href="{{ route('anggota.index') }}">
                    <span class="material-symbols-outlined">add_circle</span>Lihat Data Anggota
                </a>
            </p>
        </div>
    </div>
</div>