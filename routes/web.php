<?php

use Illuminate\Support\Facades\Route; // <--- ini wajib
use App\Http\Controllers\MataKuliahController;
use App\Http\Controllers\AbsensiController;


Route::get('/', function () {
    return redirect()->route('matakuliah.index');
});

Route::resource('matakuliah', MataKuliahController::class);
Route::get('absensi', [AbsensiController::class,'index'])->name('absensi.index');
Route::get('absensi/create', [AbsensiController::class,'create'])->name('absensi.create');
Route::post('absensi/store', [AbsensiController::class,'store'])->name('absensi.store');


