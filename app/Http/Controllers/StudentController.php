<?php

namespace App\Http\Controllers;

use App\Model\Student;
use C45\C45;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $siswa = Student::query()->get();
        return \view('siswa.index', \compact('siswa'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return \view('siswa.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $req)
    {
        $this->validate($req, [
            'nama' => 'required',
            'nisn' => 'required|unique:siswas',
            'jenis_kelamin' => 'required',
            'kelas' => 'required',
            'alamat' => 'required',
            'penghasilan_ortu' => 'required',
            'penerima_kks' => 'required',
            'r_mtk' => 'required',
            'r_bindo' => 'required',
            'r_bing' => 'required',
            'r_mapel_produktif' => 'required',
        ]);

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
            'penerima_kks' => \strtolower($req->penerima_kks),
            'r_mtk' => \strtoupper($req->r_mtk),
            'r_bindo' => \strtoupper($req->r_bindo),
            'r_bing' => \strtoupper($req->r_bing),
            'r_mapel_produktif' => \strtoupper($req->r_mapel_produktif),
            'penghasilan_ortu' => \strtolower($req->penghasilan_ortu),
        ];

        $hasil = $tree->classify($data);
        Student::create([
            'nama' => $req->nama,
            'nisn' => $req->nisn,
            'jenis_kelamin' => $req->jenis_kelamin,
            'kelas' => \strtoupper($req->kelas),
            'alamat' => $req->alamat,
            'penghasilan_ortu' => \strtolower($req->penghasilan_ortu),
            'penerima_kks' => \strtolower($req->penerima_kks),
            'r_mtk' => \strtoupper($req->r_mtk),
            'r_bindo' => \strtoupper($req->r_bindo),
            'r_bing' => \strtoupper($req->r_bing),
            'r_mapel_produktif' => \strtoupper($req->r_mapel_produktif),
            'beasiswa' => $hasil,
        ]);
        return \redirect()->route('siswa.index')->with(['msg' => "Berhasil menambah data siswa, nama: $req->nama dengan nisn : $req->nisn"]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function show(Student $student)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function edit(Student $siswa)
    {
        return \view('siswa.edit', \compact('siswa'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function update(Request $req, $id)
    {
        $this->validate($req, [
            'nama' => 'required',
            'nisn' => 'required',
            'jenis_kelamin' => 'required',
            'kelas' => 'required',
            'alamat' => 'required',
            'penghasilan_ortu' => 'required',
            'penerima_kks' => 'required',
        ]);
        $filename = \public_path() . '/csv/Data_Training.csv';
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
            'penerima_kks' => \strtolower($req->penerima_kks),
            'r_mtk' => \strtoupper($req->r_mtk),
            'r_bindo' => \strtoupper($req->r_bindo),
            'r_bing' => \strtoupper($req->r_bing),
            'r_mapel_produktif' => \strtoupper($req->r_mapel_produktif),
            'penghasilan_ortu' => \strtolower($req->penghasilan_ortu),
        ];
        // \dd($testingData);
        $hasil = $tree->classify($data);
        // \dd($hasil);
        $student = Student::findOrFail($id);
        $student->nama = $req->nama;
        $student->nisn = $req->nisn;
        $student->jenis_kelamin = $req->jenis_kelamin;
        $student->kelas = \strtoupper($req->kelas);
        $student->alamat = $req->alamat;
        $student->penghasilan_ortu = \strtolower($req->penghasilan_ortu);
        $student->penerima_kks = \strtolower($req->penerima_kks);
        $student->beasiswa = $hasil;
        $student->save();
        return \redirect()->route('siswa.index')->with(['msg' => "Berhasil merubah data siswa $req->nama"]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function destroy(Student $student)
    {
        $student->delete();
        return \redirect()->back()->with(['msg' => "berhasil menghapus data siswa $student->nama"]);
    }
}
