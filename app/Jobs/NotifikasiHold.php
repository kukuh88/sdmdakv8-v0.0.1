<?php

namespace App\Jobs;

use App\Models\Book;
use App\Jobs\NotifikasiHold;
use Illuminate\Bus\Queueable;
use App\Mail\NotifikasiHoldMail8;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldBeUnique;

class NotifikasiHold implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $now = Carbon::now();
        $date = $now->format('d');
        $bulan = $now->submonth(1)->format('m');

        $book  = Book::query()
        ->whereMonth('tmt_golongan', $bulan)->whereDay('tmt_golongan', $date)
        ->with(['lastKenaikanTingkat'])
        ->whereHas('historyKenaikanTingkat', function ($q) {
            return $q->where('status', 0);
        })->get();
      
        if (count($book) == 0 ) {
            return;
        }
        
        DB::beginTransaction();

        $mail   = Mail::to(config('mail.notifikasi_admin_address'));

        if (!empty(config('mail.notifikasi_cc'))) {
            $cc     = explode(',', config('mail.notifikasi_cc'));
            $mail->bcc($cc);
        }
        $mail->send(new NotifikasiHoldMail8($book));
        DB::commit();
   
    }
}
