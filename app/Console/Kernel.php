<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        // $schedule->command('inspire')->hourly();
        //$schedule->command('logs:clear')->days(15);
        $schedule->command('logs:clear')->everyMinute();

        // Her gün sabah 9:30'da kurları güncelle (TCMB genelde 9:30'da yayınlıyor)
        $schedule->command('exchange-rates:fetch')
                ->dailyAt('09:30')
                ->weekdays() // Sadece hafta içi
                ->withoutOverlapping();
    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
