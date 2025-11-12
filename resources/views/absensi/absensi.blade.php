@section('content')
<h1>Absensi</h1>

@if(session('success'))
    <p style="color:green">{{ session('success') }}</p>
@endif

<form action="{{ route('absensi.store') }}" method="POST">
    @csrf
    <label>Mata Kuliah:</label>
    <select name="mata_kuliah_id" required>
        @foreach($matakuliah as $mk)
            <option value="{{ $mk->id }}">{{ $mk->nama_mk }}</option>
        @endforeach
    </select><br>

    <label>Tanggal:</label>
    <input type="date" name="tanggal" required><br>

    <button type="submit">Simpan</button>
</form>

<h2>Daftar Absensi</h2>
<table border="1" cellpadding="10">
    <tr>
        <th>ID</th>
        <th>Mata Kuliah</th>
        <th>Tanggal</th>
    </tr>
    @foreach($absensi as $abs)
    <tr>
        <td>{{ $abs->id }}</td>
        <td>{{ $abs->mataKuliah->nama_mk }}</td>
        <td>{{ $abs->tanggal }}</td>
    </tr>
    @endforeach
</table>

