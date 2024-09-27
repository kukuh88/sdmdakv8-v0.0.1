<?php

namespace App\Console\Commands;

use App\Models\Book;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Mail\NotifikasiTmtGolonganMail8;
use App\Jobs\NotifikasiTmtGolongan as NotifikasiTmtGolonganJob;

class NotifikasiTmtGolongan extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'tmtgolongan';
    // protected $signature = 'tmtgolongan';

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
        $_1bulan  = date('Y-m-d', strtotime('+1 month'));
        $query    = Book::where('tmt_golongan', '<=', $_1bulan)->whereNull('notifikasi_tmtgolongan_at');

        $book = (clone $query)->get();

        if ($book->count() > 0) {
            DB::beginTransaction();
            $query->update(['notifikasi_tmtgolongan_at' => date('Y-m-d H:i:s')]);

            $cc   = explode(',', config('mail.notifikasi_cc'));

            $mail = Mail::to(config('mail.notifikasi_admin_address'));
            if (count($cc) > 0) {
                $mail->bcc($cc);
            }
            $mail->send(new NotifikasiTmtGolonganMail8($book));
            DB::commit();
            return Command::SUCCESS;
        }
            
        // foreach ($this->books as $book) {
        //     $mailData = [
        //         'subject' => 'Notifikasi TMT Golongan',
        //         'email' => $book->email,
        //         'content' => "Notifikasi TMT Golongan Anda akan berlaku pada tanggal ".$book->tmt_golongan,
        //     ];
        //     $mail = new NotificationMail($mailData);
        //     Mail::to($book->email)->send($mail);
        //     $book->created_at = now();
        //     $book->save();
        // }
    }
    // public function handle()
    // {
    //     // $books = Book::where('tmt_golongan', '<=', now()->addMonth())
    //     //     ->whereNull('notifikasi_tmt_golongan_at')
    //     //     ->get(['email', 'tmt_golongan']);

    //     // SendTmtGolonganNotificationJob::dispatch($books);
    //     NotifikasiTmtGolonganJob::dispatchSync();
    // }
}
