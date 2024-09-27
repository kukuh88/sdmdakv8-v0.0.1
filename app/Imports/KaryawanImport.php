<?php

namespace App\Imports;

use Carbon\Carbon;
use App\Models\Book;
use App\Models\Karyawan;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\FromQuery;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Symfony\Contracts\Service\Attribute\Required;
use PhpOffice\PhpSpreadsheet\Calculation\TextData\Format;

class KaryawanImport implements ToCollection, WithHeadingRow, WithValidation, SkipsOnFailure
{
    use Importable, SkipsFailures;
    /**
    * @param array $row
    *use Importable;
    * @return \Illuminate\Database\Eloquent\Model|null
    */

    public function collection(Collection $rows)
    {
       
        foreach ($rows as $row) 
        {
            // dd(Date::excelToDateTimeObject($row['tgl_lahir'])->format('Y-m-d'));
            // dd($row);
            $tgl_lahir                          = Date::ExcelTODateTimeObject($row['tgl_lahir'])->format('Y-m-d');
            $cakar                              = Date::ExcelTODateTimeObject($row['cakar'])->format('Y-m-d');
            $ttp                                = Date::ExcelTODateTimeObject($row['npp'])->format('Y-m-d');
            $npp                                = Date::ExcelTODateTimeObject($row['npp2'])->format('Y-m-d');
            $tmt_golini                         = Date::ExcelTODateTimeObject($row['tmt_golongan_saat_ini'])->format('Y-m-d');
            $tmt_gol                            = Date::excelToDateTimeObject($row['tmt_golongan'])->format('Y-m-d');
            $tmt_esl                            = Date::excelToDateTimeObject($row['tmt_eselon'])->format('Y-m-d');

            $karyawan = Karyawan::create([
                'nik'                           => $row['nik'],
                'name'                          => $row['name'] ,
                'jabatan'                       => $row['jabatan'],
                'tgl_lahir'                     => $tgl_lahir,
                'cakar'                         => $cakar,
                'formFileSm'                    => $row['formFileSm'] ?? null,
                'created_at'                    => $row['created_at'] ?? null,
                'updated_at'                    => $row['updated_at'] ?? null,
                'tanggal_terakhir_pensiun'      => $ttp,
                'notifikasi_peringatan_pada'    => $npp,
            ]);
           
            Book::create([
        
                'id_karyawan'                   => $karyawan->id,
                'golonganini'                   => $row['golongan_saat_ini'],
                'tmt_golonganini'               => $tmt_golini,
                'golongan'                      => $row['golongan'],
                'tmt_golongan'                  => $tmt_gol,
                'eselon'                        => $row['eselon'],
                'tmt_eselon'                    => $tmt_esl,
                'status'                        => $row['status'],
                'hold'                          => $row['hold'],
                'ket_hold'                      => $row['ket_hold'],
            ]);
        }
    }

    public function rules(): array
    {
        return [
            'nik'                               => 'required|unique:karyawan',
            'name'                              => 'nullable',
            'jabatan'                           => 'nullable',
            'tgl_lahir'                         => 'nullable',
            'cakar'                             => 'nullable',
            'formFileSm'                        => 'nullable',
            'created_at'                        => 'nullable',
            'updated_at'                        => 'nullable',
            'tanggal_terakhir_pensiun'          => 'nullable',
            'notifikasi_peringatan_pada'        => 'nullable',
            'golonganini'                       => 'nullable',
            'tmt_golongan'                      => 'nullable',
            'golongan'                          => 'nullable',
            'tmt_golongan'                      => 'nullable',
            'eselon'                            => 'nullable',
            'tmt_eselon'                        => 'nullable',
            'status'                            => 'nullable',
            'hold'                              => 'nullable',
            'ket_hold'                          => 'nullable'
        ];
    }

    // public function map($row): array 
    // {
    //     {
    //         if (gettype($row['tgl_lahir']) == 'double') {
    //              $row['tgl_lahir'] = Date::excelToDateTimeObject($row['tgl_lahir'])
    //              ->format('d/m/Y');
    //         }    
    //         // dd(Date::excelToDateTimeObject($row['tgl_lahir'])->format('Y-m-d'));
    //     return $row;
    //     }
    // }

}
    // public function collection(Collection $book)
    // {
    //     foreach ($book as $row) 
    //     {
    //         Book::create([
    //             'golonganini'           => $row['golonganini'],
    //             'tmt_golonganini'       => $row['tmt_golonganini'],
    //             'eselon'                => $row['eselon'],
    //             'tmt_eselon'            => $row['tmt_eselon'],
    //             'status'                => $row['status'],
    //         ]);
    //     }
    // }

    // public function model(array $row)
    // {
        
    //     return new Karyawan([
    //         'nik'                           => $row[1],
    //         'name'                          => $row[2],
    //         'jabatan'                       => $row[3],
    //         'tgl_lahir'                     => $row[4],
    //         'cakar'                         => $row[5],
    //         'formFileSm'                    => $row[6],
    //         'created_at'                    => $row[7],
    //         'updated_at'                    => $row[8],
    //         'tanggal_terakhir_pensiun'      => $row[14],
    //         'notifikasi_peringatan_pada'    => $row[15],
    //     ]);
    // }
    
    // public function model(array $row)
    // {
    //     // dd($row);
    //     return new Karyawan([
    //         'nik'                           => $row['nik'],
    //         'name'                          => $row['name'] ,
    //         'jabatan'                       => $row['jabatan'],
    //         'tgl_lahir'                     => $row['tgl_lahir'],
    //         'cakar'                         => $row['cakar'],
    //         'formFileSm'                    => $row['formFileSm'] ?? null,
    //         'created_at'                    => $row['created_at'] ?? null,
    //         'updated_at'                    => $row['updated_at'] ?? null,
    //         'tanggal_terakhir_pensiun'      => $row['npp'],
    //         'notifikasi_peringatan_pada'    => $row['npp2'],
            
    //     ]);
    // }
   
    // public function rules(): array
    // {
    //     return [
    //       'nik'                          => 'required|unique, karyawan',
    //       'name'                         => 'required',
    //       'jabatan'                      => 'required',
    //       'tgl_lahir'                    => 'required',
    //       'cakar'                        => 'required',
    //       'formFileSm'                   => 'required',
    //       'created_at'                   => 'required',
    //       'update_at'                    => 'required',
    //       'npp'                          => 'required',
    //       'npp2'                         => 'required',
          
    //     ];
    // }
