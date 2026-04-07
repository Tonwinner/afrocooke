<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Atelier;
use Illuminate\Support\Str;

class AtelierController extends Controller
{
    // Liste de tous les ateliers
    public function index()
    {
        $ateliers = Atelier::withCount('creneaux', 'avis')
                    ->latest()
                    ->paginate(10);

        return view('admin.ateliers.index', compact('ateliers'));
    }

    // Formulaire de création
    public function create()
    {
        return view('admin.ateliers.create');
    }

    // Enregistrer un nouvel atelier
    public function store(Request $request)
    {
        $request->validate([
            'titre' => 'required|string|max:255',
            'description' => 'required|string|min:20',
            'plat' => 'required|string|max:255',
            'origine_pays' => 'required|string|max:255',
            'prix' => 'required|numeric|min:0',
            'duree_minutes' => 'required|integer|min:30',
            'max_participants' => 'required|integer|min:2|max:20',
            'photo' => 'nullable|image|max:2048',
            'statut' => 'required|in:actif,inactif',
        ]);

        $data = $request->except('photo');
        $data['slug'] = Str::slug($request->titre);

        // Vérifier que le slug est unique
        $slugBase = $data['slug'];
        $compteur = 1;
        while (Atelier::where('slug', $data['slug'])->exists()) {
            $data['slug'] = $slugBase . '-' . $compteur;
            $compteur++;
        }

        // Upload photo si fournie
        if ($request->hasFile('photo')) {
            $data['photo'] = $request->file('photo')->store('photos/ateliers', 'public');
        }

        Atelier::create($data);

        return redirect()->route('admin.ateliers.index')
               ->with('success', 'Atelier créé avec succès !');
    }

    // Afficher un atelier
    public function show(Atelier $atelier)
    {
        $atelier->load('creneaux.chef', 'avis.user');

        return view('admin.ateliers.show', compact('atelier'));
    }

    // Formulaire de modification
    public function edit(Atelier $atelier)
    {
        return view('admin.ateliers.edit', compact('atelier'));
    }

    // Mettre à jour un atelier
    public function update(Request $request, Atelier $atelier)
    {
        $request->validate([
            'titre' => 'required|string|max:255',
            'description' => 'required|string|min:20',
            'plat' => 'required|string|max:255',
            'origine_pays' => 'required|string|max:255',
            'prix' => 'required|numeric|min:0',
            'duree_minutes' => 'required|integer|min:30',
            'max_participants' => 'required|integer|min:2|max:20',
            'photo' => 'nullable|image|max:2048',
            'statut' => 'required|in:actif,inactif,complet',
        ]);

        $data = $request->except('photo');

        // Mettre à jour le slug si le titre change
        if ($request->titre !== $atelier->titre) {
            $data['slug'] = Str::slug($request->titre);
            $slugBase = $data['slug'];
            $compteur = 1;
            while (Atelier::where('slug', $data['slug'])->where('id', '!=', $atelier->id)->exists()) {
                $data['slug'] = $slugBase . '-' . $compteur;
                $compteur++;
            }
        }

        // Upload nouvelle photo si fournie
        if ($request->hasFile('photo')) {
            $data['photo'] = $request->file('photo')->store('photos/ateliers', 'public');
        }

        $atelier->update($data);

        return redirect()->route('admin.ateliers.index')
               ->with('success', 'Atelier mis à jour avec succès !');
    }

    // Supprimer un atelier
    public function destroy(Atelier $atelier)
    {
        $atelier->delete();

        return redirect()->route('admin.ateliers.index')
               ->with('success', 'Atelier supprimé avec succès !');
    }
}
