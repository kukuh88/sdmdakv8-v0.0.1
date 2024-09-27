<?php

namespace App\Console\Commands;

use App\Models\Pkwt;
use Illuminate\Console\Command;
use App\Mail\NotifikasiPkwtMail8;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Jobs\NotifikasiPkwt as NotifikasiPkwtJob;

class NotifikasiPkwt extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'notifikasipkwt';

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
            return Command::SUCCESS;
    }
    // public function handle()
    // {
    //     NotifikasiPkwtJob::dispatchSync();
    //     return 0;
    // }
}
