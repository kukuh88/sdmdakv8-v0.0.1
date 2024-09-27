<?php

namespace App\Console\Commands;

use App\Models\Book;
use Illuminate\Console\Command;

class ResetTmt extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'reset:tmt';

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
        Book::whereNotNull('id')->update(['notifikasi_tmtgolongan_at' => null]);
        return 0;
    }
}
