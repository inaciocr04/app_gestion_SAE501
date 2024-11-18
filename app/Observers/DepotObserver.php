<?php

namespace App\Observers;

use App\Models\Depot;
use Carbon\Carbon;

class DepotObserver
{
    /**
     * Handle the Loan "saved" event.
     *
     * @param  \App\Models\Depot  $depot
     * @return void
     */
    public function saved(Depot $depot)
    {
        $now = Carbon::now('Europe/Paris');

        Depot::where('end_date_depot', '<=', $now)
            ->where('actif', 1)
            ->update(['actif' => 0]);

    }
}
