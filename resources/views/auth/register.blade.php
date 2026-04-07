<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription — AfroCook Experience</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,400;0,600;0,700;1,400;1,600&family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen lg:h-screen lg:overflow-hidden font-sans antialiased flex flex-col" style="font-family:'Outfit',sans-serif;background:#ffffff;">

    <main class="flex-1 flex flex-col lg:flex-row">

        {{-- ══════════════════════════════════════════
             PANNEAU GAUCHE — Image + texte (desktop)
             ══════════════════════════════════════════ --}}
        <div class="hidden lg:flex lg:w-[54%] relative overflow-hidden flex-col justify-between p-12 xl:p-16">
            <img src="https://images.unsplash.com/photo-1528712306091-ed0763094c98?w=1200&q=80" alt="" class="absolute inset-0 w-full h-full object-cover">
            <div class="absolute inset-0 bg-dark/70"></div>

            {{-- Logo + nom --}}
            <a href="{{ route('home') }}" class="relative z-10 flex items-center gap-3 self-start transition-opacity hover:opacity-80">
                <img src="{{ asset('images/logo.png') }}" alt="AfroCook Experience" class="h-14 w-auto">
                <span class="text-[18px] font-bold text-white">AfroCook <span class="text-brand-400">Experience</span></span>
            </a>

            {{-- Accroche --}}
            <div class="relative z-10 max-w-lg mt-20">
                <h2 class="text-white text-3xl xl:text-[2.25rem] font-extrabold leading-[1.12] tracking-tight mb-3" style="font-family:'Cormorant Garamond',serif;">
                    Rejoignez l'aventure<br>
                    <span class="text-brand-400 italic">culinaire africaine.</span>
                </h2>
                <p class="text-white/50 text-[14px] leading-relaxed mb-6 max-w-md">
                    Créez votre compte en quelques instants et réservez votre première
                    expérience de cuisine en duo à Cotonou.
                </p>

                <div class="space-y-4">
                    <div class="flex items-start gap-4">
                        <div class="w-9 h-9 rounded-full border-[1.5px] border-brand-400/30 flex items-center justify-center flex-shrink-0">
                            <span class="text-brand-400 text-[15px] font-bold">1</span>
                        </div>
                        <div>
                            <p class="text-white text-[15px] font-semibold">Créez votre compte</p>
                            <p class="text-white/40 text-[13px] mt-0.5">C'est rapide, gratuit et sans engagement.</p>
                        </div>
                    </div>
                    <div class="flex items-start gap-4">
                        <div class="w-9 h-9 rounded-full border-[1.5px] border-brand-400/30 flex items-center justify-center flex-shrink-0">
                            <span class="text-brand-400 text-[15px] font-bold">2</span>
                        </div>
                        <div>
                            <p class="text-white text-[15px] font-semibold">Explorez les ateliers</p>
                            <p class="text-white/40 text-[14px] leading-relaxed mt-0.5">Parcourez notre catalogue de recettes africaines.</p>
                        </div>
                    </div>
                    <div class="flex items-start gap-4">
                        <div class="w-9 h-9 rounded-full border-[1.5px] border-brand-400/30 flex items-center justify-center flex-shrink-0">
                            <span class="text-brand-400 text-[15px] font-bold">3</span>
                        </div>
                        <div>
                            <p class="text-white text-[15px] font-semibold">Réservez et cuisinez</p>
                            <p class="text-white/40 text-[14px] leading-relaxed mt-0.5">Choisissez un créneau et vivez l'expérience en duo.</p>
                        </div>
                    </div>
                </div>
            </div>

            <p class="relative z-10 text-white/20 text-[12px]">&copy; {{ date('Y') }} AfroCook Experience — Cotonou, Bénin</p>
        </div>

        {{-- ══════════════════════════════════════════
             PANNEAU DROIT — Formulaire
             ══════════════════════════════════════════ --}}
        <div class="flex-1 flex flex-col justify-center px-6 sm:px-12 lg:px-14 xl:px-20 py-8 overflow-y-auto bg-white">
            <div class="w-full max-w-[480px] mx-auto">

                {{-- Retour --}}
                <a href="{{ route('home') }}" class="inline-flex items-center gap-2 text-sm text-beige-500 hover:text-brand-500 transition-colors duration-200 mb-8 group">
                    <svg class="w-4 h-4 transition-transform duration-200 group-hover:-translate-x-0.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M19 12H5"/><polyline points="12 19 5 12 12 5"/></svg>
                    Retour au site
                </a>

                {{-- Logo mobile centré --}}
                <div class="lg:hidden text-center mb-8">
                    <a href="{{ route('home') }}" class="inline-flex items-center gap-2.5">
                        <img src="{{ asset('images/logo.png') }}" alt="AfroCook Experience" class="h-10 w-auto">
                        <span class="text-[18px] font-bold text-dark">AfroCook <span class="text-brand-500">Experience</span></span>
                    </a>
                </div>

                {{-- Titre --}}
                <h1 class="text-[28px] font-bold text-dark tracking-tight mb-1.5" style="font-family:'Cormorant Garamond',serif;">Créer un compte</h1>
                <p class="text-beige-500 text-[14px] mb-8">Rejoignez AfroCook Experience — c'est gratuit.</p>

                {{-- Formulaire --}}
                <form id="registerForm" method="POST" action="{{ route('register') }}" class="space-y-4">
                    @csrf
                    <input type="hidden" name="name" id="nameHidden" value="{{ old('name') }}">

                    {{-- Prénom + Nom --}}
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label for="prenomInput" class="block text-[13px] font-semibold text-dark mb-2">Prénom</label>
                            <div class="relative">
                                <span class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
                                    <svg class="w-[18px] h-[18px] text-beige-400" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                                </span>
                                <input type="text" id="prenomInput" required autofocus placeholder="Aminata"
                                    class="block w-full pl-11 pr-4 py-3.5 rounded-2xl border border-beige-300 bg-beige-50 text-dark text-[14px] placeholder:text-beige-400 focus:outline-none focus:border-brand-500 focus:ring-2 focus:ring-brand-500/10 focus:bg-white transition duration-200">
                            </div>
                        </div>
                        <div>
                            <label for="nomInput" class="block text-[13px] font-semibold text-dark mb-2">Nom</label>
                            <div class="relative">
                                <span class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
                                    <svg class="w-[18px] h-[18px] text-beige-400" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                                </span>
                                <input type="text" id="nomInput" required placeholder="Koffi"
                                    class="block w-full pl-11 pr-4 py-3.5 rounded-2xl border border-beige-300 bg-beige-50 text-dark text-[14px] placeholder:text-beige-400 focus:outline-none focus:border-brand-500 focus:ring-2 focus:ring-brand-500/10 focus:bg-white transition duration-200">
                            </div>
                        </div>
                    </div>
                    @error('name')
                        <p class="-mt-3 text-[13px] text-red-600 flex items-center gap-1.5">
                            <svg class="w-3.5 h-3.5 flex-shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
                            {{ $message }}
                        </p>
                    @enderror

                    {{-- Email --}}
                    <div>
                        <label for="email" class="block text-[13px] font-semibold text-dark mb-2">Adresse email</label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
                                <svg class="w-[18px] h-[18px] text-beige-400" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><rect x="2" y="4" width="20" height="16" rx="2"/><polyline points="22,7 12,13 2,7"/></svg>
                            </span>
                            <input type="email" id="email" name="email" value="{{ old('email') }}" required placeholder="votre@email.com"
                                class="block w-full pl-11 pr-4 py-3.5 rounded-2xl border border-beige-300 bg-beige-50 text-dark text-[14px] placeholder:text-beige-400 focus:outline-none focus:border-brand-500 focus:ring-2 focus:ring-brand-500/10 focus:bg-white transition duration-200">
                        </div>
                        @error('email')
                            <p class="mt-1.5 text-[13px] text-red-600 flex items-center gap-1.5">
                                <svg class="w-3.5 h-3.5 flex-shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    {{-- Téléphone --}}
                    <div>
                        <label class="block text-[13px] font-semibold text-dark mb-2">Téléphone</label>
                        <div class="flex gap-2">
                            <div class="relative" style="min-width:140px;">
                                <button type="button" id="countryBtn"
                                    class="w-full flex items-center gap-2 pl-3 pr-2 py-3.5 rounded-2xl border border-beige-300 bg-beige-50 text-dark text-[14px] transition duration-200 focus:outline-none focus:border-brand-500 focus:ring-2 focus:ring-brand-500/10 cursor-pointer">
                                    <img id="selFlag" src="https://flagcdn.com/w40/bj.png" alt="BJ" class="w-6 h-6 rounded-full object-cover flex-shrink-0">
                                    <span id="selCode" class="font-medium text-[14px]">+229</span>
                                    <svg class="w-3.5 h-3.5 text-beige-400 ml-auto flex-shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="6 9 12 15 18 9"/></svg>
                                </button>
                                <div id="countryDrop" class="absolute top-full left-0 mt-1.5 w-72 max-h-60 overflow-y-auto rounded-2xl border border-beige-200 bg-white shadow-xl shadow-dark/5 z-50 hidden">
                                    <div class="sticky top-0 bg-white p-2 border-b border-beige-100">
                                        <input type="text" id="countrySearch" placeholder="Rechercher un pays..."
                                            class="w-full px-3 py-2 rounded-xl border border-beige-200 text-[13px] placeholder:text-beige-400 focus:outline-none focus:border-brand-500 transition duration-200">
                                    </div>
                                    <div id="countryList"></div>
                                </div>
                            </div>
                            <input type="tel" id="phoneNum" placeholder="97 00 00 00"
                                class="flex-1 block px-4 py-3.5 rounded-2xl border border-beige-300 bg-beige-50 text-dark text-[14px] placeholder:text-beige-400 focus:outline-none focus:border-brand-500 focus:ring-2 focus:ring-brand-500/10 focus:bg-white transition duration-200">
                            <input type="hidden" name="telephone" id="phoneHidden" value="{{ old('telephone') }}">
                        </div>
                        @error('telephone')
                            <p class="mt-1.5 text-[13px] text-red-600 flex items-center gap-1.5">
                                <svg class="w-3.5 h-3.5 flex-shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    {{-- Mot de passe + Confirmation --}}
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label for="password" class="block text-[13px] font-semibold text-dark mb-2">Mot de passe</label>
                            <div class="relative">
                                <span class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
                                    <svg class="w-[18px] h-[18px] text-beige-400" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
                                </span>
                                <input type="password" id="password" name="password" required minlength="8" maxlength="10" placeholder="Min. 8 caractères"
                                    class="block w-full pl-11 pr-11 py-3.5 rounded-2xl border border-beige-300 bg-beige-50 text-dark text-[14px] placeholder:text-beige-400 focus:outline-none focus:border-brand-500 focus:ring-2 focus:ring-brand-500/10 focus:bg-white transition duration-200">
                                <button type="button" class="toggle-pass absolute inset-y-0 right-0 pr-3.5 flex items-center">
                                    <svg class="eye-on w-[18px] h-[18px] text-beige-400 hover:text-brand-500 transition-colors cursor-pointer" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
                                    <svg class="eye-off w-[18px] h-[18px] text-beige-400 hover:text-brand-500 transition-colors cursor-pointer hidden" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19m-6.72-1.07a3 3 0 1 1-4.24-4.24"/><line x1="1" y1="1" x2="23" y2="23"/></svg>
                                </button>
                            </div>
                            @error('password')
                                <p class="mt-1.5 text-[13px] text-red-600 flex items-center gap-1.5">
                                    <svg class="w-3.5 h-3.5 flex-shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>
                        <div>
                            <label for="password_confirmation" class="block text-[13px] font-semibold text-dark mb-2">Confirmer</label>
                            <div class="relative">
                                <span class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
                                    <svg class="w-[18px] h-[18px] text-beige-400" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
                                </span>
                                <input type="password" id="password_confirmation" name="password_confirmation" required minlength="8" maxlength="10" placeholder="Répéter le mot de passe"
                                    class="block w-full pl-11 pr-11 py-3.5 rounded-2xl border border-beige-300 bg-beige-50 text-dark text-[14px] placeholder:text-beige-400 focus:outline-none focus:border-brand-500 focus:ring-2 focus:ring-brand-500/10 focus:bg-white transition duration-200">
                                <button type="button" class="toggle-pass absolute inset-y-0 right-0 pr-3.5 flex items-center">
                                    <svg class="eye-on w-[18px] h-[18px] text-beige-400 hover:text-brand-500 transition-colors cursor-pointer" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
                                    <svg class="eye-off w-[18px] h-[18px] text-beige-400 hover:text-brand-500 transition-colors cursor-pointer hidden" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19m-6.72-1.07a3 3 0 1 1-4.24-4.24"/><line x1="1" y1="1" x2="23" y2="23"/></svg>
                                </button>
                            </div>
                        </div>
                    </div>

                    {{-- Bouton --}}
                    <button type="submit"
                        class="w-full flex items-center justify-center gap-2 py-3.5 bg-brand-500 hover:bg-brand-600 active:bg-brand-700 text-white text-[15px] font-semibold rounded-2xl transition-all duration-200 hover:shadow-lg hover:shadow-brand-500/20 active:scale-[0.98]">
                        Créer mon compte — Gratuit
                        <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 12h14"/><polyline points="12 5 19 12 12 19"/></svg>
                    </button>
                </form>

                {{-- CGU --}}
                <p class="text-center text-[12px] text-beige-400 mt-5 leading-relaxed">
                    En vous inscrivant, vous acceptez nos
                    <a href="{{ route('mentions-legales') }}" class="text-brand-600 hover:underline">conditions d'utilisation</a>.
                </p>

                {{-- Séparateur --}}
                <div class="flex items-center gap-4 my-8">
                    <div class="flex-1 h-px bg-beige-200"></div>
                    <span class="text-[11px] text-beige-400 uppercase tracking-wider">Déjà un compte ?</span>
                    <div class="flex-1 h-px bg-beige-200"></div>
                </div>

                {{-- Lien connexion --}}
                <a href="{{ route('login') }}" class="block w-full py-3.5 text-center text-[15px] font-semibold text-dark border border-beige-300 rounded-2xl hover:border-brand-500 hover:text-brand-600 transition-all duration-200">
                    Se connecter
                </a>
            </div>
        </div>
    </main>

    {{-- ═══ FOOTER — Mobile uniquement ═══ --}}
    <div class="lg:hidden h-16 bg-white flex-shrink-0"></div>
    <footer class="lg:hidden bg-dark flex-shrink-0">
        <div class="px-5 pt-14 pb-6">
            <div class="space-y-8 mb-8">
                <div>
                    <div class="flex items-center gap-2.5 mb-4">
                        <img src="{{ asset('images/logo.png') }}" alt="AfroCook" class="h-9 w-auto">
                        <span class="text-[15px] font-bold text-white">AfroCook <span class="text-brand-400">Experience</span></span>
                    </div>
                    <p class="text-[13px] text-white/30 leading-relaxed">Plateforme de réservation d'ateliers de cuisine africaine en duo à Cotonou, Bénin.</p>
                </div>
                <div>
                    <h4 class="text-[12px] font-bold uppercase tracking-[2px] text-white/50 mb-4">Liens rapides</h4>
                    <div class="space-y-3">
                        <a href="{{ route('home') }}" class="block text-[13px] text-white/35 hover:text-brand-400 transition-colors">Accueil</a>
                        <a href="{{ route('ateliers.index') }}" class="block text-[13px] text-white/35 hover:text-brand-400 transition-colors">Nos Ateliers</a>
                        <a href="{{ route('a-propos') }}" class="block text-[13px] text-white/35 hover:text-brand-400 transition-colors">À Propos</a>
                        <a href="{{ route('contact') }}" class="block text-[13px] text-white/35 hover:text-brand-400 transition-colors">Contact</a>
                    </div>
                </div>
                <div>
                    <h4 class="text-[12px] font-bold uppercase tracking-[2px] text-white/50 mb-4">Contact</h4>
                    <div class="space-y-3">
                        <div class="flex items-center gap-3">
                            <svg class="w-4 h-4 text-brand-400 flex-shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><rect x="2" y="4" width="20" height="16" rx="2"/><polyline points="22,7 12,13 2,7"/></svg>
                            <span class="text-[13px] text-white/35">contact@afrocook.com</span>
                        </div>
                        <div class="flex items-center gap-3">
                            <svg class="w-4 h-4 text-brand-400 flex-shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72"/></svg>
                            <span class="text-[13px] text-white/35">+229 97 00 00 00</span>
                        </div>
                        <div class="flex items-center gap-3">
                            <svg class="w-4 h-4 text-brand-400 flex-shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
                            <span class="text-[13px] text-white/35">Cotonou, Bénin</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="border-t border-white/5 pt-5">
                <p class="text-center text-[12px] text-white/20">&copy; {{ date('Y') }} AfroCook Experience Bénin. Tous droits réservés.</p>
            </div>
        </div>
    </footer>

    {{-- ═══ JAVASCRIPT ═══ --}}
    <script>
    (function() {
        /* Fusion Prénom + Nom → champ hidden name */
        var form = document.getElementById('registerForm');
        var prenomEl = document.getElementById('prenomInput');
        var nomEl = document.getElementById('nomInput');
        var nameHidden = document.getElementById('nameHidden');

        form.addEventListener('submit', function() {
            nameHidden.value = prenomEl.value.trim() + ' ' + nomEl.value.trim();
        });

        if (nameHidden.value) {
            var parts = nameHidden.value.split(' ');
            prenomEl.value = parts[0] || '';
            nomEl.value = parts.slice(1).join(' ') || '';
        }

        /* Sélecteur de pays avec drapeaux */
        var countries = [
            {iso:'bj',name:'Bénin',code:'+229'},{iso:'tg',name:'Togo',code:'+228'},
            {iso:'ng',name:'Nigeria',code:'+234'},{iso:'gh',name:'Ghana',code:'+233'},
            {iso:'ci',name:"Côte d'Ivoire",code:'+225'},{iso:'sn',name:'Sénégal',code:'+221'},
            {iso:'bf',name:'Burkina Faso',code:'+226'},{iso:'ml',name:'Mali',code:'+223'},
            {iso:'ne',name:'Niger',code:'+227'},{iso:'gn',name:'Guinée',code:'+224'},
            {iso:'cm',name:'Cameroun',code:'+237'},{iso:'ga',name:'Gabon',code:'+241'},
            {iso:'cg',name:'Congo',code:'+242'},{iso:'cd',name:'RD Congo',code:'+243'},
            {iso:'ma',name:'Maroc',code:'+212'},{iso:'tn',name:'Tunisie',code:'+216'},
            {iso:'dz',name:'Algérie',code:'+213'},{iso:'fr',name:'France',code:'+33'},
            {iso:'be',name:'Belgique',code:'+32'},{iso:'gb',name:'Royaume-Uni',code:'+44'},
            {iso:'de',name:'Allemagne',code:'+49'},{iso:'it',name:'Italie',code:'+39'},
            {iso:'es',name:'Espagne',code:'+34'},{iso:'ch',name:'Suisse',code:'+41'},
            {iso:'us',name:'États-Unis',code:'+1'},{iso:'ca',name:'Canada',code:'+1'},
            {iso:'br',name:'Brésil',code:'+55'},{iso:'cn',name:'Chine',code:'+86'},
            {iso:'jp',name:'Japon',code:'+81'},{iso:'in',name:'Inde',code:'+91'},
            {iso:'ae',name:'Émirats Arabes',code:'+971'},{iso:'tr',name:'Turquie',code:'+90'},
        ];
        var currentCode = '+229';
        var cBtn = document.getElementById('countryBtn');
        var cDrop = document.getElementById('countryDrop');
        var cList = document.getElementById('countryList');
        var cSearch = document.getElementById('countrySearch');
        var selFlag = document.getElementById('selFlag');
        var selCode = document.getElementById('selCode');
        var phoneNum = document.getElementById('phoneNum');
        var phoneHid = document.getElementById('phoneHidden');

        function buildList(filter) {
            var term = (filter || '').toLowerCase();
            var html = '';
            for (var i = 0; i < countries.length; i++) {
                var c = countries[i];
                if (term && c.name.toLowerCase().indexOf(term) === -1 && c.code.indexOf(term) === -1) continue;
                html += '<button type="button" data-i="'+i+'" class="w-full flex items-center gap-3 px-3 py-2.5 hover:bg-beige-50 transition-colors text-left">';
                html += '<img src="https://flagcdn.com/w40/'+c.iso+'.png" alt="'+c.iso.toUpperCase()+'" class="w-7 h-7 rounded-full object-cover flex-shrink-0">';
                html += '<span class="text-[13px] text-dark flex-1 truncate">'+c.name+'</span>';
                html += '<span class="text-[12px] text-beige-400 font-medium flex-shrink-0">'+c.code+'</span></button>';
            }
            cList.innerHTML = html || '<p class="px-3 py-4 text-[13px] text-beige-400 text-center">Aucun résultat</p>';
        }
        buildList('');

        cList.addEventListener('click', function(e) {
            var btn = e.target.closest('button');
            if (!btn) return;
            var c = countries[parseInt(btn.dataset.i)];
            selFlag.src = 'https://flagcdn.com/w40/'+c.iso+'.png';
            selCode.textContent = c.code;
            currentCode = c.code;
            cDrop.classList.add('hidden');
            syncPhone();
        });

        cBtn.addEventListener('click', function(e) {
            e.stopPropagation();
            var isHidden = cDrop.classList.contains('hidden');
            cDrop.classList.toggle('hidden');
            if (isHidden) { cSearch.value = ''; buildList(''); cSearch.focus(); }
        });

        cSearch.addEventListener('input', function() { buildList(this.value); });

        document.addEventListener('click', function(e) {
            if (!cDrop.contains(e.target) && !cBtn.contains(e.target)) cDrop.classList.add('hidden');
        });

        function syncPhone() {
            var num = phoneNum.value.replace(/\s+/g, '');
            phoneHid.value = num ? currentCode + ' ' + num : '';
        }
        phoneNum.addEventListener('input', syncPhone);

        /* Toggle visibilité mot de passe */
        var toggles = document.querySelectorAll('.toggle-pass');
        for (var t = 0; t < toggles.length; t++) {
            toggles[t].addEventListener('click', function() {
                var wrap = this.closest('.relative');
                var inp = wrap.querySelector('input');
                var on = this.querySelector('.eye-on');
                var off = this.querySelector('.eye-off');
                var showing = inp.type === 'password';
                inp.type = showing ? 'text' : 'password';
                on.classList.toggle('hidden', showing);
                off.classList.toggle('hidden', !showing);
            });
        }
    })();
    </script>
</body>
</html>