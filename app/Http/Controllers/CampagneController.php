<?php

namespace App\Http\Controllers;

use App\Models\Campagne;
use Illuminate\Http\Request;

class CampagneController extends Controller
{
    public function index()
    {
        $campagnes = Campagne::latest()->get();
        return view('campagnes.index', compact('campagnes'));
    }

    public function create()
    {
        return view('campagnes.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'titre'            => 'required|string|max:255',
            'description'      => 'required|string',
            'type'             => 'required|in:financiere,materielle',
            'objectif_montant' => 'nullable|string',
            'date_fin'         => 'nullable|date',
            'image'            => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $data = $request->all();

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('campagnes', 'public');
        }

        Campagne::create($data);

        return redirect()->route('campagnes.index')
            ->with('success', 'Campagne créée avec succès !');
    }

    public function show(Campagne $campagne)
    {
        $dons = $campagne->dons()->with('user')->latest()->get();
        return view('campagnes.show', compact('campagne', 'dons'));
    }

    public function edit(Campagne $campagne)
    {
        return view('campagnes.edit', compact('campagne'));
    }

    public function update(Request $request, Campagne $campagne)
    {
        $request->validate([
            'titre'            => 'required|string|max:255',
            'description'      => 'required|string',
            'type'             => 'required|in:financiere,materielle',
            'objectif_montant' => 'nullable|string',
            'date_fin'         => 'nullable|date',
            'image'            => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $data = $request->all();

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('campagnes', 'public');
        }

        $campagne->update($data);

        return redirect()->route('campagnes.index')
            ->with('success', 'Campagne modifiée avec succès !');
    }

    public function destroy(Campagne $campagne)
    {
        $campagne->delete();
        return redirect()->route('campagnes.index')
            ->with('success', 'Campagne supprimée avec succès !');
    }
}