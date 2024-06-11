<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Carbon\Carbon;
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
        $now=Carbon::now()->format('YmdHis');

        $schedule->command('GenerateMailNumber')
            ->timezone('Asia/Jakarta')
            ->everyFiveMinutes();
            // ->dailyAt('08:00');
            // ->everyMinute();
            // ->sendOutputTo("storage/logs/LogAlertExpired_".$now.".txt");
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
