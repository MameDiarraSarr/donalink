<?php

namespace App\Http\Controllers;

use App\Models\Campagne;
use App\Models\Don;
use App\Models\Beneficiaire;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        // Statistiques globales
        $totalDonsFinanciers = Don::where('type', 'financier')
            ->where('statut', 'confirme')
            ->sum('montant');

        $totalDonsMateriel = Don::where('type', 'materiel')
            ->where('statut', 'confirme')
            ->count();

        $totalDonateurs = User::where('role', 'donateur')->count();

        $totalCampagnes = Campagne::where('statut', 'active')->count();

        $donsEnAttente = Don::where('statut', 'en_attente')
            ->with(['user', 'campagne'])
            ->latest()
            ->take(5)
            ->get();

        return view('admin.dashboard', compact(
            'totalDonsFinanciers',
            'totalDonsMateriel',
            'totalDonateurs',
            'totalCampagnes',
            'donsEnAttente'
        ));
    }
}