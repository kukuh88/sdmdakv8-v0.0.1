<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class NotifikasiPkwtMail8 extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    private $pkwt;
    public function __construct($pkwt)
    {
        $this->pkwt = $pkwt;   
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $this->subject("SDM NOTIFIKASI PKWT");
        return $this->view('mail.notifikasi_pkwt_berakhir', 
        [
            'pkwt' => $this->pkwt
        ]);
   }
}
