@extends('layouts.app')
@section('title', 'Mes Réservations — AfroCook Experience')

@section('content')

    {{-- Header --}}
    <section class="relative py-14 sm:py-16 text-center overflow-hidden">
        <div class="absolute inset-0">
            <img src="https://images.unsplash.com/photo-1556910103-1c02745aae4d?w=1200&q=80" alt="" class="w-full h-full object-cover">
            <div class="absolute inset-0 bg-dark/75"></div>
        </div>
        <div class="relative z-10 max-w-7xl mx-auto px-5 sm:px-8 lg:px-10">
            <h1 class="text-3xl sm:text-4xl font-extrabold text-white tracking-tight mb-3">Mes Réservations</h1>
            <p class="text-[15px] text-white/50 max-w-md mx-auto">Suivez l'historique de toutes vos réservations</p>
        </div>
    </section>

    <section class="bg-beige-50 py-10 sm:py-14">
        <div class="max-w-7xl mx-auto px-5 sm:px-8 lg:px-10">

            {{-- Navigation espace client --}}
            <div class="max-w-md mx-auto -mt-20 relative z-20 mb-10">
                <div class="bg-white rounded-xl p-1.5 border border-beige-200/60 shadow-lg shadow-dark/5 flex gap-1">
                    <a href="{{ route('compte.index') }}" class="flex-1 flex items-center justify-center gap-2 py-2.5 rounded-lg text-[13px] font-semibold text-beige-500 hover:bg-beige-50 transition-colors">
                        <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                        Profil
                    </a>
                    <a href="{{ route('compte.reservations') }}" class="flex-1 flex items-center justify-center gap-2 py-2.5 rounded-lg text-[13px] font-semibold bg-brand-500 text-white transition-colors">
                        <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><rect x="3" y="4" width="18" height="18" rx="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/></svg>
                        Réservations
                    </a>
                    <a href="{{ route('compte.factures') }}" class="flex-1 flex items-center justify-center gap-2 py-2.5 rounded-lg text-[13px] font-semibold text-beige-500 hover:bg-beige-50 transition-colors">
                        <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/></svg>
                        Factures
                    </a>
                </div>
            </div>

            {{-- Liste des réservations --}}
            @if($reservations->count() > 0)
                <div class="space-y-4">
                    @foreach($reservations as $reservation)
                        <div class="bg-white rounded-2xl border border-beige-200/60 p-5 sm:p-6 hover:shadow-lg hover:shadow-dark/5 transition-all duration-200">
                            <div class="flex flex-col sm:flex-row sm:items-center gap-4">
                                {{-- Infos --}}
                                <div class="flex-1 min-w-0">
                                    <h3 class="text-[16px] font-bold text-dark mb-2">{{ $reservation->creneau->atelier->titre }}</h3>
                                    <div class="flex flex-wrap gap-x-5 gap-y-1.5">
                                        <span class="flex items-center gap-1.5 text-[13px] text-beige-500">
                                            <svg class="w-3.5 h-3.5 text-brand-500" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><rect x="3" y="4" width="18" height="18" rx="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/></svg>
                                            {{ \Carbon\Carbon::parse($reservation->creneau->date)->translatedFormat('d F Y') }}
                                        </span>
                                        <span class="flex items-center gap-1.5 text-[13px] text-beige-500">
                                            <svg class="w-3.5 h-3.5 text-brand-500" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                                            {{ \Carbon\Carbon::parse($reservation->creneau->heure_debut)->format('H:i') }} — {{ \Carbon\Carbon::parse($reservation->creneau->heure_fin)->format('H:i') }}
                                        </span>
                                        <span class="flex items-center gap-1.5 text-[13px] text-beige-500">
                                            <svg class="w-3.5 h-3.5 text-brand-500" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/></svg>
                                            {{ $reservation->nombre_personnes }} pers.
                                        </span>
                                        <span class="flex items-center gap-1.5 text-[13px] font-semibold text-dark">
                                            {{ number_format($reservation->montant_total, 0, ',', ' ') }} FCFA
                                        </span>
                                    </div>
                                </div>

                                {{-- Statut --}}
                                <div class="flex items-center gap-3 flex-shrink-0">
                                    @switch($reservation->statut)
                                        @case('en_attente')
                                            <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg text-[12px] font-semibold bg-amber-50 text-amber-700">
                                                <span class="w-1.5 h-1.5 rounded-full bg-amber-400"></span>En attente
                                            </span>
                                            @break
                                        @case('confirmee')
                                            <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg text-[12px] font-semibold bg-emerald-50 text-emerald-700">
                                                <span class="w-1.5 h-1.5 rounded-full bg-emerald-400"></span>Confirmée
                                            </span>
                                            @break
                                        @case('terminee')
                                            <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg text-[12px] font-semibold bg-blue-50 text-blue-700">
                                                <span class="w-1.5 h-1.5 rounded-full bg-blue-400"></span>Terminée
                                            </span>
                                            @break
                                        @case('annulee')
                                            <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg text-[12px] font-semibold bg-red-50 text-red-700">
                                                <span class="w-1.5 h-1.5 rounded-full bg-red-400"></span>Annulée
                                            </span>
                                            @break
                                    @endswitch
                                </div>

                                {{-- Actions --}}
                                <div class="flex items-center gap-2 flex-shrink-0">
                                    @if($reservation->statut === 'en_attente')
                                        <a href="{{ route('paiement.initier', $reservation) }}"
                                           class="flex items-center gap-1.5 px-4 py-2 bg-brand-500 hover:bg-brand-600 text-white text-[12px] font-semibold rounded-lg transition-all duration-200">
                                            <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="1" y="4" width="22" height="16" rx="2"/><line x1="1" y1="10" x2="23" y2="10"/></svg>
                                            Payer
                                        </a>
                                    @endif
                                    @if($reservation->statut === 'terminee')
                                        <button type="button" data-modal="avis-{{ $reservation->id }}"
                                            class="open-avis flex items-center gap-1.5 px-4 py-2 bg-amber-500 hover:bg-amber-600 text-white text-[12px] font-semibold rounded-lg transition-all duration-200">
                                            <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
                                            Avis
                                        </button>
                                    @endif
                                    @if($reservation->facture)
                                        <a href="{{ route('facture.pdf', $reservation->facture) }}"
                                           class="flex items-center gap-1.5 px-4 py-2 text-[12px] font-semibold text-brand-600 bg-brand-50 hover:bg-brand-100 rounded-lg transition-colors duration-200">
                                            <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="12" y1="18" x2="12" y2="12"/><polyline points="9 15 12 18 15 15"/></svg>
                                            Facture
                                        </a>
                                    @endif
                                    {{-- Supprimer (réservations annulées ou en attente) --}}
                                    @if(in_array($reservation->statut, ['annulee', 'en_attente']))
                                        <form action="{{ route('compte.supprimer-reservation', $reservation->id) }}" method="POST" data-confirm="Supprimer cette réservation de votre historique ?">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="flex items-center gap-1.5 px-3 py-2 text-[12px] font-semibold text-red-500 hover:text-white hover:bg-red-500 border border-red-200 rounded-lg transition-all duration-200">
                                                <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="3 6 5 6 21 6"/><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/></svg>
                                                Supprimer
                                            </button>
                                        </form>
                                    @endif
                                </div>
                            </div>
                        </div>

                        {{-- Modale avis --}}
                        @if($reservation->statut === 'terminee')
                            <div id="avis-{{ $reservation->id }}" class="avis-modal fixed inset-0 z-50 hidden">
                                <div class="absolute inset-0 bg-dark/40 backdrop-blur-sm modal-overlay"></div>
                                <div class="absolute inset-0 flex items-center justify-center p-4">
                                    <div class="relative w-full max-w-md bg-white rounded-2xl p-6 sm:p-8 transform scale-95 opacity-0 transition-all duration-200 modal-content">
                                        {{-- Fermer --}}
                                        <button type="button" class="close-avis absolute top-4 right-4 w-8 h-8 rounded-lg text-beige-400 hover:text-dark hover:bg-beige-100 flex items-center justify-center transition-colors">
                                            <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
                                        </button>

                                        <div class="w-10 h-10 rounded-xl bg-amber-50 flex items-center justify-center mb-4">
                                            <svg class="w-5 h-5 text-amber-500" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
                                        </div>
                                        <h3 class="text-lg font-bold text-dark mb-1">Laisser un avis</h3>
                                        <p class="text-[13px] text-beige-400 mb-6">{{ $reservation->creneau->atelier->titre }}</p>

                                        <form action="{{ route('avis.store') }}" method="POST" class="space-y-4">
                                            @csrf
                                            <input type="hidden" name="reservation_id" value="{{ $reservation->id }}">
                                            <div>
                                                <label class="block text-sm font-medium text-dark-50 mb-1.5">Note</label>
                                                <select name="note" required
                                                    class="w-full px-4 py-3 rounded-xl border border-beige-200 bg-beige-50 text-[14px] text-dark focus:outline-none focus:border-brand-500 focus:ring-2 focus:ring-brand-500/10 focus:bg-white transition duration-200">
                                                    <option value="5">★★★★★ Excellent</option>
                                                    <option value="4">★★★★ Très bien</option>
                                                    <option value="3">★★★ Bien</option>
                                                    <option value="2">★★ Moyen</option>
                                                    <option value="1">★ Décevant</option>
                                                </select>
                                            </div>
                                            <div>
                                                <label class="block text-sm font-medium text-dark-50 mb-1.5">Votre commentaire</label>
                                                <textarea name="commentaire" rows="4" required placeholder="Partagez votre expérience..."
                                                    class="w-full px-4 py-3 rounded-xl border border-beige-200 bg-beige-50 text-[14px] text-dark placeholder:text-beige-400 focus:outline-none focus:border-brand-500 focus:ring-2 focus:ring-brand-500/10 focus:bg-white transition duration-200 resize-none"></textarea>
                                            </div>
                                            <button type="submit"
                                                class="w-full flex items-center justify-center gap-2 py-3.5 bg-brand-500 hover:bg-brand-600 text-white text-[14px] font-semibold rounded-xl transition-all duration-200">
                                                <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="22" y1="2" x2="11" y2="13"/><polygon points="22 2 15 22 11 13 2 9 22 2"/></svg>
                                                Envoyer mon avis
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>

                @if($reservations->hasPages())
                    <div class="mt-10 flex justify-center">{{ $reservations->links() }}</div>
                @endif
            @else
                {{-- État vide --}}
                <div class="text-center py-20">
                    <svg class="w-14 h-14 text-beige-200 mx-auto mb-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1">
                        <rect x="3" y="4" width="18" height="18" rx="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/>
                    </svg>
                    <h3 class="text-xl font-bold text-dark mb-2">Aucune réservation</h3>
                    <p class="text-[14px] text-beige-400 mb-6">Vous n'avez pas encore réservé d'atelier.</p>
                    <a href="{{ route('ateliers.index') }}" class="inline-flex items-center gap-2 px-6 py-3 bg-brand-500 hover:bg-brand-600 text-white text-[14px] font-semibold rounded-xl transition-all duration-200">
                        Découvrir nos ateliers
                        <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 12h14"/><polyline points="12 5 19 12 12 19"/></svg>
                    </a>
                </div>
            @endif
        </div>
    </section>

@endsection

@push('scripts')
<script>
(function() {
    /* Gestion des modales d'avis avec animation */
    var openBtns = document.querySelectorAll('.open-avis');
    var modals = document.querySelectorAll('.avis-modal');

    /* Ouvrir une modale */
    function openModal(id) {
        var modal = document.getElementById(id);
        if (!modal) return;
        var content = modal.querySelector('.modal-content');
        modal.classList.remove('hidden');
        /* Animation d'entrée */
        requestAnimationFrame(function() {
            content.classList.remove('scale-95', 'opacity-0');
            content.classList.add('scale-100', 'opacity-100');
        });
    }

    /* Fermer une modale */
    function closeModal(modal) {
        var content = modal.querySelector('.modal-content');
        content.classList.remove('scale-100', 'opacity-100');
        content.classList.add('scale-95', 'opacity-0');
        setTimeout(function() { modal.classList.add('hidden'); }, 200);
    }

    /* Boutons ouvrir */
    openBtns.forEach(function(btn) {
        btn.addEventListener('click', function() {
            openModal(this.getAttribute('data-modal'));
        });
    });

    /* Boutons fermer (croix) */
    document.querySelectorAll('.close-avis').forEach(function(btn) {
        btn.addEventListener('click', function() {
            closeModal(this.closest('.avis-modal'));
        });
    });

    /* Fermer au clic sur l'overlay */
    document.querySelectorAll('.modal-overlay').forEach(function(overlay) {
        overlay.addEventListener('click', function() {
            closeModal(this.closest('.avis-modal'));
        });
    });

    /* Fermer avec Echap */
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            modals.forEach(function(modal) {
                if (!modal.classList.contains('hidden')) closeModal(modal);
            });
        }
    });
})();
</script>
@endpush