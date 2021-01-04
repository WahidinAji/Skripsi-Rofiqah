<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Nilai extends Model
{
    protected $fillable = ['siswa_id', 'r_mtk', 'r_bindo', 'r_bing', 'r_mapel_produktif'];
    public $timestamps = \true;
}
