<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MessageContact;
use Illuminate\Http\Request;

class MessageContactController extends Controller
{
    /**
     * Liste tous les messages de contact.
     * Triés du plus récent au plus ancien.
     * Les non-lus apparaissent en priorité.
     */
    public function index()
    {
        $messages = MessageContact::latest()->paginate(15);
        $nonLus = MessageContact::nonLus()->count();

        return view('admin.messages.index', compact('messages', 'nonLus'));
    }

    /**
     * Affiche un message et le marque comme lu.
     * Dès que l'admin ouvre un message, il passe en "lu".
     */
    public function show(MessageContact $message)
    {
        return view('admin.messages.show', compact('message'));
    }

    /**
     * Toggle lu/non-lu : permet à l'admin de remettre
     * un message en non-lu s'il veut le traiter plus tard.
     */
    public function toggleLu(MessageContact $message)
    {
        $message->update(['lu' => !$message->lu]);

        return redirect()->route('admin.messages.index')->with('success', $message->lu ? 'Message marqué comme lu.' : 'Message marqué comme non lu.');
    }

    /**
     * Supprimer un message définitivement.
     */
    public function destroy(MessageContact $message)
    {
        $message->delete();

        return back()->with('success', 'Message supprimé.');
    }
}