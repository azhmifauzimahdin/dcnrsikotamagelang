<?php

namespace App\Http\Controllers;

use App\Imports\SubmissionImport;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use Maatwebsite\Excel\Facades\Excel;

class SubmissionController extends Controller
{
    public function index(): View
    {
        return view('submission', [
            'title' => 'Rawat Jalan / Bayi',
            'status' => 2
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'file' => 'required|max:2048'
        ]);

        Excel::import(new SubmissionImport, $request->file('file'));

        return redirect()->route('submission.index')->with(['success' => 'File Rawat Jalan / Bayi berhasil disimpan']);
    }

    public function downloadTemplate()
    {
        return Storage::download('templates/TemplatePengajuan.xlsx');
    }
}
