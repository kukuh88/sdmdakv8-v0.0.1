<?php

namespace App\Console\Commands;

use App\Models\Book;
use App\Models\Karyawan;
use Illuminate\Console\Command;

class ResetKaryawan extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'reset:karyawan';

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
        Book::whereNotNull('id')->delete();
        Karyawan::whereNotNull('id')->delete();
        return 0;
    }
}
