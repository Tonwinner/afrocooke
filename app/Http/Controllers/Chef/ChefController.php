<?php

namespace App\Http\Controllers\Chef;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Creneau;

class ChefController extends Controller
{
    // Planning du chef connecté
    public function planning()
    {
        $creneaux = Creneau::where('chef_id', auth()->id())
                    ->where('date', '>=', now()->format('Y-m-d'))
                    ->with('atelier')
                    ->withCount('reservations')
                    ->orderBy('date')
                    ->get();

        return view('chef.planning', compact('creneaux'));
    }

    // Détails des sessions passées
    public function sessions()
    {
        $sessions = Creneau::where('chef_id', auth()->id())
                    ->where('date', '<', now()->format('Y-m-d'))
                    ->with('atelier', 'reservations.user')
                    ->orderBy('date', 'desc')
                    ->paginate(10);

        return view('chef.sessions', compact('sessions'));
    }
}
