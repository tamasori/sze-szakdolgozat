<?php

namespace App\Http\Controllers;

use App\Imports\R4Import;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Requests\ImportR4Request;

class ImportR4Controller extends Controller
{
    public function index()
    {
        return view('r4-import.index');
    }

    public function import(ImportR4Request $request)
    {
        $created = [];
        $problems = [];

        Excel::import(new R4Import($created, $problems), $request->file('file'));

        return view('r4-import.index', [
            'created' => $created,
            'problems' => $problems,
            'successes' => [__("messages.save_success")]
        ]);
    }
}
