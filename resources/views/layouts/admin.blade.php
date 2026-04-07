<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Administration — AfroCook Experience')</title>

    {{-- Police Inter --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    {{-- TailwindCSS compilé --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('styles')
</head>

<body class="font-sans bg-beige-50 text-dark antialiased">

    {{-- Container principal : sidebar + contenu --}}
    <div class="flex min-h-screen">

        {{-- ════════════════════════════════════════════
             SIDEBAR — Navigation admin
             ════════════════════════════════════════════
             - Fixe à gauche, pleine hauteur
             - flex-col avec justify-between pour pousser
               le profil en bas
             - w-64 = 256px de large
        --}}
    <aside id="sidebar" class="fixed top-0 left-0 w-64 h-screen flex flex-col bg-dark overflow-y-auto z-40 transition-transform duration-300 -translate-x-full lg:translate-x-0">

            {{-- Logo en haut --}}
            <div class="px-6 py-5 border-b border-white/5">
                <a href="{{ route('home') }}" class="flex items-center gap-3 transition-opacity hover:opacity-80">
                    <img src="{{ asset('images/logo.png') }}" alt="Atelier à Deux" class="h-10 w-auto">
                </a>
            </div>

            {{-- Navigation principale --}}
            <nav class="flex-1 px-3 py-4 space-y-1">

                {{-- Section : Principal --}}
                <p class="px-3 pt-2 pb-1.5 text-[10px] font-bold uppercase tracking-[2px] text-white/25">
                    Principal
                </p>

                {{-- Dashboard --}}
                <a href="{{ route('admin.dashboard') }}"
                   class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium transition-all duration-200
                          {{ request()->routeIs('admin.dashboard') ? 'bg-brand-500/15 text-brand-400' : 'text-white/50 hover:bg-white/5 hover:text-white/80' }}">
                    {{-- Icône dashboard --}}
                    <svg class="w-[18px] h-[18px] flex-shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                        <rect x="3" y="3" width="7" height="7" rx="1" />
                        <rect x="14" y="3" width="7" height="4" rx="1" />
                        <rect x="3" y="14" width="7" height="4" rx="1" />
                        <rect x="14" y="11" width="7" height="7" rx="1" />
                    </svg>
                    Tableau de bord
                </a>

                {{-- Section : Gestion --}}
                <p class="px-3 pt-5 pb-1.5 text-[10px] font-bold uppercase tracking-[2px] text-white/25">
                    Gestion
                </p>

                {{-- Ateliers --}}
                <a href="{{ route('admin.ateliers.index') }}"
                   class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium transition-all duration-200
                          {{ request()->routeIs('admin.ateliers.*') ? 'bg-brand-500/15 text-brand-400' : 'text-white/50 hover:bg-white/5 hover:text-white/80' }}">
                    <svg class="w-[18px] h-[18px] flex-shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M18 8h1a4 4 0 0 1 0 8h-1" /><path d="M2 8h16v9a4 4 0 0 1-4 4H6a4 4 0 0 1-4-4V8z" />
                        <line x1="6" y1="1" x2="6" y2="4" /><line x1="10" y1="1" x2="10" y2="4" /><line x1="14" y1="1" x2="14" y2="4" />
                    </svg>
                    Ateliers
                </a>

                {{-- Créneaux --}}
                <a href="{{ route('admin.creneaux.index') }}"
                   class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium transition-all duration-200
                          {{ request()->routeIs('admin.creneaux.*') ? 'bg-brand-500/15 text-brand-400' : 'text-white/50 hover:bg-white/5 hover:text-white/80' }}">
                    <svg class="w-[18px] h-[18px] flex-shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                        <rect x="3" y="4" width="18" height="18" rx="2" ry="2" />
                        <line x1="16" y1="2" x2="16" y2="6" /><line x1="8" y1="2" x2="8" y2="6" /><line x1="3" y1="10" x2="21" y2="10" />
                    </svg>
                    Créneaux
                </a>

                {{-- Réservations --}}
                <a href="{{ route('admin.reservations.index') }}"
                   class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium transition-all duration-200
                          {{ request()->routeIs('admin.reservations.*') ? 'bg-brand-500/15 text-brand-400' : 'text-white/50 hover:bg-white/5 hover:text-white/80' }}">
                    <svg class="w-[18px] h-[18px] flex-shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z" />
                        <polyline points="14 2 14 8 20 8" /><line x1="16" y1="13" x2="8" y2="13" /><line x1="16" y1="17" x2="8" y2="17" />
                    </svg>
                    Réservations
                </a>

                {{-- Section : Utilisateurs --}}
                <p class="px-3 pt-5 pb-1.5 text-[10px] font-bold uppercase tracking-[2px] text-white/25">
                    Utilisateurs
                </p>

                <a href="{{ route('admin.utilisateurs.index') }}"
                   class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium transition-all duration-200
                          {{ request()->routeIs('admin.utilisateurs.*') ? 'bg-brand-500/15 text-brand-400' : 'text-white/50 hover:bg-white/5 hover:text-white/80' }}">
                    <svg class="w-[18px] h-[18px] flex-shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2" /><circle cx="9" cy="7" r="4" />
                        <path d="M23 21v-2a4 4 0 0 0-3-3.87" /><path d="M16 3.13a4 4 0 0 1 0 7.75" />
                    </svg>
                    Utilisateurs
                </a>

                {{-- Section : Marketing --}}
                <p class="px-3 pt-5 pb-1.5 text-[10px] font-bold uppercase tracking-[2px] text-white/25">
                    Marketing
                </p>

                {{-- Codes Promo --}}
                <a href="{{ route('admin.codes-promo.index') }}"
                   class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium transition-all duration-200
                          {{ request()->routeIs('admin.codes-promo.*') ? 'bg-brand-500/15 text-brand-400' : 'text-white/50 hover:bg-white/5 hover:text-white/80' }}">
                    <svg class="w-[18px] h-[18px] flex-shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                        <polyline points="20 12 20 22 4 22 4 12" /><rect x="2" y="7" width="20" height="5" />
                        <line x1="12" y1="22" x2="12" y2="7" /><path d="M12 7H7.5a2.5 2.5 0 0 1 0-5C11 2 12 7 12 7z" />
                        <path d="M12 7h4.5a2.5 2.5 0 0 0 0-5C13 2 12 7 12 7z" />
                    </svg>
                    Codes Promo
                </a>

                {{-- Avis --}}
                <a href="{{ route('admin.avis.index') }}"
                   class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium transition-all duration-200
                          {{ request()->routeIs('admin.avis.*') ? 'bg-brand-500/15 text-brand-400' : 'text-white/50 hover:bg-white/5 hover:text-white/80' }}">
                    <svg class="w-[18px] h-[18px] flex-shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                        <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2" />
                    </svg>
                    Avis
                </a>

                {{-- Newsletter --}}
                <a href="{{ route('admin.newsletter.index') }}"
                   class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium transition-all duration-200
                          {{ request()->routeIs('admin.newsletter.*') ? 'bg-brand-500/15 text-brand-400' : 'text-white/50 hover:bg-white/5 hover:text-white/80' }}">
                    <svg class="w-[18px] h-[18px] flex-shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z" />
                        <polyline points="22,6 12,13 2,6" />
                    </svg>
                    Newsletter
                </a>

                {{-- Messages contact --}}
                    <a href="{{ route('admin.messages.index') }}"
                       class="flex items-center gap-3 px-4 py-2.5 rounded-lg text-sm transition-colors duration-150
                              {{ request()->routeIs('admin.messages.*') ? 'bg-brand-500/10 text-brand-400 font-semibold' : 'text-white/50 hover:text-white hover:bg-white/5' }}">
                        <svg class="w-[18px] h-[18px]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
                        Messages
                        @if(\App\Models\MessageContact::nonLus()->count() > 0)
                            <span class="ml-auto w-5 h-5 rounded-full bg-red-500 text-white text-[10px] font-bold flex items-center justify-center">
                                {{ \App\Models\MessageContact::nonLus()->count() }}
                            </span>
                        @endif
                    </a>

                {{-- Section : Logistique --}}
                <p class="px-3 pt-5 pb-1.5 text-[10px] font-bold uppercase tracking-[2px] text-white/25">
                    Logistique
                </p>

                {{-- Ingrédients --}}
                <a href="{{ route('admin.ingredients.index') }}"
                   class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium transition-all duration-200
                          {{ request()->routeIs('admin.ingredients.*') ? 'bg-brand-500/15 text-brand-400' : 'text-white/50 hover:bg-white/5 hover:text-white/80' }}">
                    <svg class="w-[18px] h-[18px] flex-shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z" />
                        <line x1="3" y1="6" x2="21" y2="6" /><path d="M16 10a4 4 0 0 1-8 0" />
                    </svg>
                    Ingrédients
                </a>
            </nav>

            {{-- ════════════════════════════════════════
                 PROFIL ADMIN — En bas de la sidebar
                 ════════════════════════════════════════
                 Avatar SVG + nom + bouton déconnexion
            --}}
            <div class="px-4 py-4 border-t border-white/5">
                <div class="flex items-center gap-3">
                    {{-- Avatar SVG --}}
                    <div class="w-9 h-9 rounded-lg bg-brand-500/15 flex items-center justify-center flex-shrink-0">
                        <svg class="w-[18px] h-[18px] text-brand-400" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2" />
                            <circle cx="12" cy="7" r="4" />
                        </svg>
                    </div>
                    {{-- Nom + rôle --}}
                    <div class="flex-1 min-w-0">
                        <p class="text-sm font-semibold text-white truncate">{{ auth()->user()->name }}</p>
                        <p class="text-[11px] text-white/30 capitalize">{{ auth()->user()->role }}</p>
                    </div>
                    {{-- Bouton déconnexion --}}
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" title="Déconnexion"
                            class="w-8 h-8 rounded-lg flex items-center justify-center text-white/30 hover:text-red-400 hover:bg-red-500/10 transition-all duration-200">
                            <svg class="w-[16px] h-[16px]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4" />
                                <polyline points="16 17 21 12 16 7" />
                                <line x1="21" y1="12" x2="9" y2="12" />
                            </svg>
                        </button>
                    </form>
                </div>
            </div>
        </aside>
        {{-- Overlay sombre quand sidebar ouverte sur mobile --}}
        <div id="sidebarOverlay" class="fixed inset-0 bg-dark/40 backdrop-blur-sm z-30 hidden lg:hidden"></div>

        {{-- ════════════════════════════════════════════
             ZONE CONTENU — Topbar + Main
             ════════════════════════════════════════════
             ml-64 : décalé de la largeur de la sidebar
        --}}
        <div class="flex-1 lg:ml-64 min-w-0 overflow-x-hidden">

            {{-- Topbar --}}
            <header class="sticky top-0 z-30 bg-beige-50/80 backdrop-blur-md border-b border-beige-200">
                <div class="flex items-center justify-between px-4 sm:px-8 py-4">
                    <div class="flex items-center gap-3">
                        {{-- Bouton hamburger (mobile uniquement) --}}
                        <button id="sidebarToggle" class="lg:hidden w-9 h-9 rounded-lg flex items-center justify-center text-dark hover:bg-beige-200 transition-colors">
                            <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <line x1="3" y1="6" x2="21" y2="6"/>
                                <line x1="3" y1="12" x2="21" y2="12"/>
                                <line x1="3" y1="18" x2="21" y2="18"/>
                            </svg>
                        </button>
                        <h1 class="text-lg font-bold text-dark tracking-tight">
                            @yield('page-title', 'Administration')
                        </h1>
                    </div>
                    {{-- Lien vers le site public --}}
                    <a href="{{ route('home') }}" class="flex items-center gap-2 text-sm text-beige-500 hover:text-brand-500 transition-colors duration-200">
                        <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6" />
                            <polyline points="15 3 21 3 21 9" /><line x1="10" y1="14" x2="21" y2="3" />
                        </svg>
                        Voir le site
                    </a>
                </div>
            </header>

            {{-- Zone principale --}}
            <main class="px-4 sm:px-8 py-6">
                {{-- Messages flash --}}
                @if(session('success'))
                    <div class="mb-5 px-4 py-3 rounded-xl bg-brand-50 border border-brand-200 flex items-start gap-2.5">
                        <svg class="w-5 h-5 text-brand-500 flex-shrink-0 mt-0.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
                        <p class="text-sm text-brand-700">{{ session('success') }}</p>
                    </div>
                @endif
                @if(session('error'))
                    <div class="mb-5 px-4 py-3 rounded-xl bg-red-50 border border-red-200 flex items-start gap-2.5">
                        <svg class="w-5 h-5 text-red-500 flex-shrink-0 mt-0.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="15" y1="9" x2="9" y2="15"/><line x1="9" y1="9" x2="15" y2="15"/></svg>
                        <p class="text-sm text-red-700">{{ session('error') }}</p>
                    </div>
                @endif
                @if(session('info'))
                    <div class="mb-5 px-4 py-3 rounded-xl bg-blue-50 border border-blue-200 flex items-start gap-2.5">
                        <svg class="w-5 h-5 text-blue-500 flex-shrink-0 mt-0.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="12" y1="16" x2="12" y2="12"/><line x1="12" y1="8" x2="12.01" y2="8"/></svg>
                        <p class="text-sm text-blue-700">{{ session('info') }}</p>
                    </div>
                @endif

                {{-- Contenu injecté par chaque page --}}
                @yield('content')
            </main>
        </div>
    </div>

{{-- Script sidebar mobile --}}
        <script>
        (function() {
            var sidebar = document.getElementById('sidebar');
            var overlay = document.getElementById('sidebarOverlay');
            var toggle = document.getElementById('sidebarToggle');

            function openSidebar() {
                sidebar.classList.remove('-translate-x-full');
                sidebar.classList.add('translate-x-0');
                overlay.classList.remove('hidden');
            }

            function closeSidebar() {
                sidebar.classList.add('-translate-x-full');
                sidebar.classList.remove('translate-x-0');
                overlay.classList.add('hidden');
            }

            toggle.addEventListener('click', function() {
                var isHidden = sidebar.classList.contains('-translate-x-full');
                if (isHidden) {
                    openSidebar();
                } else {
                    closeSidebar();
                }
            });

            /* Fermer au clic sur l'overlay */
            overlay.addEventListener('click', closeSidebar);

            /* Fermer quand on clique un lien de la sidebar (mobile) */
            sidebar.querySelectorAll('a').forEach(function(link) {
                link.addEventListener('click', function() {
                    if (window.innerWidth < 1024) {
                        closeSidebar();
                    }
                });
            });
        })();
        </script>

{{-- Modale de confirmation de suppression --}}
        <div id="confirmModal" class="fixed inset-0 z-50 hidden">
            {{-- Overlay sombre --}}
            <div id="confirmOverlay" class="absolute inset-0 bg-dark/40 backdrop-blur-sm"></div>
            {{-- Contenu de la modale --}}
            <div class="absolute inset-0 flex items-center justify-center p-4">
                <div id="confirmBox" class="relative w-full max-w-sm bg-white rounded-2xl shadow-xl p-6 transform scale-95 opacity-0 transition-all duration-200">
                    {{-- Icône alerte --}}
                    <div class="w-12 h-12 rounded-xl bg-red-50 flex items-center justify-center mx-auto mb-4">
                        <svg class="w-6 h-6 text-red-500" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"/>
                            <line x1="12" y1="9" x2="12" y2="13"/>
                            <line x1="12" y1="17" x2="12.01" y2="17"/>
                        </svg>
                    </div>
                    {{-- Texte --}}
                    <h3 class="text-lg font-bold text-dark text-center mb-1">Confirmer la suppression</h3>
                    <p id="confirmMessage" class="text-sm text-beige-500 text-center mb-6">Êtes-vous sûr de vouloir supprimer cet élément ?</p>
                    {{-- Boutons --}}
                    <div class="flex gap-3">
                        <button id="confirmCancel"
                            class="flex-1 px-4 py-2.5 text-sm font-semibold text-beige-500 rounded-xl border border-beige-300 hover:border-beige-400 hover:text-dark transition-all duration-200">
                            Annuler
                        </button>
                        <button id="confirmDelete"
                            class="flex-1 px-4 py-2.5 text-sm font-semibold text-white bg-red-500 hover:bg-red-600 rounded-xl transition-all duration-200 hover:shadow-lg hover:shadow-red-500/20">
                            Supprimer
                        </button>
                    </div>
                </div>
            </div>
        </div>

        {{-- Script de la modale de confirmation --}}
        <script>
        (function() {
            var modal = document.getElementById('confirmModal');
            var overlay = document.getElementById('confirmOverlay');
            var box = document.getElementById('confirmBox');
            var msg = document.getElementById('confirmMessage');
            var btnCancel = document.getElementById('confirmCancel');
            var btnDelete = document.getElementById('confirmDelete');
            var pendingForm = null;

            /* Ouvrir la modale */
            function openModal(message, form) {
                pendingForm = form;
                msg.textContent = message;
                modal.classList.remove('hidden');
                /* Animation d'entrée */
                requestAnimationFrame(function() {
                    box.classList.remove('scale-95', 'opacity-0');
                    box.classList.add('scale-100', 'opacity-100');
                });
            }

            /* Fermer la modale */
            function closeModal() {
                box.classList.remove('scale-100', 'opacity-100');
                box.classList.add('scale-95', 'opacity-0');
                setTimeout(function() {
                    modal.classList.add('hidden');
                    pendingForm = null;
                }, 200);
            }

            /* Annuler */
            btnCancel.addEventListener('click', closeModal);
            overlay.addEventListener('click', closeModal);

            /* Confirmer la suppression */
            btnDelete.addEventListener('click', function() {
                if (pendingForm) {
                    pendingForm.submit();
                }
            });

            /* Fermer avec Echap */
            document.addEventListener('keydown', function(e) {
                if (e.key === 'Escape' && !modal.classList.contains('hidden')) {
                    closeModal();
                }
            });

            /*
             * Intercepter tous les formulaires de suppression
             * On cherche les forms avec data-confirm
             * et on remplace le confirm() natif par la modale
             */
            document.addEventListener('submit', function(e) {
                var form = e.target;
                var message = form.getAttribute('data-confirm');

                if (message) {
                    e.preventDefault();
                    openModal(message, form);
                }
            });
        })();
        </script>

        {{-- ═══ Custom Select Premium Global ═══ --}}
        <script>
        (function() {
            /*
             * Transforme tous les <select> natifs en custom selects premium.
             * Fonctionne automatiquement sur toutes les pages admin.
             * Chaque select natif est caché et remplacé par un dropdown custom.
             */
            document.querySelectorAll('select').forEach(function(nativeSelect) {
                /* Ignorer les selects déjà transformés ou multiples */
                if (nativeSelect.dataset.customized || nativeSelect.multiple) return;
                nativeSelect.dataset.customized = 'true';

                /* Récupérer les options du select natif */
                var options = [];
                nativeSelect.querySelectorAll('option').forEach(function(opt) {
                    options.push({ value: opt.value, text: opt.textContent.trim(), selected: opt.selected });
                });

                /* Trouver l'option sélectionnée */
                var selectedOpt = options.find(function(o) { return o.selected; }) || options[0];

                /* Cacher le select natif */
                nativeSelect.style.position = 'absolute';
                nativeSelect.style.opacity = '0';
                nativeSelect.style.pointerEvents = 'none';
                nativeSelect.style.height = '0';
                nativeSelect.style.overflow = 'hidden';

                /* Créer le wrapper */
                var wrapper = document.createElement('div');
                wrapper.style.position = 'relative';
                wrapper.className = 'custom-select-wrapper';

                /* Bouton trigger */
                var trigger = document.createElement('button');
                trigger.type = 'button';
                trigger.className = 'w-full flex items-center justify-between px-4 py-3 rounded-xl border border-beige-200 bg-beige-50 text-[14px] text-dark cursor-pointer hover:border-brand-500/30 focus:outline-none focus:border-brand-500 focus:ring-2 focus:ring-brand-500/10 focus:bg-white transition-all duration-200';
                trigger.innerHTML = '<span class="cs-label truncate">' + selectedOpt.text + '</span>' +
                    '<svg class="w-4 h-4 text-beige-400 flex-shrink-0 transition-transform duration-200 cs-chevron" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="6 9 12 15 18 9"/></svg>';

                /* Dropdown */
                var dropdown = document.createElement('div');
                dropdown.className = 'absolute top-full left-0 right-0 mt-1.5 bg-white rounded-xl border border-beige-200/60 shadow-xl shadow-dark/8 z-50 hidden overflow-hidden';
                dropdown.style.minWidth = '100%';

                /* Barre de recherche (si plus de 5 options) */
                var searchWrap = '';
                if (options.length > 5) {
                    searchWrap = document.createElement('div');
                    searchWrap.className = 'px-3 py-2.5 border-b border-beige-100';
                    var searchInput = document.createElement('input');
                    searchInput.type = 'text';
                    searchInput.placeholder = 'Rechercher...';
                    searchInput.className = 'w-full px-3 py-2 rounded-lg border border-beige-200 bg-beige-50 text-[13px] placeholder:text-beige-400 focus:outline-none focus:border-brand-500 transition duration-200';
                    searchWrap.appendChild(searchInput);
                    dropdown.appendChild(searchWrap);

                    /* Filtrer les options en temps réel */
                    searchInput.addEventListener('input', function() {
                        var term = this.value.toLowerCase();
                        optionEls.forEach(function(el) {
                            var text = el.textContent.toLowerCase();
                            el.style.display = text.indexOf(term) !== -1 ? '' : 'none';
                        });
                    });
                }

                /* Liste des options */
                var optionsContainer = document.createElement('div');
                optionsContainer.className = 'max-h-56 overflow-y-auto py-1';
                var optionEls = [];

                options.forEach(function(opt) {
                    var el = document.createElement('div');
                    el.className = 'flex items-center gap-2.5 px-4 py-2.5 text-[13px] cursor-pointer transition-colors duration-150 ' +
                        (opt.selected ? 'bg-brand-50 text-brand-600 font-semibold' : 'text-dark hover:bg-beige-50');
                    el.textContent = opt.text;
                    el.dataset.value = opt.value;

                    el.addEventListener('click', function() {
                        /* Mettre à jour le select natif */
                        nativeSelect.value = opt.value;
                        /* Déclencher l'événement change */
                        nativeSelect.dispatchEvent(new Event('change', { bubbles: true }));
                        /* Mettre à jour le label */
                        trigger.querySelector('.cs-label').textContent = opt.text;
                        /* Surligner l'option active */
                        optionEls.forEach(function(o) {
                            o.classList.remove('bg-brand-50', 'text-brand-600', 'font-semibold');
                            o.classList.add('text-dark', 'hover:bg-beige-50');
                        });
                        el.classList.add('bg-brand-50', 'text-brand-600', 'font-semibold');
                        el.classList.remove('text-dark', 'hover:bg-beige-50');
                        /* Fermer */
                        closeDropdown();
                    });

                    optionEls.push(el);
                    optionsContainer.appendChild(el);
                });

                dropdown.appendChild(optionsContainer);

                /* État ouvert/fermé */
                var isOpen = false;

                function openDropdown() {
                    dropdown.classList.remove('hidden');
                    trigger.querySelector('.cs-chevron').classList.add('rotate-180');
                    isOpen = true;
                    if (searchWrap && searchWrap.querySelector) {
                        var si = searchWrap.querySelector('input');
                        if (si) { si.value = ''; si.focus(); }
                        optionEls.forEach(function(el) { el.style.display = ''; });
                    }
                }

                function closeDropdown() {
                    dropdown.classList.add('hidden');
                    trigger.querySelector('.cs-chevron').classList.remove('rotate-180');
                    isOpen = false;
                }

                trigger.addEventListener('click', function(e) {
                    e.preventDefault();
                    e.stopPropagation();
                    isOpen ? closeDropdown() : openDropdown();
                });

                /* Fermer au clic extérieur */
                document.addEventListener('click', function(e) {
                    if (!wrapper.contains(e.target)) closeDropdown();
                });

                /* Fermer avec Echap */
                document.addEventListener('keydown', function(e) {
                    if (e.key === 'Escape' && isOpen) closeDropdown();
                });

                /* Assembler et insérer dans le DOM */
                wrapper.appendChild(trigger);
                wrapper.appendChild(dropdown);
                nativeSelect.parentNode.insertBefore(wrapper, nativeSelect.nextSibling);
            });
        })();
        </script>

    @stack('scripts')
</body>
</html>