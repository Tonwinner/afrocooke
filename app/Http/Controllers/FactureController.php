<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Facture;
use Barryvdh\DomPDF\Facade\Pdf;

class FactureController extends Controller
{
    /**
     * Générer et télécharger la facture en PDF.
     * Le PDF est créé à la volée à partir d'une vue Blade.
     * Le navigateur télécharge automatiquement le fichier.
     */
    public function telecharger(Facture $facture)
    {
        // Vérifier que la facture appartient au client connecté
        if ($facture->reservation->user_id !== auth()->id()) {
            abort(403, 'Accès non autorisé.');
        }

        // Charger les relations nécessaires
        $facture->load('reservation.creneau.atelier', 'reservation.user', 'reservation.creneau.chef');

        // Générer le PDF depuis la vue Blade
        $pdf = Pdf::loadView('factures.pdf', compact('facture'));

        // Télécharger automatiquement le fichier
        return $pdf->download('facture-' . $facture->numero_facture . '.pdf');
    }
}