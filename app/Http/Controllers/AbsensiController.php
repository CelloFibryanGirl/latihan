<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Absensi;
use App\Models\Mahasiswa;
use App\Models\Matakuliah;

class AbsensiController extends Controller
{
    public function index(Request $req)
    {
        $daftarMatkul = Matakuliah::all();
        $daftarMahasiswa = collect();
        $matkulDipilih = $req->input('matakuliah_id');
        $tanggalDipilih = $req->input('tanggal_absensi');

        if (!empty($matkulDipilih) && !empty($tanggalDipilih)) {
            $daftarMahasiswa = Mahasiswa::all();

            $rekapAbsensi = Absensi::where('matakuliah_id', $matkulDipilih)
                ->where('tanggal_absensi', $tanggalDipilih)
                ->get()
                ->groupBy('mahasiswa_id')
                ->map(function ($item) {
                    return $item->first();
                });

            return view('absensi.absensi', [
                'mataKuliahs' => $daftarMatkul,
                'mahasiswas' => $daftarMahasiswa,
                'selectedMatkul' => $matkulDipilih,
                'selectedDate' => $tanggalDipilih,
                'existingAbsensi' => $rekapAbsensi,
            ]);
        }

        return view('absensi.absensi', [
            'mataKuliahs' => $daftarMatkul,
            'mahasiswas' => $daftarMahasiswa,
            'selectedMatkul' => $matkulDipilih,
            'selectedDate' => $tanggalDipilih,
        ]);
    }

    public function store(Request $req)
    {
        $data = $req->validate([
            'tanggal_absensi' => ['required', 'date'],
            'matakuliah_id' => ['required', 'exists:matakuliah,id'],
            'status' => ['required', 'array'],
        ]);

        $tgl = $data['tanggal_absensi'];
        $idMatkul = $data['matakuliah_id'];

        foreach ($data['status'] as $idMhs => $keterangan) {
            Absensi::updateOrCreate(
                [
                    'mahasiswa_id' => $idMhs,
                    'matakuliah_id' => $idMatkul,
                    'tanggal_absensi' => $tgl,
                ],
                [
                    'status_absen' => $keterangan,
                ]
            );
        }

        return redirect()
            ->route('absensi.index', [
                'tanggal_absensi' => $tgl,
                'matakuliah_id' => $idMatkul,
            ])
            ->with('success', 'Data absensi telah berhasil disimpan.');
    }
}
