<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    // Liste de tous les utilisateurs
    public function index(Request $request)
    {
        $query = User::query();

        // Filtre par rôle
        if ($request->filled('role')) {
            $query->where('role', $request->role);
        }

        // Recherche par nom ou email
        if ($request->filled('recherche')) {
            $query->where(function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->recherche . '%')
                  ->orWhere('email', 'like', '%' . $request->recherche . '%');
            });
        }

        $utilisateurs = $query->latest()->paginate(15);

        return view('admin.utilisateurs.index', compact('utilisateurs'));
    }

    // Mettre à jour un utilisateur (changer le rôle)
    public function update(Request $request, User $utilisateur)
    {
        $request->validate([
            'role' => 'required|in:admin,chef,logistique,client',
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $utilisateur->id,
        ]);

        $utilisateur->update([
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
        ]);

        return redirect()->route('admin.utilisateurs.index')
               ->with('success', 'Utilisateur mis à jour avec succès !');
    }

    // Supprimer un utilisateur
    public function destroy(User $utilisateur)
    {
        // Empêcher la suppression de son propre compte
        if ($utilisateur->id === auth()->id()) {
            return back()->with('error', 'Vous ne pouvez pas supprimer votre propre compte.');
        }

        // Empêcher la suppression s'il a des réservations
        if ($utilisateur->reservations()->count() > 0) {
            return back()->with('error', 'Impossible de supprimer cet utilisateur car il a des réservations.');
        }

        $utilisateur->delete();

        return redirect()->route('admin.utilisateurs.index')
               ->with('success', 'Utilisateur supprimé avec succès !');
    }
}
