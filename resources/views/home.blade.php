@extends('layouts.app')
@section('title', 'AfroCook Experience — Cuisine Africaine en Duo')

@section('content')

    {{-- ═══ HERO avec image de fond ═══ --}}
    <section class="relative bg-dark overflow-hidden">
        <div class="absolute inset-0">
            <img src="https://images.unsplash.com/photo-1504674900247-0877df9cc836?w=1600&q=80" alt="" class="w-full h-full object-cover opacity-25">
            <div class="absolute inset-0 bg-gradient-to-r from-dark via-dark/90 to-dark/50"></div>
        </div>
        <div class="absolute -top-32 -right-32 w-96 h-96 rounded-full bg-brand-500/10 blur-[120px]"></div>

        <div class="relative z-10 max-w-7xl mx-auto px-5 sm:px-8 lg:px-10 py-28 sm:py-36 lg:py-44">
            <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-white/5 border border-white/10 mb-8">
                <span class="w-2 h-2 rounded-full bg-brand-400 animate-pulse"></span>
                <span class="text-[12px] font-semibold text-white/70 uppercase tracking-widest">Cuisine Africaine en Duo</span>
            </div>

            <h1 class="text-4xl sm:text-5xl lg:text-6xl font-extrabold text-white leading-[1.08] tracking-tight max-w-2xl mb-6">
                Vivez une expérience culinaire <span class="text-brand-400 italic">inoubliable</span>
            </h1>

            <p class="text-base sm:text-lg text-white/50 max-w-xl leading-relaxed mb-10">
                Réservez un atelier de cuisine africaine authentique à Cotonou. En couple, entre amis ou en famille — découvrez, apprenez et savourez ensemble.
            </p>

            <div class="flex flex-wrap gap-4">
                <a href="{{ route('ateliers.index') }}" class="inline-flex items-center gap-2 px-7 py-3.5 bg-brand-500 hover:bg-brand-600 text-white text-sm font-semibold rounded-xl transition-all duration-200 hover:shadow-lg hover:shadow-brand-500/25">
                    Découvrir nos ateliers
                    <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 12h14"/><polyline points="12 5 19 12 12 19"/></svg>
                </a>
                <a href="{{ route('a-propos') }}" class="inline-flex items-center gap-2 px-7 py-3.5 border border-white/20 hover:border-white/40 text-white text-sm font-semibold rounded-xl transition-all duration-200 hover:bg-white/5">
                    En savoir plus
                </a>
            </div>
        </div>
    </section>

    {{-- ═══ STATS ANIMÉES — Section séparée du hero ═══ --}}
    <section class="bg-dark-200 border-y border-white/5">
        <div class="max-w-5xl mx-auto px-5 sm:px-8 lg:px-10 py-14">
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-10 sm:gap-4 text-center">
                <div class="stat-item">
                    <p class="text-3xl sm:text-4xl font-extrabold text-white tracking-tight">
                        <span class="counter" data-target="6">0</span><span class="text-brand-400">+</span>
                    </p>
                    <p class="text-[14px] text-white/40 mt-2">Ateliers disponibles</p>
                </div>
                <div class="stat-item relative">
                    <div class="hidden sm:block absolute left-0 top-1/2 -translate-y-1/2 w-px h-12 bg-white/8"></div>
                    <p class="text-3xl sm:text-4xl font-extrabold text-white tracking-tight">
                        <span class="counter" data-target="500">0</span><span class="text-brand-400">+</span>
                    </p>
                    <p class="text-[14px] text-white/40 mt-2">Participants ravis</p>
                </div>
                <div class="stat-item relative">
                    <div class="hidden sm:block absolute left-0 top-1/2 -translate-y-1/2 w-px h-12 bg-white/8"></div>
                    <p class="text-3xl sm:text-4xl font-extrabold text-white tracking-tight">
                        <span class="counter" data-target="48" data-decimal="true">0</span>
                    </p>
                    <p class="text-[14px] text-white/40 mt-2">Note moyenne sur 5</p>
                </div>
            </div>
        </div>
    </section>

    {{-- ═══ COMMENT ÇA MARCHE ═══ --}}
    <section class="bg-beige-50 py-20 sm:py-24">
        <div class="max-w-7xl mx-auto px-5 sm:px-8 lg:px-10">
            <div class="text-center mb-16">
                <p class="text-[11px] font-bold uppercase tracking-[3px] text-brand-500 mb-3">Processus</p>
                <h2 class="text-3xl sm:text-4xl font-extrabold text-dark tracking-tight">Comment ça marche ?</h2>
                <p class="text-[15px] text-beige-500 mt-3 max-w-lg mx-auto leading-relaxed">
                    De la découverte à la dégustation, votre expérience culinaire se déroule en trois étapes simples.
                </p>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-3 gap-8">
                {{-- Étape 1 --}}
                <div class="bg-white rounded-2xl p-8 border border-beige-200/60 group hover:border-brand-200 hover:shadow-lg hover:shadow-brand-500/5 transition-all duration-300">
                    <div class="flex items-center gap-4 mb-5">
                        <div class="w-12 h-12 rounded-xl bg-brand-50 flex items-center justify-center group-hover:bg-brand-500 transition-colors duration-300">
                            <svg class="w-6 h-6 text-brand-500 group-hover:text-white transition-colors duration-300" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                                <circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/>
                            </svg>
                        </div>
                        <span class="text-[13px] font-bold text-brand-500 bg-brand-50 px-3 py-1 rounded-lg">Étape 1</span>
                    </div>
                    <h3 class="text-lg font-bold text-dark mb-3">Explorez et choisissez</h3>
                    <p class="text-[14px] text-beige-500 leading-relaxed">
                        Parcourez notre catalogue d'ateliers de cuisine africaine. Jollof Rice sénégalais, Poulet DG camerounais, Pâte Rouge béninoise — chaque atelier est une aventure culinaire unique. Filtrez par pays, par plat ou par prix pour trouver l'expérience qui vous correspond.
                    </p>
                </div>

                {{-- Étape 2 --}}
                <div class="bg-white rounded-2xl p-8 border border-beige-200/60 group hover:border-brand-200 hover:shadow-lg hover:shadow-brand-500/5 transition-all duration-300">
                    <div class="flex items-center gap-4 mb-5">
                        <div class="w-12 h-12 rounded-xl bg-emerald-50 flex items-center justify-center group-hover:bg-emerald-500 transition-colors duration-300">
                            <svg class="w-6 h-6 text-emerald-500 group-hover:text-white transition-colors duration-300" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/>
                            </svg>
                        </div>
                        <span class="text-[13px] font-bold text-emerald-600 bg-emerald-50 px-3 py-1 rounded-lg">Étape 2</span>
                    </div>
                    <h3 class="text-lg font-bold text-dark mb-3">Réservez en toute sécurité</h3>
                    <p class="text-[14px] text-beige-500 leading-relaxed">
                        Choisissez votre créneau sur le calendrier, indiquez le nombre de participants (2 à 6 personnes) et payez en ligne via KkiaPay. Votre confirmation est instantanée avec un récapitulatif complet envoyé par email.
                    </p>
                </div>

                {{-- Étape 3 --}}
                <div class="bg-white rounded-2xl p-8 border border-beige-200/60 group hover:border-brand-200 hover:shadow-lg hover:shadow-brand-500/5 transition-all duration-300">
                    <div class="flex items-center gap-4 mb-5">
                        <div class="w-12 h-12 rounded-xl bg-amber-50 flex items-center justify-center group-hover:bg-amber-500 transition-colors duration-300">
                            <svg class="w-6 h-6 text-amber-500 group-hover:text-white transition-colors duration-300" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M18 8h1a4 4 0 0 1 0 8h-1"/><path d="M2 8h16v9a4 4 0 0 1-4 4H6a4 4 0 0 1-4-4V8z"/>
                                <line x1="6" y1="1" x2="6" y2="4"/><line x1="10" y1="1" x2="10" y2="4"/><line x1="14" y1="1" x2="14" y2="4"/>
                            </svg>
                        </div>
                        <span class="text-[13px] font-bold text-amber-600 bg-amber-50 px-3 py-1 rounded-lg">Étape 3</span>
                    </div>
                    <h3 class="text-lg font-bold text-dark mb-3">Cuisinez et savourez</h3>
                    <p class="text-[14px] text-beige-500 leading-relaxed">
                        Le jour J, un chef professionnel vous accueille et vous guide pas à pas dans la préparation du plat. Vous cuisinez en duo avec des ingrédients frais et locaux. À la fin, vous dégustez votre création ensemble dans une ambiance conviviale et chaleureuse.
                    </p>
                </div>
            </div>
        </div>
    </section>

    {{-- ═══ ATELIERS VEDETTES (6) ═══ --}}
    <section class="bg-white py-20 sm:py-24">
        <div class="max-w-7xl mx-auto px-5 sm:px-8 lg:px-10">
            <div class="text-center mb-14">
                <p class="text-[11px] font-bold uppercase tracking-[3px] text-brand-500 mb-3">Expériences</p>
                <h2 class="text-3xl sm:text-4xl font-extrabold text-dark tracking-tight">Nos ateliers vedettes</h2>
                <p class="text-[15px] text-beige-500 mt-3 max-w-lg mx-auto leading-relaxed">
                    Les expériences culinaires les plus appréciées par nos participants à Cotonou
                </p>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse($ateliers as $atelier)
                    <a href="{{ route('ateliers.show', $atelier->slug) }}" class="block bg-beige-50 rounded-2xl overflow-hidden border border-beige-200/60 group hover:shadow-2xl hover:shadow-brand-500/10 hover:border-brand-300 transition-all duration-300 hover:-translate-y-1.5 cursor-pointer">
                        {{-- Image --}}
                        <div class="relative h-56 overflow-hidden">
                            @if($atelier->photo)
                                <img src="{{ asset('storage/' . $atelier->photo) }}" alt="{{ $atelier->titre }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                            @else
                                <div class="w-full h-full bg-gradient-to-br from-beige-100 to-beige-200 flex items-center justify-center">
                                    <svg class="w-14 h-14 text-beige-300" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1">
                                        <path d="M18 8h1a4 4 0 0 1 0 8h-1"/><path d="M2 8h16v9a4 4 0 0 1-4 4H6a4 4 0 0 1-4-4V8z"/>
                                        <line x1="6" y1="1" x2="6" y2="4"/><line x1="10" y1="1" x2="10" y2="4"/><line x1="14" y1="1" x2="14" y2="4"/>
                                    </svg>
                                </div>
                            @endif
                            {{-- Badge pays avec drapeau --}}
                            <span class="absolute top-3 left-3 inline-flex items-center gap-1.5 px-3 py-1.5 bg-white/90 backdrop-blur-sm text-dark text-[12px] font-bold rounded-lg">
                                @php
                                    $drapeaux = [
                                        'Bénin' => 'bj', 'Sénégal' => 'sn', 'Cameroun' => 'cm',
                                        'Togo' => 'tg', 'Nigeria' => 'ng', 'Ghana' => 'gh',
                                        "Côte d'Ivoire" => 'ci', 'Mali' => 'ml', 'Niger' => 'ne',
                                        'Guinée' => 'gn', 'Gabon' => 'ga', 'Congo' => 'cg',
                                        'Maroc' => 'ma', 'Tunisie' => 'tn', 'Algérie' => 'dz',
                                    ];
                                    $iso = $drapeaux[$atelier->origine_pays] ?? null;
                                @endphp
                                @if($iso)
                                    <img src="https://flagcdn.com/w20/{{ $iso }}.png" alt="{{ $atelier->origine_pays }}" class="w-5 h-3.5 rounded-sm object-cover">
                                @endif
                                {{ $atelier->origine_pays }}
                            </span>
                        </div>

                        {{-- Contenu --}}
                        <div class="p-5">
                            <h3 class="text-[17px] font-bold text-dark mb-2">{{ $atelier->titre }}</h3>
                            <p class="text-[13px] text-beige-500 leading-relaxed mb-4">{{ Str::limit($atelier->description, 100) }}</p>

                            {{-- Meta --}}
                            <div class="flex items-center gap-5 mb-5">
                                <span class="flex items-center gap-1.5 text-[13px] text-beige-400">
                                    <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                                    {{ $atelier->duree_minutes }} min
                                </span>
                                <span class="flex items-center gap-1.5 text-[13px] text-beige-400">
                                    <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/></svg>
                                    {{ $atelier->max_participants }} pers. max
                                </span>
                            </div>

                            {{-- Prix + lien --}}
                            <div class="flex items-center justify-between pt-4 border-t border-beige-200">
                                <span class="text-xl font-extrabold text-brand-600">
                                    {{ number_format($atelier->prix, 0, ',', ' ') }}
                                    <span class="text-[13px] font-semibold text-beige-400">FCFA</span>
                                </span>
                                <span class="inline-flex items-center gap-1.5 text-[13px] font-semibold text-brand-500 group-hover:text-brand-700 transition-colors">
                                    Découvrir
                                    <svg class="w-4 h-4 transition-transform group-hover:translate-x-1" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 12h14"/><polyline points="12 5 19 12 12 19"/></svg>
                                </span>
                            </div>
                        </div>
                    </a>
                @empty
                    <div class="col-span-full text-center py-16">
                        <svg class="w-12 h-12 text-beige-200 mx-auto mb-3" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1"><path d="M18 8h1a4 4 0 0 1 0 8h-1"/><path d="M2 8h16v9a4 4 0 0 1-4 4H6a4 4 0 0 1-4-4V8z"/></svg>
                        <p class="text-[15px] text-beige-400">Aucun atelier disponible pour le moment.</p>
                    </div>
                @endforelse
            </div>

            <div class="text-center mt-12">
                <a href="{{ route('ateliers.index') }}" class="inline-flex items-center gap-2 px-7 py-3.5 bg-brand-500 hover:bg-brand-600 text-white text-[14px] font-semibold rounded-xl transition-all duration-200 hover:shadow-lg hover:shadow-brand-500/20">
                    Voir tous les ateliers
                    <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 12h14"/><polyline points="12 5 19 12 12 19"/></svg>
                </a>
            </div>
        </div>
    </section>

    {{-- ═══ NOS VALEURS ═══ --}}
    <section class="bg-beige-50 py-20 sm:py-24">
        <div class="max-w-7xl mx-auto px-5 sm:px-8 lg:px-10">
            <div class="text-center mb-14">
                <p class="text-[11px] font-bold uppercase tracking-[3px] text-brand-500 mb-3">Nos engagements</p>
                <h2 class="text-3xl sm:text-4xl font-extrabold text-dark tracking-tight">Pourquoi AfroCook Experience ?</h2>
                <p class="text-[15px] text-beige-500 mt-3 max-w-lg mx-auto leading-relaxed">
                    Chaque détail est pensé pour vous offrir une expérience culinaire mémorable et authentique.
                </p>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">
                {{-- Authenticité --}}
                <div class="bg-white p-7 rounded-2xl border border-beige-200/60 group hover:border-brand-200 hover:shadow-lg hover:shadow-brand-500/5 transition-all duration-300">
                    <div class="w-12 h-12 rounded-xl bg-brand-50 flex items-center justify-center mb-5 group-hover:bg-brand-500 transition-colors duration-300">
                        <svg class="w-6 h-6 text-brand-500 group-hover:text-white transition-colors duration-300" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                            <circle cx="12" cy="12" r="10"/><path d="M2 12h20"/><path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"/>
                        </svg>
                    </div>
                    <h3 class="text-[16px] font-bold text-dark mb-2">Authenticité garantie</h3>
                    <p class="text-[13px] text-beige-500 leading-relaxed">Des recettes traditionnelles africaines transmises de génération en génération par des chefs passionnés originaires du Bénin, du Sénégal, du Cameroun et d'ailleurs.</p>
                </div>

                {{-- Qualité --}}
                <div class="bg-white p-7 rounded-2xl border border-beige-200/60 group hover:border-emerald-200 hover:shadow-lg hover:shadow-emerald-500/5 transition-all duration-300">
                    <div class="w-12 h-12 rounded-xl bg-emerald-50 flex items-center justify-center mb-5 group-hover:bg-emerald-500 transition-colors duration-300">
                        <svg class="w-6 h-6 text-emerald-500 group-hover:text-white transition-colors duration-300" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                            <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/>
                        </svg>
                    </div>
                    <h3 class="text-[16px] font-bold text-dark mb-2">Ingrédients de qualité</h3>
                    <p class="text-[13px] text-beige-500 leading-relaxed">Chaque ingrédient est soigneusement sélectionné auprès de producteurs locaux. Des produits frais, écologiques et contrôlés pour garantir le meilleur goût possible.</p>
                </div>

                {{-- Partage --}}
                <div class="bg-white p-7 rounded-2xl border border-beige-200/60 group hover:border-rose-200 hover:shadow-lg hover:shadow-rose-500/5 transition-all duration-300">
                    <div class="w-12 h-12 rounded-xl bg-rose-50 flex items-center justify-center mb-5 group-hover:bg-rose-500 transition-colors duration-300">
                        <svg class="w-6 h-6 text-rose-500 group-hover:text-white transition-colors duration-300" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                            <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"/>
                        </svg>
                    </div>
                    <h3 class="text-[16px] font-bold text-dark mb-2">Moments de partage</h3>
                    <p class="text-[13px] text-beige-500 leading-relaxed">En couple, entre amis ou en famille — les ateliers en duo sont conçus pour renforcer vos liens à travers la cuisine. Des souvenirs mémorables à créer à deux.</p>
                </div>

                {{-- Expertise --}}
                <div class="bg-white p-7 rounded-2xl border border-beige-200/60 group hover:border-amber-200 hover:shadow-lg hover:shadow-amber-500/5 transition-all duration-300">
                    <div class="w-12 h-12 rounded-xl bg-amber-50 flex items-center justify-center mb-5 group-hover:bg-amber-500 transition-colors duration-300">
                        <svg class="w-6 h-6 text-amber-500 group-hover:text-white transition-colors duration-300" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                            <circle cx="12" cy="8" r="7"/><polyline points="8.21 13.89 7 23 12 20 17 23 15.79 13.88"/>
                        </svg>
                    </div>
                    <h3 class="text-[16px] font-bold text-dark mb-2">Chefs professionnels</h3>
                    <p class="text-[13px] text-beige-500 leading-relaxed">Nos chefs sont des professionnels expérimentés qui vous accompagnent pas à pas. Ils partagent leurs techniques, astuces et secrets pour réussir chaque recette.</p>
                </div>
            </div>
        </div>
    </section>

    {{-- ═══ GALERIE — Souvenirs de nos participants ═══ --}}
    <section class="bg-white py-20 sm:py-24">
        <div class="max-w-7xl mx-auto px-5 sm:px-8 lg:px-10">
            <div class="text-center mb-14">
                <p class="text-[11px] font-bold uppercase tracking-[3px] text-brand-500 mb-3">Souvenirs</p>
                <h2 class="text-3xl sm:text-4xl font-extrabold text-dark tracking-tight">Ils ont vécu l'expérience</h2>
                <p class="text-[15px] text-beige-500 mt-3 max-w-lg mx-auto leading-relaxed">
                    Des moments de partage capturés après le passage de nos participants
                </p>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-4">
                {{-- Photo 1 --}}
                <div class="relative rounded-2xl overflow-hidden group h-72 lg:h-80">
                    <img src="https://images.unsplash.com/photo-1556910103-1c02745aae4d?w=600&q=80" alt="Couple en cuisine" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                    <div class="absolute inset-0 bg-gradient-to-t from-dark/80 via-transparent to-transparent"></div>
                    <div class="absolute bottom-0 left-0 right-0 p-4">
                        <p class="text-white text-[13px] font-semibold">Amara & Kofi</p>
                        <p class="text-white/60 text-[11px]">« Une soirée magique à deux » — Jan. 2026</p>
                    </div>
                </div>

                {{-- Photo 2 --}}
                <div class="relative rounded-2xl overflow-hidden group h-72 lg:h-80">
                    <img src="https://images.unsplash.com/photo-1507048331197-7d4ac70811cf?w=600&q=80" alt="Amis en atelier" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                    <div class="absolute inset-0 bg-gradient-to-t from-dark/80 via-transparent to-transparent"></div>
                    <div class="absolute bottom-0 left-0 right-0 p-4">
                        <p class="text-white text-[13px] font-semibold">Fatou & Issa</p>
                        <p class="text-white/60 text-[11px]">« Le Jollof Rice parfait ! » — Fév. 2026</p>
                    </div>
                </div>

                {{-- Photo 3 --}}
                <div class="relative rounded-2xl overflow-hidden group h-72 lg:h-80">
                    <img src="https://images.unsplash.com/photo-1551218808-94e220e084d2?w=600&q=80" alt="Cuisine ensemble" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                    <div class="absolute inset-0 bg-gradient-to-t from-dark/80 via-transparent to-transparent"></div>
                    <div class="absolute bottom-0 left-0 right-0 p-4">
                        <p class="text-white text-[13px] font-semibold">Marie & Jean</p>
                        <p class="text-white/60 text-[11px]">« Anniversaire inoubliable » — Fév. 2026</p>
                    </div>
                </div>

                {{-- Photo 4 --}}
                <div class="relative rounded-2xl overflow-hidden group h-72 lg:h-80">
                    <img src="https://images.unsplash.com/photo-1528712306091-ed0763094c98?w=600&q=80" alt="Plat africain" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                    <div class="absolute inset-0 bg-gradient-to-t from-dark/80 via-transparent to-transparent"></div>
                    <div class="absolute bottom-0 left-0 right-0 p-4">
                        <p class="text-white text-[13px] font-semibold">Séna & David</p>
                        <p class="text-white/60 text-[11px]">« Poulet DG réussi du premier coup » — Mars 2026</p>
                    </div>
                </div>

                {{-- Photo 5 --}}
                <div class="relative rounded-2xl overflow-hidden group h-72 lg:h-80">
                    <img src="https://images.unsplash.com/photo-1414235077428-338989a2e8c0?w=600&q=80" alt="Dégustation" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                    <div class="absolute inset-0 bg-gradient-to-t from-dark/80 via-transparent to-transparent"></div>
                    <div class="absolute bottom-0 left-0 right-0 p-4">
                        <p class="text-white text-[13px] font-semibold">Aïcha & Paul</p>
                        <p class="text-white/60 text-[11px]">« Découverte culinaire exceptionnelle » — Mars 2026</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- ═══ TÉMOIGNAGES ═══ --}}
    @if($avis->count() > 0)
    <section class="bg-beige-50 py-20 sm:py-24">
        <div class="max-w-7xl mx-auto px-5 sm:px-8 lg:px-10">
            <div class="text-center mb-14">
                <p class="text-[11px] font-bold uppercase tracking-[3px] text-brand-500 mb-3">Témoignages</p>
                <h2 class="text-3xl sm:text-4xl font-extrabold text-dark tracking-tight">Ce que disent nos participants</h2>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5">
                @foreach($avis as $unAvis)
                    <div class="bg-white rounded-2xl p-6 border border-beige-200/60">
                        <div class="flex gap-0.5 mb-4">
                            @for($i = 1; $i <= 5; $i++)
                                <svg class="w-4 h-4 {{ $i <= $unAvis->note ? 'text-amber-400' : 'text-beige-200' }}" viewBox="0 0 24 24" fill="currentColor">
                                    <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/>
                                </svg>
                            @endfor
                        </div>
                        <p class="text-[14px] text-dark-50 leading-relaxed italic mb-5">« {{ Str::limit($unAvis->commentaire, 140) }} »</p>
                        <div class="flex items-center gap-3 pt-4 border-t border-beige-100">
                            <div class="w-9 h-9 rounded-lg bg-brand-50 flex items-center justify-center">
                                <span class="text-[11px] font-bold text-brand-600">{{ strtoupper(mb_substr($unAvis->user->name, 0, 2)) }}</span>
                            </div>
                            <div>
                                <p class="text-sm font-semibold text-dark">{{ $unAvis->user->name }}</p>
                                <p class="text-[11px] text-beige-400">{{ $unAvis->atelier->titre }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    @endif

    {{-- ═══ CTA FINAL — Carte séparée du footer ═══ --}}
    <section class="bg-beige-200 py-16 sm:py-20">
        <div class="max-w-4xl mx-auto px-5 sm:px-8 lg:px-10">
            <div class="relative bg-dark rounded-3xl p-10 sm:p-14 text-center overflow-hidden">
                {{-- Orbes décoratifs --}}
                <div class="absolute -top-20 -left-20 w-72 h-72 rounded-full bg-brand-500/10 blur-[100px]"></div>
                <div class="absolute -bottom-20 -right-20 w-64 h-64 rounded-full bg-brand-400/8 blur-[80px]"></div>

                <div class="relative z-10">
                    <h2 class="text-3xl sm:text-4xl font-extrabold text-white tracking-tight mb-4" style="font-family:'Cormorant Garamond',serif;">
                        Prêts à cuisiner <span class="text-brand-400 italic">ensemble</span> ?
                    </h2>
                    <p class="text-[15px] text-white/40 max-w-lg mx-auto mb-8 leading-relaxed">
                        Réservez votre atelier de cuisine africaine en duo et vivez une expérience unique à Cotonou.
                    </p>
                    <a href="{{ route('ateliers.index') }}" class="inline-flex items-center gap-2 px-8 py-4 bg-brand-500 hover:bg-brand-600 text-white text-[15px] font-semibold rounded-xl transition-all duration-200 hover:shadow-lg hover:shadow-brand-500/25">
                        Réserver maintenant
                        <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 12h14"/><polyline points="12 5 19 12 12 19"/></svg>
                    </a>
                </div>
            </div>
        </div>
    </section>

@endsection

@push('scripts')
<script>
(function() {
    /* Animation compteur avec easing */
    var counters = document.querySelectorAll('.counter');
    var animated = false;

    function animateCounters() {
        counters.forEach(function(el) {
            var target = parseInt(el.getAttribute('data-target'));
            var isDecimal = el.getAttribute('data-decimal') === 'true';
            var duration = 1800;
            var startTime = null;

            function step(timestamp) {
                if (!startTime) startTime = timestamp;
                var progress = Math.min((timestamp - startTime) / duration, 1);
                var ease = 1 - Math.pow(1 - progress, 4);
                var current = Math.floor(ease * target);

                el.textContent = isDecimal ? (current / 10).toFixed(1) : current;
                if (progress < 1) requestAnimationFrame(step);
            }
            requestAnimationFrame(step);
        });
    }

    /* Déclencher quand la section stats est visible */
    var statsEl = document.querySelector('.stat-item');
    if (statsEl) {
        var obs = new IntersectionObserver(function(entries) {
            if (entries[0].isIntersecting && !animated) {
                animated = true;
                animateCounters();
            }
        }, { threshold: 0.3 });
        obs.observe(statsEl);
    }
})();
</script>
@endpush