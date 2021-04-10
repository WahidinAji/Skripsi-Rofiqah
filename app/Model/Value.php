<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Value extends Model
{
    protected $fillable = ['nama', 'nisn', 'jenis_kelamin', 'kelas', 'alamat', 'penghasilan_ortu', 'penerima_kks', 'beasiswa', 'r_mtk', 'r_bindo', 'r_bing', 'r_mapel_produktif'];
    public $timestamps = true;
}
