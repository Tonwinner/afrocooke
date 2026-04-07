
@extends('layouts.admin')
@section('page-title', 'Modération des Avis')

@section('content')

    {{-- Filtres --}}
    <div class="bg-white rounded-xl border border-beige-200/60 p-5 mb-5">
        <form action="{{ route('admin.avis.index') }}" method="GET" class="flex flex-wrap items-end gap-4">
            <div class="flex-1 min-w-[150px]">
                <label class="block text-[12px] font-semibold text-dark-50 mb-1.5">Visibilité</label>
                <select name="visibilite"
                    class="w-full px-3 py-2.5 rounded-lg border border-beige-300 bg-white text-sm text-dark focus:outline-none focus:border-brand-500 focus:ring-2 focus:ring-brand-500/10 transition duration-200">
                    <option value="">Tous les avis</option>
                    <option value="visible" {{ request('visibilite') == 'visible' ? 'selected' : '' }}>Visibles</option>
                    <option value="masque" {{ request('visibilite') == 'masque' ? 'selected' : '' }}>Masqués</option>
                </select>
            </div>
            <div class="flex-1 min-w-[150px]">
                <label class="block text-[12px] font-semibold text-dark-50 mb-1.5">Note</label>
                <select name="note"
                    class="w-full px-3 py-2.5 rounded-lg border border-beige-300 bg-white text-sm text-dark focus:outline-none focus:border-brand-500 focus:ring-2 focus:ring-brand-500/10 transition duration-200">
                    <option value="">Toutes les notes</option>
                    <option value="5" {{ request('note') == '5' ? 'selected' : '' }}>5 étoiles</option>
                    <option value="4" {{ request('note') == '4' ? 'selected' : '' }}>4 étoiles</option>
                    <option value="3" {{ request('note') == '3' ? 'selected' : '' }}>3 étoiles</option>
                    <option value="2" {{ request('note') == '2' ? 'selected' : '' }}>2 étoiles</option>
                    <option value="1" {{ request('note') == '1' ? 'selected' : '' }}>1 étoile</option>
                </select>
            </div>
            <div class="flex gap-2">
                <button type="submit"
                    class="flex items-center gap-2 px-4 py-2.5 bg-brand-500 hover:bg-brand-600 text-white text-[13px] font-semibold rounded-lg transition-all duration-200">
                    <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polygon points="22 3 2 3 10 12.46 10 19 14 21 14 12.46 22 3"/></svg>
                    Filtrer
                </button>
                <a href="{{ route('admin.avis.index') }}"
                   class="px-4 py-2.5 text-[13px] font-semibold text-beige-500 hover:text-dark rounded-lg border border-beige-300 hover:border-beige-400 transition-all duration-200">
                    Réinitialiser
                </a>
            </div>
        </form>
    </div>

    {{-- Tableau --}}
    <div class="bg-white rounded-xl border border-beige-200/60 overflow-hidden">
        <div class="flex items-center justify-between px-6 py-4 border-b border-beige-100">
            <div class="flex items-center gap-3">
                <div class="w-9 h-9 rounded-lg bg-amber-50 flex items-center justify-center">
                    <svg class="w-4 h-4 text-amber-500" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                        <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/>
                    </svg>
                </div>
                <div>
                    <h2 class="text-[15px] font-bold text-dark">Avis clients</h2>
                    <p class="text-[11px] text-beige-400">{{ $avis->total() }} avis au total</p>
                </div>
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr>
                        <th class="px-5 py-3 text-left text-[10px] font-bold uppercase tracking-widest text-beige-400 bg-beige-50/50">Client</th>
                        <th class="px-5 py-3 text-left text-[10px] font-bold uppercase tracking-widest text-beige-400 bg-beige-50/50">Atelier</th>
                        <th class="px-5 py-3 text-left text-[10px] font-bold uppercase tracking-widest text-beige-400 bg-beige-50/50">Note</th>
                        <th class="px-5 py-3 text-left text-[10px] font-bold uppercase tracking-widest text-beige-400 bg-beige-50/50">Commentaire</th>
                        <th class="px-5 py-3 text-left text-[10px] font-bold uppercase tracking-widest text-beige-400 bg-beige-50/50">Date</th>
                        <th class="px-5 py-3 text-left text-[10px] font-bold uppercase tracking-widest text-beige-400 bg-beige-50/50">Visibilité</th>
                        <th class="px-5 py-3 text-right text-[10px] font-bold uppercase tracking-widest text-beige-400 bg-beige-50/50">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($avis as $unAvis)
                        <tr class="border-b border-beige-50 transition-colors duration-100 {{ !$unAvis->est_visible ? 'opacity-50' : 'hover:bg-beige-50/40' }}">
                            {{-- Client --}}
                            <td class="px-5 py-3">
                                <div class="flex items-center gap-2.5">
                                    <div class="w-7 h-7 rounded-md bg-brand-50 flex items-center justify-center flex-shrink-0">
                                        <span class="text-[10px] font-bold text-brand-600">{{ strtoupper(mb_substr($unAvis->user->name, 0, 2)) }}</span>
                                    </div>
                                    <div class="min-w-0">
                                        <p class="text-[13px] font-semibold text-dark truncate">{{ $unAvis->user->name }}</p>
                                        <p class="text-[11px] text-beige-400 truncate">{{ $unAvis->user->email }}</p>
                                    </div>
                                </div>
                            </td>
                            {{-- Atelier --}}
                            <td class="px-5 py-3 text-[13px] text-dark-50">{{ $unAvis->atelier->titre }}</td>
                            {{-- Note : étoiles SVG --}}
                            <td class="px-5 py-3">
                                <div class="flex items-center gap-0.5 mb-1">
                                    @for($i = 1; $i <= 5; $i++)
                                        <svg class="w-3.5 h-3.5 {{ $i <= $unAvis->note ? 'text-amber-400' : 'text-beige-200' }}" viewBox="0 0 24 24" fill="currentColor">
                                            <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/>
                                        </svg>
                                    @endfor
                                </div>
                                <span class="text-[11px] text-beige-400">{{ $unAvis->note }}/5</span>
                            </td>
                            {{-- Commentaire --}}
                            <td class="px-5 py-3" style="max-width: 280px;">
                                <p class="text-[13px] text-dark-50 leading-relaxed">{{ Str::limit($unAvis->commentaire, 120) }}</p>
                            </td>
                            {{-- Date --}}
                            <td class="px-5 py-3 text-[13px] text-beige-500 whitespace-nowrap">{{ $unAvis->created_at->translatedFormat('d M Y') }}</td>
                            {{-- Visibilité --}}
                            <td class="px-5 py-3">
                                @if($unAvis->est_visible)
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-md text-[11px] font-semibold bg-emerald-50 text-emerald-700">
                                        <svg class="w-3 h-3" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
                                        Visible
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-md text-[11px] font-semibold bg-red-50 text-red-700">
                                        <svg class="w-3 h-3" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94"/><line x1="1" y1="1" x2="23" y2="23"/></svg>
                                        Masqué
                                    </span>
                                @endif
                            </td>
                            {{-- Toggle visibilité --}}
                            <td class="px-5 py-3 text-right">
                                <form action="{{ route('admin.avis.toggle', $unAvis) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    @if($unAvis->est_visible)
                                        <button type="submit"
                                            class="w-8 h-8 rounded-lg flex items-center justify-center text-beige-400 hover:text-amber-600 hover:bg-amber-50 transition-all duration-200" title="Masquer cet avis">
                                            <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                                                <path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19m-6.72-1.07a3 3 0 1 1-4.24-4.24"/>
                                                <line x1="1" y1="1" x2="23" y2="23"/>
                                            </svg>
                                        </button>
                                    @else
                                        <button type="submit"
                                            class="w-8 h-8 rounded-lg flex items-center justify-center text-beige-400 hover:text-emerald-600 hover:bg-emerald-50 transition-all duration-200" title="Rendre visible">
                                            <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                                                <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/>
                                                <circle cx="12" cy="12" r="3"/>
                                            </svg>
                                        </button>
                                    @endif
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-6 py-16 text-center">
                                <svg class="w-10 h-10 text-beige-200 mx-auto mb-3" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                                    <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/>
                                </svg>
                                <p class="text-sm text-beige-400">Aucun avis pour le moment</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($avis->hasPages())
            <div class="px-6 py-4 border-t border-beige-100">
                {{ $avis->links() }}
            </div>
        @endif
    </div>

@endsection