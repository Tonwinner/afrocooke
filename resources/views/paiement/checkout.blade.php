@extends('layouts.app')
@section('title', 'Paiement — AfroCook Experience')

@section('content')

    <section class="bg-beige-50 min-h-[75vh] py-12 px-5">
        <div class="max-w-4xl mx-auto">

            {{-- Lien retour --}}
            <a href="{{ url()->previous() }}" class="inline-flex items-center gap-2 text-sm text-beige-500 hover:text-brand-500 transition-colors mb-6 group">
                <svg class="w-4 h-4 transition-transform group-hover:-translate-x-0.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M19 12H5"/><polyline points="12 19 5 12 12 5"/></svg>
                Modifier ma réservation
            </a>

            <div class="grid grid-cols-1 lg:grid-cols-5 gap-6">

                {{-- Colonne gauche : récap atelier (3 cols) --}}
                <div class="lg:col-span-3">
                    <div class="bg-white rounded-2xl border border-beige-200/60 overflow-hidden">
                        {{-- Image de l'atelier --}}
                        <div class="relative h-48 overflow-hidden">
                            @if($reservation->creneau->atelier->photo)
                                <img src="{{ asset('storage/' . $reservation->creneau->atelier->photo) }}" alt="" class="w-full h-full object-cover">
                            @else
                                <div class="w-full h-full bg-gradient-to-br from-beige-100 to-beige-200 flex items-center justify-center">
                                    <svg class="w-14 h-14 text-beige-300" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1"><path d="M18 8h1a4 4 0 0 1 0 8h-1"/><path d="M2 8h16v9a4 4 0 0 1-4 4H6a4 4 0 0 1-4-4V8z"/></svg>
                                </div>
                            @endif
                            {{-- Badge pays --}}
                            @php
                                $drapeaux = ['Bénin'=>'bj','Sénégal'=>'sn','Cameroun'=>'cm','Togo'=>'tg','Nigeria'=>'ng','Ghana'=>'gh',"Côte d'Ivoire"=>'ci','Mali'=>'ml','Niger'=>'ne','Guinée'=>'gn'];
                                $iso = $drapeaux[$reservation->creneau->atelier->origine_pays] ?? null;
                            @endphp
                            <span class="absolute top-3 left-3 inline-flex items-center gap-1.5 px-2.5 py-1 bg-white/90 backdrop-blur-sm text-dark text-[11px] font-bold rounded-lg">
                                @if($iso)
                                    <img src="https://flagcdn.com/w20/{{ $iso }}.png" alt="" class="w-4 h-3 rounded-sm object-cover">
                                @endif
                                {{ $reservation->creneau->atelier->origine_pays }}
                            </span>
                        </div>

                        <div class="p-6">
                            {{-- Titre atelier --}}
                            <h2 class="text-xl font-bold text-dark mb-4">{{ $reservation->creneau->atelier->titre }}</h2>

                            {{-- Détails en grille --}}
                            <div class="grid grid-cols-2 gap-4 mb-5">
                                <div class="flex items-start gap-3 p-3 bg-beige-50 rounded-xl">
                                    <svg class="w-5 h-5 text-brand-500 flex-shrink-0 mt-0.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><rect x="3" y="4" width="18" height="18" rx="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                                    <div>
                                        <p class="text-[11px] text-beige-400 uppercase tracking-wider mb-0.5">Date</p>
                                        <p class="text-[14px] font-semibold text-dark">{{ \Carbon\Carbon::parse($reservation->creneau->date)->translatedFormat('d F Y') }}</p>
                                    </div>
                                </div>
                                <div class="flex items-start gap-3 p-3 bg-beige-50 rounded-xl">
                                    <svg class="w-5 h-5 text-brand-500 flex-shrink-0 mt-0.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                                    <div>
                                        <p class="text-[11px] text-beige-400 uppercase tracking-wider mb-0.5">Horaire</p>
                                        <p class="text-[14px] font-semibold text-dark">{{ \Carbon\Carbon::parse($reservation->creneau->heure_debut)->format('H:i') }} — {{ \Carbon\Carbon::parse($reservation->creneau->heure_fin)->format('H:i') }}</p>
                                    </div>
                                </div>
                                <div class="flex items-start gap-3 p-3 bg-beige-50 rounded-xl">
                                    <svg class="w-5 h-5 text-brand-500 flex-shrink-0 mt-0.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/></svg>
                                    <div>
                                        <p class="text-[11px] text-beige-400 uppercase tracking-wider mb-0.5">Participants</p>
                                        <p class="text-[14px] font-semibold text-dark">{{ $reservation->nombre_personnes }} personnes</p>
                                    </div>
                                </div>
                                @if($reservation->creneau->chef)
                                    <div class="flex items-start gap-3 p-3 bg-beige-50 rounded-xl">
                                        <svg class="w-5 h-5 text-brand-500 flex-shrink-0 mt-0.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M18 8h1a4 4 0 0 1 0 8h-1"/><path d="M2 8h16v9a4 4 0 0 1-4 4H6a4 4 0 0 1-4-4V8z"/></svg>
                                        <div>
                                            <p class="text-[11px] text-beige-400 uppercase tracking-wider mb-0.5">Chef</p>
                                            <p class="text-[14px] font-semibold text-dark">{{ $reservation->creneau->chef->name }}</p>
                                        </div>
                                    </div>
                                @endif
                            </div>

                            {{-- Description courte --}}
                            <p class="text-[13px] text-beige-500 leading-relaxed">{{ Str::limit($reservation->creneau->atelier->description, 150) }}</p>
                        </div>
                    </div>
                </div>

                {{-- Colonne droite : paiement (2 cols) --}}
                <div class="lg:col-span-2 lg:sticky lg:top-24">
                    <div class="bg-white rounded-2xl border border-beige-200/60 overflow-hidden">
                        {{-- En-tête --}}
                        <div class="bg-dark px-6 py-5 text-center">
                            <div class="w-11 h-11 rounded-xl bg-brand-500/15 flex items-center justify-center mx-auto mb-3">
                                <svg class="w-6 h-6 text-brand-400" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><rect x="1" y="4" width="22" height="16" rx="2"/><line x1="1" y1="10" x2="23" y2="10"/></svg>
                            </div>
                            <h3 class="text-[16px] font-bold text-white mb-0.5">Récapitulatif</h3>
                            <p class="text-[12px] text-white/40">Vérifiez avant de payer</p>
                        </div>

                        <div class="p-6">
                            {{-- Détail prix --}}
                            <div class="space-y-3 mb-5">
                                <div class="flex justify-between text-[13px]">
                                    <span class="text-beige-500">Prix par personne</span>
                                    <span class="font-semibold text-dark">{{ number_format($reservation->creneau->atelier->prix, 0, ',', ' ') }} FCFA</span>
                                </div>
                                <div class="flex justify-between text-[13px]">
                                    <span class="text-beige-500">Participants</span>
                                    <span class="font-semibold text-dark">× {{ $reservation->nombre_personnes }}</span>
                                </div>
                                @if($reservation->code_promo)
                                    <div class="flex justify-between text-[13px]">
                                        <span class="text-beige-500">Code promo</span>
                                        <span class="font-semibold text-emerald-600">{{ $reservation->code_promo }}</span>
                                    </div>
                                @endif
                            </div>

                            {{-- Total --}}
                            <div class="border-t border-beige-100 pt-4 mb-6">
                                <div class="flex justify-between items-center">
                                    <span class="text-[15px] font-bold text-dark">Total</span>
                                    <span class="text-2xl font-extrabold text-brand-600">{{ number_format($reservation->montant_total, 0, ',', ' ') }} FCFA</span>
                                </div>
                            </div>

                            {{-- Bouton payer --}}
                            <button type="button" id="payBtn"
                                class="w-full flex items-center justify-center gap-2 py-4 bg-brand-500 hover:bg-brand-600 text-white text-[15px] font-bold rounded-xl transition-all duration-200 hover:shadow-lg hover:shadow-brand-500/25">
                                <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="11" width="18" height="11" rx="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
                                <span id="payBtnText">Payer maintenant</span>
                            </button>

                            {{-- Modes de paiement --}}
                            <div class="mt-5 pt-4 border-t border-beige-100">
                                <p class="text-[11px] text-beige-400 text-center mb-3">Moyens de paiement acceptés</p>
                                <div class="flex items-center justify-center gap-3">
                                    <span class="px-3 py-1.5 rounded-lg bg-amber-50 text-[11px] font-bold text-amber-700">MTN MoMo</span>
                                    <span class="px-3 py-1.5 rounded-lg bg-blue-50 text-[11px] font-bold text-blue-700">Moov Money</span>
                                    <span class="px-3 py-1.5 rounded-lg bg-gray-50 text-[11px] font-bold text-gray-600">Carte</span>
                                </div>
                            </div>

                            {{-- Sécurité --}}
                            <div class="flex items-center justify-center gap-2 mt-4">
                                <svg class="w-4 h-4 text-emerald-500" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
                                <span class="text-[11px] text-beige-400">Paiement 100% sécurisé via KkiaPay</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Formulaire caché pour rediriger après paiement réussi --}}
    <form id="successForm" action="{{ route('paiement.succes') }}" method="GET" style="display:none;">
        <input type="hidden" name="reservation_id" value="{{ $reservation->uuid }}">
        <input type="hidden" name="transaction_id" id="transactionInput" value="">
    </form>

@endsection

@push('scripts')
{{-- SDK KkiaPay --}}
<script src="https://cdn.kkiapay.me/k.js"></script>

<script>
(function() {
    var payBtn = document.getElementById('payBtn');
    var payBtnText = document.getElementById('payBtnText');
    var successForm = document.getElementById('successForm');
    var transactionInput = document.getElementById('transactionInput');

    /* Au clic sur "Payer", ouvrir la fenêtre KkiaPay */
    payBtn.addEventListener('click', function() {
        openKkiapayWidget({
            amount: {{ (int) $reservation->montant_total }},
            position: 'center',
            callback: '',
            data: '',
            theme: '#1a9e7a',
            key: '{{ config("kkiapay.public_key") }}',
            sandbox: {{ config('kkiapay.sandbox') ? 'true' : 'false' }},
        });
    });

    /*
     * KkiaPay déclenche cet événement quand le paiement est validé.
     * On récupère le transactionId et on redirige vers le serveur
     * pour vérifier la transaction et générer la facture.
     */
    addSuccessListener(function(response) {
        transactionInput.value = response.transactionId;
        payBtnText.textContent = 'Traitement en cours...';
        payBtn.disabled = true;
        payBtn.classList.add('opacity-50', 'cursor-not-allowed');
        successForm.submit();
    });
})();
</script>
@endpush