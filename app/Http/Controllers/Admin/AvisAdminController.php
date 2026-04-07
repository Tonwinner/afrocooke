<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Avis;

class AvisAdminController extends Controller
{
    // Liste de tous les avis
    public function index(Request $request)
    {
        $query = Avis::with('user', 'atelier');

        // Filtre par visibilité
        if ($request->filled('visibilite')) {
            if ($request->visibilite === 'visible') {
                $query->where('est_visible', true);
            } else {
                $query->where('est_visible', false);
            }
        }

        // Filtre par note
        if ($request->filled('note')) {
            $query->where('note', $request->note);
        }

        $avis = $query->latest()->paginate(15);

        return view('admin.avis.index', compact('avis'));
    }

    // Masquer ou afficher un avis
    public function toggleVisibilite(Avis $avi)
    {
        $avi->update([
            'est_visible' => !$avi->est_visible,
        ]);

        $message = $avi->est_visible
                   ? 'Avis rendu visible.'
                   : 'Avis masqué.';

        return redirect()->route('admin.avis.index')
               ->with('success', $message);
    }
}
