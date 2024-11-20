<?php

namespace App\Console\Commands;

use App\Models\Visits;
use Carbon\Carbon;
use Illuminate\Console\Command;

class UpdateVisitStatus extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:update-visit-status';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update visit_status to "oui" if end_date_visit is within 10 days from today';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $today = Carbon::now();
        $thresholdDate = $today->addDays(10);

        Visits::where('end_date_visit', '<=', $thresholdDate)
            ->where('visit_statu', 'non')
            ->update(['visit_statu' => 'oui']);

        $this->info('Les visites ont été mises à jour avec succès.');

        return 0;
    }
}
