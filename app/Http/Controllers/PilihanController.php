<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Eselon;
use App\Models\Book;
use App\Models\Pilihan;
use Illuminate\Http\Request;

class PilihanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (\request()->exists('read_book_id')) {
            Book::where('id', request('read_book_id'))->whereNull('notifikasi_tmtgolongan_readed')->update(['notifikasi_tmtgolongan_readed' => now()]);
        }
        $pilihan = Book::where(['is_pilihan' => 1])
            ->whereHas('karyawan', function ($karyawan) {
                $karyawan->where('tanggal_terakhir_pensiun', '>', now()->format('Y-m-d'));
            })
            ->get();
    
        return view('pilihan.index', compact(['pilihan']), [
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
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pilihan  $pilihan
     * @return \Illuminate\Http\Response
     */
    public function reguler($id){
        $today    = date("Y-m-d");
        $book     = Book::where('id', $id)->firstOrFail();
        $pilihan  = Book::where('id', $id)->firstOrFail();

        if($today >= $book->tmt_golongan){
            
        $tmt_golongan = Carbon::parse($book->tmt_golongan);
        $pilihan->update(['tmt_golongan' => $tmt_golongan->addYears(4), 'is_pilihan' => 0 ]);

        return redirect()->route('book.index', ['book' => $book, 'today' => $today]);
         } else {
            if(request()->ajax()){
                return response()->json([
                    'code'    => 0,
                    'message' => ('Data Anda Belum Mencukupi')
                ]);
            }
            return redirect()->route('pilihan.index')->with('info','You Have Not Enough Dates With GROUP TMT');
           
        }
    }
}
