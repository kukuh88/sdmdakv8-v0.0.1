<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NotifikasiKaryawanPeringatanMail8 extends Mailable
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
        $this->subject("SDM NOTIFIKASI PILIHAN MPP");
        return $this->view('mail.contoh',
        [
            'karyawans' => $this->karyawan_pensiun
        ]);
    }
}
