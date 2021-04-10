<?php

namespace App\Imports;

use App\Model\Student;
use C45\C45;
use Maatwebsite\Excel\Concerns\ToModel;

class StudentImport implements ToModel
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        $student = new Student();
        $student->nama = $row[0];
        $student->nisn = $row[1];
        $student->jenis_kelamin = $row[2];
        $student->kelas = $row[3];
        $student->alamat = $row[4];
        $student->penghasilan_ortu = $row[5];
        $student->penerima_kks = $row[6];
        $student->r_mtk = $row[7];
        $student->r_bindo = $row[8];
        $student->r_bing = $row[9];
        $student->r_mapel_produktif = $row[10];

        $filename = \public_path() . '/csv/Data_Training.csv'; //DATA TRAINING
        $c45 = new C45([
            'targetAttribute' => 'beasiswa',
            'trainingFile' => $filename,
            'splitCriterion' => C45::SPLIT_GAIN,
        ]);
        $tree = $c45->buildTree();
        $treeString = $tree->toString();
        $data = [
            // Tidak,B+,B+,B+,B+,Cukup,Tidak
            'penerima_kks' => \strtolower($student->penerima_kks),
            'r_mtk' => \strtoupper($student->r_mtk),
            'r_bindo' => \strtoupper($student->r_bindo),
            'r_bing' => \strtoupper($student->r_bing),
            'r_mapel_produktif' => \strtoupper($student->r_mapel_produktif),
            'penghasilan_ortu' => \strtolower($student->penghasilan_ortu),
        ];
        $hasil = $tree->classify($data);
        $student->beasiswa = $hasil;
        $student->save();
    }
}
