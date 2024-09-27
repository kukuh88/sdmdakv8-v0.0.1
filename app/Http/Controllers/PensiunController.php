<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Eselon;
use App\Models\Pensiun;
use App\Models\Karyawan;
use Illuminate\Http\Request;

class PensiunController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $karyawan   = Karyawan::whereNotNull('pilihan_pensiun')->get();
        // $pensiun = Karyawan::where(['pilihan_pensiun' => 1])->get();
        return view ('pensiun.index', compact(['karyawan']));
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
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pensiun  $pensiun
     * @return \Illuminate\Http\Response
     */
    public function show(Pensiun $pensiun)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pensiun  $pensiun
     * @return \Illuminate\Http\Response
     */
    public function edit(Karyawan $karyawan)
    {
       
        return view('pensiun.form',compact('karyawan'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pensiun  $pensiun
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pensiun $pensiun)
    {
    //   $request = $pensiun->validate([
    //     'pilihan_pensiun' => 'required|max:255'
    //   ]);

    //   $pensiun = Pensiun::update($request);
        $pensiun->update($request->all());
        session()->put('sukses', 'Data has been saved successfully!');
        return redirect()->route('pensiun.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pensiun  $pensiun
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pensiun $pensiun)
    {
        //
    }
}
