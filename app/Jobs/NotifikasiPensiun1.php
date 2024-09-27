<?php

namespace App\Jobs;

use App\Models\Karyawan;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Mail\Notifikasi1KaryawanPensiunMail;
use App\Mail\Notifikasi1KaryawanPensiunMail8;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Support\Facades\DB;

class NotifikasiPensiun1 implements ShouldQueue
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
        // notifikasi_peringatan_muncul_pada
        // notifikasi_peringatan_sudah_dikirim
        // notifikasi_peringantan_sudah_dibaca

        // ambil data karyawan yg notifikasi_pensiun_1_at nya null
        // dan (sekarang - tgl_lahirnyya) >= 54th 11bln
        // $batas_pensiun = 56;

        //kriteria 1, yg belum dapat notifikasi
        //kirteria 2, yg tanggal_terakhir_pensiun - 1 month <= sekarang


        // job -> email & menampilkan notif di web
        // web -> hasil dari job

        // khusus untuk karyawan yg memilih 6 bulan + 1
        // list karyawan yg 
        $query = Karyawan::whereNull('notifikasi_pensiun_1_at') //yg belum dikirimi notif
            ->where('pilihan_pensiun', 6) //yg pilihan pensiunnya 6 bln
            ->whereRaw("DATE_SUB(tanggal_terakhir_pensiun, INTERVAL 7 MONTH) <= ?", date('Y-m-d')) //yg tgl_terakhir_pensiun (56th) - 7 bulan >= sekarang
             ;
        
             // 2023-01-02

            //peringatan = 1thn 1 bulan dari 56th = 12 bulan 
            //notifikasi1 = 2011-06-01 = 6 bulan
            //notifikasi2 = max masa pesiun 56 = 1 bulan sebelum dia masa pensiunnya 
        
        // $karyawans = Karyawan::where("DATE_FORMAT(FROM_DAYS(DATEDIFF(NOW(), tanggal_terakhir_pensiun)), '%Y') + 0 <= notifikasi_peringatan_dibaca_pada");
        
        // $karyawan_pensiun_2 = Karyawan::where('tanggal_terakhir', '<=', date('Y-m-d', strtotime('+1 month')))->whereNull('notifikasi_pensiun_2_at')->get();

        // $karyawans = Karyawan::whereRaw("DATE_FORMAT(FROM_DAYS(DATEDIFF(NOW(), tgl_lahir)), '%Y') + 0 > " . $batas_pensiun)
            // ->whereNull('notifikasi_pensiun_1_at')
            // ->get();
            // dd($karyawans->toArray());
            // dd($karyawans);
        if ($query->count() == 0) {
            return;
        }
        DB::beginTransaction();
            $karyawans = $query->get();
            $query->update([
                'notifikasi_pensiun_1_at' => date('Y-m-d H:i:s')
            ]);

            $mail = Mail::to(config('mail.notifikasi_admin_address'));
            if (!empty(config('mail.notifikasi_cc'))) {
                $cc = explode(',', config('mail.notifikasi_cc'));
                $mail->bcc($cc);
            }
            $mail->send(new Notifikasi1KaryawanPensiunMail8($karyawans));
        DB::commit();
    }
}
