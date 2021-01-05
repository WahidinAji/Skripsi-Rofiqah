<?php

namespace App\Http\Controllers;

use App\Model\Nilai;
use App\Model\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $siswa = Siswa::query()->get();
        return \view('siswa.index', \compact('siswa'));
        // if (Auth::check()) {
        //     # code...
        // } else {
        //     return \redirect()->route('login')->with(['msg' => 'anda harus login!!']);
        // }
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
        $siswa = Siswa::create([
            'nama' => $req->nama,
            'nisn' => $req->nisn,
            'jenis_kelamin' => $req->jenis_kelamin,
            'kelas' => $req->kelas,
            'alamat' => $req->alamat,
            'penghasilan_ortu' => $req->penghasilan_ortu,
            'penerima_kks' => $req->penerima_kks,
        ]);
        Nilai::create([
            'siswa_id' => $siswa->id,
            'r_mtk' => $req->r_mtk,
            'r_bindo' => $req->r_bindo,
            'r_bing' => $req->r_bing,
            'r_mapel_produktif' => $req->r_mapel_produktif,
        ]);
        return \redirect()->route('siswa.index')->with(['msg' => "Berhasil menambah data siswa, nama: $req->nama dengan nisn : $req->nisn"]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\Siswa  $siswa
     * @return \Illuminate\Http\Response
     */
    public function show(Siswa $siswa)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\Siswa  $siswa
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $siswa = Siswa::find($id);
        return \view('siswa.edit', \compact('siswa'));
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
        $this->validate($req, [
            'nama' => 'required',
            'nisn' => 'required|unique:siswas',
            'jenis_kelamin' => 'required',
            'kelas' => 'required',
            'alamat' => 'required',
            'penghasilan_ortu' => 'required',
            'penerima_kks' => 'required',
        ]);
        $siswa = Siswa::find($id);
        $siswa->nama = $req->nama;
        $siswa->nisn = $req->nisn;
        $siswa->jenis_kelamin = $req->jenis_kelamin;
        $siswa->kelas = $req->kelas;
        $siswa->alamat = $req->alamat;
        $siswa->penghasilan_ortu = $req->penghasilan_ortu;
        $siswa->penerima_kks = $req->penerima_kks;
        $siswa->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\Siswa  $siswa
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $siswa = Siswa::find($id);
        $nilai = Nilai::find($siswa);
        $nilai->delete();
        $siswa->delete();
        return \redirect()->back()->with(['msg' => 'berhasil menghapus data siswa']);
    }
}
