<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmer le mot de passe — AfroCook Experience</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,400;0,600;0,700;1,400;1,600&family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen font-sans antialiased flex flex-col justify-center items-center px-6 py-12" style="font-family:'Outfit',sans-serif;background:#ffffff;">

    <div class="w-full max-w-[440px]">

        {{-- Logo centré --}}
        <div class="text-center mb-8">
            <a href="{{ route('home') }}" class="inline-flex items-center gap-2.5">
                <img src="{{ asset('images/logo.png') }}" alt="AfroCook Experience" class="h-10 w-auto">
                <span class="text-[18px] font-bold text-dark">AfroCook <span class="text-brand-500">Experience</span></span>
            </a>
        </div>

        {{-- Icône sécurité --}}
        <div class="flex justify-center mb-5">
            <div class="w-14 h-14 rounded-2xl bg-brand-50 flex items-center justify-center">
                <svg class="w-7 h-7 text-brand-500" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
            </div>
        </div>

        {{-- Titre --}}
        <h1 class="text-[26px] font-bold text-dark tracking-tight mb-2 text-center" style="font-family:'Cormorant Garamond',serif;">Zone sécurisée</h1>
        <p class="text-beige-500 text-[14px] mb-8 text-center leading-relaxed">
            Veuillez confirmer votre mot de passe avant de continuer.
        </p>

        {{-- Formulaire --}}
        <form method="POST" action="{{ route('password.confirm') }}" class="space-y-5">
            @csrf

            <div>
                <label for="password" class="block text-[13px] font-semibold text-dark mb-2">Mot de passe</label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
                        <svg class="w-[18px] h-[18px] text-beige-400" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
                    </span>
                    <input type="password" id="password" name="password" required autocomplete="current-password" placeholder="Votre mot de passe"
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

            <button type="submit" class="w-full flex items-center justify-center gap-2 py-3.5 bg-brand-500 hover:bg-brand-600 active:bg-brand-700 text-white text-[15px] font-semibold rounded-2xl transition-all duration-200 hover:shadow-lg hover:shadow-brand-500/20 active:scale-[0.98]">
                Confirmer
                <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="20 6 9 17 4 12"/></svg>
            </button>
        </form>
    </div>

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