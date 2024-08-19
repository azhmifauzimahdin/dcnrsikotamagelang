<?php

namespace App\Http\Controllers;

use App\Imports\ClaimImport;
use App\Models\Claim;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
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

        return redirect()->route('submission.index')->with(['success' => 'File klaim BPJS berhasil disimpan']);
    }

    public function downloadTemplate()
    {
        return Storage::download('templates/TemplateKlaim.xlsx');
    }
}
