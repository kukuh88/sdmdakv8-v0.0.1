<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use App\Models\Book;
use Illuminate\Console\Command;
use App\Mail\NotifikasiHoldMail8;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Jobs\NotifikasiHold as NotifikasiHoldJob;


class NotifikasiHold extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'notifikasihold';

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
        
        return Command::SUCCESS;
    }
    // public function handle()
    // {
    //     NotifikasiHoldJob::dispatchSync();
    //     return 0;
    // }
}
