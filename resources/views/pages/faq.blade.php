@extends('layouts.app')
@section('title', 'FAQ — AfroCook Experience')

@section('content')

    {{-- Header --}}
    <section class="relative py-16 sm:py-20 text-center overflow-hidden">
        <div class="absolute inset-0">
            <img src="https://images.unsplash.com/photo-1556911220-e15b29be8c8f?w=1200&q=80" alt="" class="w-full h-full object-cover">
            <div class="absolute inset-0 bg-dark/75"></div>
        </div>
        <div class="relative z-10 max-w-7xl mx-auto px-5 sm:px-8 lg:px-10">
            <h1 class="text-3xl sm:text-4xl font-extrabold text-white tracking-tight mb-3">Questions Fréquentes</h1>
            <p class="text-[15px] text-white/50 max-w-md mx-auto">Trouvez rapidement les réponses à vos questions</p>
        </div>
    </section>

    {{-- FAQ --}}
    <section class="bg-beige-50 py-14 sm:py-20">
        <div class="max-w-3xl mx-auto px-5 sm:px-8">

            <div class="space-y-3" id="faqList">
                {{-- Question 1 --}}
                <div class="faq-item bg-white rounded-xl border border-beige-200/60 overflow-hidden transition-all duration-200 hover:border-brand-200">
                    <button type="button" class="faq-toggle w-full flex items-center justify-between px-6 py-5 text-left">
                        <span class="text-[15px] font-semibold text-dark pr-4">Qu'est-ce qu'AfroCook Experience ?</span>
                        <svg class="faq-chevron w-5 h-5 text-brand-500 flex-shrink-0 transition-transform duration-300" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="6 9 12 15 18 9"/></svg>
                    </button>
                    <div class="faq-content" style="max-height:0;overflow:hidden;transition:max-height 0.35s ease;">
                        <p class="px-6 pb-5 text-[14px] text-beige-500 leading-relaxed">
                            AfroCook Experience est une plateforme de réservation d'ateliers de cuisine africaine en duo. Vous cuisinez des plats authentiques sous la guidance d'un chef professionnel, en couple, entre amis ou en famille.
                        </p>
                    </div>
                </div>

                {{-- Question 2 --}}
                <div class="faq-item bg-white rounded-xl border border-beige-200/60 overflow-hidden transition-all duration-200 hover:border-brand-200">
                    <button type="button" class="faq-toggle w-full flex items-center justify-between px-6 py-5 text-left">
                        <span class="text-[15px] font-semibold text-dark pr-4">Combien de personnes peuvent participer ?</span>
                        <svg class="faq-chevron w-5 h-5 text-brand-500 flex-shrink-0 transition-transform duration-300" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="6 9 12 15 18 9"/></svg>
                    </button>
                    <div class="faq-content" style="max-height:0;overflow:hidden;transition:max-height 0.35s ease;">
                        <p class="px-6 pb-5 text-[14px] text-beige-500 leading-relaxed">
                            Chaque atelier est conçu pour des petits groupes de 2 à 6 personnes (soit 1 à 3 duos). Cela garantit un accompagnement personnalisé par le chef et une expérience intime.
                        </p>
                    </div>
                </div>

                {{-- Question 3 --}}
                <div class="faq-item bg-white rounded-xl border border-beige-200/60 overflow-hidden transition-all duration-200 hover:border-brand-200">
                    <button type="button" class="faq-toggle w-full flex items-center justify-between px-6 py-5 text-left">
                        <span class="text-[15px] font-semibold text-dark pr-4">Comment se déroule le paiement ?</span>
                        <svg class="faq-chevron w-5 h-5 text-brand-500 flex-shrink-0 transition-transform duration-300" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="6 9 12 15 18 9"/></svg>
                    </button>
                    <div class="faq-content" style="max-height:0;overflow:hidden;transition:max-height 0.35s ease;">
                        <p class="px-6 pb-5 text-[14px] text-beige-500 leading-relaxed">
                            Le paiement se fait en ligne de manière sécurisée via KkiaPay. Vous pouvez payer par Mobile Money ou carte bancaire. Une confirmation et une facture sont générées automatiquement après le paiement.
                        </p>
                    </div>
                </div>

                {{-- Question 4 --}}
                <div class="faq-item bg-white rounded-xl border border-beige-200/60 overflow-hidden transition-all duration-200 hover:border-brand-200">
                    <button type="button" class="faq-toggle w-full flex items-center justify-between px-6 py-5 text-left">
                        <span class="text-[15px] font-semibold text-dark pr-4">Puis-je annuler ma réservation ?</span>
                        <svg class="faq-chevron w-5 h-5 text-brand-500 flex-shrink-0 transition-transform duration-300" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="6 9 12 15 18 9"/></svg>
                    </button>
                    <div class="faq-content" style="max-height:0;overflow:hidden;transition:max-height 0.35s ease;">
                        <p class="px-6 pb-5 text-[14px] text-beige-500 leading-relaxed">
                            Oui, vous pouvez annuler votre réservation jusqu'à 48 heures avant la date de l'atelier. Contactez-nous par email ou téléphone pour toute demande d'annulation. Un remboursement complet sera effectué.
                        </p>
                    </div>
                </div>

                {{-- Question 5 --}}
                <div class="faq-item bg-white rounded-xl border border-beige-200/60 overflow-hidden transition-all duration-200 hover:border-brand-200">
                    <button type="button" class="faq-toggle w-full flex items-center justify-between px-6 py-5 text-left">
                        <span class="text-[15px] font-semibold text-dark pr-4">Faut-il apporter quelque chose ?</span>
                        <svg class="faq-chevron w-5 h-5 text-brand-500 flex-shrink-0 transition-transform duration-300" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="6 9 12 15 18 9"/></svg>
                    </button>
                    <div class="faq-content" style="max-height:0;overflow:hidden;transition:max-height 0.35s ease;">
                        <p class="px-6 pb-5 text-[14px] text-beige-500 leading-relaxed">
                            Non, tout est fourni : ingrédients frais, ustensiles de cuisine, tabliers et fiches recettes. Venez simplement avec votre bonne humeur et votre envie de cuisiner !
                        </p>
                    </div>
                </div>

                {{-- Question 6 --}}
                <div class="faq-item bg-white rounded-xl border border-beige-200/60 overflow-hidden transition-all duration-200 hover:border-brand-200">
                    <button type="button" class="faq-toggle w-full flex items-center justify-between px-6 py-5 text-left">
                        <span class="text-[15px] font-semibold text-dark pr-4">Les ateliers conviennent-ils aux débutants ?</span>
                        <svg class="faq-chevron w-5 h-5 text-brand-500 flex-shrink-0 transition-transform duration-300" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="6 9 12 15 18 9"/></svg>
                    </button>
                    <div class="faq-content" style="max-height:0;overflow:hidden;transition:max-height 0.35s ease;">
                        <p class="px-6 pb-5 text-[14px] text-beige-500 leading-relaxed">
                            Absolument ! Nos ateliers sont conçus pour tous les niveaux, du débutant au cuisinier expérimenté. Le chef adapte ses explications et vous guide pas à pas tout au long de la recette.
                        </p>
                    </div>
                </div>

                {{-- Question 7 --}}
                <div class="faq-item bg-white rounded-xl border border-beige-200/60 overflow-hidden transition-all duration-200 hover:border-brand-200">
                    <button type="button" class="faq-toggle w-full flex items-center justify-between px-6 py-5 text-left">
                        <span class="text-[15px] font-semibold text-dark pr-4">Comment utiliser un code promo ?</span>
                        <svg class="faq-chevron w-5 h-5 text-brand-500 flex-shrink-0 transition-transform duration-300" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="6 9 12 15 18 9"/></svg>
                    </button>
                    <div class="faq-content" style="max-height:0;overflow:hidden;transition:max-height 0.35s ease;">
                        <p class="px-6 pb-5 text-[14px] text-beige-500 leading-relaxed">
                            Lors de la réservation, vous trouverez un champ "Code promo" dans le formulaire. Entrez votre code et la réduction sera appliquée automatiquement au montant total avant le paiement.
                        </p>
                    </div>
                </div>
            </div>

            {{-- Pas trouvé votre réponse --}}
            <div class="mt-12 text-center bg-white rounded-2xl p-8 border border-beige-200/60">
                <svg class="w-10 h-10 text-brand-300 mx-auto mb-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                    <circle cx="12" cy="12" r="10"/><path d="M9.09 9a3 3 0 0 1 5.83 1c0 2-3 3-3 3"/><line x1="12" y1="17" x2="12.01" y2="17"/>
                </svg>
                <h3 class="text-lg font-bold text-dark mb-2">Vous n'avez pas trouvé votre réponse ?</h3>
                <p class="text-[14px] text-beige-500 mb-5">Contactez-nous directement, nous vous répondrons rapidement.</p>
                <a href="{{ route('contact') }}" class="inline-flex items-center gap-2 px-6 py-3 bg-brand-500 hover:bg-brand-600 text-white text-[14px] font-semibold rounded-xl transition-all duration-200 hover:shadow-md hover:shadow-brand-500/20">
                    <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
                    Nous contacter
                </a>
            </div>
        </div>
    </section>

@endsection

@push('scripts')
<script>
(function() {
    var items = document.querySelectorAll('.faq-item');

    items.forEach(function(item) {
        var toggle = item.querySelector('.faq-toggle');
        var content = item.querySelector('.faq-content');
        var chevron = item.querySelector('.faq-chevron');

        toggle.addEventListener('click', function() {
            var isOpen = content.style.maxHeight !== '0px' && content.style.maxHeight !== '';

            /* Fermer tous les autres */
            items.forEach(function(other) {
                other.querySelector('.faq-content').style.maxHeight = '0px';
                other.querySelector('.faq-chevron').classList.remove('rotate-180');
            });

            /* Ouvrir celui-ci si il était fermé */
            if (!isOpen) {
                content.style.maxHeight = content.scrollHeight + 'px';
                chevron.classList.add('rotate-180');
            }
        });
    });
})();
</script>
@endpush