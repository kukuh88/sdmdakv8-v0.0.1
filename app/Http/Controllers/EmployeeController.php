<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Book;
use App\Models\Eselon;
use App\Models\Karyawan;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $eselon = Eselon::get();
        $karyawan = Karyawan::whereNull('pilihan_pensiun')->get();

        return view('employee.index', compact('eselon', 'karyawan'));
    }

    public function fetch_data(Request $request)
    {
        $dateFormat = 'd M Y';
        $templateStatus = '<label class="badge rounded-pill bg-%s">%s</label>';

        $query = Book::query()->with(['karyawan', 'lastKenaikanTingkat'])
            //book yang memiliki relasi karyawan
            // yang karyawan tersebut  tgl terakhir pensiunnnya > sekarang
            ->whereHas('karyawan', function ($karyawan) {
                $karyawan->where('tanggal_terakhir_pensiun', '>', now()->format('Y-m-d'));
            });
       
        if ($request->from_date && $request->to_date) {
            $query ->whereBetween('tmt_golongan', [$request->from_date, $request->to_date]);
        }
        if ($request->search ) {
            $query->whereHas('karyawan', function ($q) use ($request) {
                return $q->where('name', $request->search);
            });
        }

        return DataTables::of($query)
            ->addIndexColumn()
            ->addColumn('nik', function ($row) {
                return $row->karyawan->nik;
            })
            ->addColumn('nama_karyawan', function ($row) {
                return $row->karyawan->name;
            })
            ->addColumn('jabatan', function ($row) {
                return $row->karyawan->jabatan;
            })
            ->addColumn('tgl_golonganini', function ($row) use ($dateFormat) {
                return Carbon::parse($row->tmt_golonganini)->translatedFormat($dateFormat);
            })
            ->addColumn('tgl_golongan', function ($row) use ($dateFormat) {
                return Carbon::parse($row->tmt_golongan)->translatedFormat($dateFormat);
            })
            ->addColumn('tgl_eselon', function ($row) use ($dateFormat) {
                return Carbon::parse($row->tmt_eselon)->translatedFormat($dateFormat);
            })
            ->addColumn('tmt_pensiun', function ($row) use ($templateStatus) {
                $class = $row->tanggal_terakhir_pensiun < date('Y-m-d')
                    ? 'success' : 'danger';
                $text = $row->tanggal_terakhir_pensiun < date('Y-m-d')
                    ? 'Aktif' : 'Non Aktif';
                return sprintf($templateStatus, $class, $text);
            })
            ->addColumn('status_golongan', function ($row) use ($templateStatus) {
                $class = $row->is_pilihan ? 'success' : 'info';
                $text = $row->is_pilihan ? 'Pilihan' : 'Reguler';
                return sprintf($templateStatus, $class, $text);
            })
            ->addColumn('keterangan', function ($row) use ($templateStatus) {
                if ($row->tmt_golongan <= date('Y-m-d')) {
                    if ($row->lastKenaikanTingkat && $row->lastKenaikanTingkat->status == 0) {
                        $keterangan = sprintf($templateStatus, 'danger', 'On Hold');
                    } else {
                        $url = route('karyawan.approval-tingkat', $row->id_karyawan);
                        $name = $row->name;
                        $level = $row->golonganini;
                        $levelup = $row->golongan;
                        $buttons[] = sprintf('<a data-url="%s" data-emp_name="%s" data-level="%s" data-level_up="%s"
                            class="btn btn-sm btn-outline-success btn-approve-tingkat">ACC</a>',
                            $url, $name, $level, $levelup
                        );
                        $buttons[] = sprintf('<a data-url="%s" data-emp_name="%s" data-level="%s" data-level_up="%s"
                            data-bs-toggle="modal" data-bs-target="#modal-hold-approval"
                            class="btn btn-sm btn-outline-warning btn-hold-tingkat">HOLD</a>',
                            $url, $name, $level, $levelup
                        );
                        $keterangan = sprintf(
                            '<div class="btn-group" role="group">%s</div>',
                            implode("\n", $buttons)
                        );
                    }
                } else {
                    $keterangan = sprintf($templateStatus, 'warning', 'Maaf Waktu Belum Mencukupi');
                }
                return $keterangan;
            })
            ->addColumn('aksi', function ($row) {
                $buttons[] = sprintf(
                    '<a href="%s" class="btn btn-outline-warning">
                        <i class="bi bi-pencil-square"></i>
                    </a>',
                    route('book.edit', $row->id)
                );
                $buttons[] = sprintf(
                    '<a href="#" class="btn btn-outline-danger btn-action delete bi bi-trash"
                        data-url="%s" data-text="%s"></a>',
                    route('book.destroy', $row->id), $row->name
                );
                $buttons[] = sprintf(
                    '<a class="nav-item dropdown pe-3">
                        <a class="nav-link nav-profile d-flex align-items-center"
                            href="#" data-bs-toggle="dropdown">
                            <span class="d-none d-md-block dropdown-toggle ps-2 btn btn-success">
                                More
                            </span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
                            <li>
                                <a class="dropdown-item d-flex align-items-center" href="%s">
                                    <i class="bi bi-person-x-fill"></i>
                                    <span>Pensiun</span>
                                </a>
                            </li>
                        </ul>
                    </a>',
                    route('pensiun.form', $row->id_karyawan)
                );
                return implode(' ', $buttons);
            })
            ->rawColumns(['tmt_pensiun', 'status_golongan', 'keterangan', 'aksi'])
            ->make();
    }
}
