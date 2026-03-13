<?php

namespace App\Http\Controllers;

use App\Models\Beneficiaire;
use Illuminate\Http\Request;

class BeneficiaireController extends Controller
{
    // Liste des bénéficiaires
    public function index()
    {
        $beneficiaires = Beneficiaire::latest()->get();
        return view('beneficiaires.index', compact('beneficiaires'));
    }

    // Formulaire de création
    public function create()
    {
        return view('beneficiaires.create');
    }

    // Sauvegarder un bénéficiaire
    public function store(Request $request)
    {
        $request->validate([
            'nom'       => 'required|string|max:255',
            'prenom'    => 'required|string|max:255',
            'telephone' => 'nullable|string|max:20',
            'adresse'   => 'nullable|string|max:255',
            'besoins'   => 'nullable|string',
        ]);

        Beneficiaire::create($request->all());

        return redirect()->route('beneficiaires.index')
            ->with('success', 'Bénéficiaire ajouté avec succès !');
    }

    // Voir un bénéficiaire
    public function show(Beneficiaire $beneficiaire)
    {
        $distributions = $beneficiaire->distributions()->with('don')->latest()->get();
        return view('beneficiaires.show', compact('beneficiaire', 'distributions'));
    }

    // Formulaire de modification
    public function edit(Beneficiaire $beneficiaire)
    {
        return view('beneficiaires.edit', compact('beneficiaire'));
    }

    // Mettre à jour un bénéficiaire
    public function update(Request $request, Beneficiaire $beneficiaire)
    {
        $request->validate([
            'nom'       => 'required|string|max:255',
            'prenom'    => 'required|string|max:255',
            'telephone' => 'nullable|string|max:20',
            'adresse'   => 'nullable|string|max:255',
            'besoins'   => 'nullable|string',
        ]);

        $beneficiaire->update($request->all());

        return redirect()->route('beneficiaires.index')
            ->with('success', 'Bénéficiaire modifié avec succès !');
    }

    // Supprimer un bénéficiaire
    public function destroy(Beneficiaire $beneficiaire)
    {
        $beneficiaire->delete();
        return redirect()->route('beneficiaires.index')
            ->with('success', 'Bénéficiaire supprimé avec succès !');
    }
}