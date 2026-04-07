<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Avis;
use App\Models\Reservation;

class AvisController extends Controller
{
    // Enregistrer un avis
    public function store(Request $request)
    {
        $request->validate([
            'reservation_id' => 'required|exists:reservations,id',
            'note' => 'required|integer|min:1|max:5',
            'commentaire' => 'required|string|min:10|max:1000',
        ]);

        // Récupérer la réservation
        $reservation = Reservation::with('creneau')->findOrFail($request->reservation_id);

        // Vérifier que la réservation appartient au client connecté
        if ($reservation->user_id !== auth()->id()) {
            abort(403, 'Accès non autorisé.');
        }

        // Vérifier que la réservation est terminée
        if ($reservation->statut !== 'terminee') {
            return back()->with('error', 'Vous ne pouvez laisser un avis que pour un atelier terminé.');
        }

        // Vérifier que le client n'a pas déjà laissé un avis pour cet atelier
        $dejaNote = Avis::where('user_id', auth()->id())
                    ->where('atelier_id', $reservation->creneau->atelier_id)
                    ->exists();

        if ($dejaNote) {
            return back()->with('error', 'Vous avez déjà laissé un avis pour cet atelier.');
        }

        // Créer l'avis
        Avis::create([
            'user_id' => auth()->id(),
            'atelier_id' => $reservation->creneau->atelier_id,
            'note' => $request->note,
            'commentaire' => $request->commentaire,
            'est_visible' => true,
        ]);

        return back()->with('success', 'Merci pour votre avis !');
    }
}