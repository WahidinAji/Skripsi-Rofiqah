<?php

namespace App\Http\Controllers;

use App\Imports\ValueImport;
use C45\C45;
use App\Model\Value;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Maatwebsite\Excel\Facades\Excel;

class ValueController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $siswa = Value::query()->get();
        return \view('value.index', \compact('siswa'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // dd('test');
        return view('value.create');
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
        $hasil = $tree->classify($data);
        Value::create([
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
        return \redirect()->route('value.index')->with(['msg' => "Berhasil menambah data siswa, nama: $req->nama dengan nisn : $req->nisn"]);
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Model\Value  $value
     * @return \Illuminate\Http\Response
     */
    public function show(Value $value)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\Value  $value
     * @return \Illuminate\Http\Response
     */
    public function edit(Value $value)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\Value  $value
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Value $value)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\Value  $value
     * @return \Illuminate\Http\Response
     */
    public function destroy(Value $value)
    {
        //
    }
}
