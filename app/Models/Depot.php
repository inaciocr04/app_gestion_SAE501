<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Depot extends Model
{
    protected $fillable = [
        'name_depot',
        'depot_link',
        'actual_year_id',
        'year_training_id',
        'end_date_depot',
        'actif',
    ];

    public function actual_year()
    {
        return $this->belongsTo(Actual_year::class);
    }
    public function year_training()
    {
        return $this->belongsTo(Year_training::class);
    }
}
