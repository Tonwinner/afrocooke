<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Newsletter;

class NewsletterController extends Controller
{
    // Inscrire un email à la newsletter
    public function subscribe(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);

        // Vérifier si l'email existe déjà
        $existe = Newsletter::where('email', $request->email)->first();

        if ($existe) {
            if ($existe->est_actif) {
                return back()->with('info', 'Vous êtes déjà inscrit à notre newsletter.');
            }

            // Réactiver si l'email était désactivé
            $existe->update(['est_actif' => true]);
            return back()->with('success', 'Votre inscription a été réactivée !');
        }

        // Créer une nouvelle inscription
        Newsletter::create([
            'email' => $request->email,
            'est_actif' => true,
        ]);

        return back()->with('success', 'Merci pour votre inscription à la newsletter !');
    }
}
