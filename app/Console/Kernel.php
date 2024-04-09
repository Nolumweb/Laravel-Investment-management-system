<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use App\Models\Investment;

class Kernel extends ConsoleKernel
{
 
    protected $commands = [
       // \App\Console\Commands\ReleaseMaturedInvestmentsCommand::class,
        Commands\ReleaseMaturedInvestments::class,

            ];
   

    protected function schedule(Schedule $schedule)
    {
        $schedule->command('app:release-matured-investments')->everyMinute();
    }
    
    
    

    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}




