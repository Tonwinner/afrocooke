<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Creneau;
use App\Models\Atelier;
use App\Models\User;

class CreneauController extends Controller
{
    // Liste de tous les créneaux
    public function index(Request $request)
    {
        $query = Creneau::with('atelier', 'chef')
                 ->withCount('reservations');

        // Filtre par atelier
        if ($request->filled('atelier_id')) {
            $query->where('atelier_id', $request->atelier_id);
        }

        // Filtre par statut
        if ($request->filled('statut')) {
            $query->where('statut', $request->statut);
        }

        $creneaux = $query->orderBy('date', 'desc')->paginate(10);

        // Données pour les filtres et le formulaire
        $ateliers = Atelier::where('statut', 'actif')->get();
        $chefs = User::where('role', 'chef')->get();

        return view('admin.creneaux.index', compact('creneaux', 'ateliers', 'chefs'));
    }

    // Enregistrer un nouveau créneau
    public function store(Request $request)
    {
        $request->validate([
            'atelier_id' => 'required|exists:ateliers,id',
            'chef_id' => 'nullable|exists:users,id',
            'date' => 'required|date|after_or_equal:today',
            'heure_debut' => 'required',
            'heure_fin' => 'required|after:heure_debut',
        ]);

        // Récupérer le max_participants de l'atelier
        $atelier = Atelier::findOrFail($request->atelier_id);

        Creneau::create([
            'atelier_id' => $request->atelier_id,
            'chef_id' => $request->chef_id,
            'date' => $request->date,
            'heure_debut' => $request->heure_debut,
            'heure_fin' => $request->heure_fin,
            'places_restantes' => $atelier->max_participants,
            'statut' => 'disponible',
        ]);

        return redirect()->route('admin.creneaux.index')
               ->with('success', 'Créneau créé avec succès !');
    }

    // Mettre à jour un créneau
    public function update(Request $request, Creneau $creneaux)
    {
        $request->validate([
            'chef_id' => 'nullable|exists:users,id',
            'date' => 'required|date',
            'heure_debut' => 'required',
            'heure_fin' => 'required|after:heure_debut',
            'statut' => 'required|in:disponible,complet,annule',
        ]);

        $creneaux->update([
            'chef_id' => $request->chef_id,
            'date' => $request->date,
            'heure_debut' => $request->heure_debut,
            'heure_fin' => $request->heure_fin,
            'statut' => $request->statut,
        ]);

        return redirect()->route('admin.creneaux.index')
               ->with('success', 'Créneau mis à jour avec succès !');
    }

    // Supprimer un créneau
    public function destroy(Creneau $creneaux)
    {
        // Vérifier s'il y a des réservations liées
        if ($creneaux->reservations()->count() > 0) {
            return back()->with('error', 'Impossible de supprimer ce créneau car il a des réservations.');
        }

        $creneaux->delete();

        return redirect()->route('admin.creneaux.index')
               ->with('success', 'Créneau supprimé avec succès !');
    }
}