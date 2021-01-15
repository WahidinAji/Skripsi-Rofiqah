<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Siswa;
use PDF;

class BeasiswaController extends Controller
{
    public function index(){
        if (Auth::check()) {
            // $status = Siswa::paginate(10);
            $status = Siswa::all();
            // dd($status);
            return view('status.index',compact('status'));
        } else {
            return \redirect()->route('login')->with(['msg' => 'anda harus login!!']);
        }
    }
    public function export_pdf(){
        if (Auth::check()) {
            $status = Siswa::all();            
            $pdf = PDF::loadview('status.cetak',compact('status'));
            return $pdf->stream(".pdf");
        } else {
            return \redirect()->route('login')->with(['msg' => 'anda harus login!!']);
        }
    }
}
