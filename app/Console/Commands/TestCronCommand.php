<?php

namespace App\Console\Commands;

use App\Models\TestLogCron;
use Illuminate\Console\Command;

class TestCronCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'testcronlog';

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
        $query = TestLogCron::create([
            'datetime' => date('Y-m-d H:i:s')
        ]);
        return 0;
    }
}
