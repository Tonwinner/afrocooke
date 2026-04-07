<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Atelier;
use App\Models\Avis;

class CatalogueController extends Controller
{
    public function index(Request $request)
    {
        $query = Atelier::where('statut', 'actif');
        
        if ($request->filled('pays')) {
            $query->where('origine_pays', $request->pays);
        }
        if ($request->filled('plat')) {
            $query->where('plat', 'like', '%' . $request->plat . '%');
        }
        if ($request->filled('prix_max')) {
            $query->where('prix', '<=', $request->prix_max);
        }

        $pays = Atelier::where('statut', 'actif')->distinct()->pluck('origine_pays');
        $ateliers = $query->latest()->paginate(12);

        // Récupérer les 4 derniers avis visibles pour la bande défilante
        $avisClients = Avis::where('est_visible', true)
            ->with('user', 'atelier')
            ->latest()
            ->take(4)
            ->get();

        return view('ateliers.index', compact('ateliers', 'pays', 'avisClients'));
    }

    public function show(string $slug)
    {
        $atelier = Atelier::where('slug', $slug)->firstOrFail();

        $creneaux = $atelier->creneaux()
            ->where('statut', 'disponible')
            ->where('date', '>=', now()->format('Y-m-d'))
            ->with('chef')
            ->orderBy('date')
            ->get();

        $avis = $atelier->avis()
            ->where('est_visible', true)
            ->with('user')
            ->latest()
            ->get();

        $noteMoyenne = $atelier->noteMoyenne();

        return view('ateliers.show', compact('atelier', 'creneaux', 'avis', 'noteMoyenne'));
    }
}