<?php

use App\Jobs\UpdateDepotStatus;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

// Commande pour mettre à jour les statuts des dépôts
Artisan::command('update:depot-status', function () {
    dispatch(new UpdateDepotStatus()); // Envoie le job
    $this->info('Depot status has been updated!');
})->describe('Mise à jour des statuts des dépôts');

