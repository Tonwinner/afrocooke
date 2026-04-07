<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Reservation;

class ReservationAdminController extends Controller
{
    // Liste de toutes les réservations
    public function index(Request $request)
    {
        $query = Reservation::with('user', 'creneau.atelier', 'paiement');

        // Filtre par statut
        if ($request->filled('statut')) {
            $query->where('statut', $request->statut);
        }

        // Filtre par date
        if ($request->filled('date_debut')) {
            $query->whereDate('created_at', '>=', $request->date_debut);
        }

        if ($request->filled('date_fin')) {
            $query->whereDate('created_at', '<=', $request->date_fin);
        }

        // Recherche par nom du client
        if ($request->filled('recherche')) {
            $query->whereHas('user', function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->recherche . '%')
                  ->orWhere('email', 'like', '%' . $request->recherche . '%');
            });
        }

        $reservations = $query->latest()->paginate(15);

        return view('admin.reservations.index', compact('reservations'));
    }

    // Mettre à jour le statut d'une réservation
    public function update(Request $request, Reservation $reservation)
    {
        $request->validate([
            'statut' => 'required|in:en_attente,confirmee,annulee,terminee',
        ]);

        $ancienStatut = $reservation->statut;
        $nouveauStatut = $request->statut;

        // Si on annule une réservation, remettre les places
        if ($nouveauStatut === 'annulee' && $ancienStatut !== 'annulee') {
            $creneau = $reservation->creneau;
            $creneau->increment('places_restantes', $reservation->nombre_personnes);

            // Si le créneau était complet, le remettre disponible
            if ($creneau->statut === 'complet') {
                $creneau->update(['statut' => 'disponible']);
            }
        }

        $reservation->update(['statut' => $nouveauStatut]);

        return redirect()->route('admin.reservations.index')
               ->with('success', 'Statut de la réservation mis à jour !');
    }
}
