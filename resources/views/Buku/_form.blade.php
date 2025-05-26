<div class="isian">
    <label for="judul">Judul Buku</label>
    <input name="judul" type="text" value="{{ old('judul', $buku->judul ?? '') }}" required>
</div>
<div class="baris-isian baris2">
    <div class="isian">
        <label for="isbn">ISBN</label>
        <input name="isbn" type="text" value="{{ old('isbn', $buku->isbn ?? '') }}" required>
    </div>
    <div class="isian kasih-jarak">
        <label for="bahasa">Bahasa</label>
        <input name="bahasa" type="text" value="{{ old('bahasa', $buku->bahasa ?? '') }}">
    </div>
</div>
<div class="baris-isian baris2">
    <div class="isian">
        <label for="id_kategori">Kategori</label>
        <select name="id_kategori">
            <option value="">Pilih Kategori</option>
            @foreach($kategoriList as $kategori)
                <option value="{{ $kategori->id_kategori }}" {{ old('id_kategori', $buku->id_kategori ?? '') == $kategori->id_kategori ? 'selected' : '' }}>{{ $kategori->nama_kategori }}</option>
            @endforeach
        </select>
    </div>
    <div class="isian kasih-jarak">
        <label for="status">Status</label>
        <select name="status" required>
            <option value="Tersedia" {{ old('status', $buku->status ?? '') == 'Tersedia' ? 'selected' : '' }}>Tersedia
            </option>
            <option value="Habis" {{ old('status', $buku->status ?? '') == 'Habis' ? 'selected' : '' }}>Habis</option>
        </select>
    </div>
    <div class="isian kasih-jarak">
        <label for="jumlah">Jumlah</label>
        <input name="jumlah" type="number" min="1" value="{{ old('jumlah', $buku->jumlah ?? '') }}" required>
    </div>
</div>
<div class="isian">
    <label for="penulis">Penulis</label>
    <input name="penulis" type="text" value="{{ old('penulis', $buku->penulis ?? '') }}" required>
</div>
<div class="isian">
    <label for="penerbit">Penerbit</label>
    <input name="penerbit" type="text" value="{{ old('penerbit', $buku->penerbit ?? '') }}" required>
</div>
<div class="isian">
    <label for="sampul">Sampul</label>
    <div class="up-file-container">
        <button class="up-file" type="button" onclick="document.getElementById('sampul').click();">
            <span class="material-symbols-outlined" style="vertical-align: middle;">upload</span>
            Pilih Sampul
        </button>
        <input id="file-name" type="text" value="Belum memilih file" readonly>
        <input id="sampul" name="sampul" type="file" style="display: none;"
            onchange="document.getElementById('file-name').value = this.files[0]?.name || 'Belum memilih file';">
    </div>
</div>
<div class="isian">
    <label for="deskripsi">Deskripsi</label>
    <textarea name="deskripsi" required>{{ old('deskripsi', $buku->deskripsi ?? '') }}</textarea>
</div>
