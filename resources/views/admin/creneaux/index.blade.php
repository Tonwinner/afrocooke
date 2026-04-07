@extends('layouts.admin')
@section('page-title', 'Gestion des Créneaux')

@section('content')

    {{-- Filtres --}}
    <div class="bg-white rounded-xl border border-beige-200/60 p-5 mb-5">
        <form action="{{ route('admin.creneaux.index') }}" method="GET" class="flex flex-wrap items-end gap-4">
            {{-- Filtre atelier --}}
            <div class="flex-1 min-w-[180px]">
                <label class="block text-[12px] font-semibold text-dark-50 mb-1.5">Atelier</label>
                <select name="atelier_id"
                    class="w-full px-3 py-2.5 rounded-lg border border-beige-300 bg-white text-sm text-dark focus:outline-none focus:border-brand-500 focus:ring-2 focus:ring-brand-500/10 transition duration-200">
                    <option value="">Tous les ateliers</option>
                    @foreach($ateliers as $atelier)
                        <option value="{{ $atelier->id }}" {{ request('atelier_id') == $atelier->id ? 'selected' : '' }}>{{ $atelier->titre }}</option>
                    @endforeach
                </select>
            </div>
            {{-- Filtre statut --}}
            <div class="flex-1 min-w-[150px]">
                <label class="block text-[12px] font-semibold text-dark-50 mb-1.5">Statut</label>
                <select name="statut"
                    class="w-full px-3 py-2.5 rounded-lg border border-beige-300 bg-white text-sm text-dark focus:outline-none focus:border-brand-500 focus:ring-2 focus:ring-brand-500/10 transition duration-200">
                    <option value="">Tous</option>
                    <option value="disponible" {{ request('statut') == 'disponible' ? 'selected' : '' }}>Disponible</option>
                    <option value="complet" {{ request('statut') == 'complet' ? 'selected' : '' }}>Complet</option>
                    <option value="annule" {{ request('statut') == 'annule' ? 'selected' : '' }}>Annulé</option>
                </select>
            </div>
            {{-- Boutons filtre --}}
            <div class="flex gap-2">
                <button type="submit"
                    class="flex items-center gap-2 px-4 py-2.5 bg-brand-500 hover:bg-brand-600 text-white text-[13px] font-semibold rounded-lg transition-all duration-200">
                    <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <polygon points="22 3 2 3 10 12.46 10 19 14 21 14 12.46 22 3" />
                    </svg>
                    Filtrer
                </button>
                <a href="{{ route('admin.creneaux.index') }}"
                   class="px-4 py-2.5 text-[13px] font-semibold text-beige-500 hover:text-dark rounded-lg border border-beige-300 hover:border-beige-400 transition-all duration-200">
                    Réinitialiser
                </a>
            </div>
        </form>
    </div>

    {{-- Formulaire de création --}}
    <div class="bg-white rounded-xl border border-beige-200/60 p-6 mb-5">
        <div class="flex items-center gap-3 mb-5 pb-4 border-b border-beige-100">
            <div class="w-9 h-9 rounded-lg bg-brand-50 flex items-center justify-center">
                <svg class="w-4 h-4 text-brand-500" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                    <line x1="12" y1="5" x2="12" y2="19" /><line x1="5" y1="12" x2="19" y2="12" />
                </svg>
            </div>
            <div>
                <h2 class="text-[15px] font-bold text-dark">Ajouter un créneau</h2>
                <p class="text-[11px] text-beige-400">Créez un nouveau créneau pour un atelier</p>
            </div>
        </div>

        <form action="{{ route('admin.creneaux.store') }}" method="POST" class="space-y-4">
            @csrf
            {{-- Ligne 1 : Atelier + Chef --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label for="atelier_id" class="block text-sm font-medium text-dark-50 mb-1.5">Atelier</label>
                    <select id="atelier_id" name="atelier_id" required
                        class="w-full px-4 py-2.5 rounded-lg border border-beige-300 bg-white text-sm text-dark focus:outline-none focus:border-brand-500 focus:ring-2 focus:ring-brand-500/10 transition duration-200">
                        <option value="">Sélectionner un atelier</option>
                        @foreach($ateliers as $atelier)
                            <option value="{{ $atelier->id }}" {{ old('atelier_id') == $atelier->id ? 'selected' : '' }}>{{ $atelier->titre }}</option>
                        @endforeach
                    </select>
                    @error('atelier_id') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label for="chef_id" class="block text-sm font-medium text-dark-50 mb-1.5">Chef cuisinier</label>
                    <select id="chef_id" name="chef_id"
                        class="w-full px-4 py-2.5 rounded-lg border border-beige-300 bg-white text-sm text-dark focus:outline-none focus:border-brand-500 focus:ring-2 focus:ring-brand-500/10 transition duration-200">
                        <option value="">Aucun chef assigné</option>
                        @foreach($chefs as $chef)
                            <option value="{{ $chef->id }}" {{ old('chef_id') == $chef->id ? 'selected' : '' }}>{{ $chef->name }}</option>
                        @endforeach
                    </select>
                    @error('chef_id') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>
            </div>

            {{-- Ligne 2 : Date + Heures avec icônes SVG --}}
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                <div>
                    <label for="date" class="block text-sm font-medium text-dark-50 mb-1.5">Date de l'atelier</label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
                            <svg class="w-[18px] h-[18px] text-beige-400" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                                <rect x="3" y="4" width="18" height="18" rx="2" />
                                <line x1="16" y1="2" x2="16" y2="6" /><line x1="8" y1="2" x2="8" y2="6" />
                                <line x1="3" y1="10" x2="21" y2="10" />
                            </svg>
                        </span>
                        <input type="text" id="date" name="date" data-fp-date value="{{ old('date') }}" required placeholder="Sélectionner une date" autocomplete="off"
                            class="w-full pl-11 pr-4 py-3 rounded-xl border border-beige-300 bg-white text-sm text-dark focus:outline-none focus:border-brand-500 focus:ring-2 focus:ring-brand-500/10 transition duration-200 cursor-pointer">
                    </div>
                    @error('date') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label for="heure_debut" class="block text-sm font-medium text-dark-50 mb-1.5">Début</label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
                            <svg class="w-[18px] h-[18px] text-beige-400" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                                <circle cx="12" cy="12" r="10" />
                                <polyline points="12 6 12 12 16 14" />
                            </svg>
                        </span>
                        <input type="text" id="heure_debut" name="heure_debut" data-fp-time value="{{ old('heure_debut') }}" required placeholder="Début" autocomplete="off"
                            class="w-full pl-11 pr-4 py-3 rounded-xl border border-beige-300 bg-white text-sm text-dark focus:outline-none focus:border-brand-500 focus:ring-2 focus:ring-brand-500/10 transition duration-200 cursor-pointer">
                    </div>
                    @error('heure_debut') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label for="heure_fin" class="block text-sm font-medium text-dark-50 mb-1.5">Fin</label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
                            <svg class="w-[18px] h-[18px] text-beige-400" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                                <circle cx="12" cy="12" r="10" />
                                <polyline points="12 6 12 12 8 14" />
                            </svg>
                        </span>
                        <input type="text" id="heure_fin" name="heure_fin" data-fp-time value="{{ old('heure_fin') }}" required placeholder="Fin" autocomplete="off"
                            class="w-full pl-11 pr-4 py-3 rounded-xl border border-beige-300 bg-white text-sm text-dark focus:outline-none focus:border-brand-500 focus:ring-2 focus:ring-brand-500/10 transition duration-200 cursor-pointer">
                    </div>
                    @error('heure_fin') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>
            </div>

            <button type="submit"
                class="flex items-center gap-2 px-5 py-2.5 bg-brand-500 hover:bg-brand-600 text-white text-sm font-semibold rounded-lg transition-all duration-200 hover:shadow-md hover:shadow-brand-500/20">
                <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <polyline points="20 6 9 17 4 12" />
                </svg>
                Créer le créneau
            </button>
        </form>
    </div>

    {{-- Liste des créneaux --}}
    <div class="bg-white rounded-xl border border-beige-200/60 overflow-hidden">
        <div class="flex items-center justify-between px-6 py-4 border-b border-beige-100">
            <div class="flex items-center gap-3">
                <div class="w-9 h-9 rounded-lg bg-blue-50 flex items-center justify-center">
                    <svg class="w-4 h-4 text-blue-600" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                        <rect x="3" y="4" width="18" height="18" rx="2" />
                        <line x1="16" y1="2" x2="16" y2="6" /><line x1="8" y1="2" x2="8" y2="6" /><line x1="3" y1="10" x2="21" y2="10" />
                    </svg>
                </div>
                <div>
                    <h2 class="text-[15px] font-bold text-dark">Créneaux existants</h2>
                    <p class="text-[11px] text-beige-400">{{ $creneaux->total() }} créneau{{ $creneaux->total() > 1 ? 'x' : '' }}</p>
                </div>
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr>
                        <th class="px-6 py-3 text-left text-[10px] font-bold uppercase tracking-widest text-beige-400 bg-beige-50/50">Atelier</th>
                        <th class="px-6 py-3 text-left text-[10px] font-bold uppercase tracking-widest text-beige-400 bg-beige-50/50">Date</th>
                        <th class="px-6 py-3 text-left text-[10px] font-bold uppercase tracking-widest text-beige-400 bg-beige-50/50">Horaire</th>
                        <th class="px-6 py-3 text-left text-[10px] font-bold uppercase tracking-widest text-beige-400 bg-beige-50/50">Chef</th>
                        <th class="px-6 py-3 text-center text-[10px] font-bold uppercase tracking-widest text-beige-400 bg-beige-50/50">Places</th>
                        <th class="px-6 py-3 text-center text-[10px] font-bold uppercase tracking-widest text-beige-400 bg-beige-50/50">Résa</th>
                        <th class="px-6 py-3 text-left text-[10px] font-bold uppercase tracking-widest text-beige-400 bg-beige-50/50">Statut</th>
                        <th class="px-6 py-3 text-right text-[10px] font-bold uppercase tracking-widest text-beige-400 bg-beige-50/50">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($creneaux as $creneau)
                        <tr class="border-b border-beige-50 hover:bg-beige-50/40 transition-colors duration-100">
                            <td class="px-6 py-3 text-[13px] font-semibold text-dark">{{ $creneau->atelier->titre }}</td>
                            <td class="px-6 py-3 text-[13px] text-beige-500 whitespace-nowrap">{{ \Carbon\Carbon::parse($creneau->date)->translatedFormat('d F Y') }}</td>
                            <td class="px-6 py-3 text-[13px] text-dark-50 whitespace-nowrap">
                                {{ \Carbon\Carbon::parse($creneau->heure_debut)->format('H:i') }}
                                <span class="text-beige-300 mx-1">→</span>
                                {{ \Carbon\Carbon::parse($creneau->heure_fin)->format('H:i') }}
                            </td>
                            <td class="px-6 py-3 text-[13px] text-dark-50">
                                @if($creneau->chef)
                                    <span class="inline-flex items-center gap-1.5">
                                        <span class="w-5 h-5 rounded bg-brand-50 flex items-center justify-center text-[9px] font-bold text-brand-600">
                                            {{ strtoupper(mb_substr($creneau->chef->name, 0, 1)) }}
                                        </span>
                                        {{ $creneau->chef->name }}
                                    </span>
                                @else
                                    <span class="text-beige-300">—</span>
                                @endif
                            </td>
                            <td class="px-6 py-3 text-center">
                                <span class="text-[13px] font-bold {{ $creneau->places_restantes <= 2 ? 'text-red-600' : 'text-emerald-600' }}">
                                    {{ $creneau->places_restantes }}
                                </span>
                            </td>
                            <td class="px-6 py-3 text-center">
                                <span class="inline-flex items-center justify-center w-7 h-7 rounded-md text-[11px] font-bold bg-blue-50 text-blue-700">
                                    {{ $creneau->reservations_count }}
                                </span>
                            </td>
                            <td class="px-6 py-3">
                                @switch($creneau->statut)
                                    @case('disponible')
                                        <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-md text-[11px] font-semibold bg-emerald-50 text-emerald-700">
                                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-400"></span>Disponible
                                        </span>
                                        @break
                                    @case('complet')
                                        <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-md text-[11px] font-semibold bg-red-50 text-red-700">
                                            <span class="w-1.5 h-1.5 rounded-full bg-red-400"></span>Complet
                                        </span>
                                        @break
                                    @case('annule')
                                        <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-md text-[11px] font-semibold bg-gray-100 text-gray-600">
                                            <span class="w-1.5 h-1.5 rounded-full bg-gray-400"></span>Annulé
                                        </span>
                                        @break
                                @endswitch
                            </td>
                            <td class="px-6 py-3">
                                <div class="flex items-center justify-end gap-1.5">
                                    {{-- Bouton modifier --}}
                                    <button type="button" title="Modifier"
                                        class="w-8 h-8 rounded-lg flex items-center justify-center text-beige-400 hover:text-blue-600 hover:bg-blue-50 transition-all duration-200"
                                        onclick="openEditCreneau({{ json_encode([
                                            'id' => $creneau->uuid,
                                            'chef_id' => $creneau->chef_id,
                                            'date' => $creneau->date,
                                            'heure_debut' => \Carbon\Carbon::parse($creneau->heure_debut)->format('H:i'),
                                            'heure_fin' => \Carbon\Carbon::parse($creneau->heure_fin)->format('H:i'),
                                            'statut' => $creneau->statut,
                                            'atelier_titre' => $creneau->atelier->titre,
                                        ]) }})">
                                        <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
                                    </button>
                                    {{-- Bouton supprimer --}}
                                    <form action="{{ route('admin.creneaux.destroy', $creneau) }}" method="POST" data-confirm="Supprimer ce créneau ? Cette action est irréversible.">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="w-8 h-8 rounded-lg flex items-center justify-center text-beige-400 hover:text-red-600 hover:bg-red-50 transition-all duration-200" title="Supprimer">
                                            <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><polyline points="3 6 5 6 21 6"/><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/></svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="px-6 py-16 text-center">
                                <svg class="w-10 h-10 text-beige-200 mx-auto mb-3" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                                    <rect x="3" y="4" width="18" height="18" rx="2" /><line x1="16" y1="2" x2="16" y2="6" /><line x1="8" y1="2" x2="8" y2="6" /><line x1="3" y1="10" x2="21" y2="10" />
                                </svg>
                                <p class="text-sm text-beige-400">Aucun créneau créé</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($creneaux->hasPages())
            <div class="px-6 py-4 border-t border-beige-100">
                {{ $creneaux->links() }}
            </div>
        @endif
    </div>
{{-- Modale d'édition de créneau --}}
    <div id="editCreneauOverlay" class="fixed inset-0 bg-dark/40 backdrop-blur-sm z-50 hidden flex items-center justify-center p-4">
        <div id="editCreneauModal" class="bg-white rounded-2xl border border-beige-200/60 shadow-2xl w-full max-w-lg transform scale-95 opacity-0 transition-all duration-200">
            {{-- Header --}}
            <div class="flex items-center justify-between px-6 py-4 border-b border-beige-100">
                <div class="flex items-center gap-3">
                    <div class="w-9 h-9 rounded-lg bg-blue-50 flex items-center justify-center">
                        <svg class="w-4 h-4 text-blue-600" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
                    </div>
                    <div>
                        <h3 class="text-[15px] font-bold text-dark">Modifier le créneau</h3>
                        <p class="text-[11px] text-beige-400" id="editCreneauAtelier"></p>
                    </div>
                </div>
                <button type="button" onclick="closeEditCreneau()" class="w-8 h-8 rounded-lg flex items-center justify-center text-beige-400 hover:text-dark hover:bg-beige-100 transition-all duration-200">
                    <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
                </button>
            </div>
            {{-- Formulaire --}}
            <form id="editCreneauForm" method="POST" class="p-6 space-y-4">
                @csrf @method('PUT')
                {{-- Chef --}}
                <div>
                    <label class="block text-sm font-medium text-dark-50 mb-1.5">Chef cuisinier</label>
                    <select name="chef_id" id="editChefId" class="w-full px-4 py-2.5 rounded-lg border border-beige-300 bg-white text-sm text-dark focus:outline-none focus:border-brand-500 focus:ring-2 focus:ring-brand-500/10 transition duration-200">
                        <option value="">Aucun chef assigné</option>
                        @foreach($chefs as $chef)
                            <option value="{{ $chef->id }}">{{ $chef->name }}</option>
                        @endforeach
                    </select>
                </div>
                {{-- Date + Heures --}}
                <div class="grid grid-cols-3 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-dark-50 mb-1.5">Date</label>
                        <input type="text" name="date" id="editDate" data-fp-date autocomplete="off" required placeholder="Sélectionner une date" class="w-full px-3 py-2.5 rounded-lg border border-beige-300 bg-white text-sm text-dark focus:outline-none focus:border-brand-500 focus:ring-2 focus:ring-brand-500/10 transition duration-200 cursor-pointer">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-dark-50 mb-1.5">Début</label>
                        <input type="text" name="heure_debut" id="editHeureDebut" data-fp-time autocomplete="off" required placeholder="Début" class="w-full px-3 py-2.5 rounded-lg border border-beige-300 bg-white text-sm text-dark focus:outline-none focus:border-brand-500 focus:ring-2 focus:ring-brand-500/10 transition duration-200 cursor-pointer">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-dark-50 mb-1.5">Fin</label>
                        <input type="text" name="heure_fin" id="editHeureFin" data-fp-time autocomplete="off" required placeholder="Fin" class="w-full px-3 py-2.5 rounded-lg border border-beige-300 bg-white text-sm text-dark focus:outline-none focus:border-brand-500 focus:ring-2 focus:ring-brand-500/10 transition duration-200 cursor-pointer">
                    </div>
                </div>
                {{-- Statut --}}
                <div>
                    <label class="block text-sm font-medium text-dark-50 mb-1.5">Statut</label>
                    <select name="statut" id="editStatut" required class="w-full px-4 py-2.5 rounded-lg border border-beige-300 bg-white text-sm text-dark focus:outline-none focus:border-brand-500 focus:ring-2 focus:ring-brand-500/10 transition duration-200">
                        <option value="disponible">Disponible</option>
                        <option value="complet">Complet</option>
                        <option value="annule">Annulé</option>
                    </select>
                </div>
                {{-- Boutons --}}
                <div class="flex items-center gap-3 pt-2">
                    <button type="submit" class="flex items-center gap-2 px-5 py-2.5 bg-brand-500 hover:bg-brand-600 text-white text-sm font-semibold rounded-lg transition-all duration-200">
                        <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="20 6 9 17 4 12"/></svg>
                        Enregistrer
                    </button>
                    <button type="button" onclick="closeEditCreneau()" class="px-5 py-2.5 text-sm font-semibold text-beige-500 border border-beige-300 rounded-lg hover:border-beige-400 transition-all duration-200">
                        Annuler
                    </button>
                </div>
            </form>
        </div>
    </div>

@push('scripts')
<script>
(function() {
    var overlay = document.getElementById('editCreneauOverlay');
    var modal   = document.getElementById('editCreneauModal');
    var form    = document.getElementById('editCreneauForm');

    /**
     * Ouvrir la modale d'édition avec les données du créneau.
     * Reçoit un objet JSON avec id, chef_id, date, heure_debut, heure_fin, statut, atelier_titre.
     */
    window.openEditCreneau = function(data) {
        /* Construire l'URL d'action du formulaire */
        form.action = '/admin/creneaux/' + data.id; 

        /* Pré-remplir les champs */
        document.getElementById('editCreneauAtelier').textContent = data.atelier_titre;
        document.getElementById('editChefId').value = data.chef_id || '';
        document.getElementById('editDate').value = data.date;
        document.getElementById('editHeureDebut').value = data.heure_debut;
        document.getElementById('editHeureFin').value = data.heure_fin;
        document.getElementById('editStatut').value = data.statut;

        /* Afficher la modale avec animation */
        overlay.classList.remove('hidden');
        document.body.style.overflow = 'hidden';
        setTimeout(function() {
            modal.classList.remove('scale-95', 'opacity-0');
            modal.classList.add('scale-100', 'opacity-100');
        }, 10);
    };

    window.closeEditCreneau = function() {
        modal.classList.remove('scale-100', 'opacity-100');
        modal.classList.add('scale-95', 'opacity-0');
        setTimeout(function() {
            overlay.classList.add('hidden');
            document.body.style.overflow = '';
        }, 200);
    };

    /* Fermer au clic sur l'overlay */
    overlay.addEventListener('click', function(e) {
        if (e.target === overlay) closeEditCreneau();
    });

    /* Fermer avec Echap */
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape' && !overlay.classList.contains('hidden')) {
            closeEditCreneau();
        }
    });
})();


</script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/themes/airbnb.css">
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script src="https://cdn.jsdelivr.net/npm/flatpickr/dist/l10n/fr.js"></script>
<script>
(function() {
    /*
     * Flatpickr — Date Picker premium
     * Theme Airbnb + locale français
     * Appliqué automatiquement à tous les inputs [data-fp-date]
     */
    document.querySelectorAll('[data-fp-date]').forEach(function(el) {
        flatpickr(el, {
            locale: 'fr',
            dateFormat: 'Y-m-d',
            altInput: true,
            altFormat: 'j F Y',
            minDate: el.dataset.min || 'today',
            disableMobile: true,
            animate: true,
            monthSelectorType: 'dropdown',
            prevArrow: '<svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="15 18 9 12 15 6"/></svg>',
            nextArrow: '<svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="9 18 15 12 9 6"/></svg>',
        });
    });

    /*
     * Flatpickr — Time Picker premium
     * Mode heure uniquement, format 24h, pas de 5 minutes
     */
    document.querySelectorAll('[data-fp-time]').forEach(function(el) {
        flatpickr(el, {
            locale: 'fr',
            enableTime: true,
            noCalendar: true,
            dateFormat: 'H:i',
            time_24hr: true,
            minuteIncrement: 5,
            disableMobile: true,
            animate: true,
        });
    });
})();
</script>
@endpush

@endsection