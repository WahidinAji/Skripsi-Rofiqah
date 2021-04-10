<?php

namespace App\Imports;

use App\Model\Nilai;
use App\Model\Siswa;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\ToCollection;

class BeasiswaImport implements ToCollection
{
    /**
     * @param Collection $collection
     */
    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {
            Siswa::create([
                // 'id' => ++$last,
                'nama' => $row[0],
                'nisn' => $row[1],
                'jenis_kelamin' => $row[2],
                'kelas' => $row[3],
                'alamat' => $row[4],
                'penghasilan_ortu' => $row[5],
                'penerima_kks' => $row[6],
                // 'beasiswa' => $row[7],
            ]);
            $last = DB::table('siswas')->orderBy('id', 'DESC')->first();
            Nilai::create([
                // 'siswa_id' => 1,
                'r_mtk' => $row[7],
                'r_bindo' => $row[8],
                'r_bing' => $row[9],
                'r_mapel_produktif' => $row[10],
            ]);
        }
    }
}
