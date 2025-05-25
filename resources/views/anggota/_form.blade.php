<div class="isian">
    <label for="nim">NIM</label>
    <input name="nim" type="text" value="{{ old('nim', $anggota->nim ?? '') }}" required>
</div>
<div class="isian">
    <label for="nama">Nama Lengkap</label>
    <input name="nama" type="text" value="{{ old('nama', $anggota->nama ?? '') }}" required>
</div>
<div class="isian">
    <label for="email">Email</label>
    <input name="email" type="text" value="{{ old('email', $anggota->email ?? '') }}" required>
</div>
<div class="isian">
    <label for="alamat">Alamat</label>
    <input name="alamat" type="text" value="{{ old('alamat', $anggota->alamat ?? '') }}" required>
</div>
<div class="isian">
    <label for="telepon">Nomor Telepon</label>
    <input name="telepon" type="text" value="{{ old('telepon', $anggota->telepon ?? '') }}" required>
</div>
<div class="isian">
    <label for="kota">Kota</label>
    <input name="kota" type="text" value="{{ old('kota', $anggota->kota ?? '') }}" required>
</div>