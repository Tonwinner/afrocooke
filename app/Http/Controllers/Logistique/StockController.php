<?php

namespace App\Http\Controllers\Logistique;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Ingredient;

class StockController extends Controller
{
    // Liste des stocks
    public function index()
    {
        $ingredients = Ingredient::withCount('ateliers')
                       ->orderBy('nom')
                       ->get();

        $stocksBas = $ingredients->filter(function ($ingredient) {
            return $ingredient->stockBas();
        });

        return view('logistique.stocks', compact('ingredients', 'stocksBas'));
    }

    // Mettre à jour le stock d'un ingrédient
    public function update(Request $request, Ingredient $ingredient)
    {
        $request->validate([
            'quantite_stock' => 'required|numeric|min:0',
        ]);

        $ingredient->update([
            'quantite_stock' => $request->quantite_stock,
        ]);

        return redirect()->route('logistique.stocks.index')
               ->with('success', 'Stock de "' . $ingredient->nom . '" mis à jour !');
    }
}
