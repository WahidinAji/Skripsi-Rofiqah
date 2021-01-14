<?php

namespace App\Http\Controllers;

use App\Model\Nilai;
use App\Model\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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
        $s = DB::table('siswas')
            ->join('nilais', 'siswas.id', '=', 'nilais.siswa_id')
            ->select('siswas.nama', 'siswas.nisn', 'nilais.*')->get();
        // $nilai = Nilai::where('siswa_id', $s->id);
        return \view('nilai.index', \compact('s'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $nilai = Nilai::find($id);
        $s = DB::table('siswas')
            ->join('nilais', 'siswas.id', '=', 'nilais.siswa_id')
            ->select('siswas.nama', 'siswas.nisn', 'nilais.*')
            ->where('nilais.id',$nilai->id)
            ->get();
        return view('nilai.edit',compact('nilai','s'));
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
        $this->validate($req,[
            'r_mtk'=>'required',
            'r_bindo'=>'required',
            'r_bing'=>'required',
            'r_mapel_produktif'=>'required',
        ]);

        $nilai = Nilai::find($id);
        $s = DB::table('siswas')
            ->join('nilais', 'siswas.id', '=', 'nilais.siswa_id')
            ->select('siswas.nama', 'siswas.nisn', 'nilais.*')
            ->where('nilais.id',$nilai->id)
            ->get();
        foreach($s as $siswa){
            $siswa = Siswa::find($siswa->id);
        }     
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
            'penerima_kks'=>\strtolower($siswa->penerima_kks),
            'r_mtk' => \strtoupper($req->r_mtk),
            'r_bindo' => \strtoupper($req->r_bindo),
            'r_bing' => \strtoupper($req->r_bing),
            'r_mapel_produktif' => \strtoupper($req->r_mapel_produktif),
            'penghasilan_ortu' => \strtolower($siswa->penghasilan_ortu),
        ];
        // \dd($data);
        $hasil = $tree->classify($data);
        // dd($hasil);
        //save update beasiswa on table siswas           
        $siswa->beasiswa = $hasil;
        $siswa->save();

        //update field on table nilais
        $nilai->r_mtk = \strtoupper($req->r_mtk);
        $nilai->r_bindo = \strtoupper($req->r_bindo);
        $nilai->r_bing = \strtoupper($req->r_bing);
        $nilai->r_mapel_produktif = \strtoupper($req->r_mapel_produktif);
        $nilai->save();
        return redirect()->route('nilai.index')->with(['msg'=>"Berhasil merubah nilai"]);
    }
}
