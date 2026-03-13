<?php

namespace App\Http\Controllers;

use App\Models\Distribution;
use App\Models\Don;
use App\Models\Beneficiaire;
use Illuminate\Http\Request;

class DistributionController extends Controller
{
    // Liste des distributions
    public function index()
    {
        $distributions = Distribution::with(['don', 'beneficiaire'])->latest()->get();
        return view('distributions.index', compact('distributions'));
    }

    // Formulaire de création
    public function create()
    {
        // Seulement les dons confirmés et pas encore distribués
        $dons = Don::where('statut', 'confirme')
            ->whereDoesntHave('distribution')
            ->with('campagne')
            ->get();
        $beneficiaires = Beneficiaire::all();
        return view('distributions.create', compact('dons', 'beneficiaires'));
    }

    // Sauvegarder une distribution
    public function store(Request $request)
    {
        $request->validate([
            'don_id'            => 'required|exists:dons,id',
            'beneficiaire_id'   => 'required|exists:beneficiaires,id',
            'date_distribution' => 'required|date',
            'notes'             => 'nullable|string',
        ]);

        Distribution::create($request->all());

        return redirect()->route('distributions.index')
            ->with('success', 'Distribution enregistrée avec succès !');
    }

    // Voir une distribution
    public function show(Distribution $distribution)
    {
        return view('distributions.show', compact('distribution'));
    }

    // Formulaire de modification
    public function edit(Distribution $distribution)
    {
        $dons = Don::where('statut', 'confirme')->with('campagne')->get();
        $beneficiaires = Beneficiaire::all();
        return view('distributions.edit', compact('distribution', 'dons', 'beneficiaires'));
    }

    // Mettre à jour
    public function update(Request $request, Distribution $distribution)
    {
        $request->validate([
            'don_id'            => 'required|exists:dons,id',
            'beneficiaire_id'   => 'required|exists:beneficiaires,id',
            'date_distribution' => 'required|date',
            'notes'             => 'nullable|string',
        ]);

        $distribution->update($request->all());

        return redirect()->route('distributions.index')
            ->with('success', 'Distribution modifiée avec succès !');
    }

    // Supprimer
    public function destroy(Distribution $distribution)
    {
        $distribution->delete();
        return redirect()->route('distributions.index')
            ->with('success', 'Distribution supprimée avec succès !');
    }
}