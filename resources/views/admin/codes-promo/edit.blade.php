
@extends('layouts.admin')
@section('page-title', 'Modifier le Code Promo')

@section('content')

    <a href="{{ route('admin.codes-promo.index') }}" class="inline-flex items-center gap-2 text-sm text-beige-500 hover:text-brand-500 transition-colors mb-5 group">
        <svg class="w-4 h-4 transition-transform group-hover:-translate-x-0.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M19 12H5"/><polyline points="12 19 5 12 12 5"/></svg>
        Retour à la liste
    </a>

    <div class="bg-white rounded-xl border border-beige-200/60 p-6 sm:p-8">

        <div class="flex items-center gap-3 mb-6 pb-5 border-b border-beige-100">
            <div class="w-10 h-10 rounded-lg bg-amber-50 flex items-center justify-center">
                <svg class="w-5 h-5 text-amber-600" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                    <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/>
                    <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/>
                </svg>
            </div>
            <div>
                <h2 class="text-lg font-bold text-dark">{{ $codes_promo->code }}</h2>
                <p class="text-[12px] text-beige-400">Modification du code promo</p>
            </div>
        </div>

        <form action="{{ route('admin.codes-promo.update', $codes_promo) }}" method="POST" class="space-y-5">
            @csrf
            @method('PUT')

            {{-- Code + Type --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label for="code" class="block text-sm font-medium text-dark-50 mb-1.5">Code promo</label>
                    <input type="text" id="code" name="code" value="{{ old('code', $codes_promo->code) }}" required
                        class="w-full px-4 py-2.5 rounded-lg border border-beige-300 bg-white text-sm text-dark focus:outline-none focus:border-brand-500 focus:ring-2 focus:ring-brand-500/10 transition duration-200 uppercase font-mono tracking-wider">
                    @error('code') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label for="type_reduction" class="block text-sm font-medium text-dark-50 mb-1.5">Type de réduction</label>
                    <select id="type_reduction" name="type_reduction" required
                        class="w-full px-4 py-2.5 rounded-lg border border-beige-300 bg-white text-sm text-dark focus:outline-none focus:border-brand-500 focus:ring-2 focus:ring-brand-500/10 transition duration-200">
                        <option value="pourcentage" {{ old('type_reduction', $codes_promo->type_reduction) == 'pourcentage' ? 'selected' : '' }}>Pourcentage (%)</option>
                        <option value="montant_fixe" {{ old('type_reduction', $codes_promo->type_reduction) == 'montant_fixe' ? 'selected' : '' }}>Montant fixe (FCFA)</option>
                    </select>
                    @error('type_reduction') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>
            </div>

            {{-- Valeur + Usage max --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label for="valeur" class="block text-sm font-medium text-dark-50 mb-1.5">Valeur</label>
                    <input type="number" id="valeur" name="valeur" value="{{ old('valeur', $codes_promo->valeur) }}" required min="1"
                        class="w-full px-4 py-2.5 rounded-lg border border-beige-300 bg-white text-sm text-dark focus:outline-none focus:border-brand-500 focus:ring-2 focus:ring-brand-500/10 transition duration-200">
                    @error('valeur') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label for="usage_max" class="block text-sm font-medium text-dark-50 mb-1.5">Utilisations max</label>
                    <input type="number" id="usage_max" name="usage_max" value="{{ old('usage_max', $codes_promo->usage_max) }}" required min="1"
                        class="w-full px-4 py-2.5 rounded-lg border border-beige-300 bg-white text-sm text-dark focus:outline-none focus:border-brand-500 focus:ring-2 focus:ring-brand-500/10 transition duration-200">
                    @error('usage_max') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>
            </div>

            {{-- Dates --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label for="date_debut" class="block text-sm font-medium text-dark-50 mb-1.5">Date de début</label>
                    <input type="date" id="date_debut" name="date_debut" value="{{ old('date_debut', $codes_promo->date_debut->format('Y-m-d')) }}" required
                        class="w-full px-4 py-2.5 rounded-lg border border-beige-300 bg-white text-sm text-dark focus:outline-none focus:border-brand-500 focus:ring-2 focus:ring-brand-500/10 transition duration-200 cursor-pointer">
                    @error('date_debut') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label for="date_fin" class="block text-sm font-medium text-dark-50 mb-1.5">Date de fin</label>
                    <input type="date" id="date_fin" name="date_fin" value="{{ old('date_fin', $codes_promo->date_fin->format('Y-m-d')) }}" required
                        class="w-full px-4 py-2.5 rounded-lg border border-beige-300 bg-white text-sm text-dark focus:outline-none focus:border-brand-500 focus:ring-2 focus:ring-brand-500/10 transition duration-200 cursor-pointer">
                    @error('date_fin') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>
            </div>

            {{-- Statut --}}
            <div class="max-w-xs">
                <label for="statut" class="block text-sm font-medium text-dark-50 mb-1.5">Statut</label>
                <select id="statut" name="statut" required
                    class="w-full px-4 py-2.5 rounded-lg border border-beige-300 bg-white text-sm text-dark focus:outline-none focus:border-brand-500 focus:ring-2 focus:ring-brand-500/10 transition duration-200">
                    <option value="actif" {{ old('statut', $codes_promo->statut) == 'actif' ? 'selected' : '' }}>Actif</option>
                    <option value="inactif" {{ old('statut', $codes_promo->statut) == 'inactif' ? 'selected' : '' }}>Inactif</option>
                    <option value="expire" {{ old('statut', $codes_promo->statut) == 'expire' ? 'selected' : '' }}>Expiré</option>
                </select>
                @error('statut') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
            </div>

            <div class="flex items-center gap-3 pt-3">
                <button type="submit"
                    class="flex items-center gap-2 px-5 py-2.5 bg-brand-500 hover:bg-brand-600 text-white text-sm font-semibold rounded-lg transition-all duration-200 hover:shadow-md hover:shadow-brand-500/20">
                    <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="20 6 9 17 4 12"/></svg>
                    Enregistrer
                </button>
                <a href="{{ route('admin.codes-promo.index') }}"
                   class="px-5 py-2.5 text-sm font-semibold text-beige-500 hover:text-dark rounded-lg border border-beige-300 hover:border-beige-400 transition-all duration-200">
                    Annuler
                </a>
            </div>
        </form>
    </div>

@endsection