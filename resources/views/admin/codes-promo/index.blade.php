
@extends('layouts.admin')
@section('page-title', 'Gestion des Codes Promo')

@section('content')

    <div class="bg-white rounded-xl border border-beige-200/60 overflow-hidden">

        {{-- En-tête --}}
        <div class="flex items-center justify-between px-6 py-4 border-b border-beige-100">
            <div class="flex items-center gap-3">
                <div class="w-9 h-9 rounded-lg bg-amber-50 flex items-center justify-center">
                    <svg class="w-4 h-4 text-amber-600" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                        <polyline points="20 12 20 22 4 22 4 12" /><rect x="2" y="7" width="20" height="5" />
                        <line x1="12" y1="22" x2="12" y2="7" /><path d="M12 7H7.5a2.5 2.5 0 0 1 0-5C11 2 12 7 12 7z" />
                        <path d="M12 7h4.5a2.5 2.5 0 0 0 0-5C13 2 12 7 12 7z" />
                    </svg>
                </div>
                <div>
                    <h2 class="text-[15px] font-bold text-dark">Codes Promo</h2>
                    <p class="text-[11px] text-beige-400">{{ $codesPromo->total() }} code{{ $codesPromo->total() > 1 ? 's' : '' }}</p>
                </div>
            </div>
            <a href="{{ route('admin.codes-promo.create') }}"
               class="flex items-center gap-2 px-4 py-2.5 bg-brand-500 hover:bg-brand-600 text-white text-[13px] font-semibold rounded-lg transition-all duration-200 hover:shadow-md hover:shadow-brand-500/20">
                <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
                Nouveau code
            </a>
        </div>

        {{-- Table --}}
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr>
                        <th class="px-5 py-3 text-left text-[10px] font-bold uppercase tracking-widest text-beige-400 bg-beige-50/50">Code</th>
                        <th class="px-5 py-3 text-left text-[10px] font-bold uppercase tracking-widest text-beige-400 bg-beige-50/50">Type</th>
                        <th class="px-5 py-3 text-left text-[10px] font-bold uppercase tracking-widest text-beige-400 bg-beige-50/50">Valeur</th>
                        <th class="px-5 py-3 text-left text-[10px] font-bold uppercase tracking-widest text-beige-400 bg-beige-50/50">Période</th>
                        <th class="px-5 py-3 text-left text-[10px] font-bold uppercase tracking-widest text-beige-400 bg-beige-50/50">Utilisation</th>
                        <th class="px-5 py-3 text-left text-[10px] font-bold uppercase tracking-widest text-beige-400 bg-beige-50/50">Statut</th>
                        <th class="px-5 py-3 text-right text-[10px] font-bold uppercase tracking-widest text-beige-400 bg-beige-50/50">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($codesPromo as $code)
                        <tr class="border-b border-beige-50 hover:bg-beige-50/40 transition-colors duration-100">
                            {{-- Code promo en monospace --}}
                            <td class="px-5 py-3">
                                <span class="font-mono text-[14px] font-bold text-dark tracking-wider">{{ $code->code }}</span>
                            </td>
                            {{-- Type de réduction --}}
                            <td class="px-5 py-3">
                                @if($code->type_reduction == 'pourcentage')
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-md text-[11px] font-semibold bg-blue-50 text-blue-700">
                                        <svg class="w-3 h-3" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="9" cy="9" r="2"/><circle cx="15" cy="15" r="2"/><line x1="5" y1="19" x2="19" y2="5"/></svg>
                                        Pourcentage
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-md text-[11px] font-semibold bg-amber-50 text-amber-700">
                                        <svg class="w-3 h-3" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="12" y1="1" x2="12" y2="23"/><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"/></svg>
                                        Montant fixe
                                    </span>
                                @endif
                            </td>
                            {{-- Valeur --}}
                            <td class="px-5 py-3 text-[14px] font-bold text-brand-600 whitespace-nowrap">
                                @if($code->type_reduction == 'pourcentage')
                                    {{ $code->valeur }}%
                                @else
                                    {{ number_format($code->valeur, 0, ',', ' ') }} FCFA
                                @endif
                            </td>
                            {{-- Période --}}
                            <td class="px-5 py-3 whitespace-nowrap">
                                <p class="text-[13px] text-dark-50">{{ \Carbon\Carbon::parse($code->date_debut)->format('d/m/Y') }}</p>
                                <p class="text-[11px] text-beige-400">au {{ \Carbon\Carbon::parse($code->date_fin)->format('d/m/Y') }}</p>
                            </td>
                            {{-- Barre de progression utilisation --}}
                            <td class="px-5 py-3" style="min-width: 140px;">
                                @php $pct = $code->usage_max > 0 ? ($code->usage_actuel / $code->usage_max * 100) : 0; @endphp
                                <div class="flex items-center gap-2 mb-1.5">
                                    <span class="text-[13px] font-bold text-dark">{{ $code->usage_actuel }}</span>
                                    <span class="text-[11px] text-beige-400">/ {{ $code->usage_max }}</span>
                                </div>
                                <div class="w-full h-1.5 rounded-full bg-beige-200 overflow-hidden">
                                    <div class="h-full rounded-full transition-all duration-500 {{ $pct >= 80 ? 'bg-red-400' : ($pct >= 50 ? 'bg-amber-400' : 'bg-brand-500') }}"
                                         style="width: {{ $pct }}%;"></div>
                                </div>
                            </td>
                            {{-- Statut --}}
                            <td class="px-5 py-3">
                                @switch($code->statut)
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
                                    @case('expire')
                                        <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-md text-[11px] font-semibold bg-red-50 text-red-700">
                                            <span class="w-1.5 h-1.5 rounded-full bg-red-400"></span>Expiré
                                        </span>
                                        @break
                                @endswitch
                            </td>
                            {{-- Actions --}}
                            <td class="px-5 py-3">
                                <div class="flex items-center justify-end gap-2">
                                    <a href="{{ route('admin.codes-promo.edit', $code) }}"
                                       class="w-8 h-8 rounded-lg flex items-center justify-center text-beige-400 hover:text-amber-600 hover:bg-amber-50 transition-all duration-200" title="Modifier">
                                        <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                                            <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/>
                                            <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/>
                                        </svg>
                                    </a>
                                    <form action="{{ route('admin.codes-promo.destroy', $code) }}" method="POST" data-confirm="Supprimer ce code promo ? Cette action est irréversible.">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="w-8 h-8 rounded-lg flex items-center justify-center text-beige-400 hover:text-red-600 hover:bg-red-50 transition-all duration-200" title="Supprimer">
                                            <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
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
                                    <polyline points="20 12 20 22 4 22 4 12"/><rect x="2" y="7" width="20" height="5"/>
                                </svg>
                                <p class="text-sm text-beige-400">Aucun code promo créé</p>
                                <a href="{{ route('admin.codes-promo.create') }}" class="text-[13px] font-semibold text-brand-500 hover:underline mt-1 inline-block">Créer le premier</a>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($codesPromo->hasPages())
            <div class="px-6 py-4 border-t border-beige-100">
                {{ $codesPromo->links() }}
            </div>
        @endif
    </div>

@endsection