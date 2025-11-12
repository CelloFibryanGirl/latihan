<h1>Tambah Mata Kuliah</h1>
<a href="{{ route('matakuliah.index') }}">Kembali</a>

<form action="{{ route('matakuliah.store') }}" method="POST">
    @csrf
    <label>Kode:</label><br>
    <input type="text" name="kode" required><br>
    
    <label>Nama Mata Kuliah:</label><br>
    <input type="text" name="nama_matakuliah" required><br>
    
    <label>Jurusan:</label><br>
    <input type="text" name="jurusan" required><br><br>
    
    <button type="submit">Simpan</button>
</form>
