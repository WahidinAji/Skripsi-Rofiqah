<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    protected $fillable = ['name', 'nisn', 'jenis_kelamin', 'kelas', 'alamat', 'penghasilan_ortu', 'penerima_kks', 'beasiswa'];
    public $timestamps = \true;
}
