<?php

namespace App\Http\Controllers;

use App\Model\Nilai;
use App\Model\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use C45\C45 as C45AJA;

class SiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::check()) {
            $siswa = Siswa::query()->get();
            return \view('siswa.index', \compact('siswa'));
        } else {
            return \redirect()->route('login')->with(['msg' => 'anda harus login!!']);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (Auth::check()) {
            return \view('siswa.create');
        } else {
            return \redirect()->route('login')->with(['msg' => 'anda harus login!!']);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $req)
    {
        if (Auth::check()) {
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
            // \dd($req->all());
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
            $siswa = Siswa::create([
                'nama' => $req->nama,
                'nisn' => $req->nisn,
                'jenis_kelamin' => $req->jenis_kelamin,
                'kelas' => \strtoupper($req->kelas),
                'alamat' => $req->alamat,
                'penghasilan_ortu' => \strtolower($req->penghasilan_ortu),
                'penerima_kks' => \strtolower($req->penerima_kks),
                'beasiswa' => $hasil,
            ]);
            Nilai::create([
                'siswa_id' => $siswa->id,
                'r_mtk' => \strtoupper($req->r_mtk),
                'r_bindo' => \strtoupper($req->r_bindo),
                'r_bing' => \strtoupper($req->r_bing),
                'r_mapel_produktif' => \strtoupper($req->r_mapel_produktif),
            ]);
            return \redirect()->route('siswa.index')->with(['msg' => "Berhasil menambah data siswa, nama: $req->nama dengan nisn : $req->nisn"]);
        } else {
            return \redirect()->route('login')->with(['msg' => 'anda harus login!!']);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\Siswa  $siswa
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (Auth::check()) {
            $siswa = Siswa::find($id);
            return \view('siswa.edit', \compact('siswa'));
        } else {
            return \redirect()->route('login')->with(['msg' => 'anda harus login!!']);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\Siswa  $siswa
     * @return \Illuminate\Http\Response
     */
    public function update(Request $req, $id)
    {
        if (Auth::check()) {
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
            $c45 = new C45AJA([
                'targetAttribute' => 'beasiswa',
                'trainingFile' => $filename,
                'splitCriterion' => C45AJA::SPLIT_GAIN,
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
            $siswa = Siswa::find($id);
            $siswa->nama = $req->nama;
            $siswa->nisn = $req->nisn;
            $siswa->jenis_kelamin = $req->jenis_kelamin;
            $siswa->kelas = \strtoupper($req->kelas);
            $siswa->alamat = $req->alamat;
            $siswa->penghasilan_ortu = \strtolower($req->penghasilan_ortu);
            $siswa->penerima_kks = \strtolower($req->penerima_kks);
            $siswa->beasiswa = $hasil;
            $siswa->save();
            return \redirect()->route('siswa.index')->with(['msg' => "Berhasil merubah data siswa $req->nama"]);
        } else {
            return \redirect()->route('login')->with(['msg' => 'anda harus login!!']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\Siswa  $siswa
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (Auth::check()) {
            $siswa = Siswa::find($id);
            $siswa->delete();
            return \redirect()->back()->with(['msg' => "berhasil menghapus data siswa $siswa->nama"]);
        } else {
            return \redirect()->route('login')->with(['msg' => 'anda harus login!!']);
        }
    }
}
