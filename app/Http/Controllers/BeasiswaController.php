<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Siswa;
use PDF;

class BeasiswaController extends Controller
{
    public function index(){
        // $status = Siswa::paginate(10);
        $status = Siswa::all();
        // dd($status);
        return view('status.index',compact('status'));
    }
    public function export_pdf(){
        $status = Siswa::all();
        
        $pdf = PDF::loadview('status.cetak',compact('status'));
        return $pdf->stream(".pdf");
    }
}
