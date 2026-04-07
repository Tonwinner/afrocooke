
@extends('layouts.admin')
@section('page-title', 'Modifier l\'atelier')

@section('content')

    {{-- Lien retour --}}
    <a href="{{ route('admin.ateliers.index') }}" class="inline-flex items-center gap-2 text-sm text-beige-500 hover:text-brand-500 transition-colors mb-5 group">
        <svg class="w-4 h-4 transition-transform group-hover:-translate-x-0.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M19 12H5" /><polyline points="12 19 5 12 12 5" />
        </svg>
        Retour à la liste
    </a>

    <div class="bg-white rounded-xl border border-beige-200/60 p-6 sm:p-8">

        {{-- En-tête --}}
        <div class="flex items-center gap-3 mb-6 pb-5 border-b border-beige-100">
            <div class="w-10 h-10 rounded-lg bg-amber-50 flex items-center justify-center">
                <svg class="w-5 h-5 text-amber-600" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7" />
                    <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z" />
                </svg>
            </div>
            <div>
                <h2 class="text-lg font-bold text-dark">{{ $atelier->titre }}</h2>
                <p class="text-[12px] text-beige-400">Modification de l'atelier</p>
            </div>
        </div>

        <form action="{{ route('admin.ateliers.update', $atelier) }}" method="POST" enctype="multipart/form-data" class="space-y-5">
            @csrf
            @method('PUT')

            {{-- Ligne 1 : Titre + Plat --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label for="titre" class="block text-sm font-medium text-dark-50 mb-1.5">Titre de l'atelier</label>
                    <input type="text" id="titre" name="titre" value="{{ old('titre', $atelier->titre) }}" required
                        class="w-full px-4 py-2.5 rounded-lg border border-beige-300 bg-white text-sm text-dark placeholder:text-beige-400 focus:outline-none focus:border-brand-500 focus:ring-2 focus:ring-brand-500/10 transition duration-200">
                    @error('titre') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label for="plat" class="block text-sm font-medium text-dark-50 mb-1.5">Nom du plat</label>
                    <input type="text" id="plat" name="plat" value="{{ old('plat', $atelier->plat) }}" required
                        class="w-full px-4 py-2.5 rounded-lg border border-beige-300 bg-white text-sm text-dark placeholder:text-beige-400 focus:outline-none focus:border-brand-500 focus:ring-2 focus:ring-brand-500/10 transition duration-200">
                    @error('plat') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>
            </div>

            {{-- Description --}}
            <div>
                <label for="description" class="block text-sm font-medium text-dark-50 mb-1.5">Description</label>
                <textarea id="description" name="description" rows="4" required
                    class="w-full px-4 py-2.5 rounded-lg border border-beige-300 bg-white text-sm text-dark placeholder:text-beige-400 focus:outline-none focus:border-brand-500 focus:ring-2 focus:ring-brand-500/10 transition duration-200 resize-none">{{ old('description', $atelier->description) }}</textarea>
                @error('description') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
            </div>

            {{-- Ligne 2 : Pays + Prix --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label for="origine_pays" class="block text-sm font-medium text-dark-50 mb-1.5">Pays d'origine</label>
                    <input type="text" id="origine_pays" name="origine_pays" value="{{ old('origine_pays', $atelier->origine_pays) }}" required
                        class="w-full px-4 py-2.5 rounded-lg border border-beige-300 bg-white text-sm text-dark placeholder:text-beige-400 focus:outline-none focus:border-brand-500 focus:ring-2 focus:ring-brand-500/10 transition duration-200">
                    @error('origine_pays') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label for="prix" class="block text-sm font-medium text-dark-50 mb-1.5">Prix par personne (FCFA)</label>
                    <input type="number" id="prix" name="prix" value="{{ old('prix', $atelier->prix) }}" required min="0"
                        class="w-full px-4 py-2.5 rounded-lg border border-beige-300 bg-white text-sm text-dark placeholder:text-beige-400 focus:outline-none focus:border-brand-500 focus:ring-2 focus:ring-brand-500/10 transition duration-200">
                    @error('prix') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>
            </div>

            {{-- Ligne 3 : Durée + Participants --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label for="duree_minutes" class="block text-sm font-medium text-dark-50 mb-1.5">Durée (minutes)</label>
                    <input type="number" id="duree_minutes" name="duree_minutes" value="{{ old('duree_minutes', $atelier->duree_minutes) }}" required min="30"
                        class="w-full px-4 py-2.5 rounded-lg border border-beige-300 bg-white text-sm text-dark placeholder:text-beige-400 focus:outline-none focus:border-brand-500 focus:ring-2 focus:ring-brand-500/10 transition duration-200">
                    @error('duree_minutes') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label for="max_participants" class="block text-sm font-medium text-dark-50 mb-1.5">Participants maximum</label>
                    <input type="number" id="max_participants" name="max_participants" value="{{ old('max_participants', $atelier->max_participants) }}" required min="2" max="20"
                        class="w-full px-4 py-2.5 rounded-lg border border-beige-300 bg-white text-sm text-dark placeholder:text-beige-400 focus:outline-none focus:border-brand-500 focus:ring-2 focus:ring-brand-500/10 transition duration-200">
                    @error('max_participants') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>
            </div>

            {{-- Ligne 4 : Photo + Statut --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label for="photo" class="block text-sm font-medium text-dark-50 mb-1.5">Photo de l'atelier</label>
                    <input type="file" id="photo" name="photo" accept="image/*"
                        class="w-full text-sm text-beige-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-brand-50 file:text-brand-600 hover:file:bg-brand-100 file:cursor-pointer file:transition-colors">
                    @if($atelier->photo)
                        <p class="mt-1.5 text-[12px] text-beige-400 flex items-center gap-1.5">
                            <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><rect x="3" y="3" width="18" height="18" rx="2"/><circle cx="8.5" cy="8.5" r="1.5"/><polyline points="21 15 16 10 5 21"/></svg>
                            Photo actuelle : {{ $atelier->photo }}
                        </p>
                    @endif
                    @error('photo') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label for="statut" class="block text-sm font-medium text-dark-50 mb-1.5">Statut</label>
                    <select id="statut" name="statut" required
                        class="w-full px-4 py-2.5 rounded-lg border border-beige-300 bg-white text-sm text-dark focus:outline-none focus:border-brand-500 focus:ring-2 focus:ring-brand-500/10 transition duration-200">
                        <option value="actif" {{ old('statut', $atelier->statut) == 'actif' ? 'selected' : '' }}>Actif</option>
                        <option value="inactif" {{ old('statut', $atelier->statut) == 'inactif' ? 'selected' : '' }}>Inactif</option>
                        <option value="complet" {{ old('statut', $atelier->statut) == 'complet' ? 'selected' : '' }}>Complet</option>
                    </select>
                    @error('statut') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>
            </div>

            {{-- Boutons --}}
            <div class="flex items-center gap-3 pt-3">
                <button type="submit"
                    class="flex items-center gap-2 px-5 py-2.5 bg-brand-500 hover:bg-brand-600 text-white text-sm font-semibold rounded-lg transition-all duration-200 hover:shadow-md hover:shadow-brand-500/20">
                    <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <polyline points="20 6 9 17 4 12" />
                    </svg>
                    Enregistrer
                </button>
                <a href="{{ route('admin.ateliers.index') }}"
                   class="px-5 py-2.5 text-sm font-semibold text-beige-500 hover:text-dark rounded-lg border border-beige-300 hover:border-beige-400 transition-all duration-200">
                    Annuler
                </a>
            </div>
        </form>
    </div>

@endsection