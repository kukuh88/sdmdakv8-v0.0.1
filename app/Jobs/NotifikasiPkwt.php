<?php

namespace App\Jobs;

use App\Models\Pkwt;
use Illuminate\Bus\Queueable;
use App\Mail\NotifikasiPkwtMail8;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldBeUnique;

class NotifikasiPkwt implements ShouldQueue
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
            // karyawan yg notifikasi peringatannya sudah lewat dan belum dikirimi notifikasi
            $query = Pkwt::whereRaw("DATE_SUB(tgl_berakhir, INTERVAL 1 MONTH) <= ?", date('Y-m-d'))
            ->whereNull('notifikasi_pkwt_at');
          
            //  dd($query->toArray());

            // notifikasi AT untuk mengirikam dan sudah di kirim atau belum 
            $pkwt = $query->get();
            // dd($pkwt);
            if (count($pkwt) == 0 ) {
                    return;
            } 
            
            DB::beginTransaction();
            $query->update([
                'notifikasi_pkwt_at' => date('Y-m-d H:i:s')
            ]);
            $mail   = Mail::to(config('mail.notifikasi_admin_address'));

            if (!empty(config('mail.notifikasi_cc'))) {
                $cc     = explode(',', config('mail.notifikasi_cc'));
                $mail->bcc($cc);
            }
            $mail->send(new NotifikasiPkwtMail8($pkwt));
            DB::commit();
    }
}
