<?php

namespace App\Http\Controllers;

use App\Imports\DataImport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ImportController extends Controller
{
    public function showImporForm()
    {
        return view('manager.index');
    }
    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,csv,xls',
        ]);

        Excel::import(new DataImport, $request->file('file'));

        return redirect()->back()->with('success', 'Données importés avec succés !');
    }
}
