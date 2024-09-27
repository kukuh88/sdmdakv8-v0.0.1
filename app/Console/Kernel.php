<?php

namespace App\Console;

use App\Jobs\LogJob;
use App\Jobs\NotifikasiHold;
use App\Jobs\NotifikasiPkwt;
use App\Jobs\NotifikasiPensiun1;
use App\Jobs\NotifikasiPensiun2;
use App\Jobs\NotifikasiPeringatan;
use App\Jobs\NotifikasiTmtGolongan;
use Illuminate\Support\Facades\Log;
use Illuminate\Console\Scheduling\Schedule;
use App\Console\Commands\TestLogCronCommand;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->command('notifikasihold')->everyMinute();
        $schedule->command('notifikasipkwt')->everyMinute();
        $schedule->command('tmtgolongan')->everyMinute();
        $schedule->command('employee:posisi')->everyMinute();
        $schedule->command('notifikasip1')->everyMinute();
        $schedule->command('notifikasi1')->everyMinute();
        $schedule->command('notifikasi2')->everyMinute();
        // $schedule->command(TestCronCommand::class)->everyMinute();
        // $schedule->command('inspire')->hourly();
        // $schedule->job(LogJob::class)->everyMinute();
        // $schedule->job(LogJob::class)->everyTwoMinutes();

        // //1
        // cron -> hosting/vps
        // * * * * * php artisan schedule:run >> /dev/null   -> room

        // //2
        // cron -> laravel (kernel.php) -> bagi bagi\
        //   Masukkan Kode Anda Disini
        // $schedule->call(function () {
            
        // Pengecekan apakah cronjob berhasil atau tidak
     	// Mencatat info log 
        //     Log::info('Cronjob berhasil dijalankan');
        // })->everyTwoMinutes();
        
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
