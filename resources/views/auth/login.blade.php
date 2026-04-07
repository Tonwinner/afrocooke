<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion — AfroCook Experience</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,400;0,600;0,700;1,400;1,600&family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen lg:h-screen lg:overflow-hidden font-sans antialiased flex flex-col" style="font-family:'Outfit',sans-serif;background:#ffffff;">

    {{-- ═══ VERSION PC : Split-screen sans navbar ni footer ═══ --}}
    {{-- ═══ VERSION MOBILE : Formulaire + footer ═══ --}}

    <main class="flex-1 flex flex-col lg:flex-row">

        {{-- ══════════════════════════════════════════
             PANNEAU GAUCHE — Image + texte (desktop)
             ══════════════════════════════════════════ --}}
        <div class="hidden lg:flex lg:w-[54%] relative overflow-hidden flex-col justify-between p-12 xl:p-16">
            {{-- Image de fond --}}
            <img src="https://images.unsplash.com/photo-1556909114-f6e7ad7d3136?w=1200&q=80" alt="" class="absolute inset-0 w-full h-full object-cover">
            {{-- Overlay sombre pour lisibilité du texte --}}
            <div class="absolute inset-0 bg-dark/70"></div>

            {{-- Logo --}}
            <a href="{{ route('home') }}" class="relative z-10 flex items-center gap-3 self-start transition-opacity hover:opacity-80">
                <img src="{{ asset('images/logo.png') }}" alt="AfroCook Experience" class="h-14 w-auto">
                <span class="text-[18px] font-bold text-white">AfroCook <span class="text-brand-400">Experience</span></span>
            </a>

            {{-- Accroche --}}
            <div class="relative z-10 max-w-lg">
                <h2 class="text-white text-4xl xl:text-[2.75rem] font-extrabold leading-[1.12] tracking-tight mb-5" style="font-family:'Cormorant Garamond',serif;">
                    La cuisine africaine,<br>
                    <span class="text-brand-400 italic">une expérience à partager.</span>
                </h2>
                <p class="text-white/50 text-[16px] leading-relaxed mb-12 max-w-md">
                    Réservez un atelier culinaire en duo à Cotonou. Des recettes authentiques,
                    des chefs passionnés, des moments inoubliables.
                </p>

                {{-- 3 arguments --}}
                <div class="space-y-6">
                    <div class="flex items-start gap-4">
                        <div class="w-10 h-10 rounded-lg bg-brand-500/15 border border-brand-500/25 flex items-center justify-center flex-shrink-0">
                            <svg class="w-[18px] h-[18px] text-brand-400" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                        </div>
                        <div>
                            <p class="text-white text-[15px] font-semibold">Ateliers en duo</p>
                            <p class="text-white/40 text-[14px] leading-relaxed mt-0.5">Couple, amis ou famille — cuisinez ensemble.</p>
                        </div>
                    </div>
                    <div class="flex items-start gap-4">
                        <div class="w-10 h-10 rounded-lg bg-brand-500/15 border border-brand-500/25 flex items-center justify-center flex-shrink-0">
                            <svg class="w-[18px] h-[18px] text-brand-400" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
                        </div>
                        <div>
                            <p class="text-white text-[15px] font-semibold">Paiement sécurisé</p>
                            <p class="text-white/40 text-[14px] leading-relaxed mt-0.5">Réservez via KkiaPay avec confirmation immédiate.</p>
                        </div>
                    </div>
                    <div class="flex items-start gap-4">
                        <div class="w-10 h-10 rounded-lg bg-brand-500/15 border border-brand-500/25 flex items-center justify-center flex-shrink-0">
                            <svg class="w-[18px] h-[18px] text-brand-400" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
                        </div>
                        <div>
                            <p class="text-white text-[15px] font-semibold">Chefs professionnels</p>
                            <p class="text-white/40 text-[14px] leading-relaxed mt-0.5">Des recettes authentiques encadrées par des experts.</p>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Copyright panneau gauche --}}
            <p class="relative z-10 text-white/20 text-[12px]">&copy; {{ date('Y') }} AfroCook Experience — Cotonou, Bénin</p>
        </div>

        {{-- ══════════════════════════════════════════
             PANNEAU DROIT — Formulaire
             ══════════════════════════════════════════ --}}
        <div class="flex-1 flex flex-col justify-center px-6 sm:px-12 lg:px-16 xl:px-24 py-12 bg-white">
            <div class="w-full max-w-[440px] mx-auto">

                {{-- Retour accueil --}}
                <a href="{{ route('home') }}" class="inline-flex items-center gap-2 text-sm text-beige-500 hover:text-brand-500 transition-colors duration-200 mb-8 group">
                    <svg class="w-4 h-4 transition-transform duration-200 group-hover:-translate-x-0.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M19 12H5"/><polyline points="12 19 5 12 12 5"/></svg>
                    Retour au site
                </a>

                {{-- Logo mobile centré avec nom --}}
                <div class="lg:hidden text-center mb-8">
                    <a href="{{ route('home') }}" class="inline-flex items-center gap-2.5">
                        <img src="{{ asset('images/logo.png') }}" alt="AfroCook Experience" class="h-10 w-auto">
                        <span class="text-[18px] font-bold text-dark">AfroCook <span class="text-brand-500">Experience</span></span>
                    </a>
                </div>

                {{-- Titre --}}
                <h1 class="text-[28px] font-bold text-dark tracking-tight mb-1.5" style="font-family:'Cormorant Garamond',serif;">Se connecter</h1>
                <p class="text-beige-500 text-[14px] mb-8">Pas encore de compte ? <a href="{{ route('register') }}" class="text-brand-500 font-semibold hover:text-brand-600 transition-colors">Créer un compte</a></p>

                {{-- Flash --}}
                @if (session('status'))
                    <div class="mb-6 px-4 py-3 rounded-xl bg-brand-50 border border-brand-200 flex items-start gap-2.5">
                        <svg class="w-5 h-5 text-brand-500 flex-shrink-0 mt-0.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
                        <p class="text-sm text-brand-700">{{ session('status') }}</p>
                    </div>
                @endif

                {{-- Formulaire --}}
                <form method="POST" action="{{ route('login') }}" class="space-y-5">
                    @csrf

                    <div>
                        <label for="email" class="block text-[13px] font-semibold text-dark mb-2">Adresse email</label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
                                <svg class="w-[18px] h-[18px] text-beige-400" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><rect x="2" y="4" width="20" height="16" rx="2"/><polyline points="22,7 12,13 2,7"/></svg>
                            </span>
                            <input type="email" id="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username" placeholder="votre@email.com"
                                class="block w-full pl-11 pr-4 py-3.5 rounded-2xl border border-beige-300 bg-beige-50 text-dark text-[14px] placeholder:text-beige-400 focus:outline-none focus:border-brand-500 focus:ring-2 focus:ring-brand-500/10 focus:bg-white transition duration-200">
                        </div>
                        @error('email')
                            <p class="mt-1.5 text-[13px] text-red-600 flex items-center gap-1.5">
                                <svg class="w-3.5 h-3.5 flex-shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <div>
                        <label for="password" class="block text-[13px] font-semibold text-dark mb-2">Mot de passe</label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
                                <svg class="w-[18px] h-[18px] text-beige-400" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
                            </span>
                            <input type="password" id="password" name="password" required autocomplete="current-password" placeholder="Min. 8 caractères"
                                class="block w-full pl-11 pr-11 py-3.5 rounded-2xl border border-beige-300 bg-beige-50 text-dark text-[14px] placeholder:text-beige-400 focus:outline-none focus:border-brand-500 focus:ring-2 focus:ring-brand-500/10 focus:bg-white transition duration-200">
                            <button type="button" id="toggleBtn" class="absolute inset-y-0 right-0 pr-3.5 flex items-center">
                                <svg id="eyeShow" class="w-[18px] h-[18px] text-beige-400 hover:text-brand-500 transition-colors cursor-pointer" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
                                <svg id="eyeHide" class="w-[18px] h-[18px] text-beige-400 hover:text-brand-500 transition-colors cursor-pointer hidden" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19m-6.72-1.07a3 3 0 1 1-4.24-4.24"/><line x1="1" y1="1" x2="23" y2="23"/></svg>
                            </button>
                        </div>
                        @error('password')
                            <p class="mt-1.5 text-[13px] text-red-600 flex items-center gap-1.5">
                                <svg class="w-3.5 h-3.5 flex-shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <div class="flex items-center justify-between pt-0.5">
                        <label class="flex items-center gap-2 cursor-pointer select-none">
                            <input type="checkbox" name="remember" class="w-[15px] h-[15px] rounded border-beige-300 text-brand-500 focus:ring-brand-500/20 transition">
                            <span class="text-[13px] text-beige-500">Se souvenir de moi</span>
                        </label>
                        @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}" class="text-[13px] font-semibold text-brand-600 hover:text-brand-700 transition-colors">Mot de passe oublié ?</a>
                        @endif
                    </div>

                    <button type="submit" class="w-full flex items-center justify-center gap-2 py-3.5 bg-brand-500 hover:bg-brand-600 active:bg-brand-700 text-white text-[15px] font-semibold rounded-2xl transition-all duration-200 hover:shadow-lg hover:shadow-brand-500/20 active:scale-[0.98]">
                        Se connecter
                        <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 12h14"/><polyline points="12 5 19 12 12 19"/></svg>
                    </button>
                </form>

                <div class="flex items-center gap-4 my-8">
                    <div class="flex-1 h-px bg-beige-200"></div>
                    <span class="text-[11px] text-beige-400 uppercase tracking-wider">Nouveau sur AfroCook ?</span>
                    <div class="flex-1 h-px bg-beige-200"></div>
                </div>

                <a href="{{ route('register') }}" class="block w-full py-3.5 text-center text-[15px] font-semibold text-dark border border-beige-300 rounded-2xl hover:border-brand-500 hover:text-brand-600 transition-all duration-200">
                    Créer un compte gratuit
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
                        <a href="{{ route('faq') }}" class="block text-[13px] text-white/35 hover:text-brand-400 transition-colors">FAQ</a>
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

    {{-- ═══ JS ═══ --}}
    <script>
    (function() {
        var btn = document.getElementById('toggleBtn');
        var field = document.getElementById('password');
        var show = document.getElementById('eyeShow');
        var hide = document.getElementById('eyeHide');
        btn.addEventListener('click', function() {
            var isHidden = field.type === 'password';
            field.type = isHidden ? 'text' : 'password';
            show.classList.toggle('hidden', isHidden);
            hide.classList.toggle('hidden', !isHidden);
        });
    })();
    </script>
</body>
</html>