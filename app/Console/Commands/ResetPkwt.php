<?php

namespace App\Console\Commands;

use App\Models\Pkwt;
use Illuminate\Console\Command;

class ResetPkwt extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'reset:pkwt';

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
        Pkwt::whereNotNull('id')
        ->update([
            'notifikasi_pkwt_at' => null
        ]);
        return 0;
    }
}
