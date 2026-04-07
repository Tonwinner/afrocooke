<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Newsletter;

class NewsletterAdminController extends Controller
{
    // Liste des abonnés
    public function index()
    {
        $abonnes = Newsletter::where('est_actif', true)
                   ->latest()
                   ->paginate(20);

        $totalAbonnes = Newsletter::where('est_actif', true)->count();
        $totalDesinscrits = Newsletter::where('est_actif', false)->count();

        return view('admin.newsletter.index', compact('abonnes', 'totalAbonnes', 'totalDesinscrits'));
    }

    // Envoyer une newsletter (préparation)
    public function envoyer(Request $request)
    {
        $request->validate([
            'sujet' => 'required|string|max:255',
            'contenu' => 'required|string|min:20',
        ]);

        // Pour l'instant on simule l'envoi
        // Plus tard on utilisera Laravel Mail avec une file d'attente
        $totalDestinataires = Newsletter::where('est_actif', true)->count();

        return redirect()->route('admin.newsletter.index')
               ->with('success', 'Newsletter envoyée à ' . $totalDestinataires . ' abonnés !');
    }
}
