<?php

namespace App\Console\Commands;
use App\Models\Karyawan;
use Illuminate\Console\Command;
use App\Jobs\NotifikasiPeringatan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Mail\NotifikasiKaryawanPeringatanMail8;

class NotifikasiPeringatan1 extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'notifikasip1';

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
        return Command::SUCCESS;
    }
    // public function handle()
    // {
    //     NotifikasiPeringatan::dispatchSync();
    //     return 0;
    // }
}
