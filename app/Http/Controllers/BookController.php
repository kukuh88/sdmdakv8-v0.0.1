<?php

namespace App\Http\Controllers;

use App\Models\ApprovelKenaikan;
use Carbon\Carbon;
use App\Models\Book;
use App\Models\Pkwt;
use App\Models\Eselon;
use App\Models\Pilihan;
use App\Models\Karyawan;
use Illuminate\Http\Request;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $query = Karyawan::select('*');

        // $cloning_query = clone $query
        // LogJob::dispatchSync();
        // LogJob::dispatch();

        // untuk update data kalau akses functionnya dari notifikasi
        if (\request()->exists('read_book_id', 'read_pkwt_id')) {
            Book::where('id', request('read_book_id'))->whereNull('notifikasi_tmtgolongan_readed')->update(['notifikasi_tmtgolongan_readed' => now()]);
            Pkwt::where('id', request('read_pkwt_id'))->whereNull('notifikasi_pkwt_readed')->update(['notifikasi_pkwt_readed' => now()]);
        }
        // dd('x');


        //1x query
        //2x query
        $book = Book::with('karyawan')
            ->whereHas('karyawan', function ($karyawan) {
                $karyawan->where('tanggal_terakhir_pensiun', '>', now()->format('Y-m-d'));
            })
            ->where(['is_pilihan' => 0])->get();
        // $karyawan = ApprovelKenaikan::with('AprovelKenaikan')->where(['status' => 1])->get();
        // dd($book->toArray());
        return view('book.index', compact(['book']), [
            'eselon' => Eselon::get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $attributes = $request->validate([
            'id_karyawan'       => 'required|max:255|unique:book',
            // 'name'           => 'required|max:255',
            // 'jabatan'        => 'required|max:255',
            'golonganini'       => 'required|max:255',
            'tmt_golonganini'   => 'required|max:255',
            'eselon'            => 'required|max:255|exists:'.(new Eselon)->getTable().',eselon',
            'tmt_eselon'        => 'required|max:255',

        ]);
        $eselon = Eselon::where('eselon', $request->eselon)->first();
        $attributes['is_pilihan'] = 0;

        if($request->golonganini < $eselon->min_gol){
            $attributes['is_pilihan'] = 1;
        }

        $attributes['status'] = 1;

        if ($request->golonganini < $eselon->max_gol) {

            $attributes['golongan'] = $request->golonganini + 1;
            $tmt_golini = carbon::parse($attributes['tmt_golonganini']);
            if($attributes['is_pilihan'] === 1){
                $attributes['tmt_golongan'] = $tmt_golini->addYears(1);
            } else {
                $attributes['tmt_golongan'] = $tmt_golini->addYears(4);
            }
        } else {
            if(request()->ajax()){
                return response()->json([
                    'code' => 0,
                    'message' => ('Data Anda Belum Mencukupi')
                ]);
            }
            return redirect()->route('employee.index')->with('danger','Eselon Max Group Is Sufficient');
        }
        // dd($attributes);

        $book = Book::create($attributes);
        return redirect()->route('employee.index')->with('success', 'Data has been saved successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function show(Book $book)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function edit(Book $book)
    {
        return view('book.edit', compact(['book']), [
            'eselon' => Eselon::get(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Book $book)
    {
        // $book = Book::find($id);
        $book->update($request->all());
        session()->put('sukses', 'Data has been saved successfully!');
        return redirect()->route('employee.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function destroy(Book $book)
    {
        $book->delete();
        if(request()->ajax()){
            return response()->json([
                'code'    => 0,
                'message' => ('message berhasil')
            ]);
        }
        return redirect()->route('book.index')->with('success','Data has been deleted successfully!');
    }

    public function notif()
    {
        $books  = Book::with('karyawan')->whereNotNull('notifikasi_tmtgolongan_at')
        ->whereNull('notifikasi_tmtgolongan_readed')
        ->get();

        $pkwt = Pkwt::whereNotNull('notifikasi_pkwt_at')
        ->whereNull('notifikasi_pkwt_readed')
        ->with('kategorikontrak')
        ->get();
        // dd($pkwt);

        // $pkwtData = Pkwt::with('kategorikontrak')->get();

            // dd($kategorikontrak->toArray());

        //1
        //notifkasi_1_kekirim. & belum kebaca
        //notifikasi_2_kekirim. & notifikasi_2 belum kebaca. walaupun notifikasi_1_sudah kebca
        $pensiun_karyawan = Karyawan::with('bookActive')
            ->where(function($query_root) {
                $query_root->where(function($query) {
                    $query->whereNotNull('notifikasi_pensiun_1_at')
                    ->whereNull('notifikasi_pensiun_1_readed')
                    ->whereNull('notifikasi_pensiun_2_at');
                })
                ->orWhere(function($q) {
                    $q->whereNotNull('notifikasi_pensiun_2_at')
                    ->whereNull('notifikasi_pensiun_2_readed')
                    ->where('tanggal_terakhir_pensiun', '>=', date('Y-m-d H:i:s'));
                })
                ->orWhere(function($q) {
                    $q->whereNotNull('notifikasi_peringatan_dikirim_pada')
                    ->whereNull('notifikasi_peringatan_dibaca_pada');
                });
            })
            ->get();

        return response()->json(['data' => $books, 'pensiun' => $pensiun_karyawan, 'pkwt' => $pkwt ]);
    }

    public function eselon()
    {
        $eselon = Eselon::all();
        return view('eselon.index', ['eselon' => $eselon]);
    }


    // public function sendTmtGolonganNotification()
    // {
    //     $tmt_golongan_batas = date('Y-m-d', strtotime('+1 month'));
    //     $books = Book::where('tmt_golongan', '<=', $tmt_golongan_batas)
    //         ->whereNull('notifikasi_tmt_golongan_at')->get(['email', 'tmt_golongan']);

    //     SendTmtGolonganNotificationJob::dispatch($books);
    // }

    public function detailKaryawan (Karyawan $karyawan)
    {
        return response()->json($karyawan);
    }

}
