<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

use App\RequestBaptis;
use Carbon\Carbon;

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
        // $schedule->command('inspire')
        //          ->hourly();

        /* Example of Scheduler for Rejecting Requests that are due. */
        $schedule->call(function () {
            // Request Baptis
            $requests = RequestBaptis::get();
            foreach($requests as $request) {
                $date = Carbon::parse($request->tanggal);
                if($date->isToday()) {
                    $request->status = RequestBaptis::STATUS_REJECTED;
                    $request->delete();
                }
            } 
        })->daily();
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
