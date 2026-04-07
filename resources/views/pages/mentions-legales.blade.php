@extends('layouts.app')
@section('title', 'Mentions Légales — AfroCook Experience')

@section('content')

    {{-- Header --}}
    <section class="relative bg-dark py-16 sm:py-20 text-center overflow-hidden">
        <div class="absolute -bottom-20 -left-20 w-72 h-72 rounded-full bg-brand-500/10 blur-[100px]"></div>
        <div class="relative z-10 max-w-7xl mx-auto px-5 sm:px-8 lg:px-10">
            <h1 class="text-3xl sm:text-4xl font-extrabold text-white tracking-tight mb-3">Mentions Légales</h1>
            <p class="text-[15px] text-white/40 max-w-md mx-auto">Informations juridiques et conditions générales</p>
        </div>
    </section>

    {{-- Contenu --}}
    <section class="bg-beige-50 py-14 sm:py-20">
        <div class="max-w-3xl mx-auto px-5 sm:px-8">
            <div class="bg-white rounded-2xl border border-beige-200/60 p-7 sm:p-10">

                {{-- Éditeur --}}
                <div class="mb-10">
                    <div class="flex items-center gap-3 mb-4">
                        <div class="w-9 h-9 rounded-lg bg-brand-50 flex items-center justify-center flex-shrink-0">
                            <svg class="w-4 h-4 text-brand-500" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                        </div>
                        <h2 class="text-[18px] font-bold text-dark">Éditeur du site</h2>
                    </div>
                    <div class="pl-12 space-y-2">
                        <p class="text-[14px] text-beige-500 leading-relaxed">Le site AfroCook Experience est édité par <span class="font-semibold text-dark">AfroCook Experience</span>, entreprise basée à Cotonou, Bénin.</p>
                        <p class="text-[14px] text-beige-500">Adresse : Cotonou, Bénin</p>
                        <p class="text-[14px] text-beige-500">Email : contact@afrocook.com</p>
                        <p class="text-[14px] text-beige-500">Téléphone : +229 97 00 00 00</p>
                    </div>
                </div>

                {{-- Hébergement --}}
                <div class="mb-10">
                    <div class="flex items-center gap-3 mb-4">
                        <div class="w-9 h-9 rounded-lg bg-blue-50 flex items-center justify-center flex-shrink-0">
                            <svg class="w-4 h-4 text-blue-500" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><rect x="2" y="2" width="20" height="8" rx="2"/><rect x="2" y="14" width="20" height="8" rx="2"/><line x1="6" y1="6" x2="6.01" y2="6"/><line x1="6" y1="18" x2="6.01" y2="18"/></svg>
                        </div>
                        <h2 class="text-[18px] font-bold text-dark">Hébergement</h2>
                    </div>
                    <div class="pl-12">
                        <p class="text-[14px] text-beige-500 leading-relaxed">Le site est hébergé par un prestataire d'hébergement web professionnel assurant la disponibilité et la sécurité des données.</p>
                    </div>
                </div>

                {{-- Propriété intellectuelle --}}
                <div class="mb-10">
                    <div class="flex items-center gap-3 mb-4">
                        <div class="w-9 h-9 rounded-lg bg-amber-50 flex items-center justify-center flex-shrink-0">
                            <svg class="w-4 h-4 text-amber-500" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
                        </div>
                        <h2 class="text-[18px] font-bold text-dark">Propriété intellectuelle</h2>
                    </div>
                    <div class="pl-12">
                        <p class="text-[14px] text-beige-500 leading-relaxed">L'ensemble du contenu du site (textes, images, graphismes, logo, icônes) est la propriété exclusive d'AfroCook Experience. Toute reproduction, même partielle, est interdite sans autorisation préalable.</p>
                    </div>
                </div>

                {{-- Données personnelles --}}
                <div class="mb-10">
                    <div class="flex items-center gap-3 mb-4">
                        <div class="w-9 h-9 rounded-lg bg-emerald-50 flex items-center justify-center flex-shrink-0">
                            <svg class="w-4 h-4 text-emerald-500" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
                        </div>
                        <h2 class="text-[18px] font-bold text-dark">Protection des données</h2>
                    </div>
                    <div class="pl-12 space-y-3">
                        <p class="text-[14px] text-beige-500 leading-relaxed">Les données personnelles collectées sur ce site (nom, email, téléphone) sont utilisées uniquement dans le cadre de la gestion des réservations et de la communication avec nos clients. Elles ne sont en aucun cas transmises à des tiers.</p>
                        <p class="text-[14px] text-beige-500 leading-relaxed">Conformément à la réglementation en vigueur, vous disposez d'un droit d'accès, de rectification et de suppression de vos données personnelles. Pour exercer ce droit, contactez-nous à <span class="font-semibold text-brand-600">contact@atelieradeux.com</span>.</p>
                    </div>
                </div>

                {{-- Conditions de réservation --}}
                <div class="mb-10">
                    <div class="flex items-center gap-3 mb-4">
                        <div class="w-9 h-9 rounded-lg bg-rose-50 flex items-center justify-center flex-shrink-0">
                            <svg class="w-4 h-4 text-rose-500" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/></svg>
                        </div>
                        <h2 class="text-[18px] font-bold text-dark">Conditions de réservation</h2>
                    </div>
                    <div class="pl-12">
                        <p class="text-[14px] text-beige-500 leading-relaxed">Toute réservation effectuée sur le site est ferme et définitive après confirmation du paiement. Les annulations sont possibles jusqu'à 48 heures avant la date de l'atelier. Un remboursement complet sera effectué dans ce délai.</p>
                    </div>
                </div>

                {{-- Cookies --}}
                <div>
                    <div class="flex items-center gap-3 mb-4">
                        <div class="w-9 h-9 rounded-lg bg-purple-50 flex items-center justify-center flex-shrink-0">
                            <svg class="w-4 h-4 text-purple-500" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
                        </div>
                        <h2 class="text-[18px] font-bold text-dark">Cookies</h2>
                    </div>
                    <div class="pl-12">
                        <p class="text-[14px] text-beige-500 leading-relaxed">Le site utilise des cookies nécessaires à son bon fonctionnement (session, CSRF). En naviguant sur le site, vous acceptez l'utilisation de ces cookies techniques.</p>
                    </div>
                </div>

            </div>

            {{-- Dernière mise à jour --}}
            <p class="text-center text-[12px] text-beige-400 mt-6">Dernière mise à jour : {{ date('F Y') }}</p>
        </div>
    </section>

@endsection