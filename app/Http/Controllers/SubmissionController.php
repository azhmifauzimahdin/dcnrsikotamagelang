<?php

namespace App\Http\Controllers;

use App\Imports\SubmissionImport;
use App\Models\Claim;
use App\Models\Dcn;
use App\Models\Submission;
use Carbon\Carbon;
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

        Submission::truncate();
        Excel::import(new SubmissionImport, $request->file('file'));

        Dcn::truncate();
        $claims = Claim::get();
        $now = Carbon::now();
        $dcn = [];
        foreach ($claims as $claim) {
            $dcn[] = [
                'patsep' => $claim->patsep,
                'dcndate' => $now,
                'totalsubmitted' => $claim->totalrs - $claim->submission->totalrajal,
                'totalapproved' => $claim->totalbpjs - $claim->submission->totalrajal - $claim->submission->totalbayi,
                'created_at' => $now,
                'updated_at' => $now
            ];
        }
        Dcn::insert($dcn);

        return redirect()->route('dcn.index')->with(['success' => 'File Rawat Jalan / Bayi berhasil disimpan']);
    }

    public function downloadTemplate()
    {
        return Storage::download('templates/TemplatePengajuan.xlsx');
    }
}
