
@extends('layouts.admin')
@section('page-title', 'Créer un Code Promo')

@section('content')

    <a href="{{ route('admin.codes-promo.index') }}" class="inline-flex items-center gap-2 text-sm text-beige-500 hover:text-brand-500 transition-colors mb-5 group">
        <svg class="w-4 h-4 transition-transform group-hover:-translate-x-0.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M19 12H5"/><polyline points="12 19 5 12 12 5"/></svg>
        Retour à la liste
    </a>

    <div class="bg-white rounded-xl border border-beige-200/60 p-6 sm:p-8">

        <div class="flex items-center gap-3 mb-6 pb-5 border-b border-beige-100">
            <div class="w-10 h-10 rounded-lg bg-brand-50 flex items-center justify-center">
                <svg class="w-5 h-5 text-brand-500" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
            </div>
            <div>
                <h2 class="text-lg font-bold text-dark">Nouveau code promo</h2>
                <p class="text-[12px] text-beige-400">Créez un code de réduction pour vos clients</p>
            </div>
        </div>

        <form action="{{ route('admin.codes-promo.store') }}" method="POST" class="space-y-5">
            @csrf

            {{-- Code + Type --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label for="code" class="block text-sm font-medium text-dark-50 mb-1.5">Code promo</label>
                    <input type="text" id="code" name="code" value="{{ old('code') }}" required placeholder="Ex: BIENVENUE20"
                        class="w-full px-4 py-2.5 rounded-lg border border-beige-300 bg-white text-sm text-dark placeholder:text-beige-400 focus:outline-none focus:border-brand-500 focus:ring-2 focus:ring-brand-500/10 transition duration-200 uppercase font-mono tracking-wider">
                    @error('code') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label for="type_reduction" class="block text-sm font-medium text-dark-50 mb-1.5">Type de réduction</label>
                    <select id="type_reduction" name="type_reduction" required
                        class="w-full px-4 py-2.5 rounded-lg border border-beige-300 bg-white text-sm text-dark focus:outline-none focus:border-brand-500 focus:ring-2 focus:ring-brand-500/10 transition duration-200">
                        <option value="pourcentage" {{ old('type_reduction') == 'pourcentage' ? 'selected' : '' }}>Pourcentage (%)</option>
                        <option value="montant_fixe" {{ old('type_reduction') == 'montant_fixe' ? 'selected' : '' }}>Montant fixe (FCFA)</option>
                    </select>
                    @error('type_reduction') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>
            </div>

            {{-- Valeur + Usage max --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label for="valeur" class="block text-sm font-medium text-dark-50 mb-1.5">Valeur</label>
                    <input type="number" id="valeur" name="valeur" value="{{ old('valeur') }}" required min="1" placeholder="Ex: 20 ou 5000"
                        class="w-full px-4 py-2.5 rounded-lg border border-beige-300 bg-white text-sm text-dark placeholder:text-beige-400 focus:outline-none focus:border-brand-500 focus:ring-2 focus:ring-brand-500/10 transition duration-200">
                    @error('valeur') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label for="usage_max" class="block text-sm font-medium text-dark-50 mb-1.5">Utilisations max</label>
                    <input type="number" id="usage_max" name="usage_max" value="{{ old('usage_max', 100) }}" required min="1" placeholder="Ex: 100"
                        class="w-full px-4 py-2.5 rounded-lg border border-beige-300 bg-white text-sm text-dark placeholder:text-beige-400 focus:outline-none focus:border-brand-500 focus:ring-2 focus:ring-brand-500/10 transition duration-200">
                    @error('usage_max') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>
            </div>

            {{-- Dates --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label for="date_debut" class="block text-sm font-medium text-dark-50 mb-1.5">Date de début</label>
                    <input type="date" id="date_debut" name="date_debut" value="{{ old('date_debut') }}" required min="{{ date('Y-m-d') }}"
                        class="w-full px-4 py-2.5 rounded-lg border border-beige-300 bg-white text-sm text-dark focus:outline-none focus:border-brand-500 focus:ring-2 focus:ring-brand-500/10 transition duration-200 cursor-pointer">
                    @error('date_debut') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label for="date_fin" class="block text-sm font-medium text-dark-50 mb-1.5">Date de fin</label>
                    <input type="date" id="date_fin" name="date_fin" value="{{ old('date_fin') }}" required
                        class="w-full px-4 py-2.5 rounded-lg border border-beige-300 bg-white text-sm text-dark focus:outline-none focus:border-brand-500 focus:ring-2 focus:ring-brand-500/10 transition duration-200 cursor-pointer">
                    @error('date_fin') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>
            </div>

            <div class="flex items-center gap-3 pt-3">
                <button type="submit"
                    class="flex items-center gap-2 px-5 py-2.5 bg-brand-500 hover:bg-brand-600 text-white text-sm font-semibold rounded-lg transition-all duration-200 hover:shadow-md hover:shadow-brand-500/20">
                    <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="20 6 9 17 4 12"/></svg>
                    Créer le code
                </button>
                <a href="{{ route('admin.codes-promo.index') }}"
                   class="px-5 py-2.5 text-sm font-semibold text-beige-500 hover:text-dark rounded-lg border border-beige-300 hover:border-beige-400 transition-all duration-200">
                    Annuler
                </a>
            </div>
        </form>
    </div>

@endsection