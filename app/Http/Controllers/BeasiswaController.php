<?php

namespace App\Http\Controllers;

use App\Model\Student;
use PDF;
use Illuminate\Support\Facades\Auth;

class BeasiswaController extends Controller
{
    public function index()
    {
        if (Auth::check()) {
            $status = Student::all();
            // dd($status);
            return view('status.index', compact('status'));
        } else {
            return \redirect()->route('login')->with(['msg' => 'anda harus login!!']);
        }
    }
    public function export_pdf()
    {
        if (Auth::check()) {
            $status = Student::all();
            $pdf = PDF::loadview('status.cetak', compact('status'));
            return $pdf->stream(".pdf");
        } else {
            return \redirect()->route('login')->with(['msg' => 'anda harus login!!']);
        }
    }
}
