<?php

namespace App\Http\Controllers;

use App\Models\Don;
use App\Models\Campagne;
use Illuminate\Http\Request;

class DonController extends Controller
{
    // Liste de tous les dons (admin)
    public function index()
    {
        $dons = Don::with(['user', 'campagne'])->latest()->get();
        return view('dons.index', compact('dons'));
    }

    // Formulaire de don (donateur)
    public function create()
    {
        $campagnes = Campagne::where('statut', 'active')->get();
        return view('dons.create', compact('campagnes'));
    }

    // Sauvegarder un don (donateur)
    public function store(Request $request)
    {
        $request->validate([
            'campagne_id'          => 'required|exists:campagnes,id',
            'type'                 => 'required|in:financier,materiel',
            'montant'              => 'nullable|numeric|min:0',
            'description_materiel' => 'nullable|string',
            'quantite'             => 'nullable|integer|min:1',
            'mode_paiement'        => 'nullable|in:wave,orange_money,virement,especes',
            'anonyme'              => 'boolean',
        ]);

        Don::create([
            'user_id'              => auth()->id(),
            'campagne_id'          => $request->campagne_id,
            'type'                 => $request->type,
            'montant'              => $request->montant,
            'description_materiel' => $request->description_materiel,
            'quantite'             => $request->quantite,
            'mode_paiement'        => $request->mode_paiement,
            'anonyme'              => $request->has('anonyme'),
            'statut'               => 'en_attente',
        ]);

        return redirect()->route('dons.mes-dons')
            ->with('success', 'Votre don a été enregistré ! En attente de confirmation.');
    }

    // Voir un don
    public function show(Don $don)
    {
        return view('dons.show', compact('don'));
    }

    // Confirmer un don (admin)
    public function update(Request $request, Don $don)
    {
        $don->update(['statut' => 'confirme']);

        // Mettre à jour le montant collecté de la campagne
        if ($don->type == 'financier') {
            $don->campagne->increment('montant_collecte', $don->montant);
        }

        return redirect()->route('dons.index')
            ->with('success', 'Don confirmé avec succès !');
    }

    // Annuler un don (admin)
    public function destroy(Don $don)
    {
        $don->update(['statut' => 'annule']);
        return redirect()->route('dons.index')
            ->with('success', 'Don annulé.');
    }

    // Mes dons (donateur)
    public function mesDons()
    {
        $dons = Don::where('user_id', auth()->id())
            ->with('campagne')
            ->latest()
            ->get();
        return view('dons.mes-dons', compact('dons'));
    }
}