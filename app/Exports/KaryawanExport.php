<?php

namespace App\Exports;

use App\Models\ApprovelKenaikan;
use App\Models\Book;
use App\Models\Karyawan;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;


class KaryawanExport implements WithHeadings, FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
  
    public function headings(): array
    {
        return [
            'ID',
            'NIK',
            'NAMA LENGKAP',
            'JABATAN',
            'TGL lAHIR',
            'CAKAR',
            'FOTO PEGAWAI',
            'CREATED AT',
            'UPDATED AT',
            'PP',
            'NPP1',
            'P1A',
            'NP2',
            'P2A',
            'TTP',
            'NPP',
            'NPP2',
            'ID KARYAWAN',
            'GOLONGAN SAAT INI',
            'TMT GOLONGAN SAAT INI',
            'GOLONGAN MENDATANG',
            'TMT GOLONGAN MENDATANG',
            'ESLON',
            'TMT ESLON',
            'STATUS',
            'HOLD',
            'KET HOLD',
        ];
    }

    public function view(): View
    {
        return view('invoices.karyawan', [
            // 'approvalkenaikan'  => ApprovelKenaikan::all(),
            'karyawan'          => Karyawan::all(),
            'book'              => Book::all()
        ]);
    }
}
