<?php

namespace App\Console\Commands;

use App\Models\Karyawan;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Mail\Notifikasi2KaryawanPensiunMail8;
use App\Jobs\NotifikasiPensiun2 as NotifikasiPensiun2Job;

class NotifikasiPensiun2 extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'notifikasi2';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
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
        return Command::SUCCESS;
    }
    // public function handle()
    // {
    //     NotifikasiPensiun2Job::dispatchSync();
    //     return Command::SUCCESS;
    // }
}
