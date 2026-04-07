<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Reservation;
use App\Models\User;
use App\Models\Atelier;
use App\Models\Paiement;
use App\Models\Creneau;

class DashboardController extends Controller
{
    public function index()
    {
        // Compteurs généraux
        $totalReservations = Reservation::count();
        $reservationsMois = Reservation::whereMonth('created_at', now()->month)
                            ->whereYear('created_at', now()->year)
                            ->count();

        $totalClients = User::where('role', 'client')->count();
        $totalAteliers = Atelier::where('statut', 'actif')->count();

        // Revenus
        $revenuTotal = Paiement::where('statut', 'reussi')->sum('montant');
        $revenuMois = Paiement::where('statut', 'reussi')
                      ->whereMonth('created_at', now()->month)
                      ->whereYear('created_at', now()->year)
                      ->sum('montant');

        // Taux d'occupation (créneaux complets / total créneaux)
        $totalCreneaux = Creneau::count();
        $creneauxComplets = Creneau::where('statut', 'complet')->count();
        $tauxOccupation = $totalCreneaux > 0
                          ? round(($creneauxComplets / $totalCreneaux) * 100, 1)
                          : 0;

        // 5 dernières réservations
        $dernieresReservations = Reservation::with('user', 'creneau.atelier')
                                 ->latest()
                                 ->take(5)
                                 ->get();

        // Revenus des 6 derniers mois pour le graphique
        $revenusMensuels = [];
        for ($i = 5; $i >= 0; $i--) {
            $date = now()->subMonths($i);
            $revenusMensuels[] = [
                'mois' => $date->translatedFormat('M Y'),
                'montant' => Paiement::where('statut', 'reussi')
                            ->whereMonth('created_at', $date->month)
                            ->whereYear('created_at', $date->year)
                            ->sum('montant'),
            ];
        }

        return view('admin.dashboard', compact(
            'totalReservations',
            'reservationsMois',
            'totalClients',
            'totalAteliers',
            'revenuTotal',
            'revenuMois',
            'tauxOccupation',
            'dernieresReservations',
            'revenusMensuels'
        ));
    }
}