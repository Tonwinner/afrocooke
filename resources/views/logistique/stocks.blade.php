@extends('layouts.app')
@section('title', 'Gestion des Stocks — AfroCook Experience')

@section('content')

    {{-- Header --}}
    <section class="relative py-14 sm:py-16 text-center overflow-hidden">
        <div class="absolute inset-0">
            <img src="https://images.unsplash.com/photo-1556910103-1c02745aae4d?w=1200&q=80" alt="" class="w-full h-full object-cover">
            <div class="absolute inset-0 bg-dark/75"></div>
        </div>
        <div class="relative z-10 max-w-7xl mx-auto px-5 sm:px-8 lg:px-10">
            <h1 class="text-3xl sm:text-4xl font-extrabold text-white tracking-tight mb-3">Gestion des Stocks</h1>
            <p class="text-[15px] text-white/50 max-w-md mx-auto">Suivez et mettez à jour vos stocks d'ingrédients</p>
        </div>
    </section>

    <section class="bg-beige-50 py-10 sm:py-14">
        <div class="max-w-7xl mx-auto px-5 sm:px-8 lg:px-10">

            {{-- Alertes stock bas --}}
            @if($stocksBas->count() > 0)
                <div class="bg-amber-50 border border-amber-200 rounded-2xl p-5 mb-8">
                    <div class="flex items-center gap-3 mb-4">
                        <div class="w-9 h-9 rounded-lg bg-amber-100 flex items-center justify-center flex-shrink-0">
                            <svg class="w-4 h-4 text-amber-600" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"/>
                                <line x1="12" y1="9" x2="12" y2="13"/><line x1="12" y1="17" x2="12.01" y2="17"/>
                            </svg>
                        </div>
                        <h3 class="text-[15px] font-bold text-amber-800">{{ $stocksBas->count() }} ingrédient{{ $stocksBas->count() > 1 ? 's' : '' }} en stock bas</h3>
                    </div>
                    <div class="flex flex-wrap gap-3">
                        @foreach($stocksBas as $ingredient)
                            <div class="flex items-center gap-3 bg-white rounded-xl px-4 py-3 border border-amber-200">
                                <div class="w-8 h-8 rounded-lg bg-red-50 flex items-center justify-center flex-shrink-0">
                                    <svg class="w-4 h-4 text-red-500" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="23 18 13.5 8.5 8.5 13.5 1 6"/><polyline points="17 18 23 18 23 12"/></svg>
                                </div>
                                <div>
                                    <p class="text-[13px] font-semibold text-dark">{{ $ingredient->nom }}</p>
                                    <p class="text-[11px] text-red-500">{{ $ingredient->quantite_stock }} {{ $ingredient->unite }} (seuil: {{ $ingredient->seuil_alerte }})</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

            {{-- Tableau des stocks --}}
            <div class="bg-white rounded-2xl border border-beige-200/60 overflow-hidden">
                <div class="flex items-center justify-between px-6 py-4 border-b border-beige-100">
                    <div class="flex items-center gap-3">
                        <div class="w-9 h-9 rounded-lg bg-brand-50 flex items-center justify-center">
                            <svg class="w-4 h-4 text-brand-500" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"/><line x1="3" y1="6" x2="21" y2="6"/><path d="M16 10a4 4 0 0 1-8 0"/></svg>
                        </div>
                        <div>
                            <h2 class="text-[15px] font-bold text-dark">Tous les ingrédients</h2>
                            <p class="text-[11px] text-beige-400">{{ $ingredients->count() }} ingrédient{{ $ingredients->count() > 1 ? 's' : '' }}</p>
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
                                <th class="px-5 py-3 text-right text-[10px] font-bold uppercase tracking-widest text-beige-400 bg-beige-50/50">Mise à jour</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($ingredients as $ingredient)
                                @php
                                    $stockBas = $ingredient->stockBas();
                                    $pct = $ingredient->seuil_alerte > 0 ? min(($ingredient->quantite_stock / ($ingredient->seuil_alerte * 3)) * 100, 100) : 100;
                                    $attention = $ingredient->quantite_stock <= $ingredient->seuil_alerte * 2 && !$stockBas;
                                @endphp
                                <tr class="border-b border-beige-50 transition-colors duration-100 {{ $stockBas ? 'bg-red-50/30' : 'hover:bg-beige-50/40' }}">
                                    <td class="px-5 py-3 text-[13px] font-semibold text-dark">{{ $ingredient->nom }}</td>
                                    <td class="px-5 py-3 text-[13px] text-beige-500">{{ $ingredient->unite }}</td>
                                    {{-- Stock avec barre --}}
                                    <td class="px-5 py-3" style="min-width: 130px;">
                                        <span class="text-[14px] font-bold {{ $stockBas ? 'text-red-600' : ($attention ? 'text-amber-600' : 'text-emerald-600') }}">
                                            {{ $ingredient->quantite_stock }}
                                        </span>
                                        <div class="w-full h-1 rounded-full bg-beige-200 mt-1.5 overflow-hidden">
                                            <div class="h-full rounded-full transition-all duration-500 {{ $stockBas ? 'bg-red-400' : ($attention ? 'bg-amber-400' : 'bg-emerald-500') }}"
                                                 style="width: {{ $pct }}%;"></div>
                                        </div>
                                    </td>
                                    <td class="px-5 py-3 text-[13px] text-beige-400">{{ $ingredient->seuil_alerte }}</td>
                                    <td class="px-5 py-3 text-center">
                                        <span class="inline-flex items-center justify-center w-7 h-7 rounded-md text-[11px] font-bold bg-blue-50 text-blue-700">{{ $ingredient->ateliers_count }}</span>
                                    </td>
                                    {{-- État --}}
                                    <td class="px-5 py-3">
                                        @if($stockBas)
                                            <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-md text-[11px] font-semibold bg-red-50 text-red-700">
                                                <svg class="w-3 h-3" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"/><line x1="12" y1="9" x2="12" y2="13"/><line x1="12" y1="17" x2="12.01" y2="17"/></svg>
                                                Critique
                                            </span>
                                        @elseif($attention)
                                            <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-md text-[11px] font-semibold bg-amber-50 text-amber-700">
                                                <svg class="w-3 h-3" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
                                                Attention
                                            </span>
                                        @else
                                            <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-md text-[11px] font-semibold bg-emerald-50 text-emerald-700">
                                                <svg class="w-3 h-3" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="20 6 9 17 4 12"/></svg>
                                                OK
                                            </span>
                                        @endif
                                    </td>
                                    {{-- MAJ rapide --}}
                                    <td class="px-5 py-3">
                                        <form action="{{ route('logistique.stocks.update', $ingredient) }}" method="POST" class="flex items-center justify-end gap-1.5">
                                            @csrf
                                            @method('PUT')
                                            <input type="number" name="quantite_stock" value="{{ $ingredient->quantite_stock }}" min="0" step="0.1"
                                                class="w-20 px-2 py-1.5 rounded-md border border-beige-300 bg-white text-[13px] text-dark text-center focus:outline-none focus:border-brand-500 transition duration-200">
                                            <button type="submit"
                                                class="w-7 h-7 rounded-md flex items-center justify-center bg-brand-50 text-brand-600 hover:bg-brand-500 hover:text-white transition-all duration-200" title="Mettre à jour">
                                                <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="px-6 py-16 text-center">
                                        <svg class="w-10 h-10 text-beige-200 mx-auto mb-3" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1"><path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"/><line x1="3" y1="6" x2="21" y2="6"/></svg>
                                        <p class="text-sm text-beige-400">Aucun ingrédient enregistré. Contactez l'administrateur.</p>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>

@endsection