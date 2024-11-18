<?php

namespace App\Console\Commands;

use App\Models\Depot;
use Carbon\Carbon;
use Illuminate\Console\Command;

class UpdateDepotStatus extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'depot:update-depot-status';


    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Met à jour les statuts des dépôts dont la date de fin est passée';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $now = Carbon::now('Europe/Paris');

        Depot::where('end_date_depot', '<=', $now)
            ->where('actif', 1)
            ->update(['actif' => 0]);

        $this->info('Les statuts des dépôts ont été mis à jour avec succès.');
    }
}
