<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use App\Models\Reservation;
use App\Models\Paiement;
use App\Models\Facture;

class PaiementController extends Controller
{
    /**
     * Afficher la page de paiement (checkout).
     * La réservation est résolue par UUID grâce à getRouteKeyName().
     */
    public function initier(Reservation $reservation)
    {
        // Vérifier que la réservation appartient au client connecté
        if ($reservation->user_id !== auth()->id()) {
            abort(403, 'Accès non autorisé.');
        }

        // Vérifier que la réservation est en attente de paiement
        if ($reservation->statut !== 'en_attente') {
            return redirect()->route('compte.reservations')
                   ->with('error', 'Cette réservation a déjà été traitée.');
        }

        // Charger les relations pour l'affichage
        $reservation->load('creneau.atelier', 'creneau.chef');

        return view('paiement.checkout', compact('reservation'));
    }

    /**
     * Traiter le retour après paiement KkiaPay.
     *
     * Flux complet :
     * 1. Le client paie via la fenêtre KkiaPay (côté JS)
     * 2. KkiaPay renvoie un transactionId au JS
     * 3. Le JS redirige ici avec reservation_id (UUID) + transaction_id
     * 4. On vérifie la transaction auprès de l'API KkiaPay
     * 5. Si confirmée → paiement + facture créés, réservation confirmée
     * 6. Si échouée → redirection vers page échec
     */
    public function succes(Request $request)
    {
        $reservationUuid = $request->query('reservation_id');
        $transactionId = $request->query('transaction_id');

        // Vérifier que les paramètres sont présents
        if (!$reservationUuid) {
            return redirect()->route('home')->with('error', 'Paramètres de paiement manquants.');
        }

        // Trouver la réservation par UUID
        $reservation = Reservation::where('uuid', $reservationUuid)->first();

        if (!$reservation) {
            return redirect()->route('home')->with('error', 'Réservation introuvable.');
        }

        // Vérifier que la réservation appartient au client connecté
        if ($reservation->user_id !== auth()->id()) {
            abort(403, 'Accès non autorisé.');
        }

        // Si déjà confirmée, afficher directement la page succès
        if ($reservation->statut === 'confirmee') {
            $reservation->load('creneau.atelier', 'paiement', 'facture');
            return view('paiement.succes', compact('reservation'));
        }

        // Vérifier la transaction KkiaPay
        $verified = false;

        if (config('kkiapay.sandbox')) {
            // En sandbox : accepter si on a un transactionId
            $verified = !empty($transactionId);
            Log::info('KkiaPay Sandbox — Transaction acceptée: ' . $transactionId);
        } else {
            // En production : vérifier auprès de l'API KkiaPay
            $verified = $this->verifierTransaction($transactionId);
        }

        if ($verified) {
            // Créer le paiement (si pas déjà existant)
            if (!$reservation->paiement) {
                Paiement::create([
                    'reservation_id' => $reservation->id,
                    'montant' => $reservation->montant_total,
                    'methode' => 'kkiapay',
                    'transaction_id' => $transactionId,
                    'statut' => 'reussi',
                    'date_paiement' => now(),
                ]);
            }

            // Mettre à jour le statut de la réservation
            $reservation->update(['statut' => 'confirmee']);

            // Générer la facture (si pas déjà existante)
          if (!$reservation->facture) {
    // Vérifier une dernière fois si une facture n'a pas été créée entre-temps
           $existingFacture = Facture::where('reservation_id', $reservation->id)->first();
    
          if (!$existingFacture) {
        $numeroFacture = Facture::genererNumero();
        
        // Sécurité : vérifier que ce numéro n'existe pas déjà
        if (Facture::where('numero_facture', $numeroFacture)->exists()) {
            // En cas de conflit, générer avec timestamp (solution d'urgence)
            $numeroFacture = 'FAC-' . now()->format('Y') . '-' . now()->format('His');
        }
        
        Facture::create([
            'reservation_id' => $reservation->id,
            'numero_facture' => $numeroFacture,
            'montant_ht' => round($reservation->montant_total / 1.18, 2),
            'montant_ttc' => $reservation->montant_total,
        ]);
    }
}

            // Charger les relations pour l'affichage
            $reservation->load('creneau.atelier', 'paiement', 'facture');

            return view('paiement.succes', compact('reservation'));
        }

        // Échec : rediriger vers la page échec avec l'UUID
        return redirect()->route('paiement.echec', [
            'reservation_id' => $reservation->uuid,
        ]);
    }

    /**
     * Page d'échec de paiement.
     */
    public function echec(Request $request)
    {
        $reservationUuid = $request->query('reservation_id');

        if (!$reservationUuid) {
            return redirect()->route('home')->with('error', 'Paramètres manquants.');
        }

        // Trouver la réservation par UUID
        $reservation = Reservation::where('uuid', $reservationUuid)->first();

        if (!$reservation) {
            return redirect()->route('home')->with('error', 'Réservation introuvable.');
        }

        return view('paiement.echec', compact('reservation'));
    }

    /**
     * Vérifier une transaction KkiaPay via leur API.
     *
     * Endpoint : https://api.kkiapay.me/api/v1/transactions/status
     * Header : x-private-key (clé privée KkiaPay)
     * Body : { transactionId: "xxx" }
     *
     * Retourne true si le paiement est confirmé, false sinon.
     */
    private function verifierTransaction($transactionId)
    {
        if (empty($transactionId)) {
            return false;
        }

        try {
            $response = Http::withHeaders([
                'x-private-key' => config('kkiapay.private_key'),
            ])->post('https://api.kkiapay.me/api/v1/transactions/status', [
                'transactionId' => $transactionId,
            ]);

            if ($response->successful()) {
                $data = $response->json();
                Log::info('KkiaPay verification response: ', $data);
                return isset($data['status']) && strtoupper($data['status']) === 'SUCCESS';
            }

            Log::warning('KkiaPay verification failed with status: ' . $response->status());
            return false;
        } catch (\Exception $e) {
            Log::error('KkiaPay verification error: ' . $e->getMessage());
            return false;
        }
    }

    /**
     * Webhook KkiaPay (appelé par le serveur KkiaPay).
     * Reçoit les notifications de transaction automatiquement.
     */
    public function webhook(Request $request)
    {
        $payload = $request->all();
        Log::info('KkiaPay Webhook reçu: ', $payload);

        return response()->json(['status' => 'ok']);
    }
}