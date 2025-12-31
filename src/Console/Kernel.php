<?php

namespace OmarMokhtar\HijriDate\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use OmarMokhtar\HijriDate\Console\ValidateHijriCommand;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your package.
     *
     * @var array
     */
    protected $commands = [
        ValidateHijriCommand::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->command('hijri:validate')->dailyAt('00:05');
    }

    /**
     * Register the commands for the application.
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');
    }
}
