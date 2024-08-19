<?php

namespace App\Imports;

use App\Models\Submission;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithUpserts;

class SubmissionImport implements ToModel, WithHeadingRow, WithUpserts
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {

        return new Submission([
            'admdatetime' => $row['tgl_masuk'],
            'disdatetime' => $row['tgl_pulang'],
            'patid' => (int)$row['no_rm'],
            'patname' => $row['nama_pasien'],
            'patsep' => $row['no_klaim_sep'],
            'totalrajal' => (float)$row['total_rajal'],
            'totalbayi' => (float)$row['total_bayi']
        ]);
    }

    public function rules(): array
    {
        return [
            'admdatetime' => 'required',
            'disdatetime' => 'required',
            'patid' => 'required',
            'patname' => 'required',
            'patsep' => 'required'
        ];
    }

    public function uniqueBy()
    {
        return 'patsep';
    }
}
