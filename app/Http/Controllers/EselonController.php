<?php

namespace App\Http\Controllers;

use App\Models\Eselon;
use Illuminate\Http\Request;

class EselonController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $eselon = Eselon::all();
        return view('eselon.index', compact('eselon'));
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

         'eselon'  => 'required|max:255|unique:eselon',
         'min_gol' => 'required|max:255',
         'max_gol' => 'required|max:255',
           
        ]);
       
        $eselon = Eselon::create($validatedData);  

        return redirect()->route('eselon.index')->with('success', 'Data has been saved successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Eselon  $eselon
     * @return \Illuminate\Http\Response
     */
    public function show(Eselon $eselon)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Eselon  $eselon
     * @return \Illuminate\Http\Response
     */
    public function edit(Eselon $eselon)
    {
        return view('eselon.edit', compact('eselon'));
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Eselon  $eselon
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Eselon $eselon)
    {
        $eselon->update($request->all());
        session()->put('sukses', 'Data has been saved updated successfully!');

        return redirect()->route('eselon.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Eselon  $eselon
     * @return \Illuminate\Http\Response
     */
    public function destroy(Eselon $eselon)
    {
        $eselon->delete();
        if(request()->ajax()){
            return response()->json([
                'code'    => 0,
                'message' => ('message berhasil')
            ]);
        }
        return redirect()->route('eselon.index')->with('success','Data has been deleted successfully!');
    }


}
