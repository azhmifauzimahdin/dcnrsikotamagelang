<?php

namespace App\Http\Controllers;

use App\Imports\ClaimImport;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use Maatwebsite\Excel\Facades\Excel;

class ClaimController extends Controller
{
    public function index(): View
    {
        return view('claim', [
            'title' => 'DCN',
            'status' => 1
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'file' => 'required|max:2048'
        ]);

        Excel::import(new ClaimImport, $request->file('file'));

        return back()->with('success', 'File Klaim Berhasil di tambah');
    }

    public function downloadTemplate()
    {
        $filePath = storage_path('/templates/TemplateKlaim.xlsx');

        if (file_exists($filePath)) {
            return response()->download($filePath);
        } else {
            abort(404, 'File not found');
        }
    }
}
