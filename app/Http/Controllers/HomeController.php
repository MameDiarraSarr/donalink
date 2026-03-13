<?php

namespace App\Http\Controllers;

use App\Models\Campagne;
use App\Models\Don;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $campagnes      = Campagne::where('statut', 'active')->latest()->get();
        $totalCampagnes = Campagne::where('statut', 'active')->count();
        $totalDonateurs = User::where('role', 'donateur')->count();
        $totalCollecte  = Don::where('statut', 'confirme')
                            ->where('type', 'financier')
                            ->sum('montant');

        return view('welcome', compact(
            'campagnes',
            'totalCampagnes',
            'totalDonateurs',
            'totalCollecte'
        ));
    }
}