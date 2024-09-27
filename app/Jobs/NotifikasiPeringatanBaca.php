<?php

namespace App\Jobs;

use App\Models\Karyawan;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldBeUnique;

class NotifikasiPeringatanBaca implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
    * @return void  
     */
    public function handle()
    {
        //karyawan yang belum membaca notifikasi ini maka akan di kirimkan jika sudah dikirim maka tidak dikirimkan lagi
        $query = Karyawan::where('notifikasi_peringatan_dikirim_pada');
    }
}
