<?php

namespace App\Imports;

use App\Models\Pkwt;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use Carbon\Carbon;
use PhpOffice\PhpSpreadsheet\Calculation\TextData\Format;

class PkwtImport implements ToCollection, WithHeadingRow, WithValidation,  SkipsOnFailure
{
    /**
    * @param Collection $collection
    */
    use Importable, SkipsFailures;



public function collection(Collection $rows)
{
    foreach ($rows as $row)
    {
        // Jika 'tgl_bergabung' adalah numerik (format Excel), konversi menggunakan Date::excelToDateTimeObject
        if (is_numeric($row['tgl_bergabung'])) {
            $tgl_bergabung = Date::excelToDateTimeObject($row['tgl_bergabung'])->format('Y-m-d');
        } else {
            // Jika 'tgl_bergabung' sudah berupa string tanggal, gunakan Carbon untuk parse
            $tgl_bergabung = Carbon::parse($row['tgl_bergabung'])->format('Y-m-d');
        }

        // Perlakukan yang sama untuk 'tgl_berakhir'
        if (is_numeric($row['tgl_berakhir'])) {
            $tgl_berakhir = Date::excelToDateTimeObject($row['tgl_berakhir'])->format('Y-m-d');
        } else {
            $tgl_berakhir = Carbon::parse($row['tgl_berakhir'])->format('Y-m-d');
        }

        Pkwt::create([
            'nik'              => $row['nik'],
            'full_name'        => $row['full_name'],
            'jabatan'          => $row['jabatan'],
            'tgl_bergabung'    => $tgl_bergabung,
            'tgl_berakhir'     => $tgl_berakhir,
            'formFileSm'       => $row['formFileSm'] ?? null,
            'created_at'       => $row['created_at'] ?? null,
            'updated_at'       => $row['updated_at'] ?? null,
        ]);
    }
}

    public function rules(): array
    {
        return [
            'nik'                               => 'required|unique:pkwt',
            'full_name'                         => 'nullable',
            'jabatan'                           => 'nullable',
            'tgl_bergabung'                     => 'nullable',
            'tgl_berakhir'                      => 'nullable',
            'formFileSm'                        => 'nullable|file|mimes:pdf,jpg,jpeg,png',
            'created_at'                        => 'nullable',
            'updated_at'                        => 'nullable',
        ];
    }
}
