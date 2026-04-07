@extends('layouts.app')
@section('title', 'À Propos — AfroCook Experience')

@section('content')

    {{-- Header --}}
    <section class="relative py-16 sm:py-20 text-center overflow-hidden">
        <div class="absolute inset-0">
            <img src="https://images.unsplash.com/photo-1507048331197-7d4ac70811cf?w=1200&q=80" alt="" class="w-full h-full object-cover">
            <div class="absolute inset-0 bg-dark/75"></div>
        </div>
        <div class="relative z-10 max-w-7xl mx-auto px-5 sm:px-8 lg:px-10">
            <h1 class="text-3xl sm:text-4xl font-extrabold text-white tracking-tight mb-3">À Propos</h1>
            <p class="text-[15px] text-white/50 max-w-md mx-auto">Découvrez l'histoire et la mission d'AfroCook Experience</p>
        </div>
    </section>

    {{-- Notre histoire --}}
    <section class="bg-white py-16 sm:py-20">
        <div class="max-w-7xl mx-auto px-5 sm:px-8 lg:px-10">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                {{-- Texte --}}
                <div>
                    <p class="text-[11px] font-bold uppercase tracking-[3px] text-brand-500 mb-3">Notre histoire</p>
                    <h2 class="text-2xl sm:text-3xl font-extrabold text-dark tracking-tight mb-6 leading-tight">
                        La passion de la cuisine africaine, partagée à deux
                    </h2>
                    <div class="space-y-4">
                        <p class="text-[15px] text-beige-500 leading-relaxed">
                            AfroCook Experience est né d'une conviction simple : la gastronomie africaine mérite d'être découverte, partagée et célébrée. Riche de saveurs uniques et de traditions culinaires ancestrales, elle reste pourtant insuffisamment représentée dans le monde digital.
                        </p>
                        <p class="text-[15px] text-beige-500 leading-relaxed">
                            Notre plateforme a été conçue pour offrir une expérience immersive, où chaque duo — couple, amis ou famille — peut apprendre à cuisiner des plats authentiques sous la guidance de chefs professionnels passionnés.
                        </p>
                        <p class="text-[15px] text-beige-500 leading-relaxed">
                            Basés à Cotonou, au Bénin, nous sommes fiers de contribuer à la valorisation de notre patrimoine culinaire tout en créant des moments de partage inoubliables.
                        </p>
                    </div>
                </div>
                {{-- Image --}}
                <div class="relative rounded-2xl overflow-hidden h-80 lg:h-96">
                    <img src="https://images.unsplash.com/photo-1556910103-1c02745aae4d?w=800&q=80" alt="Cuisine africaine" class="w-full h-full object-cover">
                    <div class="absolute inset-0 bg-gradient-to-t from-dark/30 to-transparent"></div>
                </div>
            </div>
        </div>
    </section>

    {{-- Notre mission --}}
    <section class="bg-beige-50 py-16 sm:py-20">
        <div class="max-w-7xl mx-auto px-5 sm:px-8 lg:px-10">
            <div class="text-center mb-14">
                <p class="text-[11px] font-bold uppercase tracking-[3px] text-brand-500 mb-3">Notre mission</p>
                <h2 class="text-2xl sm:text-3xl font-extrabold text-dark tracking-tight">Ce qui nous anime</h2>
                <p class="text-[15px] text-beige-500 mt-3 max-w-lg mx-auto">Trois piliers fondamentaux guident chacune de nos actions</p>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
                {{-- Pilier 1 --}}
                <div class="bg-white p-7 rounded-2xl border border-beige-200/60 text-center group hover:border-brand-200 hover:shadow-lg hover:shadow-brand-500/5 transition-all duration-300">
                    <div class="w-14 h-14 rounded-xl bg-brand-50 flex items-center justify-center mx-auto mb-5 group-hover:bg-brand-500 transition-colors duration-300">
                        <svg class="w-6 h-6 text-brand-500 group-hover:text-white transition-colors duration-300" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                            <circle cx="12" cy="12" r="10"/><path d="M2 12h20"/><path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"/>
                        </svg>
                    </div>
                    <h3 class="text-[17px] font-bold text-dark mb-3">Valoriser la gastronomie</h3>
                    <p class="text-[14px] text-beige-500 leading-relaxed">Mettre en lumière la richesse et la diversité des cuisines d'Afrique à travers des expériences concrètes et accessibles à tous.</p>
                </div>

                {{-- Pilier 2 --}}
                <div class="bg-white p-7 rounded-2xl border border-beige-200/60 text-center group hover:border-rose-200 hover:shadow-lg hover:shadow-rose-500/5 transition-all duration-300">
                    <div class="w-14 h-14 rounded-xl bg-rose-50 flex items-center justify-center mx-auto mb-5 group-hover:bg-rose-500 transition-colors duration-300">
                        <svg class="w-6 h-6 text-rose-500 group-hover:text-white transition-colors duration-300" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                            <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/>
                            <path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/>
                        </svg>
                    </div>
                    <h3 class="text-[17px] font-bold text-dark mb-3">Créer du lien humain</h3>
                    <p class="text-[14px] text-beige-500 leading-relaxed">Offrir des moments de partage authentiques entre participants, dans une ambiance conviviale et chaleureuse autour de la cuisine.</p>
                </div>

                {{-- Pilier 3 --}}
                <div class="bg-white p-7 rounded-2xl border border-beige-200/60 text-center group hover:border-blue-200 hover:shadow-lg hover:shadow-blue-500/5 transition-all duration-300">
                    <div class="w-14 h-14 rounded-xl bg-blue-50 flex items-center justify-center mx-auto mb-5 group-hover:bg-blue-500 transition-colors duration-300">
                        <svg class="w-6 h-6 text-blue-500 group-hover:text-white transition-colors duration-300" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                            <rect x="2" y="3" width="20" height="14" rx="2" ry="2"/><line x1="8" y1="21" x2="16" y2="21"/><line x1="12" y1="17" x2="12" y2="21"/>
                        </svg>
                    </div>
                    <h3 class="text-[17px] font-bold text-dark mb-3">Digitaliser l'expérience</h3>
                    <p class="text-[14px] text-beige-500 leading-relaxed">Simplifier la réservation et l'organisation grâce à une plateforme moderne, intuitive et sécurisée via KkiaPay.</p>
                </div>
            </div>
        </div>
    </section>

    {{-- L'équipe --}}
    <section class="bg-white py-16 sm:py-20">
        <div class="max-w-7xl mx-auto px-5 sm:px-8 lg:px-10">
            <div class="text-center mb-14">
                <p class="text-[11px] font-bold uppercase tracking-[3px] text-brand-500 mb-3">L'équipe</p>
                <h2 class="text-2xl sm:text-3xl font-extrabold text-dark tracking-tight">Les visages d'AfroCook Experience</h2>
                <p class="text-[15px] text-beige-500 mt-3 max-w-lg mx-auto">Des passionnés au service de votre expérience culinaire</p>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
                {{-- Fondateur --}}
                <div class="bg-beige-50 rounded-2xl overflow-hidden border border-beige-200/60 group hover:shadow-lg hover:shadow-dark/5 transition-all duration-300">
                    <div class="h-64 overflow-hidden">
                        @if(file_exists(public_path('images/equipe/fondateur.jpg')))
                            <img src="{{ asset('images/equipe/fondateur.jpg') }}" alt="Fondateur" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                        @else
                            <div class="w-full h-full bg-gradient-to-br from-brand-50 to-beige-100 flex flex-col items-center justify-center">
                                <div class="w-20 h-20 rounded-2xl bg-brand-100 flex items-center justify-center mb-3">
                                    <svg class="w-10 h-10 text-brand-400" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                                </div>
                                <p class="text-[11px] text-beige-400">Photo à venir</p>
                            </div>
                        @endif
                    </div>
                    <div class="p-5 text-center">
                        <h3 class="text-[16px] font-bold text-dark mb-1">Fondateur</h3>
                        <p class="text-[13px] text-beige-500">Direction & Vision</p>
                    </div>
                </div>

                {{-- Chef principal --}}
                <div class="bg-beige-50 rounded-2xl overflow-hidden border border-beige-200/60 group hover:shadow-lg hover:shadow-dark/5 transition-all duration-300">
                    <div class="h-64 overflow-hidden">
                        @if(file_exists(public_path('images/equipe/chef-amina.jpg')))
                            <img src="{{ asset('images/equipe/chef-amina.jpg') }}" alt="Chef Amina" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                        @else
                            <div class="w-full h-full bg-gradient-to-br from-amber-50 to-beige-100 flex flex-col items-center justify-center">
                                <div class="w-20 h-20 rounded-2xl bg-amber-100 flex items-center justify-center mb-3">
                                    <svg class="w-10 h-10 text-amber-400" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M18 8h1a4 4 0 0 1 0 8h-1"/><path d="M2 8h16v9a4 4 0 0 1-4 4H6a4 4 0 0 1-4-4V8z"/></svg>
                                </div>
                                <p class="text-[11px] text-beige-400">Photo à venir</p>
                            </div>
                        @endif
                    </div>
                    <div class="p-5 text-center">
                        <h3 class="text-[16px] font-bold text-dark mb-1">Chef Amina</h3>
                        <p class="text-[13px] text-beige-500">Chef Cuisinier Principal</p>
                    </div>
                </div>

                {{-- Support --}}
                <div class="bg-beige-50 rounded-2xl overflow-hidden border border-beige-200/60 group hover:shadow-lg hover:shadow-dark/5 transition-all duration-300">
                    <div class="h-64 overflow-hidden">
                        @if(file_exists(public_path('images/equipe/support.jpg')))
                            <img src="{{ asset('images/equipe/support.jpg') }}" alt="Équipe Support" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                        @else
                            <div class="w-full h-full bg-gradient-to-br from-blue-50 to-beige-100 flex flex-col items-center justify-center">
                                <div class="w-20 h-20 rounded-2xl bg-blue-100 flex items-center justify-center mb-3">
                                    <svg class="w-10 h-10 text-blue-400" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
                                </div>
                                <p class="text-[11px] text-beige-400">Photo à venir</p>
                            </div>
                        @endif
                    </div>
                    <div class="p-5 text-center">
                        <h3 class="text-[16px] font-bold text-dark mb-1">Équipe Support</h3>
                        <p class="text-[13px] text-beige-500">Relation Client 24/7</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Chiffres clés --}}
    <section class="bg-dark py-14 sm:py-16">
        <div class="max-w-5xl mx-auto px-5 sm:px-8 lg:px-10">
            <div class="grid grid-cols-2 sm:grid-cols-4 gap-8 text-center">
                <div>
                    <p class="text-3xl font-extrabold text-white tracking-tight">12+</p>
                    <p class="text-[13px] text-white/40 mt-1">Ateliers</p>
                </div>
                <div>
                    <p class="text-3xl font-extrabold text-white tracking-tight">500+</p>
                    <p class="text-[13px] text-white/40 mt-1">Participants</p>
                </div>
                <div>
                    <p class="text-3xl font-extrabold text-white tracking-tight">8</p>
                    <p class="text-[13px] text-white/40 mt-1">Pays représentés</p>
                </div>
                <div>
                    <p class="text-3xl font-extrabold text-white tracking-tight">4.8</p>
                    <p class="text-[13px] text-white/40 mt-1">Note moyenne</p>
                </div>
            </div>
        </div>
    </section>

    {{-- CTA --}}
    <section class="bg-beige-50 py-14 sm:py-16 text-center">
        <div class="max-w-7xl mx-auto px-5 sm:px-8 lg:px-10">
            <h2 class="text-2xl sm:text-3xl font-extrabold text-dark tracking-tight mb-3">Envie de tenter l'expérience ?</h2>
            <p class="text-[15px] text-beige-500 mb-8 max-w-md mx-auto">Réservez votre premier atelier de cuisine africaine en duo à Cotonou.</p>
            <a href="{{ route('ateliers.index') }}" class="inline-flex items-center gap-2 px-7 py-3.5 bg-brand-500 hover:bg-brand-600 text-white text-[14px] font-semibold rounded-xl transition-all duration-200 hover:shadow-lg hover:shadow-brand-500/20">
                Découvrir nos ateliers
                <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 12h14"/><polyline points="12 5 19 12 12 19"/></svg>
            </a>
        </div>
    </section>

@endsection