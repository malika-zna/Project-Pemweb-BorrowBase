@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('stylefafa.css') }}">
@endsection
@section('content')
@include('partials.sidebar-hapus-kategori')
<div class="konten">
    <h1>Hapus Kategori</h1>
    <form action="{{ route('kategori.destroy', 0) }}" method="POST" id="form-hapus-kategori"
        onsubmit="return confirm('Yakin ingin menghapus kategori ini?')">
        @csrf
        @method('DELETE')
        <label for="kategori">Kategori</label>
        <select id="kategori" name="kategori_id" class="input-kategori" required>
            <option value="" disabled selected>Pilih Kategori</option>
            @foreach ($kategori as $item)
                <option value="{{ $item->id_kategori }}">{{ $item->nama_kategori }}</option>
            @endforeach
        </select>
        <div class="tombol-aksi" style="margin-top:20px;">
            <button type="submit" class="btn-hapus">Hapus</button>
        </div>
    </form>
</div>

<script>
    // Ubah action form sesuai kategori yang dipilih
    document.getElementById('kategori').addEventListener('change', function () {
        var form = document.getElementById('form-hapus-kategori');
        var selectedId = this.value;
        form.action = "{{ url('kategori') }}/" + selectedId;
    });
</script>