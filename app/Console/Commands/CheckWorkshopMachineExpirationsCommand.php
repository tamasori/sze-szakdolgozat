<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use Illuminate\Console\Command;
use App\Models\WorkshopMachinery;
use App\Notifications\WorkshopMachineExpirationNotification;

class CheckWorkshopMachineExpirationsCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'workshop-machinery:check-expiration';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check workshop machinery expirations';

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
        $workshopMachineries = WorkshopMachinery::all();

        foreach ($workshopMachineries as $workshopMachinery) {
            $date = $workshopMachinery->inspectionRecords()->orderBy("date","DESC")->first()->date;
            $diffInDays = abs(Carbon::now()->diffInDays(Carbon::createFromTimeString($date)));
            if (in_array($diffInDays, [28,14,7,3,1])){
                \Notification::route("mail",config("company.email"))
                     ->notify(new WorkshopMachineExpirationNotification($workshopMachinery, $diffInDays));
            }
        }
        return 1;
    }
}
