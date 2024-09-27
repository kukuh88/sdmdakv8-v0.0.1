<?php

namespace App\Console\Commands;
use App\Models\Karyawan;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Mail\Notifikasi1KaryawanPensiunMail8;
use App\Jobs\NotifikasiPensiun1 as NotifikasiPensiun1Job;

class NotifikasiPensiun1 extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'notifikasi1';

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
        return Command::SUCCESS;
    }
    // public function handle()
    // {
    //     NotifikasiPensiun1Job::dispatchSync();
    //     return Command::SUCCESS;
    // }
}
