<?php

namespace App\Console;

use App\Console\Commands\CheckCronbJobSetCommand;
use App\Console\Commands\NewVersion;
use App\Console\Commands\VendorCleanUpCommand;
use App\Console\Commands\AttendanceCheck;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        CheckCronbJobSetCommand::class
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('cron:job-set')->daily();
        // $schedule->command('email:invoice-generate')->cron('0 0 1 * *');
        // $schedule->command('email:invoice-notice')->daily();
        // $schedule->command('email:license-expired')->daily();
        $schedule->command('check:attendance')->dailyAt('16:30');
        // $schedule->command('check:attendance')->everyMinute('1');
        $schedule->command('task:mail')->everyMinute();
        $schedule->command('attendance:report')->monthlyOn(1, '14:00');
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
