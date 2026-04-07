
@extends('layouts.admin')
@section('page-title', 'Gestion des Ingrédients')

@section('content')

    {{-- Filtre --}}
    <div class="bg-white rounded-xl border border-beige-200/60 p-5 mb-5">
        <form action="{{ route('admin.ingredients.index') }}" method="GET" class="flex flex-wrap items-end gap-4">
            <div class="min-w-[200px]">
                <label class="block text-[12px] font-semibold text-dark-50 mb-1.5">Affichage</label>
                <select name="stock_bas"
                    class="w-full px-3 py-2.5 rounded-lg border border-beige-300 bg-white text-sm text-dark focus:outline-none focus:border-brand-500 focus:ring-2 focus:ring-brand-500/10 transition duration-200">
                    <option value="">Tous les ingrédients</option>
                    <option value="1" {{ request('stock_bas') ? 'selected' : '' }}>Stock bas uniquement</option>
                </select>
            </div>
            <div class="flex gap-2">
                <button type="submit"
                    class="flex items-center gap-2 px-4 py-2.5 bg-brand-500 hover:bg-brand-600 text-white text-[13px] font-semibold rounded-lg transition-all duration-200">
                    <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polygon points="22 3 2 3 10 12.46 10 19 14 21 14 12.46 22 3"/></svg>
                    Filtrer
                </button>
                <a href="{{ route('admin.ingredients.index') }}"
                   class="px-4 py-2.5 text-[13px] font-semibold text-beige-500 hover:text-dark rounded-lg border border-beige-300 hover:border-beige-400 transition-all duration-200">
                    Réinitialiser
                </a>
            </div>
        </form>
    </div>

    {{-- Formulaire d'ajout --}}
    <div class="bg-white rounded-xl border border-beige-200/60 p-6 mb-5">
        <div class="flex items-center gap-3 mb-5 pb-4 border-b border-beige-100">
            <div class="w-9 h-9 rounded-lg bg-brand-50 flex items-center justify-center">
                <svg class="w-4 h-4 text-brand-500" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                    <line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/>
                </svg>
            </div>
            <div>
                <h2 class="text-[15px] font-bold text-dark">Ajouter un ingrédient</h2>
                <p class="text-[11px] text-beige-400">Ajoutez un nouvel ingrédient au stock</p>
            </div>
        </div>

        <form action="{{ route('admin.ingredients.store') }}" method="POST" class="space-y-4">
            @csrf
            {{-- Nom + Unité --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label for="nom" class="block text-sm font-medium text-dark-50 mb-1.5">Nom</label>
                    <input type="text" id="nom" name="nom" value="{{ old('nom') }}" required placeholder="Ex: Tomates fraîches"
                        class="w-full px-4 py-2.5 rounded-lg border border-beige-300 bg-white text-sm text-dark placeholder:text-beige-400 focus:outline-none focus:border-brand-500 focus:ring-2 focus:ring-brand-500/10 transition duration-200">
                    @error('nom') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label for="unite" class="block text-sm font-medium text-dark-50 mb-1.5">Unité</label>
                    <select id="unite" name="unite" required
                        class="w-full px-4 py-2.5 rounded-lg border border-beige-300 bg-white text-sm text-dark focus:outline-none focus:border-brand-500 focus:ring-2 focus:ring-brand-500/10 transition duration-200">
                        <option value="kg" {{ old('unite') == 'kg' ? 'selected' : '' }}>Kilogramme (kg)</option>
                        <option value="g" {{ old('unite') == 'g' ? 'selected' : '' }}>Gramme (g)</option>
                        <option value="litre" {{ old('unite') == 'litre' ? 'selected' : '' }}>Litre (L)</option>
                        <option value="piece" {{ old('unite') == 'piece' ? 'selected' : '' }}>Pièce</option>
                    </select>
                    @error('unite') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>
            </div>
            {{-- Quantité + Seuil --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label for="quantite_stock" class="block text-sm font-medium text-dark-50 mb-1.5">Quantité en stock</label>
                    <input type="number" id="quantite_stock" name="quantite_stock" value="{{ old('quantite_stock', 0) }}" required min="0" step="0.1"
                        class="w-full px-4 py-2.5 rounded-lg border border-beige-300 bg-white text-sm text-dark focus:outline-none focus:border-brand-500 focus:ring-2 focus:ring-brand-500/10 transition duration-200">
                    @error('quantite_stock') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label for="seuil_alerte" class="block text-sm font-medium text-dark-50 mb-1.5">Seuil d'alerte</label>
                    <input type="number" id="seuil_alerte" name="seuil_alerte" value="{{ old('seuil_alerte', 5) }}" required min="0" step="0.1"
                        class="w-full px-4 py-2.5 rounded-lg border border-beige-300 bg-white text-sm text-dark focus:outline-none focus:border-brand-500 focus:ring-2 focus:ring-brand-500/10 transition duration-200">
                    @error('seuil_alerte') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>
            </div>
            <button type="submit"
                class="flex items-center gap-2 px-5 py-2.5 bg-brand-500 hover:bg-brand-600 text-white text-sm font-semibold rounded-lg transition-all duration-200 hover:shadow-md hover:shadow-brand-500/20">
                <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="20 6 9 17 4 12"/></svg>
                Ajouter
            </button>
        </form>
    </div>

    {{-- Tableau des ingrédients --}}
    <div class="bg-white rounded-xl border border-beige-200/60 overflow-hidden">
        <div class="flex items-center justify-between px-6 py-4 border-b border-beige-100">
            <div class="flex items-center gap-3">
                <div class="w-9 h-9 rounded-lg bg-amber-50 flex items-center justify-center">
                    <svg class="w-4 h-4 text-amber-600" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"/>
                        <line x1="3" y1="6" x2="21" y2="6"/><path d="M16 10a4 4 0 0 1-8 0"/>
                    </svg>
                </div>
                <div>
                    <h2 class="text-[15px] font-bold text-dark">Ingrédients</h2>
                    <p class="text-[11px] text-beige-400">{{ $ingredients->total() }} ingrédient{{ $ingredients->total() > 1 ? 's' : '' }} enregistré{{ $ingredients->total() > 1 ? 's' : '' }}</p>
                </div>
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr>
                        <th class="px-5 py-3 text-left text-[10px] font-bold uppercase tracking-widest text-beige-400 bg-beige-50/50">Ingrédient</th>
                        <th class="px-5 py-3 text-left text-[10px] font-bold uppercase tracking-widest text-beige-400 bg-beige-50/50">Unité</th>
                        <th class="px-5 py-3 text-left text-[10px] font-bold uppercase tracking-widest text-beige-400 bg-beige-50/50">Stock</th>
                        <th class="px-5 py-3 text-left text-[10px] font-bold uppercase tracking-widest text-beige-400 bg-beige-50/50">Seuil</th>
                        <th class="px-5 py-3 text-center text-[10px] font-bold uppercase tracking-widest text-beige-400 bg-beige-50/50">Ateliers</th>
                        <th class="px-5 py-3 text-left text-[10px] font-bold uppercase tracking-widest text-beige-400 bg-beige-50/50">État</th>
                        <th class="px-5 py-3 text-right text-[10px] font-bold uppercase tracking-widest text-beige-400 bg-beige-50/50">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($ingredients as $ingredient)
                        @php
                            $stockBas = $ingredient->stockBas();
                            $pct = $ingredient->seuil_alerte > 0 ? min(($ingredient->quantite_stock / ($ingredient->seuil_alerte * 3)) * 100, 100) : 100;
                        @endphp
                        <tr class="border-b border-beige-50 transition-colors duration-100 {{ $stockBas ? 'bg-red-50/30' : 'hover:bg-beige-50/40' }}">
                            <td class="px-5 py-3 text-[13px] font-semibold text-dark">{{ $ingredient->nom }}</td>
                            <td class="px-5 py-3 text-[13px] text-beige-500">{{ $ingredient->unite }}</td>
                            {{-- Stock avec barre de progression --}}
                            <td class="px-5 py-3" style="min-width: 130px;">
                                <span class="text-[14px] font-bold {{ $stockBas ? 'text-red-600' : 'text-emerald-600' }}">
                                    {{ $ingredient->quantite_stock }}
                                </span>
                                <div class="w-full h-1 rounded-full bg-beige-200 mt-1.5 overflow-hidden">
                                    <div class="h-full rounded-full transition-all duration-500 {{ $stockBas ? 'bg-red-400' : ($pct < 50 ? 'bg-amber-400' : 'bg-emerald-500') }}"
                                         style="width: {{ $pct }}%;"></div>
                                </div>
                            </td>
                            <td class="px-5 py-3 text-[13px] text-beige-400">{{ $ingredient->seuil_alerte }}</td>
                            <td class="px-5 py-3 text-center">
                                <span class="inline-flex items-center justify-center w-7 h-7 rounded-md text-[11px] font-bold bg-blue-50 text-blue-700">
                                    {{ $ingredient->ateliers_count }}
                                </span>
                            </td>
                            {{-- État --}}
                            <td class="px-5 py-3">
                                @if($stockBas)
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-md text-[11px] font-semibold bg-red-50 text-red-700">
                                        <svg class="w-3 h-3" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                            <path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"/>
                                            <line x1="12" y1="9" x2="12" y2="13"/><line x1="12" y1="17" x2="12.01" y2="17"/>
                                        </svg>
                                        Stock bas
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-md text-[11px] font-semibold bg-emerald-50 text-emerald-700">
                                        <svg class="w-3 h-3" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="20 6 9 17 4 12"/></svg>
                                        OK
                                    </span>
                                @endif
                            </td>
                            {{-- Actions : mise à jour stock + supprimer --}}
                            <td class="px-5 py-3">
                                <div class="flex items-center justify-end gap-2">
                                    {{-- MAJ rapide quantité --}}
                                    <form action="{{ route('admin.ingredients.update', $ingredient) }}" method="POST" class="flex items-center gap-1.5">
                                        @csrf
                                        @method('PUT')
                                        <input type="hidden" name="nom" value="{{ $ingredient->nom }}">
                                        <input type="hidden" name="unite" value="{{ $ingredient->unite }}">
                                        <input type="hidden" name="seuil_alerte" value="{{ $ingredient->seuil_alerte }}">
                                        <input type="number" name="quantite_stock" value="{{ $ingredient->quantite_stock }}" min="0" step="0.1"
                                            class="w-20 px-2 py-1.5 rounded-md border border-beige-300 bg-white text-[13px] text-dark text-center focus:outline-none focus:border-brand-500 transition duration-200">
                                        <button type="submit"
                                            class="w-7 h-7 rounded-md flex items-center justify-center bg-brand-50 text-brand-600 hover:bg-brand-500 hover:text-white transition-all duration-200" title="Mettre à jour">
                                            <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg>
                                        </button>
                                    </form>
                                    {{-- Supprimer --}}
                                    <form action="{{ route('admin.ingredients.destroy', $ingredient) }}" method="POST" data-confirm="Supprimer cet ingrédient ? Cette action est irréversible.">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="w-7 h-7 rounded-md flex items-center justify-center text-beige-400 hover:text-red-600 hover:bg-red-50 transition-all duration-200" title="Supprimer">
                                            <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                                                <polyline points="3 6 5 6 21 6"/><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/>
                                                <line x1="10" y1="11" x2="10" y2="17"/><line x1="14" y1="11" x2="14" y2="17"/>
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-6 py-16 text-center">
                                <svg class="w-10 h-10 text-beige-200 mx-auto mb-3" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                                    <path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"/>
                                    <line x1="3" y1="6" x2="21" y2="6"/>
                                </svg>
                                <p class="text-sm text-beige-400">Aucun ingrédient enregistré</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($ingredients->hasPages())
            <div class="px-6 py-4 border-t border-beige-100">
                {{ $ingredients->links() }}
            </div>
        @endif
    </div>

@endsection