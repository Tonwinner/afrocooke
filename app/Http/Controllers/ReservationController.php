<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Creneau;
use App\Models\Reservation;
use App\Models\CodePromo;

class ReservationController extends Controller
{
    // Afficher le formulaire de réservation
    public function create(Creneau $creneau)
    {
        // Vérifier que le créneau est encore disponible
        if (!$creneau->estDisponible()) {
            return redirect()->back()->with('error', 'Ce créneau n\'est plus disponible.');
        }

        // Charger l'atelier lié au créneau
        $creneau->load('atelier', 'chef');

        return view('reservation.create', compact('creneau'));
    }

    // Enregistrer la réservation
    public function store(Request $request)
    {
        $request->validate([
            'creneau_id' => 'required|exists:creneaux,id',
            'nombre_personnes' => 'required|integer|in:2,4,6',
            'code_promo' => 'nullable|string',
            'notes' => 'nullable|string|max:500',
        ], [
            'nombre_personnes.in' => 'Le nombre de participants doit être 2, 4 ou 6.',
        ]);

        // Récupérer le créneau avec son atelier
        $creneau = Creneau::with('atelier')->findOrFail($request->creneau_id);

        // Vérifier la disponibilité
        if (!$creneau->estDisponible()) {
            return back()->with('error', 'Ce créneau n\'est plus disponible.');
        }

        // Vérifier qu'il reste assez de places (par paires)
        if ($creneau->places_restantes < $request->nombre_personnes) {
            return back()->with('error', 'Il ne reste que ' . $creneau->places_restantes . ' places pour ce créneau.');
        }

        // Calculer le montant total
        $montant = $creneau->atelier->prix * $request->nombre_personnes;

        // Appliquer le code promo si fourni
        $codePromoId = null;
        if ($request->filled('code_promo')) {
            $codePromo = CodePromo::where('code', $request->code_promo)->first();

            if ($codePromo && $codePromo->estValide()) {
                $reduction = $codePromo->calculerReduction($montant);
                $montant -= $reduction;
                $codePromoId = $codePromo->id;

                // Incrémenter le compteur d'utilisation
                $codePromo->increment('usage_actuel');
            } else {
                return back()->with('error', 'Le code promo est invalide ou expiré.');
            }
        }

        // Créer la réservation
        $reservation = Reservation::create([
            'user_id' => auth()->id(),
            'creneau_id' => $creneau->id,
            'code_promo_id' => $codePromoId,
            'nombre_personnes' => $request->nombre_personnes,
            'montant_total' => $montant,
            'statut' => 'en_attente',
            'notes' => $request->notes,
        ]);

        // Mettre à jour les places restantes
        $creneau->decrement('places_restantes', $request->nombre_personnes);

        // Recharger pour avoir la valeur à jour
        $creneau->refresh();

        // Si moins de 2 places restantes, marquer le créneau comme complet
        if ($creneau->places_restantes < 2) {
            $creneau->update(['statut' => 'complet', 'places_restantes' => 0]);
        }

        // Rediriger vers le paiement
        return redirect()->route('paiement.initier', $reservation);
    }
}