<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class CompteController extends Controller
{
    // Page profil du client
    public function index()
    {
        $user = auth()->user();
        return view('compte.index', compact('user'));
    }

    // Mettre à jour le profil
    public function update(Request $request)
    {
        $user = auth()->user();

        $rules = [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'telephone' => 'nullable|string|max:30',
            'adresse' => 'nullable|string|max:255',
            'photo' => 'nullable|image|max:2048',
        ];

        // Ajouter la validation du mot de passe seulement si rempli
        if ($request->filled('password')) {
            $rules['password'] = 'required|string|min:8|confirmed';
        }

        $request->validate($rules);

        $user->name = $request->name;
        $user->email = $request->email;
        $user->telephone = $request->telephone;
        $user->adresse = $request->adresse;

        // Upload nouvelle photo
        if ($request->hasFile('photo')) {
            // Supprimer l'ancienne photo si elle existe
            if ($user->photo && Storage::disk('public')->exists($user->photo)) {
                Storage::disk('public')->delete($user->photo);
            }
            $path = $request->file('photo')->store('photos/users', 'public');
            $user->photo = $path;
        }

        if ($request->filled('password')) {
            $user->password = $request->password;
        }

        $user->save();

        return back()->with('success', 'Profil mis à jour avec succès !');
    }

    // Supprimer la photo de profil
    public function supprimerPhoto()
    {
        $user = auth()->user();

        if ($user->photo && Storage::disk('public')->exists($user->photo)) {
            Storage::disk('public')->delete($user->photo);
        }

        $user->photo = null;
        $user->save();

        return back()->with('success', 'Photo de profil supprimée.');
    }

    // Page mes réservations
    public function reservations()
    {
        $reservations = auth()->user()->reservations()
            ->with('creneau.atelier', 'creneau.chef', 'paiement', 'facture')
            ->latest()
            ->paginate(10);

        return view('compte.reservations', compact('reservations'));
    }

    // Supprimer une réservation échouée/annulée
    public function supprimerReservation($id)
    {
        $reservation = auth()->user()->reservations()->findOrFail($id);

        // Seules les réservations annulées ou en attente peuvent être supprimées
        if (!in_array($reservation->statut, ['annulee', 'en_attente'])) {
            return back()->with('error', 'Seules les réservations annulées ou en attente peuvent être supprimées.');
        }

        $reservation->delete();

        return back()->with('success', 'Réservation supprimée de votre historique.');
    }

    // Page mes factures
    public function factures()
    {
        $factures = auth()->user()->reservations()
            ->has('facture')
            ->with('facture', 'creneau.atelier')
            ->latest()
            ->paginate(10);

        return view('compte.factures', compact('factures'));
    }
}