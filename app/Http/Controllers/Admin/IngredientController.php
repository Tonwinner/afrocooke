<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Ingredient;

class IngredientController extends Controller
{
    // Liste de tous les ingrédients
    public function index(Request $request)
    {
        $query = Ingredient::withCount('ateliers');

        // Filtre : afficher uniquement les stocks bas
        if ($request->filled('stock_bas')) {
            $query->whereColumn('quantite_stock', '<=', 'seuil_alerte');
        }

        $ingredients = $query->orderBy('nom')->paginate(15);

        return view('admin.ingredients.index', compact('ingredients'));
    }

    // Enregistrer un nouvel ingrédient
    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'unite' => 'required|in:kg,g,litre,piece',
            'quantite_stock' => 'required|numeric|min:0',
            'seuil_alerte' => 'required|numeric|min:0',
        ]);

        Ingredient::create([
            'nom' => $request->nom,
            'unite' => $request->unite,
            'quantite_stock' => $request->quantite_stock,
            'seuil_alerte' => $request->seuil_alerte,
        ]);

        return redirect()->route('admin.ingredients.index')
               ->with('success', 'Ingrédient ajouté avec succès !');
    }

    // Mettre à jour un ingrédient
    public function update(Request $request, Ingredient $ingredient)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'unite' => 'required|in:kg,g,litre,piece',
            'quantite_stock' => 'required|numeric|min:0',
            'seuil_alerte' => 'required|numeric|min:0',
        ]);

        $ingredient->update([
            'nom' => $request->nom,
            'unite' => $request->unite,
            'quantite_stock' => $request->quantite_stock,
            'seuil_alerte' => $request->seuil_alerte,
        ]);

        return redirect()->route('admin.ingredients.index')
               ->with('success', 'Ingrédient mis à jour !');
    }

    // Supprimer un ingrédient
    public function destroy(Ingredient $ingredient)
    {
        $ingredient->delete();

        return redirect()->route('admin.ingredients.index')
               ->with('success', 'Ingrédient supprimé !');
    }
}
