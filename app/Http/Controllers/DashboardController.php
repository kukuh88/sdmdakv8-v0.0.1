<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Pkwt;
use App\Models\Karyawan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{

    public function index(){
        return view('dashboard');
    }

    public function dashboard(){
        
        $tables      = DB::select('SELECT COUNT(*) as total FROM book WHERE book.id = ?', [env('sdmnotifikasi')]);
        $totalTables = $tables[0]->total;

        $pkwt        = DB::select('SELECT COUNT(*) as total FROM pkwt WHERE pkwt.id = ?', [env('sdmnotifikasi')]);
        $totalPkt    = $pkwt[0]->total;

    
        $allKaryawan = Book::join('karyawan', 'book.id_karyawan', '=', 'karyawan.id')
        ->select('book.*', 'karyawan.nik', 'karyawan.name', 'karyawan.jabatan')
        ->whereNull('karyawan.pilihan_pensiun')
        ->count();

        $hold = Book::join('approvel_kenaikan', 'book.id_karyawan', '=', 'approvel_kenaikan.id_karyawan')
        ->select('approvel_kenaikan.*', 'approvel_kenaikan.keterangan')
        ->whereNotNull('approvel_kenaikan.keterangan')
        ->count();
        // dd($hold);

        $golReg = Book::where('is_pilihan', 0)->count();
        $golPil = Book::where('is_pilihan', 1)->count();
        $pkwt   = Pkwt::all()->count();
       
        $book  = Book::query()
        ->with(['lastKenaikanTingkat'])
        ->whereHas('historyKenaikanTingkat', function ($q) {
            return $q->where('status', 0);
        })
        ->get();
        $karyawan = Karyawan::whereNotNull('pilihan_pensiun')->get();
        return view('dashboard', compact(['book','karyawan', 'allKaryawan', 'golReg', 'golPil', 'pkwt','hold']));


    }
}
