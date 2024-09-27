<?php

namespace App\Http\Controllers;

use App\Models\Pkwt;
use App\Exports\PkwtExport;

use App\Imports\PkwtImport;
use Illuminate\Http\Request;
use App\Models\KategoriKontrak;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Artisan;

class PkwtController extends Controller
{
    public function index(){

        if (\request()->exists('read_pkwt_id')){
            Pkwt::where('id', request('read_pkwt_id'))->whereNull('notifikasi_pkwt_readed')->update(['notifikasi_pkwt_readed' => now()]);
        }

        $pkwt = Pkwt::with('kategorikontrak')->get();
        // dd($pkwt);

        return view('pkwt.index', compact('pkwt') , [
            'kategorikontrak' => KategoriKontrak::get(),
        ]);
    }



    public function store(Request $request){

        $attributes = $request->validate([
            'nik'                => 'required|max:255|unique:pkwt',
            'formFileSm'         => 'required|mimes:jpg,jpeg,png',
            'full_name'          => 'required|max:255',
            'jabatan'            => 'required|max:255',
            'tgl_bergabung'      => 'required|max:255',
            'tgl_berakhir'       => 'required|max:255',
            'id_kategorikontrak' => 'required|max:255',
        ]);

        if($request->file('formFileSm')){
            $attributes['formFileSm'] = $request
            ->file('formFileSm')
            ->store('fotopegawai', 'public');
        }

       $pkwt = Pkwt::create($attributes);
       session()->put('sukses', 'Data has been saved successfully!');
        return redirect()->route('pkwt.index');
        }

    public function edit(Pkwt $pkwt){

        return view('pkwt.edit', compact('pkwt'), [
            'kategorikontrak' => KategoriKontrak::get(),
        ]);
    }

    public  function update(Request $request, Pkwt $pkwt)
    {
         $request->validate([
            'formFileSm' => 'nullable|mimes:jpg,jpeg,png',
        ]);

        $data = $request->all();
        $old_foto = null;
        $data['notifikasi_pkwt_at'] = null;
        $data['notifikasi_pkwt_readed'] = null;

        if (!empty($request->file('formFileSm'))) {
            $data['formFileSm'] = $request->file('formFileSm')->store('fotopegawai', 'public');
            $old_foto = storage_path('app/public/' . $pkwt->formFileSm);
        } else if (!empty($request->file('formFileSm'))) {
            unlink(storage_path('app/public/'.$old_foto));
        }

        DB::beginTransaction();

        $pkwt->update($data);

        DB::commit();
        // session()->put('sukses', 'Data has been saved successfully!');
        // return redirect()->route('karyawan.index');
        return response()->json("Data has been saved successfully!");
    }

    public function destroy(Pkwt $pkwt){

        $pkwt->delete();
        if(request()->ajax()){
            return response()->json([
                'code'    => 0,
                'message' => ('message berhasil')
            ]);
        }
        return redirect()->route('karyawan.index')->with('success','Data has been deleted successfully!');
    }

    public function storage()
    {
       Artisan::call('storage:link');
    }

    public function notif()
    {
        $pkwt = Pkwt::with('pkwt')->whereNotNull('notifikasi_pkwt_at')
        ->whereNull('notifikasi_pkwt_readed')
        ->get();

        dd($pkwt);

        $pkwt = Pkwt::with('bookActive')
            ->where(function($query_root) {
                $query_root->where(function($query) {
                    $query->whereNotNull('notifikasi_pkwt_at')
                    ->whereNull('notifikasi_pkwt_readed');
                });
            })
            ->get();

        return response()->json(['data' => $pkwt]);
    }

    public function pkwtexport()
    {
        return Excel::download(new PkwtExport, 'pkwt.xlsx');
    }

    public function pkwtimport(Request $request)
    {
        $file = $request->file('file')->store('/app/public/datakaryawan/');

        $import = new PkwtImport;
        $import->import($file);

        if($import->failures()){
            return back()->withfailure($import->failures());
        } else {
            session()->flash('danger', 'Harus Excel Bukan Yang lain');
            return redirect()->route('pkwt.index');
        }
        return redirect()->route('pkwt.index')->with('sukses', 'Data has been import web successfully!');
    }
}
