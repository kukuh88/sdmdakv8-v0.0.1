<?php

namespace App\Jobs;

use App\Models\Book;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\SerializesModels;
use App\Mail\NotifikasiTmtGolonganMail;
use App\Mail\NotifikasiTmtGolonganMail8;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldBeUnique;

class NotifikasiTmtGolongan implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $books;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
    //    $this->books = $books;
    }

    /**
     * Execute the job.
     *
     * @return void
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
}
