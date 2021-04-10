<?php

namespace App\Http\Controllers;

use App\Model\Nilai;
use App\Model\Siswa;
use App\Model\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use C45\C45 as C45AJA;

class NilaiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::check()) {
            $s = Student::all();
            return \view('nilai.index', \compact('s'));
        } else {
            return \redirect()->route('login')->with(['msg' => 'anda harus login!!']);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (Auth::check()) {
            $nilai = Student::findOrFail($id);
            return view('nilai.edit', compact('nilai'));
        } else {
            return \redirect()->route('login')->with(['msg' => 'anda harus login!!']);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $req, $id)
    {
        if (Auth::check()) {
            $this->validate($req, [
                'r_mtk' => 'required',
                'r_bindo' => 'required',
                'r_bing' => 'required',
                'r_mapel_produktif' => 'required',
            ]);

            $nilai = Student::find($id);
            $filename = \public_path() . '/csv/Data_Training.csv'; //DATA TRAINING
            // \dd($filename);
            $c45 = new C45AJA([
                'targetAttribute' => 'beasiswa',
                'trainingFile' => $filename,
                'splitCriterion' => C45AJA::SPLIT_GAIN,
            ]);
            $tree = $c45->buildTree();
            $treeString = $tree->toString();
            $data = [
                'penerima_kks' => \strtolower($nilai->penerima_kks),
                'r_mtk' => \strtoupper($req->r_mtk),
                'r_bindo' => \strtoupper($req->r_bindo),
                'r_bing' => \strtoupper($req->r_bing),
                'r_mapel_produktif' => \strtoupper($req->r_mapel_produktif),
                'penghasilan_ortu' => \strtolower($nilai->penghasilan_ortu),
            ];
            $hasil = $tree->classify($data);
            $nilai->beasiswa = $hasil;
            $nilai->r_mtk = \strtoupper($req->r_mtk);
            $nilai->r_bindo = \strtoupper($req->r_bindo);
            $nilai->r_bing = \strtoupper($req->r_bing);
            $nilai->r_mapel_produktif = \strtoupper($req->r_mapel_produktif);
            $nilai->save();
            return redirect()->route('nilai.index')->with(['msg' => "Berhasil merubah nilai"]);
        } else {
            return \redirect()->route('login')->with(['msg' => 'anda harus login!!']);
        }
    }
}
