<?php

namespace App\Http\Controllers;

use App\Imports\ValueImport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Maatwebsite\Excel\Facades\Excel;

class ImportValue extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $req)
    {
        $this->validate($req, [
            'file' => 'required',
        ]);
        $file = $req->file('file');
        $nm = rand() . $file->getClientOriginalName();
        $file->move('file_csv', $nm);
        Excel::import(new ValueImport, public_path('/file_csv/' . $nm), null, \Maatwebsite\Excel\Excel::CSV);

        Session::flash('sukses', 'Success');
        return redirect()->route('value.index');
    }
}
