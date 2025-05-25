<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\BukuController;
use App\Http\Controllers\AnggotaController;
use App\Http\Controllers\PeminjamanController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\HomeController;

// Route::get('/', function () {
//     return view('welcome');
// });

// Route::get('/', function () {
//     return redirect()->route('buku.index');
// });

// Route::get('/', function () {
//     return view('welcome');
// });
// Route::get('/', fn () => redirect()->route('login'));
Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
// Halaman setelah login
Route::get('/beranda', [HomeController::class, 'index'])->middleware('auth')->name('beranda');

Route::resource('buku', BukuController::class);
Route::resource('anggota', AnggotaController::class);
Route::resource('peminjaman', PeminjamanController::class);
Route::get('kategori/delete', [KategoriController::class, 'delete'])->name('kategori.delete');
Route::get('kategori/create', [KategoriController::class, 'create'])->name('kategori.create');
Route::get('kategori/{id}', [KategoriController::class, 'show'])->name('kategori.show');
Route::get('kategori/{id}/add-buku', [KategoriController::class, 'addBuku'])->name('kategori.addBuku');
// Route::get('kategori/{id}/add', [KategoriController::class, 'addBuku'])->name('kategori.add');
Route::post('kategori/{kategori_id}/add-buku/{buku_id}', [KategoriController::class, 'updateKategoriBuku'])->name('kategori.updateKategoriBuku');
Route::get('kategori/{kategori_id}/buku/{buku_id}', [KategoriController::class, 'showBuku'])->name('kategori.book');
Route::post('kategori/{kategori_id}/buku/{buku_id}/hapus', [KategoriController::class, 'hapusBukuDariKategori'])->name('kategori.book.remove');
Route::resource('kategori', KategoriController::class);
Route::middleware('auth')->group(function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');
    Route::get('/admin/tambah', [AdminController::class, 'create'])->name('admin.create');
    Route::post('/admin/tambah', [AdminController::class, 'store'])->name('admin.store');
    Route::get('/admin/profil', [AdminController::class, 'profile'])->name('admin.profile');
});
Route::delete('/admin/profil', [AdminController::class, 'destroy'])->name('admin.profile.destroy');
Route::post('/admin/profil/update-foto', [AdminController::class, 'updateFoto'])->name('admin.profile.updateFoto');
Route::post('/admin/profil/update', [AdminController::class, 'updateProfile'])->name('admin.profile.update');
Route::post('/admin/profil/update-tahun', [AdminController::class, 'updateTahun'])->name('admin.profile.updateTahun');
Route::post('/admin/profil/update-nama', [AdminController::class, 'updateNama'])->name('admin.profile.updateNama');



