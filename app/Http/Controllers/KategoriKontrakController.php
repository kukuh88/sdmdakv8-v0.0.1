<?php

namespace App\Http\Controllers;

use App\Models\KategoriKontrak;
use Illuminate\Http\Request;

class KategoriKontrakController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $KategoriKontrak = KategoriKontrak::all();

        // Ambil id kategori yang sudah dipakai, misalnya "PKWT" atau "Tenaga Ahli"
        // Ubah menjadi array menggunakan pluck dan toArray
        $existingCategories = KategoriKontrak::pluck('kategorikontrak')->toArray();

        return view('kategorikontrak.index', compact('KategoriKontrak', 'existingCategories'));
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
        $validatedData = $request->validate([
            'kategorikontrak' => 'required|max:255',
        ]);

        $validatedData = kategorikontrak::create($validatedData);

        return redirect()->route('kategorikontrak.index')->with('success', 'Data has been saved successfuly!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\KategoriKontrak  $KategoriKontrak
     * @return \Illuminate\Http\Response
     */
    public function show(KategoriKontrak $kategorikontrak)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\KategoriKontrak  $KategoriKontrak
     * @return \Illuminate\Http\Response
     */
    public function edit(KategoriKontrak $kategorikontrak)
    {
        return view('kategorikontrak.edit', compact('kategorikontrak'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\KategoriKontrak  $KategoriKontrak
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, KategoriKontrak $kategorikontrak)
    {
        $kategorikontrak->update($request->all());
        session()->put('sukses', 'Data has been saved updated successfully!');

        return redirect()->route('kategorikontrak.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\KategoriKontrak  $KategoriKontrak
     * @return \Illuminate\Http\Response
     */
    public function destroy(KategoriKontrak $kategorikontrak)
    {
        $kategorikontrak->delete();
            if(request()->ajax()){
                return response()->json([
                'code'      => 0,
                'message'   => ('message berhasil')
            ]);
        }
        return redirect()->route('kategorikontrak.index')->with('success', 'Data has been deleted successfully!');
    }
}
