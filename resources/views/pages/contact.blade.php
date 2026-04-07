@extends('layouts.app')
@section('title', 'Contact — AfroCook Experience')

@section('content')

    {{-- Header --}}
    <section class="relative py-16 sm:py-20 text-center overflow-hidden">
        <div class="absolute inset-0">
            <img src="https://images.unsplash.com/photo-1414235077428-338989a2e8c0?w=1200&q=80" alt="" class="w-full h-full object-cover">
            <div class="absolute inset-0 bg-dark/75"></div>
        </div>
        <div class="relative z-10 max-w-7xl mx-auto px-5 sm:px-8 lg:px-10">
            <h1 class="text-3xl sm:text-4xl font-extrabold text-white tracking-tight mb-3">Contact</h1>
            <p class="text-[15px] text-white/50 max-w-md mx-auto">Une question ? N'hésitez pas à nous écrire</p>
        </div>
    </section>

    {{-- Contenu principal --}}
    <section class="bg-beige-50 py-14 sm:py-20">
        <div class="max-w-7xl mx-auto px-5 sm:px-8 lg:px-10">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-10">

                {{-- Coordonnées --}}
                <div>
                    <p class="text-[11px] font-bold uppercase tracking-[3px] text-brand-500 mb-3">Nos coordonnées</p>
                    <h2 class="text-2xl font-extrabold text-dark tracking-tight mb-8">Restons en contact</h2>

                    <div class="space-y-6">
                        {{-- Adresse --}}
                        <div class="flex items-start gap-4">
                            <div class="w-11 h-11 rounded-xl bg-brand-50 flex items-center justify-center flex-shrink-0">
                                <svg class="w-5 h-5 text-brand-500" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
                            </div>
                            <div>
                                <h3 class="text-[15px] font-bold text-dark mb-1">Adresse</h3>
                                <p class="text-[14px] text-beige-500">Cotonou, Bénin</p>
                            </div>
                        </div>
                        {{-- Téléphone --}}
                        <div class="flex items-start gap-4">
                            <div class="w-11 h-11 rounded-xl bg-emerald-50 flex items-center justify-center flex-shrink-0">
                                <svg class="w-5 h-5 text-emerald-500" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72c.127.96.361 1.903.7 2.81a2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
                            </div>
                            <div>
                                <h3 class="text-[15px] font-bold text-dark mb-1">Téléphone</h3>
                                <p class="text-[14px] text-beige-500">+229 97 00 00 00</p>
                            </div>
                        </div>
                        {{-- Email --}}
                        <div class="flex items-start gap-4">
                            <div class="w-11 h-11 rounded-xl bg-blue-50 flex items-center justify-center flex-shrink-0">
                                <svg class="w-5 h-5 text-blue-500" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
                            </div>
                            <div>
                                <h3 class="text-[15px] font-bold text-dark mb-1">Email</h3>
                                <p class="text-[14px] text-beige-500">contact@afrocook.com</p>
                            </div>
                        </div>
                        {{-- Horaires --}}
                        <div class="flex items-start gap-4">
                            <div class="w-11 h-11 rounded-xl bg-amber-50 flex items-center justify-center flex-shrink-0">
                                <svg class="w-5 h-5 text-amber-500" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                            </div>
                            <div>
                                <h3 class="text-[15px] font-bold text-dark mb-1">Horaires</h3>
                                <p class="text-[14px] text-beige-500">Lundi — Samedi : 8h00 - 18h00</p>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Formulaire --}}
                <div class="bg-white p-7 sm:p-8 rounded-2xl border border-beige-200/60 shadow-sm">
                    <h2 class="text-xl font-bold text-dark mb-6">Envoyez-nous un message</h2>
                    <form action="{{ route('contact.envoyer') }}" method="POST" class="space-y-5">
                        @csrf
                        <div>
                            <label for="nom" class="block text-sm font-medium text-dark-50 mb-1.5">Nom complet</label>
                            <input type="text" id="nom" name="nom" value="{{ old('nom') }}" required placeholder="Votre nom"
                                class="w-full px-4 py-3 rounded-xl border border-beige-200 bg-beige-50 text-[14px] text-dark placeholder:text-beige-400 focus:outline-none focus:border-brand-500 focus:ring-2 focus:ring-brand-500/10 focus:bg-white transition duration-200">
                            @error('nom') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label for="email" class="block text-sm font-medium text-dark-50 mb-1.5">Email</label>
                            <input type="email" id="email" name="email" value="{{ old('email') }}" required placeholder="votre@email.com"
                                class="w-full px-4 py-3 rounded-xl border border-beige-200 bg-beige-50 text-[14px] text-dark placeholder:text-beige-400 focus:outline-none focus:border-brand-500 focus:ring-2 focus:ring-brand-500/10 focus:bg-white transition duration-200">
                            @error('email') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label for="message" class="block text-sm font-medium text-dark-50 mb-1.5">Message</label>
                            <textarea id="message" name="message" rows="5" required placeholder="Votre message..."
                                class="w-full px-4 py-3 rounded-xl border border-beige-200 bg-beige-50 text-[14px] text-dark placeholder:text-beige-400 focus:outline-none focus:border-brand-500 focus:ring-2 focus:ring-brand-500/10 focus:bg-white transition duration-200 resize-none">{{ old('message') }}</textarea>
                            @error('message') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                        </div>
                        <button type="submit"
                            class="w-full flex items-center justify-center gap-2 py-3.5 bg-brand-500 hover:bg-brand-600 text-white text-[14px] font-semibold rounded-xl transition-all duration-200 hover:shadow-lg hover:shadow-brand-500/20">
                            <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="22" y1="2" x2="11" y2="13"/><polygon points="22 2 15 22 11 13 2 9 22 2"/></svg>
                            Envoyer le message
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </section>

    {{-- Newsletter --}}
    <section class="bg-brand-500 relative overflow-hidden">
        <div class="absolute inset-0 bg-[url('data:image/svg+xml,%3Csvg%20width%3D%2260%22%20height%3D%2260%22%20viewBox%3D%220%200%2060%2060%22%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%3E%3Cg%20fill%3D%22%23ffffff%22%20fill-opacity%3D%220.06%22%3E%3Ccircle%20cx%3D%221%22%20cy%3D%221%22%20r%3D%221%22%2F%3E%3C%2Fg%3E%3C%2Fsvg%3E')]"></div>
        <div class="relative z-10 max-w-7xl mx-auto px-5 sm:px-8 lg:px-10 py-14 sm:py-16 text-center">
            <h2 class="text-2xl sm:text-3xl font-extrabold text-white tracking-tight mb-3">Restez informé</h2>
            <p class="text-[14px] text-white/70 mb-8 max-w-md mx-auto">Recevez nos nouvelles recettes, offres exclusives et invitations en avant-première.</p>
            <form action="{{ route('newsletter.subscribe') }}" method="POST" class="flex flex-col sm:flex-row gap-3 max-w-md mx-auto">
                @csrf
                <input type="email" name="email" placeholder="Votre adresse email..." required
                    class="flex-1 px-5 py-3 rounded-xl text-[14px] text-dark bg-white focus:outline-none focus:ring-2 focus:ring-white/30">
                <button type="submit"
                    class="px-6 py-3 bg-dark hover:bg-dark-50 text-white text-[14px] font-semibold rounded-xl transition-all duration-200 whitespace-nowrap">
                    S'inscrire
                </button>
            </form>
        </div>
    </section>

@endsection