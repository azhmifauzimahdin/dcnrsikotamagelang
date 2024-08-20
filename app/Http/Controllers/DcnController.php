<?php

namespace App\Http\Controllers;

use App\Exports\DcnExport;
use App\Models\Claim;
use App\Models\Dcn;
use App\Models\Submission;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Number;
use Illuminate\View\View;
use Maatwebsite\Excel\Facades\Excel;

class DcnController extends Controller
{
    public function index(): View
    {
        $dcns = Dcn::get();
        $dcns->map(function ($dcn) {
            $dcn->dcndateformat = Carbon::parse($dcn->dcndate)->format('d/m/Y');
            return $dcn;
        });

        $dcnfpk = [
            'totalsubmitted' => $this->currencyFormat($dcns->sum('totalsubmitted')),
            'totalapproved' => $this->currencyFormat($dcns->sum('totalapproved')),
            'totaldifference' => $this->currencyFormat($dcns->sum('totalapproved') - $dcns->sum('totalsubmitted')),
            'totalinvoice' => $this->currencyFormat(Claim::get()->sum('totalbpjs'))
        ];

        return view('dcn', [
            'title' => 'DCN FPK BPJS',
            'status' => 3,
            'dcns' => $dcns,
            'dcnfpk' => $dcnfpk
        ]);
    }

    function currencyFormat($item)
    {
        return Number::format($item, locale: 'de');
    }

    public function export()
    {
        return Excel::download(new DcnExport, 'FPKBPJS.csv');
    }

    public function destroy(): RedirectResponse
    {
        Submission::truncate();
        Claim::whereNotNull('patsep')->delete();
        return redirect()->route('claim.index');
    }
}
