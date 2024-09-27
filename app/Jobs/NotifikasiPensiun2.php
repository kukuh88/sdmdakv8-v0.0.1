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
use App\Mail\Notifikasi2KaryawanPensiunMail8;
use Illuminate\Contracts\Queue\ShouldBeUnique;

class NotifikasiPensiun2 implements ShouldQueue
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
        // cari list karyawan yang kreteria 1 pilihan pensiunnya 12 dan 

        $_1bulan   = date('Y-m-d', strtotime('+1 month'));
        $query     = Karyawan::whereNull('notifikasi_pensiun_2_at')->where('tanggal_terakhir_pensiun', '<=', $_1bulan);

        // tgl_terakhir_pensiun - 1 bulan tgl_terakhir_pensiun >= date('y-m-d', strtotime('-1  month') AND notifikasi_pensiun_2_at is null

        $karyawans = (clone $query)->get();
        if (count($karyawans) == 0) {
            return 0;
        } 

        DB::beginTransaction();
        (clone $query)->update(['notifikasi_pensiun_ 2_at' => date('Y-m-d H:i:s')]);
        $mail = Mail::to(config('mail.notifikasi_admin_address'));
        
        if (!empty(config('mail.notifikasi_cc'))) {
            $listCc = explode(',', config('mail.notifikasi_cc')); // array
            foreach ($listCc as $cc) {
                $mail->bcc($cc);
            }
        }
        $mail->send(new Notifikasi2KaryawanPensiunMail8($karyawans));
        DB::commit();
    }
}
