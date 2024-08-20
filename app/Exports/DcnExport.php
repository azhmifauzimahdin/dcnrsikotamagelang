<?php

namespace App\Exports;

use App\Models\Dcn;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class DcnExport implements FromQuery, WithHeadings, WithMapping, ShouldAutoSize
{
    use Exportable;

    public function map($dcn): array
    {
        static $number = 1;
        return [
            $number++,
            $dcn->patsep,
            '',
            Carbon::parse($dcn->dcndate)->format('d/m/Y'),
            '',
            $dcn->totalsubmitted,
            $dcn->totalapproved
        ];
    }

    public function query()
    {
        return Dcn::query();
    }

    public function headings(): array
    {
        return [
            [
                'No',
                'No.SEP',
                '',
                'Tgl. Verifikasi',
                '',
                'Biaya',
                'Biaya'
            ],
            [
                'No',
                'No.SEP',
                '',
                'Tgl. Verifikasi',
                '',
                'Diajukan',
                'Disetujui'
            ]
        ];
    }
}
