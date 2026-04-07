<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CodePromo;

class CodePromoController extends Controller
{
    // Liste de tous les codes promo
    public function index()
    {
        $codesPromo = CodePromo::withCount('reservations')
                      ->latest()
                      ->paginate(10);

        return view('admin.codes-promo.index', compact('codesPromo'));
    }

    // Formulaire de création
    public function create()
    {
        return view('admin.codes-promo.create');
    }

    // Enregistrer un nouveau code promo
    public function store(Request $request)
    {
        $request->validate([
            'code' => 'required|string|max:50|unique:code_promos,code',
            'type_reduction' => 'required|in:pourcentage,montant_fixe',
            'valeur' => 'required|numeric|min:1',
            'date_debut' => 'required|date|after_or_equal:today',
            'date_fin' => 'required|date|after:date_debut',
            'usage_max' => 'required|integer|min:1',
        ]);

        // Si pourcentage, la valeur ne peut pas dépasser 100
        if ($request->type_reduction === 'pourcentage' && $request->valeur > 100) {
            return back()->withErrors(['valeur' => 'Le pourcentage ne peut pas dépasser 100%.'])
                   ->withInput();
        }

        CodePromo::create([
            'code' => strtoupper($request->code),
            'type_reduction' => $request->type_reduction,
            'valeur' => $request->valeur,
            'date_debut' => $request->date_debut,
            'date_fin' => $request->date_fin,
            'usage_max' => $request->usage_max,
            'usage_actuel' => 0,
            'statut' => 'actif',
        ]);

        return redirect()->route('admin.codes-promo.index')
               ->with('success', 'Code promo créé avec succès !');
    }

    // Modifier un code promo
    public function edit(CodePromo $codes_promo)
    {
        return view('admin.codes-promo.edit', compact('codes_promo'));
    }

    // Mettre à jour un code promo
    public function update(Request $request, CodePromo $codes_promo)
    {
        $request->validate([
            'code' => 'required|string|max:50|unique:code_promos,code,' . $codes_promo->id,
            'type_reduction' => 'required|in:pourcentage,montant_fixe',
            'valeur' => 'required|numeric|min:1',
            'date_debut' => 'required|date',
            'date_fin' => 'required|date|after:date_debut',
            'usage_max' => 'required|integer|min:1',
            'statut' => 'required|in:actif,inactif,expire',
        ]);

        if ($request->type_reduction === 'pourcentage' && $request->valeur > 100) {
            return back()->withErrors(['valeur' => 'Le pourcentage ne peut pas dépasser 100%.'])
                   ->withInput();
        }

        $codes_promo->update([
            'code' => strtoupper($request->code),
            'type_reduction' => $request->type_reduction,
            'valeur' => $request->valeur,
            'date_debut' => $request->date_debut,
            'date_fin' => $request->date_fin,
            'usage_max' => $request->usage_max,
            'statut' => $request->statut,
        ]);

        return redirect()->route('admin.codes-promo.index')
               ->with('success', 'Code promo mis à jour !');
    }

    // Supprimer un code promo
    public function destroy(CodePromo $codes_promo)
    {
        $codes_promo->delete();

        return redirect()->route('admin.codes-promo.index')
               ->with('success', 'Code promo supprimé !');
    }
}