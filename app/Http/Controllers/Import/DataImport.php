<?php

namespace App\Http\Controllers\Import;

use App\Http\Controllers\Controller;
use App\Imports\StudentImport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Maatwebsite\Excel\Facades\Excel;

class DataImport extends Controller
{
    public function __invoke(Request $req)
    {
        $this->validate($req, [
            'file' => 'required',
        ]);
        $file = $req->file('file');
        $nm = rand() . $file->getClientOriginalName();
        $file->move('import_csv', $nm);
        Excel::import(new StudentImport, public_path('/import_csv/' . $nm), null, \Maatwebsite\Excel\Excel::CSV);

        Session::flash('sukses', 'Success');
        return redirect()->route('siswa.index');
    }
}
