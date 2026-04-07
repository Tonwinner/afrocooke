@extends('layouts.app')
@section('title', 'Mes Factures — AfroCook Experience')

@section('content')

    {{-- Header --}}
    <section class="relative py-14 sm:py-16 text-center overflow-hidden">
        <div class="absolute inset-0">
            <img src="https://images.unsplash.com/photo-1556910103-1c02745aae4d?w=1200&q=80" alt="" class="w-full h-full object-cover">
            <div class="absolute inset-0 bg-dark/75"></div>
        </div>
        <div class="relative z-10 max-w-7xl mx-auto px-5 sm:px-8 lg:px-10">
            <h1 class="text-3xl sm:text-4xl font-extrabold text-white tracking-tight mb-3">Mes Factures</h1>
            <p class="text-[15px] text-white/50 max-w-md mx-auto">Consultez et téléchargez vos factures</p>
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
                    <a href="{{ route('compte.reservations') }}" class="flex-1 flex items-center justify-center gap-2 py-2.5 rounded-lg text-[13px] font-semibold text-beige-500 hover:bg-beige-50 transition-colors">
                        <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><rect x="3" y="4" width="18" height="18" rx="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/></svg>
                        Réservations
                    </a>
                    <a href="{{ route('compte.factures') }}" class="flex-1 flex items-center justify-center gap-2 py-2.5 rounded-lg text-[13px] font-semibold bg-brand-500 text-white transition-colors">
                        <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/></svg>
                        Factures
                    </a>
                </div>
            </div>

            {{-- Tableau des factures --}}
            @if($factures->count() > 0)
                <div class="bg-white rounded-2xl border border-beige-200/60 overflow-hidden">
                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead>
                                <tr>
                                    <th class="px-5 py-3 text-left text-[10px] font-bold uppercase tracking-widest text-beige-400 bg-beige-50/50">N° Facture</th>
                                    <th class="px-5 py-3 text-left text-[10px] font-bold uppercase tracking-widest text-beige-400 bg-beige-50/50">Atelier</th>
                                    <th class="px-5 py-3 text-left text-[10px] font-bold uppercase tracking-widest text-beige-400 bg-beige-50/50">Date</th>
                                    <th class="px-5 py-3 text-left text-[10px] font-bold uppercase tracking-widest text-beige-400 bg-beige-50/50">Montant TTC</th>
                                    <th class="px-5 py-3 text-right text-[10px] font-bold uppercase tracking-widest text-beige-400 bg-beige-50/50">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($factures as $reservation)
                                    <tr class="border-b border-beige-50 hover:bg-beige-50/40 transition-colors duration-100">
                                        {{-- Numéro facture --}}
                                        <td class="px-5 py-4">
                                            <span class="text-[14px] font-semibold text-dark font-mono">{{ $reservation->facture->numero_facture }}</span>
                                        </td>
                                        {{-- Atelier --}}
                                        <td class="px-5 py-4 text-[14px] text-dark-50">{{ $reservation->creneau->atelier->titre }}</td>
                                        {{-- Date --}}
                                        <td class="px-5 py-4 text-[14px] text-beige-500 whitespace-nowrap">{{ $reservation->facture->created_at->translatedFormat('d F Y') }}</td>
                                        {{-- Montant --}}
                                        <td class="px-5 py-4">
                                            <span class="text-[15px] font-bold text-brand-600">{{ number_format($reservation->facture->montant_ttc, 0, ',', ' ') }} FCFA</span>
                                        </td>
                                        {{-- Télécharger --}}
                                        <td class="px-5 py-4 text-right">
                                            <a href="{{ route('facture.pdf', $reservation->facture) }}"
                                               class="inline-flex items-center gap-1.5 px-4 py-2 text-[12px] font-semibold text-brand-600 bg-brand-50 hover:bg-brand-100 rounded-lg transition-colors duration-200">
                                                <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="12" y1="18" x2="12" y2="12"/><polyline points="9 15 12 18 15 15"/></svg>
                                                Télécharger
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                @if($factures->hasPages())
                    <div class="mt-10 flex justify-center">{{ $factures->links() }}</div>
                @endif
            @else
                {{-- État vide --}}
                <div class="text-center py-20">
                    <svg class="w-14 h-14 text-beige-200 mx-auto mb-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1">
                        <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/>
                    </svg>
                    <h3 class="text-xl font-bold text-dark mb-2">Aucune facture</h3>
                    <p class="text-[14px] text-beige-400 mb-6">Vos factures apparaîtront ici après chaque paiement confirmé.</p>
                    <a href="{{ route('ateliers.index') }}" class="inline-flex items-center gap-2 px-6 py-3 bg-brand-500 hover:bg-brand-600 text-white text-[14px] font-semibold rounded-xl transition-all duration-200">
                        Découvrir nos ateliers
                        <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 12h14"/><polyline points="12 5 19 12 12 19"/></svg>
                    </a>
                </div>
            @endif
        </div>
    </section>

@endsection