<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vérifier votre email — AfroCook Experience</title>
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

        {{-- Icône email --}}
        <div class="flex justify-center mb-6">
            <div class="w-16 h-16 rounded-2xl bg-brand-50 flex items-center justify-center">
                <svg class="w-8 h-8 text-brand-500" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><rect x="2" y="4" width="20" height="16" rx="2"/><polyline points="22,7 12,13 2,7"/></svg>
            </div>
        </div>

        {{-- Titre --}}
        <h1 class="text-[26px] font-bold text-dark tracking-tight mb-2 text-center" style="font-family:'Cormorant Garamond',serif;">Vérifiez votre email</h1>
        <p class="text-beige-500 text-[14px] mb-8 text-center leading-relaxed">
            Merci de votre inscription ! Avant de commencer, veuillez vérifier votre adresse email en cliquant sur le lien que nous venons de vous envoyer.
        </p>

        {{-- Flash succès --}}
        @if (session('status') == 'verification-link-sent')
            <div class="mb-6 px-4 py-3 rounded-xl bg-brand-50 border border-brand-200 flex items-start gap-2.5">
                <svg class="w-5 h-5 text-brand-500 flex-shrink-0 mt-0.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
                <p class="text-[13px] text-brand-700">Un nouveau lien de vérification a été envoyé à votre adresse email.</p>
            </div>
        @endif

        {{-- Actions --}}
        <div class="space-y-3">
            <form method="POST" action="{{ route('verification.send') }}">
                @csrf
                <button type="submit" class="w-full flex items-center justify-center gap-2 py-3.5 bg-brand-500 hover:bg-brand-600 active:bg-brand-700 text-white text-[15px] font-semibold rounded-2xl transition-all duration-200 hover:shadow-lg hover:shadow-brand-500/20 active:scale-[0.98]">
                    Renvoyer l'email de vérification
                    <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 12h14"/><polyline points="12 5 19 12 12 19"/></svg>
                </button>
            </form>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="w-full py-3.5 text-center text-[14px] font-semibold text-beige-500 hover:text-dark border border-beige-300 rounded-2xl hover:border-dark transition-all duration-200">
                    Se déconnecter
                </button>
            </form>
        </div>
    </div>
</body>
</html>