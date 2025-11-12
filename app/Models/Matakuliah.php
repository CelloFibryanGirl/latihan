<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Matakuliah extends Model
{
    protected $table = 'matakuliah';

    protected $fillable = [
        'kode',
        'nama_matakuliah',
    ];

    public function absensi()
    {
        return $this->hasMany(Absensi::class, 'matakuliah_id');
    }
}
