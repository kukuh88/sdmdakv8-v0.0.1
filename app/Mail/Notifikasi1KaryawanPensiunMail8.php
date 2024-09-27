<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class Notifikasi1KaryawanPensiunMail8 extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    private $karyawan_pensiun;
    public function __construct($karyawan_pensiun)
    {
        $this->karyawan_pensiun = $karyawan_pensiun;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $this->subject("SDM NOTIFIKASI 6 MONTH");
        return $this->view('mail.notifikasi_pensiun_1',
        [
            'karyawans' => $this->karyawan_pensiun
        ]);
    }
}
