<?php

namespace App\Jobs;

use App\Models\Karyawan;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Mail\Notifikasi1KaryawanPensiunMail8;
use App\Mail\NotifikasiKaryawanPeringatanMail8;
use Illuminate\Contracts\Queue\ShouldBeUnique;

class NotifikasiPeringatan implements ShouldQueue
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
        $query     = Karyawan::where('notifikasi_peringatan_pada', '<=', date('Y-m-d'))
        ->whereNull('notifikasi_peringatan_dikirim_pada');

        $karyawans = $query->get();
        if (count($karyawans) == 0 ) {
            return;
        }

        DB::beginTransaction();
        $query->update([
            'notifikasi_peringatan_dikirim_pada' => date('Y-m-d H:i:s')
        ]);

        $mail   = Mail::to(config('mail.notifikasi_admin_address'));
        if (!empty(config('mail.notifikasi_cc'))) {
            $cc = explode(',', config('mail.notifikasi_cc'));
            $mail->bcc($cc);
        }
        $mail->send(new NotifikasiKaryawanPeringatanMail8($karyawans));
        DB::commit();
    }
}
