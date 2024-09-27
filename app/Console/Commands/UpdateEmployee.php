<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use App\Models\Book;
use App\Models\Eselon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class UpdateEmployee extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'employee:posisi';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $now  = Carbon::now()->format('Y-m-d');
        $book = Book::where('tmt_golongan', '<=', $now)->get();
        // dd($book);
        
        DB::beginTransaction();
        foreach ($book as $employee) {
            $eselon= Eselon::where('eselon', $employee->eselon)->first();
            $tempgolongan = $employee->golonganini + 1;
          
            if($tempgolongan <= $eselon->max_gol){
                // dd("MASUK");
                $years         = ($tempgolongan < $eselon->min_gol) ? 1:4 ;
                $next_golongan = $tempgolongan + 1;
                
                $employee->update([
                    'golonganini'     => $tempgolongan,
                    'tmt_golonganini' => $employee->tmt_golongan,
                    'golongan'        => $next_golongan,
                    'tmt_golongan'    => Carbon::parse($employee->tmt_golongan)->addYears($years),
                    'is_pilihan'      => $years === 4 ? 0 : 1,
                ]);
                $employee->notifikasi_tmtgolongan_at = null;
                $employee->notifikasi_tmtgolongan_readed = null;
                $employee->save();
            } 
        }
        DB::commit();
        return Command::SUCCESS;
    }
    
}
