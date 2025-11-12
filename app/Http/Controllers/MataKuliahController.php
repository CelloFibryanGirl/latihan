<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Matakuliah;

class MataKuliahController extends Controller
{
    public function index()
    {
        $semuaMatkul = Matakuliah::all();

        return view('matakuliah.matakuliah', [
            'mataKuliahs' => $semuaMatkul,
        ]);
    }

    public function create()
    {
        return view('matakuliah.creatematakuliah');
    }

    public function store(Request $req)
    {
        $data = $req->validate([
            'kode' => ['required', 'string', 'max:255'],
            'nama_matakuliah' => ['required', 'string', 'max:255'],
        ]);

        Matakuliah::create([
            'kode' => $data['kode'],
            'nama_matakuliah' => $data['nama_matakuliah'],
        ]);

        return redirect()
            ->route('mata-kuliah.index')
            ->with('success', 'Data mata kuliah berhasil ditambahkan.');
    }

    public function show($id)
    {
        $matkul = Matakuliah::find($id);

        if (!$matkul) {
            return redirect()
                ->route('mata-kuliah.index')
                ->with('error', 'Data mata kuliah tidak ditemukan.');
        }

        return view('matakuliah.updatematakuliah', [
            'mataKuliah' => $matkul,
        ]);
    }

    public function update(Request $req, $id)
    {
        $matkul = Matakuliah::find($id);

        if (empty($matkul)) {
            return redirect()
                ->route('mata-kuliah.index')
                ->with('error', 'Data mata kuliah tidak ditemukan.');
        }

        $inputBaru = $req->validate([
            'kode' => ['required', 'string', 'max:255'],
            'nama_matakuliah' => ['required', 'string', 'max:255'],
        ]);

        $matkul->update($inputBaru);

        return redirect()
            ->route('mata-kuliah.index')
            ->with('success', 'Data mata kuliah berhasil diperbarui.');
    }

    public function delete($id)
    {
        $matkul = Matakuliah::find($id);

        if (!$matkul) {
            return redirect()
                ->route('mata-kuliah.index')
                ->with('error', 'Data mata kuliah tidak ditemukan.');
        }

        $matkul->delete();

        return redirect()
            ->route('mata-kuliah.index')
            ->with('success', 'Data mata kuliah berhasil dihapus.');
    }
}
