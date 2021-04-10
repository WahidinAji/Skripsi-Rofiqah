<?php

namespace App\Imports;

use App\Model\Value;
use C45\C45;
use Maatwebsite\Excel\Concerns\ToModel;

class ValueImport implements ToModel
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        $v = new Value();
        // return new Value([
        $v->nama = $row[0];
        $v->nisn = $row[1];
        $v->jenis_kelamin = $row[2];
        $v->kelas = $row[3];
        $v->alamat = $row[4];
        $v->penghasilan_ortu = $row[5];
        $v->penerima_kks = $row[6];
        $v->r_mtk = $row[7];
        $v->r_bindo = $row[8];
        $v->r_bing = $row[9];
        $v->r_mapel_produktif = $row[10];

        $filename = \public_path() . '/csv/Data_Training.csv'; //DATA TRAINING
        // \dd($filename);
        $c45 = new C45([
            'targetAttribute' => 'beasiswa',
            'trainingFile' => $filename,
            'splitCriterion' => C45::SPLIT_GAIN,
        ]);
        $tree = $c45->buildTree();
        $treeString = $tree->toString();
        $data = [
            // Tidak,B+,B+,B+,B+,Cukup,Tidak
            'penerima_kks' => \strtolower($v->penerima_kks),
            'r_mtk' => \strtoupper($v->r_mtk),
            'r_bindo' => \strtoupper($v->r_bindo),
            'r_bing' => \strtoupper($v->r_bing),
            'r_mapel_produktif' => \strtoupper($v->r_mapel_produktif),
            'penghasilan_ortu' => \strtolower($v->penghasilan_ortu),
        ];
        $hasil = $tree->classify($data);
        $v->beasiswa = $hasil;
        $v->save();
        // ]);
    }
}
