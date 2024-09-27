<?php

namespace App\Http\Controllers;

use Exception;
use Carbon\Carbon;
use App\Models\Book;
use App\Models\Pkwt;
use App\Models\Eselon;
use App\Models\Karyawan;
use App\Imports\BookImport;
use Illuminate\Http\Request;
use App\Exports\KaryawanExport;
use App\Imports\KaryawanImport;
use App\Models\ApprovelKenaikan;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Storage;

class KaryawanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $karyawan = Karyawan::query()
            ->with(['lastKenaikanTingkat'])
            ->get();

        return view('karyawan.index', compact(['karyawan']), [
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
        // dd($request->all());
        $attributes = $request->validate([
            'nik'             => 'required|max:255|unique:karyawan',
            'name'            => 'required|max:255',
            'jabatan'         => 'required|max:255',
            'tgl_lahir'       => 'required|max:255',
            'cakar'           => 'required|max:255',
            'formFileSm'      => 'required|mimes:jpg,jpeg,png',
            'golonganini'     => 'required|max:255',
            'tmt_golonganini' => 'required|max:255',
            'eselon'          => 'required|max:255|exists:'.(new Eselon)->getTable().',eselon',
            'tmt_eselon'      => 'required|max:255',
        ]);
        $attributes['tanggal_terakhir_pensiun'] = date('Y-m-d', strtotime($request->tgl_lahir.' +56years'));

        // dd($attributes);
        if($request->file('formFileSm')){
            $attributes['formFileSm'] = $request
            ->file('formFileSm')
            ->store('fotopegawai', 'public');
        }

        $notifikasi_peringatan = date('Y-m-d', strtotime($attributes['tgl_lahir'] . ' +54years +11months'));
        $attributes['notifikasi_peringatan_pada'] = $notifikasi_peringatan;
        

        DB::beginTransaction();
        $karyawan = Karyawan::create($attributes);
        // dd($karyawan, $attributes);
        
        // operasi insert book
        $eselon = Eselon::where('eselon', $request->eselon)->first(); 
        $attributes['is_pilihan'] = 0;


        if($request->golonganini < $eselon->min_gol){
            $attributes['is_pilihan'] = 1;
        }

        $attributes['status'] = 1;

        if ($request->golonganini < $eselon->max_gol) {
            
            $attributes['golongan'] = $request->golonganini + 1;
            $tmt_golini = Carbon::parse($attributes['tmt_golonganini']);
            if($attributes['is_pilihan'] === 1){
                $attributes['tmt_golongan'] = $tmt_golini->addYears(1);
            } else {
                $attributes['tmt_golongan'] = $tmt_golini->addYears(4);
            }
        } else {
            session()->flash('danger', 'Eselon Max Group Is Sufficient');
            return redirect()->route('karyawan.index');
        }

        // biar ga perlu set $attributes['id_karyawan'] = $karyawan->id;
        $karyawan->book()->create($attributes);
        // dd("X");
        DB::commit();
        session()->put('sukses', 'Data has been saved successfully!');
        return redirect()->route('karyawan.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Karyawan  $karyawan
     * @return \Illuminate\Http\Response
     */
    public function show(Karyawan $karyawan)
    {
        $karyawan   = Karyawan::all();
        $book       = Book::all();
        return view('invoices.karyawan', compact(['karyawan','book']));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Karyawan  $karyawan
     * @return \Illuminate\Http\Response
     */
    public function edit(Karyawan $karyawan)
    {
        return view('karyawan.edit', compact(['karyawan']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Karyawan  $karyawan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Karyawan $karyawan)
    {
        $request->validate([
            'formFileSm' => 'nullable|mimes:jpg,jpeg,png',
        ]);

        $data = $request->all();
        $data['tgl_terakhir_pensiun'] = date('Y-m-d', strtotime($data['tgl_lahir']. ' +56years'));

        $old_foto = null;
        // $upload = (storage_path('app/public/fotopegawai'.$old_foto));
       
        if (!empty($request->file('formFileSm'))) {
            $data['formFileSm'] = $request->file('formFileSm')->store('fotopegawai', 'public');
            $old_foto = storage_path('app/public/' . $karyawan->formFileSm);
        } else if (!empty($request->file('formFileSm'))) {
            unlink(storage_path('app/public/'.$old_foto));
        }
        // dd($data, $old_foto);

        DB::beginTransaction();

        $karyawan->update($data);

        
        DB::commit();
        // session()->put('sukses', 'Data has been saved successfully!');
        // return redirect()->route('karyawan.index');
        return response()->json("Data has been saved successfully!");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Karyawan  $karyawanphp
     * @return \Illuminate\Http\Response
     */
    public function destroy(Karyawan $karyawan)
    {
        $karyawan->delete();
        if(request()->ajax()){
            return response()->json([
                'code'    => 0,
                'message' => ('message berhasil')
            ]);
        }
        return redirect()->route('karyawan.index')->with('success','Data has been deleted successfully!');
    }

    public function editPensiun(Karyawan $karyawan)
    {
        return view('pensiun.form', compact('karyawan'));
    }

    public function updatePensiun1(Karyawan $karyawan)
    {
        request()->validate([
            'pilihan_pensiun' => 'required|in:6,12'
        ]);

        $karyawan->pilihan_pensiun = request('pilihan_pensiun');
        if (request('pilihan_pensiun') == 12) {
            $karyawan->notifikasi_pensiun_1_at     = $karyawan->notifikasi_peringatan_pada;
            $karyawan->notifikasi_pensiun_1_readed = date('Y-m-d H:i:s');
        }
        $karyawan->notifikasi_peringatan_dibaca_pada = date('Y-m-d H:i:s');
        // $_55_tahun = date('Y-m-d', strtotime($karyawan->tgl_lahir . ' +55years'));
        // $_55_tahun = date('Y-m-d', strtotime($_55_tahun.' +'.request('pilihan_pensiun')."months"));
        // $karyawan->tanggal_terakhir_pensiun = $_55_tahun;
        $karyawan->save();

        session()->put('sukses', 'Data has been saved successfully!');
        return redirect()->route('pensiun.index');
    }

    public function storage()
    {
       Artisan::call('storage:link');
    }

    public function mail()
    {
        // $karyawans = Karyawan::inRandomOrder()->get();
        // $book      = Book::inRandomOrder()->get();
        // $pkwt      = Pkwt::inRandomOrder()->get();
        // return view ('e-mail.contoh', compact('karyawans'));
        // return view ('e-mail.notifikasi_pensiun_2', compact('karyawans'));
        // return view ('e-mail.notifikasi_pensiun_1', compact('karyawans'));
        // return view ('e-mail.notifikasi_tmt_golongan', compact('book'));
        // return view ('e-mail.notifikasi_pkwt_berakhir', compact('pkwt'));
        // return view ('e-mail.final', compact('karyawans'));
    }

    public function karyawanexport()
    { 
        return Excel::download(new KaryawanExport, 'Karyawan.xlsx');
    }

    public function karyawanimport(Request $request)
    {
        $file = $request->file('file')->store('/app/public/datakaryawan/');

        $import = new KaryawanImport;
        $import->import($file);

        if($import->failures()){
            return back()->withfailure($import->failures());
        }
        
        return redirect()->route('karyawan.index')->with('sukses', 'Data has been import web successfully!');


        // hasil upload
        // $fileupload      = $request->file('file');
        // $nameFile        = $fileupload->getClientOriginalName();
        // $fileupload->storeAs('datakaryawan', $nameFile, 'public');

        // $import = Excel::import(new KaryawanImport, storage_path('/app/public/datakaryawan/'.$nameFile));

        // return redirect()->route('karyawan.index')->with('success', 'Data has been import web successfully!');
    }

    public function holdon()
    {
        // $book  = Book::query()
        // ->whereRaw("DATE_SUB(tmt_golongan, INTERVAL 1 MONTH) <= ?", date('Y-m-d'))
        // ->with(['lastKenaikanTingkat'])
        // ->whereHas('historyKenaikanTingkat', function ($q) {
        //     return $q->where('status', 0);
        // })->get();
        // dd($book);

        // $now = Carbon::now();
        // $date = $now->format('d');
        // $bulan = $now->addMonth(1)->format('m');

        // $book  = Book::query()
        // ->whereMonth('tmt_golongan', $bulan)->whereDay('tmt_golongan', $date)
        // ->with(['lastKenaikanTingkat'])
        // ->whereHas('historyKenaikanTingkat', function ($q) {
        //     return $q->where('status', 0);
        // })->get();
        // dd($book);

        $karyawan = Karyawan::query()
            ->with(['lastKenaikanTingkat'])
            ->whereHas('historyKenaikanTingkat', function ($q) {
                return $q->where('status', 0);
            })
            ->get();
        
        $book  = Book::query()
        ->with(['lastKenaikanTingkat'])
        ->whereHas('historyKenaikanTingkat', function ($q) {
            return $q->where('status', 0);
        })
        ->get();
        
        return view('hold.index', compact('book','karyawan'));
    }

    // bagian ke naikan Acc
    public function approvel_kenaikan(Request $request, Karyawan $karyawan)
    {
        $request->validate([
            'status'        => ['required', 'integer', 'in:0,1,2'],
            'keterangan'    => ['nullable', 'string'],
            'golonganini'   => ['required', 'integer'],
            'golongannaik'  => ['required', 'integer'],
            
        ]);
        
        $book = $karyawan->book;

        $approvel = ApprovelKenaikan::firstOrCreate([
            'id_karyawan'   => $book->id_karyawan,
            'golonganini'   => $request->golonganini,
            'golongannaik'  => $request->golongannaik,
        ]);

        $attributes['status'] = $request->status;

        if($request->status == 1) {
            $attributes['approved_at'] = date('Y-m-d H:i:s');
            $attributes['approved_by'] = auth()->user()->id;

            // bug
            $eselon = Eselon::where('eselon', $book->eselon)->first();
            // dd($eselon);

            $book->golonganini     = $request->golongannaik;
            $book->golongan        = $request->golongannaik + 1;
            $book->tmt_golonganini = $book->tmt_golongan;

            // dd($eselon);
            // bug
            if ($book->golonganini < $eselon->min_gol){
                $book->is_pilihan = 1;
            }

            if ($book->golongannaik < $eselon->max_gol) {
                $tmt_golini = Carbon::parse($book->tmt_golonganini);
                if ($book->is_pilihan === 1){
                    $book->tmt_golongan = $tmt_golini->addYears(1)->format('Y-m-d');
                } else {
                    $book->tmt_golongan = $tmt_golini->addYears(4)->format('Y-m-d');
                }
            }
        } else{
            $attributes['keterangan'] = $request->keterangan;
        }

        $approvel->update($attributes);
       
        $book->last_approval_id = $approvel->id;
        $book->update();
        $karyawan->last_approval_id = $approvel->id;
        $karyawan->update();

        return response()->json([
            'status' => 'success',
            'title' => 'Berhasil !',
            'message' => 'Data Karyawan berhasil di update',
        ], 200);
    }
    
    public function history_hold()
    {
        $approvel = ApprovelKenaikan::all();
        $karyawan = Karyawan::all();
        $book     = Book::all();
        return view('hold.history', compact('approvel', 'karyawan', 'book'));
    }
}
