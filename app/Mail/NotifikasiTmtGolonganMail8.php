<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NotifikasiTmtGolonganMail8 extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    private $book_tmt_golongan;
    public function __construct($book_tmt_golongan)
    {
        $this->book_tmt_golongan = $book_tmt_golongan;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $this->subject("SDM NOTIFIKASI GOLONGAN MENDATANG");
        return $this->view('mail.notifikasi_tmt_golongan',
        [
            'book' => $this->book_tmt_golongan
        ]);
    }
}
