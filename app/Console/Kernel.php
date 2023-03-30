<?php

namespace App\Console;

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
        //
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->command('verify_member_subscription_payment')
            ->dailyAt('23:59')
            ->timezone('America/Toronto');

        $schedule->command('process_member_claims')
            ->dailyAt('23:59')
            ->timezone('America/Toronto');
        
        $schedule->command('showSubscriptionDetails')
            ->everyMinute()
            ->timezone('America/Toronto');   
            
        $schedule->command('InvoicesGenerate')
            ->monthlyOn(1, '12:00')
            ->timezone('America/Toronto');     
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }
}
