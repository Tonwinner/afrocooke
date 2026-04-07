@extends('layouts.app')
@section('title', 'Mon Compte — AfroCook Experience')

@section('content')

    {{-- Header --}}
    <section class="relative py-14 sm:py-16 text-center overflow-hidden">
        <div class="absolute inset-0">
            <img src="https://images.unsplash.com/photo-1556910103-1c02745aae4d?w=1200&q=80" alt="" class="w-full h-full object-cover">
            <div class="absolute inset-0 bg-dark/75"></div>
        </div>
        <div class="relative z-10 max-w-7xl mx-auto px-5 sm:px-8 lg:px-10">
            <h1 class="text-3xl sm:text-4xl font-extrabold text-white tracking-tight mb-3">Mon Compte</h1>
            <p class="text-[15px] text-white/50 max-w-md mx-auto">Gérez votre profil et vos informations personnelles</p>
        </div>
    </section>

    <section class="bg-beige-50 py-10 sm:py-14">
        <div class="max-w-7xl mx-auto px-5 sm:px-8 lg:px-10">

            {{-- Navigation espace client --}}
            <div class="max-w-md mx-auto -mt-20 relative z-20 mb-10">
                <div class="bg-white rounded-xl p-1.5 border border-beige-200/60 shadow-lg shadow-dark/5 flex gap-1">
                    <a href="{{ route('compte.index') }}"
                       class="flex-1 flex items-center justify-center gap-2 py-2.5 rounded-lg text-[13px] font-semibold bg-brand-500 text-white transition-colors">
                        <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                        Profil
                    </a>
                    <a href="{{ route('compte.reservations') }}"
                       class="flex-1 flex items-center justify-center gap-2 py-2.5 rounded-lg text-[13px] font-semibold text-beige-500 hover:bg-beige-50 transition-colors">
                        <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><rect x="3" y="4" width="18" height="18" rx="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/></svg>
                        Réservations
                    </a>
                    <a href="{{ route('compte.factures') }}"
                       class="flex-1 flex items-center justify-center gap-2 py-2.5 rounded-lg text-[13px] font-semibold text-beige-500 hover:bg-beige-50 transition-colors">
                        <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/></svg>
                        Factures
                    </a>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-4 gap-8 items-start">

                {{-- Sidebar profil --}}
                <div class="lg:col-span-1">
                    <div class="bg-white rounded-2xl border border-beige-200/60 p-6 text-center">
                        {{-- Avatar --}}
                        <div class="relative mx-auto mb-4 w-20 h-20">
                            <div class="w-20 h-20 rounded-2xl bg-brand-50 flex items-center justify-center overflow-hidden">
                                @if($user->photo)
                                    <img src="{{ asset('storage/' . $user->photo) }}" alt="{{ $user->name }}" class="w-full h-full object-cover">
                                @else
                                    <span class="text-2xl font-bold text-brand-600">{{ strtoupper(mb_substr($user->name, 0, 2)) }}</span>
                                @endif
                            </div>
                            @if($user->photo)
                                <form action="{{ route('compte.supprimer-photo') }}" method="POST" class="absolute -top-1 -right-1">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" title="Supprimer la photo"
                                        class="w-6 h-6 rounded-full bg-red-500 hover:bg-red-600 text-white flex items-center justify-center transition-colors shadow-sm">
                                        <svg class="w-3 h-3" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
                                    </button>
                                </form>
                            @endif
                        </div>
                        <h3 class="text-[16px] font-bold text-dark mb-0.5">{{ $user->name }}</h3>
                        <p class="text-[13px] text-beige-500 mb-1">{{ $user->email }}</p>
                        @if($user->telephone)
                            <p class="text-[13px] text-beige-400 mb-3">{{ $user->telephone }}</p>
                        @endif
                        {{-- Badge rôle --}}
                        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-lg text-[11px] font-bold bg-brand-50 text-brand-600 uppercase tracking-wider">
                            {{ $user->role }}
                        </span>
                    </div>
                </div>

                {{-- Formulaire modification --}}
                <div class="lg:col-span-3">
                    <div class="bg-white rounded-2xl border border-beige-200/60 p-6 sm:p-8">
                        <div class="flex items-center gap-3 mb-6 pb-5 border-b border-beige-100">
                            <div class="w-10 h-10 rounded-xl bg-brand-50 flex items-center justify-center">
                                <svg class="w-5 h-5 text-brand-500" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                                    <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/>
                                    <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/>
                                </svg>
                            </div>
                            <div>
                                <h2 class="text-lg font-bold text-dark">Modifier mon profil</h2>
                                <p class="text-[12px] text-beige-400">Mettez à jour vos informations personnelles</p>
                            </div>
                        </div>

                        <form action="{{ route('compte.update') }}" method="POST" enctype="multipart/form-data" class="space-y-5">
                            @csrf
                            @method('PUT')

                            {{-- Nom + Email --}}
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                <div>
                                    <label for="name" class="block text-sm font-medium text-dark-50 mb-1.5">Nom complet</label>
                                    <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}" required
                                        class="w-full px-4 py-3 rounded-xl border border-beige-200 bg-beige-50 text-[14px] text-dark focus:outline-none focus:border-brand-500 focus:ring-2 focus:ring-brand-500/10 focus:bg-white transition duration-200">
                                    @error('name') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                                </div>
                                <div>
                                    <label for="email" class="block text-sm font-medium text-dark-50 mb-1.5">Adresse email</label>
                                    <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}" required
                                        class="w-full px-4 py-3 rounded-xl border border-beige-200 bg-beige-50 text-[14px] text-dark focus:outline-none focus:border-brand-500 focus:ring-2 focus:ring-brand-500/10 focus:bg-white transition duration-200">
                                    @error('email') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                                </div>
                            </div>

                            {{-- Téléphone + Adresse --}}
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                <div>
                                    <label for="telephone" class="block text-sm font-medium text-dark-50 mb-1.5">Téléphone</label>
                                    <input type="text" id="telephone" name="telephone" value="{{ old('telephone', $user->telephone) }}" placeholder="+229 97 00 00 00"
                                        class="w-full px-4 py-3 rounded-xl border border-beige-200 bg-beige-50 text-[14px] text-dark placeholder:text-beige-400 focus:outline-none focus:border-brand-500 focus:ring-2 focus:ring-brand-500/10 focus:bg-white transition duration-200">
                                    @error('telephone') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                                </div>
                                <div>
                                    <label for="adresse" class="block text-sm font-medium text-dark-50 mb-1.5">Adresse</label>
                                    <input type="text" id="adresse" name="adresse" value="{{ old('adresse', $user->adresse) }}" placeholder="Votre adresse"
                                        class="w-full px-4 py-3 rounded-xl border border-beige-200 bg-beige-50 text-[14px] text-dark placeholder:text-beige-400 focus:outline-none focus:border-brand-500 focus:ring-2 focus:ring-brand-500/10 focus:bg-white transition duration-200">
                                    @error('adresse') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                                </div>
                            </div>

                            {{-- Photo de profil --}}
                            <div>
                                <label class="block text-sm font-medium text-dark-50 mb-1.5">Photo de profil</label>
                                <label for="photo" class="flex items-center gap-3 px-4 py-3 rounded-xl border border-dashed border-beige-300 bg-beige-50 cursor-pointer hover:border-brand-400 hover:bg-brand-50/30 transition-colors duration-200">
                                    <svg class="w-5 h-5 text-beige-400" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><rect x="3" y="3" width="18" height="18" rx="2"/><circle cx="8.5" cy="8.5" r="1.5"/><polyline points="21 15 16 10 5 21"/></svg>
                                    <span id="photoLabel" class="text-[14px] text-beige-400">Choisir une image...</span>
                                    <input type="file" id="photo" name="photo" accept="image/*" class="hidden">
                                </label>
                                @error('photo') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                            </div>

                            {{-- Séparateur mot de passe --}}
                            <div class="pt-3">
                                <p class="text-[11px] font-bold uppercase tracking-[2px] text-beige-400 mb-4 flex items-center gap-3">
                                    <span class="flex-1 h-px bg-beige-100"></span>
                                    Changer le mot de passe
                                    <span class="flex-1 h-px bg-beige-100"></span>
                                </p>
                            </div>

                            {{-- Mot de passe --}}
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                <div>
                                    <label for="password" class="block text-sm font-medium text-dark-50 mb-1.5">Nouveau mot de passe</label>
                                    <div class="relative">
                                        <input type="password" id="password" name="password" placeholder="Laisser vide pour ne pas changer"
                                            class="w-full px-4 py-3 pr-11 rounded-xl border border-beige-200 bg-beige-50 text-[14px] text-dark placeholder:text-beige-400 focus:outline-none focus:border-brand-500 focus:ring-2 focus:ring-brand-500/10 focus:bg-white transition duration-200">
                                        {{-- Toggle visibilité --}}
                                        <button type="button" class="toggle-pwd absolute right-3 top-1/2 -translate-y-1/2 text-beige-400 hover:text-dark transition-colors" data-target="password">
                                            <svg class="eye-open w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
                                            <svg class="eye-closed w-5 h-5 hidden" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94"/><line x1="1" y1="1" x2="23" y2="23"/></svg>
                                        </button>
                                    </div>
                                    @error('password') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                                </div>
                                <div>
                                    <label for="password_confirmation" class="block text-sm font-medium text-dark-50 mb-1.5">Confirmer</label>
                                    <div class="relative">
                                        <input type="password" id="password_confirmation" name="password_confirmation" placeholder="Confirmez le mot de passe"
                                            class="w-full px-4 py-3 pr-11 rounded-xl border border-beige-200 bg-beige-50 text-[14px] text-dark placeholder:text-beige-400 focus:outline-none focus:border-brand-500 focus:ring-2 focus:ring-brand-500/10 focus:bg-white transition duration-200">
                                        <button type="button" class="toggle-pwd absolute right-3 top-1/2 -translate-y-1/2 text-beige-400 hover:text-dark transition-colors" data-target="password_confirmation">
                                            <svg class="eye-open w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
                                            <svg class="eye-closed w-5 h-5 hidden" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94"/><line x1="1" y1="1" x2="23" y2="23"/></svg>
                                        </button>
                                    </div>
                                </div>
                            </div>

                            {{-- Bouton --}}
                            <div class="pt-2">
                                <button type="submit"
                                    class="flex items-center gap-2 px-6 py-3 bg-brand-500 hover:bg-brand-600 text-white text-[14px] font-semibold rounded-xl transition-all duration-200 hover:shadow-lg hover:shadow-brand-500/20">
                                    <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="20 6 9 17 4 12"/></svg>
                                    Enregistrer les modifications
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection

@push('scripts')
<script>
(function() {
    /* Toggle visibilité mot de passe */
    document.querySelectorAll('.toggle-pwd').forEach(function(btn) {
        btn.addEventListener('click', function() {
            var targetId = this.getAttribute('data-target');
            var input = document.getElementById(targetId);
            var eyeOpen = this.querySelector('.eye-open');
            var eyeClosed = this.querySelector('.eye-closed');

            /* Basculer le type du champ */
            if (input.type === 'password') {
                input.type = 'text';
                eyeOpen.classList.add('hidden');
                eyeClosed.classList.remove('hidden');
            } else {
                input.type = 'password';
                eyeOpen.classList.remove('hidden');
                eyeClosed.classList.add('hidden');
            }
        });
    });

    /* Afficher le nom du fichier sélectionné pour la photo */
    var photoInput = document.getElementById('photo');
    var photoLabel = document.getElementById('photoLabel');
    if (photoInput) {
        photoInput.addEventListener('change', function() {
            photoLabel.textContent = this.files.length > 0
                ? this.files[0].name
                : 'Choisir une image...';
            /* Changer la couleur du label si fichier sélectionné */
            photoLabel.classList.toggle('text-brand-600', this.files.length > 0);
            photoLabel.classList.toggle('text-beige-400', this.files.length === 0);
        });
    }
})();
</script>
@endpush