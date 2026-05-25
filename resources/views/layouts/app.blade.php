<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'AfroCook Experience — Cuisine Africaine en Duo')</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,400;0,600;0,700;1,400;1,600&family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('styles')
</head>

<body class="font-sans bg-beige-50 text-dark antialiased" style="font-family:'Outfit',sans-serif;">

    {{-- Overlay mobile --}}
    <div id="mobileOverlay" class="fixed inset-0 bg-dark/50 backdrop-blur-sm z-40 hidden lg:hidden"></div>

    {{-- ═══ NAVBAR ═══ --}}
    <nav id="mainNav" class="fixed top-0 left-0 right-0 z-50 transition-transform duration-300 translate-y-0">
        {{-- Fond avec blur --}}
        <div class="bg-white/95 backdrop-blur-lg border-b border-beige-200/50 shadow-sm shadow-dark/[0.02]">
            <div class="max-w-7xl mx-auto px-5 sm:px-8 lg:px-10 h-[68px] flex items-center justify-between">

                {{-- Logo --}}
                <a href="{{ route('home') }}" class="flex items-center gap-3 flex-shrink-0">
                    <img src="{{ asset('images/logo.png') }}" alt="AfroCook Experience" class="h-11 w-auto rounded-xl bg-dark p-1.5">
                    <span class="font-bold text-[16px] text-dark tracking-tight">
                        AfroCook <span class="text-brand-500">Experience</span>
                    </span>
                </a>

                {{-- Liens desktop --}}
                <div class="hidden lg:flex items-center gap-8">
                    <a href="{{ route('home') }}"
                       class="text-[14px] font-semibold transition-colors duration-200 {{ request()->routeIs('home') ? 'text-brand-500' : 'text-dark/70 hover:text-brand-500' }}">
                        Accueil
                    </a>
                    <a href="{{ route('ateliers.index') }}"
                       class="text-[14px] font-semibold transition-colors duration-200 {{ request()->routeIs('ateliers.*') ? 'text-brand-500' : 'text-dark/70 hover:text-brand-500' }}">
                        Nos Ateliers
                    </a>
                    <a href="{{ route('a-propos') }}"
                       class="text-[14px] font-semibold transition-colors duration-200 {{ request()->routeIs('a-propos') ? 'text-brand-500' : 'text-dark/70 hover:text-brand-500' }}">
                        À Propos
                    </a>
                    <a href="{{ route('contact') }}"
                       class="text-[14px] font-semibold transition-colors duration-200 {{ request()->routeIs('contact') ? 'text-brand-500' : 'text-dark/70 hover:text-brand-500' }}">
                        Contact
                    </a>
                    <a href="{{ route('faq') }}"
                       class="text-[14px] font-semibold transition-colors duration-200 {{ request()->routeIs('faq') ? 'text-brand-500' : 'text-dark/70 hover:text-brand-500' }}">
                        FAQ
                    </a>
                </div>

                {{-- Actions desktop --}}
                <div class="hidden lg:flex items-center gap-3">
                    @auth
                        {{-- Menu utilisateur avec dropdown --}}
                        <div class="relative" id="userMenuWrap">
                            <button id="userMenuBtn" type="button"
                                class="flex items-center gap-2.5 pl-2 pr-3 py-1.5 rounded-xl hover:bg-beige-100 transition-colors duration-200">
                                {{-- Avatar initiales --}}
                                <div class="w-8 h-8 rounded-lg bg-brand-50 flex items-center justify-center">
                                    <span class="text-[11px] font-bold text-brand-600">{{ strtoupper(mb_substr(auth()->user()->name, 0, 2)) }}</span>
                                </div>
                                <span class="text-[14px] font-semibold text-dark">{{ Str::limit(auth()->user()->name, 15) }}</span>
                                <svg class="w-4 h-4 text-beige-400" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="6 9 12 15 18 9"/></svg>
                            </button>
                            {{-- Dropdown --}}
                            <div id="userMenuDrop" class="absolute right-0 top-full mt-2 w-56 bg-white rounded-xl border border-beige-200/60 shadow-xl shadow-dark/5 z-50 hidden">
                                {{-- Info utilisateur --}}
                                <div class="px-4 py-3 border-b border-beige-100">
                                    <p class="text-[13px] font-semibold text-dark truncate">{{ auth()->user()->name }}</p>
                                    <p class="text-[11px] text-beige-400 truncate">{{ auth()->user()->email }}</p>
                                </div>
                                {{-- Liens --}}
                                <div class="py-1.5">
                                    @if(auth()->user()->estAdmin())
                                        <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 px-4 py-2.5 text-[13px] text-dark-50 hover:bg-beige-50 transition-colors">
                                            <svg class="w-4 h-4 text-beige-400" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><rect x="3" y="3" width="7" height="7" rx="1"/><rect x="14" y="3" width="7" height="4" rx="1"/><rect x="3" y="14" width="7" height="4" rx="1"/><rect x="14" y="11" width="7" height="7" rx="1"/></svg>
                                            Administration
                                        </a>
                                    @elseif(auth()->user()->estChef())
                                        <a href="{{ route('chef.planning') }}" class="flex items-center gap-3 px-4 py-2.5 text-[13px] text-dark-50 hover:bg-beige-50 transition-colors">
                                            <svg class="w-4 h-4 text-beige-400" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><rect x="3" y="4" width="18" height="18" rx="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/></svg>
                                            Mon Planning
                                        </a>
                                    @elseif(auth()->user()->estLogistique())
                                        <a href="{{ route('logistique.stocks.index') }}" class="flex items-center gap-3 px-4 py-2.5 text-[13px] text-dark-50 hover:bg-beige-50 transition-colors">
                                            <svg class="w-4 h-4 text-beige-400" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"/><line x1="3" y1="6" x2="21" y2="6"/></svg>
                                            Stocks
                                        </a>
                                    @else
                                        <a href="{{ route('compte.index') }}" class="flex items-center gap-3 px-4 py-2.5 text-[13px] text-dark-50 hover:bg-beige-50 transition-colors">
                                            <svg class="w-4 h-4 text-beige-400" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                                            Mon Compte
                                        </a>
                                        <a href="{{ route('compte.reservations') }}" class="flex items-center gap-3 px-4 py-2.5 text-[13px] text-dark-50 hover:bg-beige-50 transition-colors">
                                            <svg class="w-4 h-4 text-beige-400" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/></svg>
                                            Mes Réservations
                                        </a>
                                    @endif
                                </div>
                                {{-- Déconnexion --}}
                                <div class="border-t border-beige-100 py-1.5">
                                    <form action="{{ route('logout') }}" method="POST">
                                        @csrf
                                        <button type="submit" class="flex items-center gap-3 w-full px-4 py-2.5 text-[13px] text-red-500 hover:bg-red-50 transition-colors text-left">
                                            <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/><polyline points="16 17 21 12 16 7"/><line x1="21" y1="12" x2="9" y2="12"/></svg>
                                            Déconnexion
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @else
                        <a href="{{ route('login') }}" class="text-[14px] font-semibold text-dark/70 hover:text-dark transition-colors">Connexion</a>
                        <a href="{{ route('register') }}" class="px-5 py-2.5 bg-brand-500 hover:bg-brand-600 text-white text-[14px] font-semibold rounded-xl transition-all duration-200 hover:shadow-lg hover:shadow-brand-500/20">Réserver</a>
                    @endauth
                </div>

                {{-- Hamburger mobile --}}
                <button id="navToggle" class="lg:hidden w-10 h-10 rounded-xl flex items-center justify-center text-dark hover:bg-beige-100 transition-colors">
                    <svg id="navOpen" class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round">
                        <line x1="4" y1="6" x2="20" y2="6"/>
                        <line x1="4" y1="12" x2="20" y2="12"/>
                        <line x1="4" y1="18" x2="20" y2="18"/>
                    </svg>
                    <svg id="navClose" class="w-5 h-5 hidden" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round">
                        <line x1="18" y1="6" x2="6" y2="18"/>
                        <line x1="6" y1="6" x2="18" y2="18"/>
                    </svg>
                </button>
            </div>
        </div>

        {{-- Menu mobile --}}
        <div id="mobileMenu" class="lg:hidden fixed top-[68px] right-0 w-72 h-[calc(100vh-68px)] bg-white border-l border-beige-200 z-50 transform translate-x-full transition-transform duration-300 shadow-xl shadow-dark/10">
            <div class="flex flex-col h-full">
                {{-- Liens --}}
                <div class="flex-1 px-5 py-5 space-y-1 overflow-y-auto">
                    <a href="{{ route('home') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl text-[15px] font-semibold {{ request()->routeIs('home') ? 'bg-brand-50 text-brand-600' : 'text-dark/70 hover:bg-beige-50' }} transition-colors">
                        <svg class="w-5 h-5 flex-shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>
                        Accueil
                    </a>
                    <a href="{{ route('ateliers.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl text-[15px] font-semibold {{ request()->routeIs('ateliers.*') ? 'bg-brand-50 text-brand-600' : 'text-dark/70 hover:bg-beige-50' }} transition-colors">
                        <svg class="w-5 h-5 flex-shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M18 8h1a4 4 0 0 1 0 8h-1"/><path d="M2 8h16v9a4 4 0 0 1-4 4H6a4 4 0 0 1-4-4V8z"/></svg>
                        Nos Ateliers
                    </a>
                    <a href="{{ route('a-propos') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl text-[15px] font-semibold {{ request()->routeIs('a-propos') ? 'bg-brand-50 text-brand-600' : 'text-dark/70 hover:bg-beige-50' }} transition-colors">
                        <svg class="w-5 h-5 flex-shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><circle cx="12" cy="12" r="10"/><line x1="12" y1="16" x2="12" y2="12"/><line x1="12" y1="8" x2="12.01" y2="8"/></svg>
                        À Propos
                    </a>
                    <a href="{{ route('contact') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl text-[15px] font-semibold {{ request()->routeIs('contact') ? 'bg-brand-50 text-brand-600' : 'text-dark/70 hover:bg-beige-50' }} transition-colors">
                        <svg class="w-5 h-5 flex-shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
                        Contact
                    </a>
                    <a href="{{ route('faq') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl text-[15px] font-semibold {{ request()->routeIs('faq') ? 'bg-brand-50 text-brand-600' : 'text-dark/70 hover:bg-beige-50' }} transition-colors">
                        <svg class="w-5 h-5 flex-shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><circle cx="12" cy="12" r="10"/><path d="M9.09 9a3 3 0 0 1 5.83 1c0 2-3 3-3 3"/><line x1="12" y1="17" x2="12.01" y2="17"/></svg>
                        FAQ
                    </a>
                </div>
                {{-- Actions mobile --}}
                <div class="px-5 py-5 border-t border-beige-100 space-y-2.5">
                    @auth
                        @if(auth()->user()->estAdmin())
                            <a href="{{ route('admin.dashboard') }}" class="block w-full px-4 py-3 text-center text-[15px] font-semibold text-brand-600 bg-brand-50 rounded-xl">Administration</a>
                        @elseif(auth()->user()->estChef())
                            <a href="{{ route('chef.planning') }}" class="block w-full px-4 py-3 text-center text-[15px] font-semibold text-brand-600 bg-brand-50 rounded-xl">Mon Planning</a>
                        @elseif(auth()->user()->estLogistique())
                            <a href="{{ route('logistique.stocks.index') }}" class="block w-full px-4 py-3 text-center text-[15px] font-semibold text-brand-600 bg-brand-50 rounded-xl">Stocks</a>
                        @else
                            <a href="{{ route('compte.index') }}" class="block w-full px-4 py-3 text-center text-[15px] font-semibold text-brand-600 bg-brand-50 rounded-xl">Mon Compte</a>
                        @endif
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="w-full px-4 py-3 text-[15px] text-beige-500 hover:text-red-500 rounded-xl transition-colors">Déconnexion</button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="block w-full px-4 py-3 text-center text-[15px] font-semibold text-dark border border-beige-300 rounded-xl hover:border-beige-400 transition-colors">Connexion</a>
                        <a href="{{ route('register') }}" class="block w-full px-4 py-3 text-center text-[15px] font-semibold text-white bg-brand-500 rounded-xl hover:bg-brand-600 transition-colors">Réserver</a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    {{-- Spacer pour compenser la navbar fixed --}}
    <div class="h-[68px]"></div>

    {{-- Messages flash --}}
    @if(session('success'))
        <div class="max-w-7xl mx-auto px-5 sm:px-8 lg:px-10 mt-5">
            <div class="px-4 py-3 rounded-xl bg-brand-50 border border-brand-200 flex items-start gap-2.5">
                <svg class="w-5 h-5 text-brand-500 flex-shrink-0 mt-0.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
                <p class="text-sm text-brand-700">{{ session('success') }}</p>
            </div>
        </div>
    @endif
    @if(session('error'))
        <div class="max-w-7xl mx-auto px-5 sm:px-8 lg:px-10 mt-5">
            <div class="px-4 py-3 rounded-xl bg-red-50 border border-red-200 flex items-start gap-2.5">
                <svg class="w-5 h-5 text-red-500 flex-shrink-0 mt-0.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="15" y1="9" x2="9" y2="15"/><line x1="9" y1="9" x2="15" y2="15"/></svg>
                <p class="text-sm text-red-700">{{ session('error') }}</p>
            </div>
        </div>
    @endif

    {{-- Contenu --}}
    <main>@yield('content')</main>

    {{-- ═══ FOOTER ═══ --}}
    <footer class="bg-dark">
        <div class="max-w-7xl mx-auto px-5 sm:px-8 lg:px-10 pt-16 pb-8">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-12 mb-14">
                {{-- Marque --}}
                <div class="lg:col-span-1">
                    <div class="flex items-center gap-2.5 mb-5">
                        <img src="{{ asset('images/logo.png') }}" alt="AfroCook Experience" class="h-10 w-auto">
                        <span class="text-[16px] font-bold text-white">AfroCook <span class="text-brand-400">Experience</span></span>
                    </div>
                    <p class="text-[14px] text-white/40 leading-relaxed max-w-xs mb-6">
                        Plateforme de réservation d'ateliers de cuisine africaine en duo à Cotonou, Bénin.
                    </p>
                    {{-- Réseaux sociaux --}}
                    <div class="flex gap-3">
                        {{-- Facebook --}}
                        <a href="https://facebook.com" target="_blank" rel="noopener noreferrer" class="w-9 h-9 rounded-lg bg-white/5 border border-white/10 flex items-center justify-center text-white/40 hover:text-brand-400 hover:border-brand-400/30 transition-all duration-200" title="Facebook">
                            <svg class="w-4 h-4" viewBox="0 0 24 24" fill="currentColor"><path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"/></svg>
                        </a>
                        {{-- Instagram --}}
                        <a href="https://instagram.com" target="_blank" rel="noopener noreferrer" class="w-9 h-9 rounded-lg bg-white/5 border border-white/10 flex items-center justify-center text-white/40 hover:text-brand-400 hover:border-brand-400/30 transition-all duration-200" title="Instagram">
                            <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="2" width="20" height="20" rx="5"/><path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"/><line x1="17.5" y1="6.5" x2="17.51" y2="6.5"/></svg>
                        </a>
                        {{-- TikTok --}}
                        <a href="https://tiktok.com" target="_blank" rel="noopener noreferrer" class="w-9 h-9 rounded-lg bg-white/5 border border-white/10 flex items-center justify-center text-white/40 hover:text-brand-400 hover:border-brand-400/30 transition-all duration-200" title="TikTok">
                            <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M9 12a4 4 0 1 0 4 4V4a5 5 0 0 0 5 5"/></svg>
                        </a>
                        {{-- WhatsApp --}}
                        <a href="https://wa.me/22997000000" target="_blank" rel="noopener noreferrer" class="w-9 h-9 rounded-lg bg-white/5 border border-white/10 flex items-center justify-center text-white/40 hover:text-brand-400 hover:border-brand-400/30 transition-all duration-200" title="WhatsApp">
                            <svg class="w-4 h-4" viewBox="0 0 24 24" fill="currentColor"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347z"/><path d="M12 0C5.373 0 0 5.373 0 12c0 2.625.846 5.059 2.284 7.034L.789 23.492l4.624-1.47A11.94 11.94 0 0 0 12 24c6.627 0 12-5.373 12-12S18.627 0 12 0z"/></svg>
                        </a>
                    </div>
                </div>

                {{-- Navigation --}}
                <div>
                    <h4 class="text-[12px] font-bold uppercase tracking-[2px] text-white/30 mb-5">Navigation</h4>
                    <div class="space-y-3">
                        <a href="{{ route('home') }}" class="block text-[14px] text-white/50 hover:text-brand-400 transition-colors">Accueil</a>
                        <a href="{{ route('ateliers.index') }}" class="block text-[14px] text-white/50 hover:text-brand-400 transition-colors">Nos Ateliers</a>
                        <a href="{{ route('a-propos') }}" class="block text-[14px] text-white/50 hover:text-brand-400 transition-colors">À Propos</a>
                        <a href="{{ route('contact') }}" class="block text-[14px] text-white/50 hover:text-brand-400 transition-colors">Contact</a>
                    </div>
                </div>

                {{-- Infos --}}
                <div>
                    <h4 class="text-[12px] font-bold uppercase tracking-[2px] text-white/30 mb-5">Informations</h4>
                    <div class="space-y-3">
                        <a href="{{ route('faq') }}" class="block text-[14px] text-white/50 hover:text-brand-400 transition-colors">FAQ</a>
                        <a href="{{ route('mentions-legales') }}" class="block text-[14px] text-white/50 hover:text-brand-400 transition-colors">Mentions Légales</a>
                    </div>
                </div>

                {{-- Contact --}}
                <div>
                    <h4 class="text-[12px] font-bold uppercase tracking-[2px] text-white/30 mb-5">Contact</h4>
                    <div class="space-y-4">
                        <div class="flex items-start gap-3">
                            <svg class="w-[18px] h-[18px] text-brand-400 flex-shrink-0 mt-0.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
                            <span class="text-[14px] text-white/50 leading-relaxed">Cotonou, Bénin</span>
                        </div>
                        <div class="flex items-start gap-3">
                            <svg class="w-[18px] h-[18px] text-brand-400 flex-shrink-0 mt-0.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72c.127.96.361 1.903.7 2.81a2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
                            <span class="text-[14px] text-white/50">+229 97 00 00 00</span>
                        </div>
                        <div class="flex items-start gap-3">
                            <svg class="w-[18px] h-[18px] text-brand-400 flex-shrink-0 mt-0.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
                            <span class="text-[14px] text-white/50">contact@afrocook.com</span>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Bottom --}}
            <div class="border-t border-white/5 pt-7 flex flex-col sm:flex-row justify-between items-center gap-3">
                <p class="text-[13px] text-white/25">&copy; {{ date('Y') }} AfroCook Experience Bénin. Tous droits réservés.</p>
                <p class="text-[13px] text-white/25">
                    <span class="text-brand-400">AfroCook Experience</span> — Cotonou, Bénin
                </p>
            </div>
        </div>
    </footer>

    {{-- JAVASCRIPT --}}
    <script>
    (function() {
        /* ─── Menu mobile ─── */
        var toggle = document.getElementById('navToggle');
        var menu = document.getElementById('mobileMenu');
        var overlay = document.getElementById('mobileOverlay');
        var iconOpen = document.getElementById('navOpen');
        var iconClose = document.getElementById('navClose');
        var isOpen = false;

        function openMenu() {
            menu.classList.remove('translate-x-full');
            menu.classList.add('translate-x-0');
            overlay.classList.remove('hidden');
            iconOpen.classList.add('hidden');
            iconClose.classList.remove('hidden');
            document.body.style.overflow = 'hidden';
            isOpen = true;
        }

        function closeMenu() {
            menu.classList.add('translate-x-full');
            menu.classList.remove('translate-x-0');
            overlay.classList.add('hidden');
            iconOpen.classList.remove('hidden');
            iconClose.classList.add('hidden');
            document.body.style.overflow = '';
            isOpen = false;
        }

        toggle.addEventListener('click', function() { isOpen ? closeMenu() : openMenu(); });
        overlay.addEventListener('click', closeMenu);
        menu.querySelectorAll('a').forEach(function(link) { link.addEventListener('click', closeMenu); });

        /* Menu utilisateur dropdown */
        var userBtn = document.getElementById('userMenuBtn');
        var userDrop = document.getElementById('userMenuDrop');
        var userWrap = document.getElementById('userMenuWrap');

        if (userBtn) {
            userBtn.addEventListener('click', function(e) {
                e.stopPropagation();
                userDrop.classList.toggle('hidden');
            });
            document.addEventListener('click', function(e) {
                if (userWrap && !userWrap.contains(e.target)) {
                    userDrop.classList.add('hidden');
                }
            });
        }

        /* ─── Navbar hide/show au scroll ─── */
        var nav = document.getElementById('mainNav');
        var lastScroll = 0;
        var threshold = 300; /* La navbar reste visible sur les 300 premiers pixels */
        var delta = 15; /* Ignorer les micro-scrolls de moins de 15px */

        window.addEventListener('scroll', function() {
            var current = window.scrollY;
            var diff = Math.abs(current - lastScroll);

            /* Ignorer les petits mouvements */
            if (diff < delta) return;

            if (current <= threshold) {
                /* En haut de page : toujours visible */
                nav.classList.remove('-translate-y-full');
                nav.classList.add('translate-y-0');
            } else if (current > lastScroll) {
                /* Scroll vers le bas : cacher */
                nav.classList.remove('translate-y-0');
                nav.classList.add('-translate-y-full');
            } else {
                /* Scroll vers le haut : montrer */
                nav.classList.remove('-translate-y-full');
                nav.classList.add('translate-y-0');
            }

            lastScroll = current;
        });
    })();
    </script>
    @stack('scripts')
</body>
</html>