<?php

namespace App\Http\Controllers;

use App\Models\Actual_year;
use App\Models\GroupTD;
use App\Models\GroupTP;
use App\Models\Year_training;
use Illuminate\Http\Request;

class GroupeAnneeController extends Controller
{
    public function index()
    {
        $tpCount = GroupTP::count();
        $tdCount = GroupTD::count();
        $yearTrainingCount = Year_training::count();
        $actualYearCount = Actual_year::count();

        // Passer les comptes à la vue
        return view('groupes.index', compact('tpCount', 'tdCount', 'yearTrainingCount', 'actualYearCount'));
    }
}
