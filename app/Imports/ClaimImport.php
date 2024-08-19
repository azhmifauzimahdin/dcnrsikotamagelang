<?php

namespace App\Imports;

use App\Models\Claim;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithUpserts;

class ClaimImport implements ToModel, WithHeadingRow, WithUpserts
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new Claim([
            'admdatetime' => $row['tgl_masuk'],
            'disdatetime' => $row['tgl_pulang'],
            'patid' => (int)$row['no_rm'],
            'patname' => $row['nama_pasien'],
            'patsep' => $row['no_klaim_sep'],
            'totalbpjs' => (float)$row['total_tarif'],
            'totalrs' => (float)$row['tarif_rs']
        ]);
    }

    public function rules(): array
    {
        return [
            'admdatetime' => 'required',
            'disdatetime' => 'required',
            'patid' => 'required',
            'patname' => 'required',
            'patsep' => 'required',
            'totalbpjs' => 'required',
            'totalrs' => 'required'
        ];
    }

    public function uniqueBy()
    {
        return 'patsep';
    }
}
