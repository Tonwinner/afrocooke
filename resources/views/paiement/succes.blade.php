@extends('layouts.app')
@section('title', 'Paiement Réussi — AfroCook Experience')

@section('content')

    <section class="bg-beige-50 min-h-[70vh] flex items-center justify-center py-12 px-5">
        <div class="w-full max-w-lg">
            <div class="bg-white rounded-2xl border border-beige-200/60 shadow-lg shadow-dark/5 p-8 sm:p-10 text-center">

                {{-- Icône succès animée --}}
                <div class="w-20 h-20 rounded-full bg-emerald-50 flex items-center justify-center mx-auto mb-6 success-pop">
                    <svg class="w-10 h-10 text-emerald-500" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/>
                        <polyline points="22 4 12 14.01 9 11.01"/>
                    </svg>
                </div>

                <h1 class="text-2xl font-extrabold text-dark tracking-tight mb-2">Paiement réussi !</h1>
                <p class="text-[15px] text-beige-500 mb-8">Votre réservation est confirmée. Vous recevrez un email de confirmation.</p>

                {{-- Détails --}}
                <div class="bg-beige-50 rounded-xl p-5 text-left mb-8">
                    <div class="space-y-0">
                        <div class="flex justify-between py-2.5 border-b border-beige-200/60">
                            <span class="text-[13px] text-beige-500">Atelier</span>
                            <span class="text-[14px] font-semibold text-dark">{{ $reservation->creneau->atelier->titre }}</span>
                        </div>
                        <div class="flex justify-between py-2.5 border-b border-beige-200/60">
                            <span class="text-[13px] text-beige-500">Date</span>
                            <span class="text-[14px] font-semibold text-dark">{{ \Carbon\Carbon::parse($reservation->creneau->date)->translatedFormat('d F Y') }}</span>
                        </div>
                        <div class="flex justify-between py-2.5 border-b border-beige-200/60">
                            <span class="text-[13px] text-beige-500">Horaire</span>
                            <span class="text-[14px] font-semibold text-dark">{{ \Carbon\Carbon::parse($reservation->creneau->heure_debut)->format('H:i') }} — {{ \Carbon\Carbon::parse($reservation->creneau->heure_fin)->format('H:i') }}</span>
                        </div>
                        <div class="flex justify-between py-2.5 border-b border-beige-200/60">
                            <span class="text-[13px] text-beige-500">Participants</span>
                            <span class="text-[14px] font-semibold text-dark">{{ $reservation->nombre_personnes }} personnes</span>
                        </div>
                        <div class="flex justify-between py-2.5 {{ $reservation->facture ? 'border-b border-beige-200/60' : '' }}">
                            <span class="text-[13px] text-beige-500">Montant payé</span>
                            <span class="text-[14px] font-bold text-emerald-600">{{ number_format($reservation->montant_total, 0, ',', ' ') }} FCFA</span>
                        </div>
                        @if($reservation->facture)
                            <div class="flex justify-between py-2.5">
                                <span class="text-[13px] text-beige-500">N° Facture</span>
                                <span class="text-[14px] font-semibold text-dark font-mono">{{ $reservation->facture->numero_facture }}</span>
                            </div>
                        @endif
                    </div>
                </div>

                {{-- Actions --}}
                <div class="flex flex-col sm:flex-row gap-3">
                    @if($reservation->facture)
                        <a href="{{ route('facture.pdf', $reservation->facture) }}"
                           class="flex-1 flex items-center justify-center gap-2 py-3.5 bg-brand-500 hover:bg-brand-600 text-white text-[14px] font-semibold rounded-xl transition-all duration-200 hover:shadow-md hover:shadow-brand-500/20">
                            <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="12" y1="18" x2="12" y2="12"/><polyline points="9 15 12 18 15 15"/></svg>
                            Télécharger la facture
                        </a>
                    @endif
                    <a href="{{ route('compte.reservations') }}"
                       class="flex-1 flex items-center justify-center gap-2 py-3.5 text-[14px] font-semibold text-dark border border-beige-300 hover:border-beige-400 rounded-xl transition-all duration-200">
                        <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/></svg>
                        Mes réservations
                    </a>
                </div>
            </div>
        </div>
    </section>

@endsection

@push('styles')
<style>
    .success-pop { animation: popIn 0.6s cubic-bezier(0.34, 1.56, 0.64, 1); }
    @keyframes popIn { 0% { transform: scale(0); opacity: 0; } 100% { transform: scale(1); opacity: 1; } }
</style>
@endpush