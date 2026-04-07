<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mot de passe oublié — AfroCook Experience</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,400;0,600;0,700;1,400;1,600&family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen font-sans antialiased flex flex-col justify-center items-center px-5 py-10" style="font-family:'Outfit',sans-serif;background:#ffffff;">

    <div class="w-full max-w-[440px]">

        {{-- Logo centré --}}
        <div class="text-center mb-8">
            <a href="{{ route('home') }}" class="inline-flex items-center gap-2.5">
                <img src="{{ asset('images/logo.png') }}" alt="AfroCook Experience" class="h-10 w-auto">
                <span class="text-[18px] font-bold text-dark">AfroCook <span class="text-brand-500">Experience</span></span>
            </a>
        </div>

        {{-- Carte --}}
        <div class="bg-white border border-beige-200/60 rounded-2xl p-8 shadow-sm">

            {{-- Icône --}}
            <div class="w-12 h-12 rounded-xl bg-brand-50 flex items-center justify-center mx-auto mb-5">
                <svg class="w-6 h-6 text-brand-500" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
            </div>

            <h1 class="text-[24px] font-bold text-dark tracking-tight text-center mb-2" style="font-family:'Cormorant Garamond',serif;">Mot de passe oublié</h1>
            <p class="text-[14px] text-beige-500 text-center mb-6 leading-relaxed">
                Entrez votre adresse email et nous vous enverrons un lien pour réinitialiser votre mot de passe.
            </p>

            {{-- Flash --}}
            @if (session('status'))
                <div class="mb-5 px-4 py-3 rounded-xl bg-brand-50 border border-brand-200 flex items-start gap-2.5">
                    <svg class="w-5 h-5 text-brand-500 flex-shrink-0 mt-0.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
                    <p class="text-[13px] text-brand-700">{{ session('status') }}</p>
                </div>
            @endif

            <form method="POST" action="{{ route('password.email') }}" class="space-y-5">
                @csrf

                <div>
                    <label for="email" class="block text-[13px] font-semibold text-dark mb-2">Adresse email</label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
                            <svg class="w-[18px] h-[18px] text-beige-400" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><rect x="2" y="4" width="20" height="16" rx="2"/><polyline points="22,7 12,13 2,7"/></svg>
                        </span>
                        <input type="email" id="email" name="email" value="{{ old('email') }}" required autofocus placeholder="votre@email.com"
                            class="block w-full pl-11 pr-4 py-3.5 rounded-2xl border border-beige-300 bg-beige-50 text-dark text-[14px] placeholder:text-beige-400 focus:outline-none focus:border-brand-500 focus:ring-2 focus:ring-brand-500/10 focus:bg-white transition duration-200">
                    </div>
                    @error('email')
                        <p class="mt-1.5 text-[13px] text-red-600 flex items-center gap-1.5">
                            <svg class="w-3.5 h-3.5 flex-shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <button type="submit" class="w-full flex items-center justify-center gap-2 py-3.5 bg-brand-500 hover:bg-brand-600 text-white text-[15px] font-semibold rounded-2xl transition-all duration-200 hover:shadow-lg hover:shadow-brand-500/20 active:scale-[0.98]">
                    Envoyer le lien
                    <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="22" y1="2" x2="11" y2="13"/><polygon points="22 2 15 22 11 13 2 9 22 2"/></svg>
                </button>
            </form>
        </div>

        {{-- Retour --}}
        <div class="text-center mt-6">
            <a href="{{ route('login') }}" class="inline-flex items-center gap-2 text-[14px] text-beige-500 hover:text-brand-500 transition-colors">
                <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M19 12H5"/><polyline points="12 19 5 12 12 5"/></svg>
                Retour à la connexion
            </a>
        </div>
    </div>

</body>
</html>