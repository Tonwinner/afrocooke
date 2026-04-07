<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MessageContact;

class PageController extends Controller
{
    // Page À propos
    public function aPropos()
    {
        return view('pages.a-propos');
    }

    // Page Contact (affichage du formulaire)
    public function contact()
    {
        return view('pages.contact');
    }

    /**
     * Envoi du formulaire de contact.
     * Valide les données, les stocke en base dans messages_contact,
     * puis redirige avec un message de succès.
     */
    public function envoyerContact(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'email' => 'required|email',
            'message' => 'required|string|min:10',
        ]);

        // Stocker le message en base de données
        MessageContact::create([
            'nom' => $request->nom,
            'email' => $request->email,
            'message' => $request->message,
        ]);

        return back()->with('success', 'Votre message a été envoyé avec succès ! Nous vous répondrons rapidement.');
    }

    // Page FAQ
    public function faq()
    {
        return view('pages.faq');
    }

    // Page Mentions légales
    public function mentionsLegales()
    {
        return view('pages.mentions-legales');
    }
}