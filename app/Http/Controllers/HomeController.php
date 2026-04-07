<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Atelier;
use App\Models\Avis;

class HomeController extends Controller
{
    public function index()
    {
        // 12 ateliers actifs les plus récents pour la page d'accueil
        $ateliers = Atelier::where('statut', 'actif')
                    ->latest()
                    ->take(12)
                    ->get();

        // Récupérer les 6 derniers avis visibles pour les témoignages
        $avis = Avis::where('est_visible', true)
                ->with('user', 'atelier')
                ->latest()
                ->take(6)
                ->get();

        return view('home', compact('ateliers', 'avis'));
    }
}