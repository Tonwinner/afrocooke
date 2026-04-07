@extends('layouts.app')
@section('title', 'Échec du Paiement — AfroCook Experience')

@section('content')

    <section class="bg-beige-50 min-h-[70vh] flex items-center justify-center py-12 px-5">
        <div class="w-full max-w-lg">
            <div class="bg-white rounded-2xl border border-beige-200/60 shadow-lg shadow-dark/5 p-8 sm:p-10 text-center">

                {{-- Icône échec --}}
                <div class="w-20 h-20 rounded-full bg-red-50 flex items-center justify-center mx-auto mb-6 echec-pop">
                    <svg class="w-10 h-10 text-red-500" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="12" cy="12" r="10"/>
                        <line x1="15" y1="9" x2="9" y2="15"/>
                        <line x1="9" y1="9" x2="15" y2="15"/>
                    </svg>
                </div>

                <h1 class="text-2xl font-extrabold text-dark tracking-tight mb-2">Paiement échoué</h1>
                <p class="text-[15px] text-beige-500 leading-relaxed mb-8">
                    Le paiement n'a pas pu être traité. Votre réservation est en attente. Vous pouvez réessayer ou nous contacter pour obtenir de l'aide.
                </p>

                {{-- Actions --}}
                <div class="flex flex-col sm:flex-row gap-3">
                    <a href="{{ route('paiement.initier', $reservation) }}"
                       class="flex-1 flex items-center justify-center gap-2 py-3.5 bg-brand-500 hover:bg-brand-600 text-white text-[14px] font-semibold rounded-xl transition-all duration-200 hover:shadow-md hover:shadow-brand-500/20">
                        <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="23 4 23 10 17 10"/><path d="M20.49 15a9 9 0 1 1-2.12-9.36L23 10"/></svg>
                        Réessayer le paiement
                    </a>
                    <a href="{{ route('contact') }}"
                       class="flex-1 flex items-center justify-center gap-2 py-3.5 text-[14px] font-semibold text-dark border border-beige-300 hover:border-beige-400 rounded-xl transition-all duration-200">
                        <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
                        Nous contacter
                    </a>
                </div>
            </div>

            {{-- Lien retour --}}
            <div class="text-center mt-6">
                <a href="{{ route('ateliers.index') }}" class="text-[13px] text-beige-500 hover:text-brand-500 transition-colors">← Retour aux ateliers</a>
            </div>
        </div>
    </section>

@endsection

@push('styles')
<style>
    .echec-pop { animation: echecPop 0.6s cubic-bezier(0.34, 1.56, 0.64, 1); }
    @keyframes echecPop { 0% { transform: scale(0); opacity: 0; } 100% { transform: scale(1); opacity: 1; } }
</style>
@endpush