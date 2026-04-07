@extends('layouts.admin')
@section('page-title', 'Gestion des Réservations')

@section('content')

    {{-- Filtres --}}
    <div class="bg-white rounded-xl border border-beige-200/60 p-5 mb-5">
        <form action="{{ route('admin.reservations.index') }}" method="GET" class="flex flex-wrap items-end gap-4">
            <div class="flex-1 min-w-[140px]">
                <label class="block text-[12px] font-semibold text-dark-50 mb-1.5">Statut</label>
                <select name="statut"
                    class="w-full px-3 py-2.5 rounded-lg border border-beige-300 bg-white text-sm text-dark focus:outline-none focus:border-brand-500 focus:ring-2 focus:ring-brand-500/10 transition duration-200">
                    <option value="">Tous</option>
                    <option value="en_attente" {{ request('statut') == 'en_attente' ? 'selected' : '' }}>En attente</option>
                    <option value="confirmee" {{ request('statut') == 'confirmee' ? 'selected' : '' }}>Confirmée</option>
                    <option value="terminee" {{ request('statut') == 'terminee' ? 'selected' : '' }}>Terminée</option>
                    <option value="annulee" {{ request('statut') == 'annulee' ? 'selected' : '' }}>Annulée</option>
                </select>
            </div>
            <div class="flex-1 min-w-[140px]">
                <label class="block text-[12px] font-semibold text-dark-50 mb-1.5">Date début</label>
                <input type="text" name="date_debut" data-fp-date value="{{ request('date_debut') }}" placeholder="Sélectionner..." autocomplete="off"
                    class="w-full px-3 py-2.5 rounded-lg border border-beige-300 bg-white text-sm text-dark focus:outline-none focus:border-brand-500 focus:ring-2 focus:ring-brand-500/10 transition duration-200 cursor-pointer">
            </div>
            <div class="flex-1 min-w-[140px]">
                <label class="block text-[12px] font-semibold text-dark-50 mb-1.5">Date fin</label>
                <input type="text" name="date_fin" data-fp-date value="{{ request('date_fin') }}" placeholder="Sélectionner..." autocomplete="off"
                    class="w-full px-3 py-2.5 rounded-lg border border-beige-300 bg-white text-sm text-dark focus:outline-none focus:border-brand-500 focus:ring-2 focus:ring-brand-500/10 transition duration-200 cursor-pointer">
            </div>
            <div class="flex-1 min-w-[170px]">
                <label class="block text-[12px] font-semibold text-dark-50 mb-1.5">Rechercher</label>
                <input type="text" name="recherche" value="{{ request('recherche') }}" placeholder="Nom ou email..."
                    class="w-full px-3 py-2.5 rounded-lg border border-beige-300 bg-white text-sm text-dark placeholder:text-beige-400 focus:outline-none focus:border-brand-500 focus:ring-2 focus:ring-brand-500/10 transition duration-200">
            </div>
            <div class="flex gap-2">
                <button type="submit"
                    class="flex items-center gap-2 px-4 py-2.5 bg-brand-500 hover:bg-brand-600 text-white text-[13px] font-semibold rounded-lg transition-all duration-200">
                    <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polygon points="22 3 2 3 10 12.46 10 19 14 21 14 12.46 22 3"/></svg>
                    Filtrer
                </button>
                <a href="{{ route('admin.reservations.index') }}"
                   class="px-4 py-2.5 text-[13px] font-semibold text-beige-500 hover:text-dark rounded-lg border border-beige-300 hover:border-beige-400 transition-all duration-200">
                    Réinitialiser
                </a>
            </div>
        </form>
    </div>

    {{-- Tableau --}}
    <div class="bg-white rounded-xl border border-beige-200/60 overflow-hidden">
        <div class="flex items-center justify-between px-6 py-4 border-b border-beige-100">
            <div class="flex items-center gap-3">
                <div class="w-9 h-9 rounded-lg bg-brand-50 flex items-center justify-center">
                    <svg class="w-4 h-4 text-brand-500" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/>
                    </svg>
                </div>
                <div>
                    <h2 class="text-[15px] font-bold text-dark">Réservations</h2>
                    <p class="text-[11px] text-beige-400">{{ $reservations->total() }} résultat{{ $reservations->total() > 1 ? 's' : '' }}</p>
                </div>
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr>
                        <th class="px-5 py-3 text-left text-[10px] font-bold uppercase tracking-widest text-beige-400 bg-beige-50/50">ID</th>
                        <th class="px-5 py-3 text-left text-[10px] font-bold uppercase tracking-widest text-beige-400 bg-beige-50/50">Client</th>
                        <th class="px-5 py-3 text-left text-[10px] font-bold uppercase tracking-widest text-beige-400 bg-beige-50/50">Atelier</th>
                        <th class="px-5 py-3 text-left text-[10px] font-bold uppercase tracking-widest text-beige-400 bg-beige-50/50">Date</th>
                        <th class="px-5 py-3 text-center text-[10px] font-bold uppercase tracking-widest text-beige-400 bg-beige-50/50">Pers.</th>
                        <th class="px-5 py-3 text-left text-[10px] font-bold uppercase tracking-widest text-beige-400 bg-beige-50/50">Montant</th>
                        <th class="px-5 py-3 text-left text-[10px] font-bold uppercase tracking-widest text-beige-400 bg-beige-50/50">Paiement</th>
                        <th class="px-5 py-3 text-left text-[10px] font-bold uppercase tracking-widest text-beige-400 bg-beige-50/50">Statut</th>
                        <th class="px-5 py-3 text-right text-[10px] font-bold uppercase tracking-widest text-beige-400 bg-beige-50/50">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($reservations as $reservation)
                        <tr class="border-b border-beige-50 hover:bg-beige-50/40 transition-colors duration-100">
                            <td class="px-5 py-3 text-[12px] text-beige-400 font-mono">#{{ $reservation->id }}</td>
                            <td class="px-5 py-3">
                                <div class="flex items-center gap-2.5">
                                    <div class="w-7 h-7 rounded-md bg-brand-50 flex items-center justify-center flex-shrink-0">
                                        <span class="text-[10px] font-bold text-brand-600">{{ strtoupper(mb_substr($reservation->user->name, 0, 2)) }}</span>
                                    </div>
                                    <div class="min-w-0">
                                        <p class="text-[13px] font-semibold text-dark truncate">{{ $reservation->user->name }}</p>
                                        <p class="text-[11px] text-beige-400 truncate">{{ $reservation->user->email }}</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-5 py-3 text-[13px] text-dark-50">{{ $reservation->creneau->atelier->titre }}</td>
                            <td class="px-5 py-3 whitespace-nowrap">
                                <p class="text-[13px] text-dark-50">{{ \Carbon\Carbon::parse($reservation->creneau->date)->translatedFormat('d F Y') }}</p>
                                <p class="text-[11px] text-beige-400">{{ \Carbon\Carbon::parse($reservation->creneau->heure_debut)->format('H:i') }}</p>
                            </td>
                            <td class="px-5 py-3 text-center">
                                <span class="inline-flex items-center justify-center w-7 h-7 rounded-md text-[11px] font-bold bg-beige-100 text-dark-50">
                                    {{ $reservation->nombre_personnes }}
                                </span>
                            </td>
                            <td class="px-5 py-3 text-[13px] font-bold text-brand-600 whitespace-nowrap">
                                {{ number_format($reservation->montant_total, 0, ',', ' ') }} FCFA
                            </td>
                            {{-- Badge paiement --}}
                            <td class="px-5 py-3">
                                @if($reservation->paiement)
                                    @switch($reservation->paiement->statut)
                                        @case('reussi')
                                            <span class="inline-flex items-center gap-1.5 px-2 py-0.5 rounded-md text-[11px] font-semibold bg-emerald-50 text-emerald-700">
                                                <span class="w-1.5 h-1.5 rounded-full bg-emerald-400"></span>Payé
                                            </span>
                                            @break
                                        @case('en_attente')
                                            <span class="inline-flex items-center gap-1.5 px-2 py-0.5 rounded-md text-[11px] font-semibold bg-amber-50 text-amber-700">
                                                <span class="w-1.5 h-1.5 rounded-full bg-amber-400"></span>En attente
                                            </span>
                                            @break
                                        @case('echoue')
                                            <span class="inline-flex items-center gap-1.5 px-2 py-0.5 rounded-md text-[11px] font-semibold bg-red-50 text-red-700">
                                                <span class="w-1.5 h-1.5 rounded-full bg-red-400"></span>Échoué
                                            </span>
                                            @break
                                        @case('rembourse')
                                            <span class="inline-flex items-center gap-1.5 px-2 py-0.5 rounded-md text-[11px] font-semibold bg-blue-50 text-blue-700">
                                                <span class="w-1.5 h-1.5 rounded-full bg-blue-400"></span>Remboursé
                                            </span>
                                            @break
                                    @endswitch
                                @else
                                    <span class="inline-flex items-center gap-1.5 px-2 py-0.5 rounded-md text-[11px] font-semibold bg-gray-100 text-gray-500">
                                        <span class="w-1.5 h-1.5 rounded-full bg-gray-400"></span>Non payé
                                    </span>
                                @endif
                            </td>
                            {{-- Badge statut réservation --}}
                            <td class="px-5 py-3">
                                @switch($reservation->statut)
                                    @case('en_attente')
                                        <span class="inline-flex items-center gap-1.5 px-2 py-0.5 rounded-md text-[11px] font-semibold bg-amber-50 text-amber-700">
                                            <span class="w-1.5 h-1.5 rounded-full bg-amber-400"></span>En attente
                                        </span>
                                        @break
                                    @case('confirmee')
                                        <span class="inline-flex items-center gap-1.5 px-2 py-0.5 rounded-md text-[11px] font-semibold bg-emerald-50 text-emerald-700">
                                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-400"></span>Confirmée
                                        </span>
                                        @break
                                    @case('terminee')
                                        <span class="inline-flex items-center gap-1.5 px-2 py-0.5 rounded-md text-[11px] font-semibold bg-blue-50 text-blue-700">
                                            <span class="w-1.5 h-1.5 rounded-full bg-blue-400"></span>Terminée
                                        </span>
                                        @break
                                    @case('annulee')
                                        <span class="inline-flex items-center gap-1.5 px-2 py-0.5 rounded-md text-[11px] font-semibold bg-red-50 text-red-700">
                                            <span class="w-1.5 h-1.5 rounded-full bg-red-400"></span>Annulée
                                        </span>
                                        @break
                                @endswitch
                            </td>
                            {{-- Actions rapides par icônes --}}
                            <td class="px-5 py-3">
                                <div class="flex items-center justify-end gap-1">
                                    {{-- Confirmer --}}
                                    @if($reservation->statut !== 'confirmee')
                                        <form action="{{ route('admin.reservations.update', $reservation) }}" method="POST">
                                            @csrf @method('PUT')
                                            <input type="hidden" name="statut" value="confirmee">
                                            <button type="submit" title="Confirmer"
                                                class="w-7 h-7 rounded-md flex items-center justify-center text-emerald-400 hover:text-white hover:bg-emerald-500 transition-all duration-200">
                                                <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="20 6 9 17 4 12"/></svg>
                                            </button>
                                        </form>
                                    @endif
                                    {{-- Terminer --}}
                                    @if($reservation->statut === 'confirmee')
                                        <form action="{{ route('admin.reservations.update', $reservation) }}" method="POST">
                                            @csrf @method('PUT')
                                            <input type="hidden" name="statut" value="terminee">
                                            <button type="submit" title="Marquer terminée"
                                                class="w-7 h-7 rounded-md flex items-center justify-center text-blue-400 hover:text-white hover:bg-blue-500 transition-all duration-200">
                                                <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
                                            </button>
                                        </form>
                                    @endif
                                    {{-- Annuler --}}
                                    @if(!in_array($reservation->statut, ['annulee', 'terminee']))
                                        <form action="{{ route('admin.reservations.update', $reservation) }}" method="POST" data-confirm="Annuler cette réservation ?">
                                            @csrf @method('PUT')
                                            <input type="hidden" name="statut" value="annulee">
                                            <button type="submit" title="Annuler"
                                                class="w-7 h-7 rounded-md flex items-center justify-center text-red-400 hover:text-white hover:bg-red-500 transition-all duration-200">
                                                <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="15" y1="9" x2="9" y2="15"/><line x1="9" y1="9" x2="15" y2="15"/></svg>
                                            </button>
                                        </form>
                                    @endif
                                    {{-- Remettre en attente (si annulée) --}}
                                    @if($reservation->statut === 'annulee')
                                        <form action="{{ route('admin.reservations.update', $reservation) }}" method="POST">
                                            @csrf @method('PUT')
                                            <input type="hidden" name="statut" value="en_attente">
                                            <button type="submit" title="Remettre en attente"
                                                class="w-7 h-7 rounded-md flex items-center justify-center text-amber-400 hover:text-white hover:bg-amber-500 transition-all duration-200">
                                                <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="23 4 23 10 17 10"/><path d="M20.49 15a9 9 0 1 1-2.12-9.36L23 10"/></svg>
                                            </button>
                                        </form>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9" class="px-6 py-16 text-center">
                                <svg class="w-10 h-10 text-beige-200 mx-auto mb-3" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                                    <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/>
                                </svg>
                                <p class="text-sm text-beige-400">Aucune réservation trouvée</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($reservations->hasPages())
            <div class="px-6 py-4 border-t border-beige-100">
                {{ $reservations->links() }}
            </div>
        @endif
    </div>

    @push('scripts')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/themes/airbnb.css">
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script src="https://cdn.jsdelivr.net/npm/flatpickr/dist/l10n/fr.js"></script>
<script>
(function() {
    document.querySelectorAll('[data-fp-date]').forEach(function(el) {
        flatpickr(el, {
            locale: 'fr',
            dateFormat: 'Y-m-d',
            altInput: true,
            altFormat: 'j F Y',
            disableMobile: true,
            animate: true,
            prevArrow: '<svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="15 18 9 12 15 6"/></svg>',
            nextArrow: '<svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="9 18 15 12 9 6"/></svg>',
        });
    });
})();
</script>
@endpush

@endsection