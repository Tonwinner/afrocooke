{{-- 
    ┌──────────────────────────────────────────────────┐
    │  DASHBOARD ADMIN — Atelier à Deux                │
    │  Fichier : resources/views/admin/dashboard.blade  │
    │  Layout parent : layouts/admin                    │
    │  Controller : Admin/DashboardController@index     │
    │  Route : /admin/dashboard                         │
    │                                                    │
    │  Contenu :                                         │
    │  - 4 KPI principaux (ligne 1)                     │
    │  - 3 KPI secondaires (ligne 2)                    │
    │  - Graphique revenus 6 mois (barres animées)      │
    │  - Tableau des 5 dernières réservations            │
    │                                                    │
    │  Stack : TailwindCSS + SVG inline + JS vanilla    │
    └──────────────────────────────────────────────────┘
--}}
@extends('layouts.admin')

@section('page-title', 'Tableau de bord')

@section('content')

    {{-- 
        ═══════════════════════════════════════════════════
        LIGNE 1 — 4 indicateurs clés de performance
        ═══════════════════════════════════════════════════
        Grille responsive :
        - mobile    : 1 colonne
        - tablette  : 2 colonnes  
        - desktop   : 4 colonnes
        
        Chaque carte contient :
        - Un label descriptif en haut
        - Le chiffre principal en gros
        - Un sous-texte explicatif
        - Une icône SVG dans un carré coloré à droite
    --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-4 mb-5">

        {{-- KPI : Réservations totales --}}
        <div class="bg-white rounded-xl p-5 border border-beige-200/60 flex items-start justify-between group hover:border-brand-200 transition-colors duration-200">
            <div>
                <p class="text-[11px] font-semibold uppercase tracking-widest text-beige-400">Réservations</p>
                <p class="text-[28px] font-extrabold text-dark leading-tight mt-1 tracking-tight">{{ $totalReservations }}</p>
                <p class="text-[11px] text-beige-400 mt-0.5">total cumulé</p>
            </div>
            {{-- Icône calendrier --}}
            <div class="w-10 h-10 rounded-lg bg-brand-500/8 flex items-center justify-center flex-shrink-0 group-hover:bg-brand-500/15 transition-colors duration-200">
                <svg class="w-[18px] h-[18px] text-brand-500" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                    <rect x="3" y="4" width="18" height="18" rx="2" />
                    <line x1="16" y1="2" x2="16" y2="6" />
                    <line x1="8" y1="2" x2="8" y2="6" />
                    <line x1="3" y1="10" x2="21" y2="10" />
                    <path d="M8 14h.01" /><path d="M12 14h.01" /><path d="M16 14h.01" />
                    <path d="M8 18h.01" /><path d="M12 18h.01" />
                </svg>
            </div>
        </div>

        {{-- KPI : Revenus totaux --}}
        <div class="bg-white rounded-xl p-5 border border-beige-200/60 flex items-start justify-between group hover:border-emerald-200 transition-colors duration-200">
            <div>
                <p class="text-[11px] font-semibold uppercase tracking-widest text-beige-400">Revenus</p>
                <p class="text-[28px] font-extrabold text-dark leading-tight mt-1 tracking-tight">{{ number_format($revenuTotal, 0, ',', ' ') }}</p>
                <p class="text-[11px] text-beige-400 mt-0.5">FCFA cumulés</p>
            </div>
            {{-- Icône monnaie --}}
            <div class="w-10 h-10 rounded-lg bg-emerald-500/8 flex items-center justify-center flex-shrink-0 group-hover:bg-emerald-500/15 transition-colors duration-200">
                <svg class="w-[18px] h-[18px] text-emerald-600" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="12" cy="12" r="10" />
                    <line x1="12" y1="6" x2="12" y2="18" />
                    <path d="M15.5 9.5c-.8-1-2-1.5-3.5-1.5-2 0-3.5 1-3.5 2.5S9 13 12 13.5s3.5 1 3.5 2.5c0 1.5-1.5 2.5-3.5 2.5-1.5 0-2.7-.5-3.5-1.5" />
                </svg>
            </div>
        </div>

        {{-- KPI : Clients inscrits --}}
        <div class="bg-white rounded-xl p-5 border border-beige-200/60 flex items-start justify-between group hover:border-blue-200 transition-colors duration-200">
            <div>
                <p class="text-[11px] font-semibold uppercase tracking-widest text-beige-400">Clients</p>
                <p class="text-[28px] font-extrabold text-dark leading-tight mt-1 tracking-tight">{{ $totalClients }}</p>
                <p class="text-[11px] text-beige-400 mt-0.5">inscrits</p>
            </div>
            {{-- Icône utilisateurs --}}
            <div class="w-10 h-10 rounded-lg bg-blue-500/8 flex items-center justify-center flex-shrink-0 group-hover:bg-blue-500/15 transition-colors duration-200">
                <svg class="w-[18px] h-[18px] text-blue-600" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2" />
                    <circle cx="9" cy="7" r="4" />
                    <path d="M22 21v-2a4 4 0 0 0-3-3.87" />
                    <path d="M16 3.13a4 4 0 0 1 0 7.75" />
                </svg>
            </div>
        </div>

        {{-- KPI : Taux d'occupation --}}
        <div class="bg-white rounded-xl p-5 border border-beige-200/60 flex items-start justify-between group hover:border-amber-200 transition-colors duration-200">
            <div>
                <p class="text-[11px] font-semibold uppercase tracking-widest text-beige-400">Occupation</p>
                <p class="text-[28px] font-extrabold text-dark leading-tight mt-1 tracking-tight">{{ $tauxOccupation }}<span class="text-lg">%</span></p>
                <p class="text-[11px] text-beige-400 mt-0.5">des créneaux</p>
            </div>
            {{-- Icône jauge --}}
            <div class="w-10 h-10 rounded-lg bg-amber-500/8 flex items-center justify-center flex-shrink-0 group-hover:bg-amber-500/15 transition-colors duration-200">
                <svg class="w-[18px] h-[18px] text-amber-600" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M12 20v-6" />
                    <path d="M6 20v-4" />
                    <path d="M18 20V10" />
                    <path d="M12 10V4" />
                    <path d="M6 12V4" />
                    <path d="M18 6V4" />
                </svg>
            </div>
        </div>
    </div>

    {{-- 
        ═══════════════════════════════════════════════════
        LIGNE 2 — 3 indicateurs secondaires compacts
        ═══════════════════════════════════════════════════
        Format horizontal : icône à gauche, données à droite
    --}}
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mb-5">

        {{-- Ateliers actifs --}}
        <div class="bg-white rounded-xl px-5 py-4 border border-beige-200/60 flex items-center gap-4">
            <div class="w-9 h-9 rounded-lg bg-brand-500/8 flex items-center justify-center flex-shrink-0">
                <svg class="w-4 h-4 text-brand-500" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M18 8h1a4 4 0 0 1 0 8h-1" />
                    <path d="M2 8h16v9a4 4 0 0 1-4 4H6a4 4 0 0 1-4-4V8z" />
                    <line x1="6" y1="1" x2="6" y2="4" />
                    <line x1="10" y1="1" x2="10" y2="4" />
                    <line x1="14" y1="1" x2="14" y2="4" />
                </svg>
            </div>
            <div>
                <p class="text-xl font-extrabold text-dark leading-tight">{{ $totalAteliers }}</p>
                <p class="text-[11px] text-beige-400">ateliers actifs</p>
            </div>
        </div>

        {{-- Revenus ce mois --}}
        <div class="bg-white rounded-xl px-5 py-4 border border-beige-200/60 flex items-center gap-4">
            <div class="w-9 h-9 rounded-lg bg-emerald-500/8 flex items-center justify-center flex-shrink-0">
                <svg class="w-4 h-4 text-emerald-600" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                    <polyline points="22 7 13.5 15.5 8.5 10.5 2 17" />
                    <polyline points="16 7 22 7 22 13" />
                </svg>
            </div>
            <div>
                <p class="text-xl font-extrabold text-dark leading-tight">{{ number_format($revenuMois, 0, ',', ' ') }}</p>
                <p class="text-[11px] text-beige-400">FCFA ce mois</p>
            </div>
        </div>

        {{-- Réservations ce mois --}}
        <div class="bg-white rounded-xl px-5 py-4 border border-beige-200/60 flex items-center gap-4">
            <div class="w-9 h-9 rounded-lg bg-blue-500/8 flex items-center justify-center flex-shrink-0">
                <svg class="w-4 h-4 text-blue-600" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M16 4h2a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h2" />
                    <rect x="8" y="2" width="8" height="4" rx="1" />
                    <path d="M9 14l2 2 4-4" />
                </svg>
            </div>
            <div>
                <p class="text-xl font-extrabold text-dark leading-tight">{{ $reservationsMois }}</p>
                <p class="text-[11px] text-beige-400">réservations ce mois</p>
            </div>
        </div>
    </div>

    {{-- 
        ═══════════════════════════════════════════════════
        GRAPHIQUE — Revenus des 6 derniers mois
        ═══════════════════════════════════════════════════
        Barres HTML/CSS animées au chargement via JS.
        Hauteur proportionnelle au montant maximum.
        Hover : affiche le montant exact + change la teinte.
    --}}
    <div class="bg-white rounded-xl border border-beige-200/60 p-6 mb-5">
        
        {{-- En-tête du graphique --}}
        <div class="flex items-center justify-between mb-6">
            <div>
                <h2 class="text-[15px] font-bold text-dark">Revenus mensuels</h2>
                <p class="text-[11px] text-beige-400 mt-0.5">Évolution sur les 6 derniers mois</p>
            </div>
            <div class="flex items-center gap-2">
                <span class="w-2.5 h-2.5 rounded-sm bg-brand-500"></span>
                <span class="text-[11px] text-beige-400">Revenus (FCFA)</span>
            </div>
        </div>

        {{-- Zone des barres --}}
        @php $maxRevenu = max(array_column($revenusMensuels, 'montant')); @endphp
        <div class="flex items-end gap-3" style="height: 220px;">
            @foreach($revenusMensuels as $mois)
                @php
                    $pct = $maxRevenu > 0 ? ($mois['montant'] / $maxRevenu * 100) : 0;
                @endphp
                <div class="flex-1 flex flex-col items-center gap-2 group cursor-pointer">
                    {{-- Montant : visible au hover --}}
                    <span class="text-[10px] font-bold text-dark opacity-0 group-hover:opacity-100 transition-opacity duration-150 whitespace-nowrap">
                        {{ number_format($mois['montant'], 0, ',', ' ') }}
                    </span>
                    {{-- Barre animée --}}
                    <div class="chart-bar w-full rounded-t-md bg-brand-500 group-hover:bg-brand-600 transition-all duration-300"
                         data-height="{{ max($pct, 2) }}"
                         style="height: 0%; min-height: 3px;"
                         title="{{ $mois['mois'] }} — {{ number_format($mois['montant'], 0, ',', ' ') }} FCFA">
                    </div>
                    {{-- Mois --}}
                    <span class="text-[10px] text-beige-400 font-medium">{{ $mois['mois'] }}</span>
                </div>
            @endforeach
        </div>
    </div>

    {{-- 
        ═══════════════════════════════════════════════════
        TABLEAU — 5 dernières réservations
        ═══════════════════════════════════════════════════
        - Avatar avec initiales du client
        - Badges statut avec pastille colorée
        - Hover léger sur les lignes
        - Lien "Voir tout" vers la liste complète
    --}}
    <div class="bg-white rounded-xl border border-beige-200/60 overflow-hidden">

        {{-- En-tête du tableau --}}
        <div class="flex items-center justify-between px-6 py-4 border-b border-beige-100">
            <div>
                <h2 class="text-[15px] font-bold text-dark">Dernières réservations</h2>
                <p class="text-[11px] text-beige-400 mt-0.5">Les 5 plus récentes</p>
            </div>
            <a href="{{ route('admin.reservations.index') }}" class="text-[13px] font-semibold text-brand-500 hover:text-brand-700 transition-colors flex items-center gap-1.5">
                Tout voir
                <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M5 12h14" /><polyline points="12 5 19 12 12 19" />
                </svg>
            </a>
        </div>

        {{-- Table responsive --}}
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr>
                        <th class="px-6 py-3 text-left text-[10px] font-bold uppercase tracking-widest text-beige-400 bg-beige-50/50">Client</th>
                        <th class="px-6 py-3 text-left text-[10px] font-bold uppercase tracking-widest text-beige-400 bg-beige-50/50">Atelier</th>
                        <th class="px-6 py-3 text-left text-[10px] font-bold uppercase tracking-widest text-beige-400 bg-beige-50/50">Date</th>
                        <th class="px-6 py-3 text-left text-[10px] font-bold uppercase tracking-widest text-beige-400 bg-beige-50/50">Montant</th>
                        <th class="px-6 py-3 text-left text-[10px] font-bold uppercase tracking-widest text-beige-400 bg-beige-50/50">Statut</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($dernieresReservations as $reservation)
                        <tr class="border-b border-beige-50 hover:bg-beige-50/40 transition-colors duration-100">
                            
                            {{-- Colonne client : avatar initiales + nom + email --}}
                            <td class="px-6 py-3">
                                <div class="flex items-center gap-3">
                                    <div class="w-8 h-8 rounded-lg bg-brand-50 flex items-center justify-center flex-shrink-0">
                                        <span class="text-[11px] font-bold text-brand-600">
                                            {{ strtoupper(mb_substr($reservation->user->name, 0, 2)) }}
                                        </span>
                                    </div>
                                    <div class="min-w-0">
                                        <p class="text-[13px] font-semibold text-dark truncate">{{ $reservation->user->name }}</p>
                                        <p class="text-[11px] text-beige-400 truncate">{{ $reservation->user->email }}</p>
                                    </div>
                                </div>
                            </td>

                            {{-- Colonne atelier --}}
                            <td class="px-6 py-3 text-[13px] text-dark-50">
                                {{ $reservation->creneau->atelier->titre }}
                            </td>

                            {{-- Colonne date --}}
                            <td class="px-6 py-3 text-[13px] text-beige-500 whitespace-nowrap">
                                {{ $reservation->created_at->translatedFormat('d M Y') }}
                            </td>

                            {{-- Colonne montant --}}
                            <td class="px-6 py-3 text-[13px] font-bold text-brand-600 whitespace-nowrap">
                                {{ number_format($reservation->montant_total, 0, ',', ' ') }} FCFA
                            </td>

                            {{-- 
                                Colonne statut
                                Badge avec pastille colorée + texte
                                Couleurs selon le statut :
                                - en_attente : ambre
                                - confirmee  : émeraude
                                - terminee   : bleu
                                - annulee    : rouge
                            --}}
                            <td class="px-6 py-3">
                                @switch($reservation->statut)
                                    @case('en_attente')
                                        <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-md text-[11px] font-semibold bg-amber-50 text-amber-700">
                                            <span class="w-1.5 h-1.5 rounded-full bg-amber-400"></span>
                                            En attente
                                        </span>
                                        @break
                                    @case('confirmee')
                                        <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-md text-[11px] font-semibold bg-emerald-50 text-emerald-700">
                                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-400"></span>
                                            Confirmée
                                        </span>
                                        @break
                                    @case('terminee')
                                        <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-md text-[11px] font-semibold bg-blue-50 text-blue-700">
                                            <span class="w-1.5 h-1.5 rounded-full bg-blue-400"></span>
                                            Terminée
                                        </span>
                                        @break
                                    @case('annulee')
                                        <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-md text-[11px] font-semibold bg-red-50 text-red-700">
                                            <span class="w-1.5 h-1.5 rounded-full bg-red-400"></span>
                                            Annulée
                                        </span>
                                        @break
                                @endswitch
                            </td>
                        </tr>
                    @empty
                        {{-- Cas où aucune réservation n'existe --}}
                        <tr>
                            <td colspan="5" class="px-6 py-16 text-center">
                                <svg class="w-10 h-10 text-beige-200 mx-auto mb-3" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                                    <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z" />
                                    <polyline points="14 2 14 8 20 8" />
                                </svg>
                                <p class="text-sm text-beige-400">Aucune réservation pour le moment</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

@endsection

{{-- 
    ═══════════════════════════════════════════════════
    JAVASCRIPT — Animation des barres du graphique
    ═══════════════════════════════════════════════════
    Au chargement de la page, les barres montent
    progressivement de 0% à leur hauteur finale.
    Chaque barre a un délai légèrement décalé
    pour un effet cascade fluide.
--}}
@push('scripts')
<script>
(function() {
    /* 
     * Attendre que le DOM soit prêt puis animer
     * chaque barre avec un délai croissant
     */
    var bars = document.querySelectorAll('.chart-bar');

    /* Petit délai pour laisser le navigateur peindre d'abord */
    setTimeout(function() {
        for (var i = 0; i < bars.length; i++) {
            (function(bar, delay) {
                setTimeout(function() {
                    /* Lire la hauteur cible depuis data-height */
                    bar.style.height = bar.getAttribute('data-height') + '%';
                }, delay);
            })(bars[i], i * 80);
        }
    }, 200);
})();
</script>
@endpush