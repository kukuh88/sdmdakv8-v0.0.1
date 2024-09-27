<?php

namespace App\Console\Commands;

use App\Models\Karyawan;
use Illuminate\Console\Command;

class ResetNotifikasi1 extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'reset:notifikasi1';

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
        Karyawan::whereNotNull('id')
                ->update([
                    'notifikasi_pensiun_1_at' => null
                ]);
        return 0;
    }
}
