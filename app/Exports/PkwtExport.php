<?php

namespace App\Exports;

use App\Models\Pkwt;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class PkwtExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Pkwt::all();
    }

    public function headings(): array
    {
        return [
            'ID',
            'NIK',
            'FOTO PEGAWAI',
            'NAMA LENGKAP',
            'JABATAN',
            'TGL BERGABUNG',
            'TGL BERAKHIR',
            'NPP',
            'NPP2',
            'CREATED AT',
            'UPDATED AT',
        ];
    }
}
