
@extends('layouts.admin')
@section('page-title', 'Gestion des Ateliers')

@section('content')

    <div class="bg-white rounded-xl border border-beige-200/60 overflow-hidden">

        {{-- En-tête : titre + bouton créer --}}
        <div class="flex items-center justify-between px-6 py-4 border-b border-beige-100">
            <div class="flex items-center gap-3">
                <div class="w-9 h-9 rounded-lg bg-brand-50 flex items-center justify-center">
                    <svg class="w-4 h-4 text-brand-500" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M18 8h1a4 4 0 0 1 0 8h-1" /><path d="M2 8h16v9a4 4 0 0 1-4 4H6a4 4 0 0 1-4-4V8z" />
                        <line x1="6" y1="1" x2="6" y2="4" /><line x1="10" y1="1" x2="10" y2="4" /><line x1="14" y1="1" x2="14" y2="4" />
                    </svg>
                </div>
                <div>
                    <h2 class="text-[15px] font-bold text-dark">Liste des ateliers</h2>
                    <p class="text-[11px] text-beige-400">{{ $ateliers->total() }} atelier{{ $ateliers->total() > 1 ? 's' : '' }} au total</p>
                </div>
            </div>
            <a href="{{ route('admin.ateliers.create') }}"
               class="flex items-center gap-2 px-4 py-2.5 bg-brand-500 hover:bg-brand-600 text-white text-[13px] font-semibold rounded-lg transition-all duration-200 hover:shadow-md hover:shadow-brand-500/20">
                <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <line x1="12" y1="5" x2="12" y2="19" /><line x1="5" y1="12" x2="19" y2="12" />
                </svg>
                Nouvel atelier
            </a>
        </div>

        {{-- Table --}}
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr>
                        <th class="px-6 py-3 text-left text-[10px] font-bold uppercase tracking-widest text-beige-400 bg-beige-50/50">Atelier</th>
                        <th class="px-6 py-3 text-left text-[10px] font-bold uppercase tracking-widest text-beige-400 bg-beige-50/50">Pays</th>
                        <th class="px-6 py-3 text-left text-[10px] font-bold uppercase tracking-widest text-beige-400 bg-beige-50/50">Prix</th>
                        <th class="px-6 py-3 text-left text-[10px] font-bold uppercase tracking-widest text-beige-400 bg-beige-50/50">Durée</th>
                        <th class="px-6 py-3 text-center text-[10px] font-bold uppercase tracking-widest text-beige-400 bg-beige-50/50">Créneaux</th>
                        <th class="px-6 py-3 text-center text-[10px] font-bold uppercase tracking-widest text-beige-400 bg-beige-50/50">Avis</th>
                        <th class="px-6 py-3 text-left text-[10px] font-bold uppercase tracking-widest text-beige-400 bg-beige-50/50">Statut</th>
                        <th class="px-6 py-3 text-right text-[10px] font-bold uppercase tracking-widest text-beige-400 bg-beige-50/50">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($ateliers as $atelier)
                        <tr class="border-b border-beige-50 hover:bg-beige-50/40 transition-colors duration-100">

                            {{-- Atelier : titre + plat --}}
                            <td class="px-6 py-3">
                                <p class="text-[13px] font-semibold text-dark">{{ $atelier->titre }}</p>
                                <p class="text-[11px] text-beige-400 mt-0.5">{{ Str::limit($atelier->plat, 35) }}</p>
                            </td>

                            {{-- Pays --}}
                            <td class="px-6 py-3 text-[13px] text-dark-50">{{ $atelier->origine_pays }}</td>

                            {{-- Prix --}}
                            <td class="px-6 py-3 text-[13px] font-bold text-brand-600 whitespace-nowrap">
                                {{ number_format($atelier->prix, 0, ',', ' ') }} FCFA
                            </td>

                            {{-- Durée --}}
                            <td class="px-6 py-3 text-[13px] text-beige-500 whitespace-nowrap">
                                {{ $atelier->duree_minutes }} min
                            </td>

                            {{-- Créneaux (badge numérique) --}}
                            <td class="px-6 py-3 text-center">
                                <span class="inline-flex items-center justify-center w-7 h-7 rounded-md text-[11px] font-bold bg-blue-50 text-blue-700">
                                    {{ $atelier->creneaux_count }}
                                </span>
                            </td>

                            {{-- Avis (badge numérique) --}}
                            <td class="px-6 py-3 text-center">
                                <span class="inline-flex items-center justify-center w-7 h-7 rounded-md text-[11px] font-bold bg-amber-50 text-amber-700">
                                    {{ $atelier->avis_count }}
                                </span>
                            </td>

                            {{-- Statut --}}
                            <td class="px-6 py-3">
                                @switch($atelier->statut)
                                    @case('actif')
                                        <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-md text-[11px] font-semibold bg-emerald-50 text-emerald-700">
                                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-400"></span>Actif
                                        </span>
                                        @break
                                    @case('inactif')
                                        <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-md text-[11px] font-semibold bg-gray-100 text-gray-600">
                                            <span class="w-1.5 h-1.5 rounded-full bg-gray-400"></span>Inactif
                                        </span>
                                        @break
                                    @case('complet')
                                        <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-md text-[11px] font-semibold bg-red-50 text-red-700">
                                            <span class="w-1.5 h-1.5 rounded-full bg-red-400"></span>Complet
                                        </span>
                                        @break
                                @endswitch
                            </td>

                            {{-- Actions : modifier + supprimer --}}
                            <td class="px-6 py-3">
                                <div class="flex items-center justify-end gap-2">
                                    {{-- Bouton modifier --}}
                                    <a href="{{ route('admin.ateliers.edit', $atelier) }}"
                                       class="w-8 h-8 rounded-lg flex items-center justify-center text-beige-400 hover:text-amber-600 hover:bg-amber-50 transition-all duration-200"
                                       title="Modifier">
                                        <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7" />
                                            <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z" />
                                        </svg>
                                    </a>
                                    {{-- Bouton supprimer --}}
                                    <form action="{{ route('admin.ateliers.destroy', $atelier) }}" method="POST"
                                          data-confirm="Supprimer cet atelier ? Cette action est irréversible.">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="w-8 h-8 rounded-lg flex items-center justify-center text-beige-400 hover:text-red-600 hover:bg-red-50 transition-all duration-200"
                                            title="Supprimer">
                                            <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                                                <polyline points="3 6 5 6 21 6" />
                                                <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2" />
                                                <line x1="10" y1="11" x2="10" y2="17" />
                                                <line x1="14" y1="11" x2="14" y2="17" />
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="px-6 py-16 text-center">
                                <svg class="w-10 h-10 text-beige-200 mx-auto mb-3" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                                    <path d="M18 8h1a4 4 0 0 1 0 8h-1" /><path d="M2 8h16v9a4 4 0 0 1-4 4H6a4 4 0 0 1-4-4V8z" />
                                </svg>
                                <p class="text-sm text-beige-400">Aucun atelier créé</p>
                                <a href="{{ route('admin.ateliers.create') }}" class="text-[13px] font-semibold text-brand-500 hover:underline mt-1 inline-block">Créer le premier</a>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Pagination --}}
        @if($ateliers->hasPages())
            <div class="px-6 py-4 border-t border-beige-100">
                {{ $ateliers->links() }}
            </div>
        @endif
    </div>

@endsection