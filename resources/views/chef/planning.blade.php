@extends('layouts.app')
@section('title', 'Mon Planning — AfroCook Experience')

@section('content')

    {{-- Header --}}
    <section class="relative py-14 sm:py-16 text-center overflow-hidden">
        <div class="absolute inset-0">
            <img src="https://images.unsplash.com/photo-1507048331197-7d4ac70811cf?w=1200&q=80" alt="" class="w-full h-full object-cover">
            <div class="absolute inset-0 bg-dark/75"></div>
        </div>
        <div class="relative z-10 max-w-7xl mx-auto px-5 sm:px-8 lg:px-10">
            <h1 class="text-3xl sm:text-4xl font-extrabold text-white tracking-tight mb-3">Mon Planning</h1>
            <p class="text-[15px] text-white/50 max-w-md mx-auto">Vos prochains ateliers à animer</p>
        </div>
    </section>

    <section class="bg-beige-50 py-10 sm:py-14">
        <div class="max-w-7xl mx-auto px-5 sm:px-8 lg:px-10">

            {{-- Navigation chef --}}
            <div class="max-w-sm mx-auto -mt-20 relative z-20 mb-10">
                <div class="bg-white rounded-xl p-1.5 border border-beige-200/60 shadow-lg shadow-dark/5 flex gap-1">
                    <a href="{{ route('chef.planning') }}"
                       class="flex-1 flex items-center justify-center gap-2 py-2.5 rounded-lg text-[13px] font-semibold bg-brand-500 text-white transition-colors">
                        <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><rect x="3" y="4" width="18" height="18" rx="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                        Planning
                    </a>
                    <a href="{{ route('chef.sessions') }}"
                       class="flex-1 flex items-center justify-center gap-2 py-2.5 rounded-lg text-[13px] font-semibold text-beige-500 hover:bg-beige-50 transition-colors">
                        <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><polyline points="23 4 23 10 17 10"/><path d="M20.49 15a9 9 0 1 1-2.12-9.36L23 10"/></svg>
                        Sessions passées
                    </a>
                </div>
            </div>

            {{-- Grille des créneaux --}}
            @if($creneaux->count() > 0)
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5">
                    @foreach($creneaux as $creneau)
                        <div class="bg-white rounded-2xl border border-beige-200/60 p-6 border-l-4 border-l-brand-500 hover:shadow-lg hover:shadow-dark/5 transition-all duration-200">
                            {{-- Date --}}
                            <p class="text-[17px] font-bold text-dark mb-4">
                                {{ \Carbon\Carbon::parse($creneau->date)->translatedFormat('l d F Y') }}
                            </p>
                            {{-- Détails --}}
                            <div class="space-y-2.5 mb-5">
                                <div class="flex items-center gap-2.5 text-[14px] text-dark-50">
                                    <svg class="w-4 h-4 text-brand-500 flex-shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M18 8h1a4 4 0 0 1 0 8h-1"/><path d="M2 8h16v9a4 4 0 0 1-4 4H6a4 4 0 0 1-4-4V8z"/></svg>
                                    <strong>{{ $creneau->atelier->titre }}</strong>
                                </div>
                                <div class="flex items-center gap-2.5 text-[14px] text-beige-500">
                                    <svg class="w-4 h-4 text-brand-500 flex-shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                                    {{ \Carbon\Carbon::parse($creneau->heure_debut)->format('H:i') }} — {{ \Carbon\Carbon::parse($creneau->heure_fin)->format('H:i') }}
                                </div>
                                <div class="flex items-center gap-2.5 text-[14px] text-beige-500">
                                    <svg class="w-4 h-4 text-brand-500 flex-shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12"/><line x1="12" y1="16" x2="12" y2="16"/></svg>
                                    {{ $creneau->atelier->duree_minutes }} minutes
                                </div>
                            </div>
                            {{-- Réservations + places --}}
                            <div class="flex items-center justify-between pt-4 border-t border-beige-100">
                                <span class="flex items-center gap-1.5 text-[13px] text-beige-500">
                                    <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/></svg>
                                    {{ $creneau->reservations_count }} réservation{{ $creneau->reservations_count > 1 ? 's' : '' }}
                                </span>
                                @if($creneau->places_restantes > 2)
                                    <span class="inline-flex items-center gap-1.5 text-[12px] font-semibold text-emerald-600">
                                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-400"></span>{{ $creneau->places_restantes }} places
                                    </span>
                                @elseif($creneau->places_restantes > 0)
                                    <span class="inline-flex items-center gap-1.5 text-[12px] font-semibold text-amber-600">
                                        <span class="w-1.5 h-1.5 rounded-full bg-amber-400"></span>{{ $creneau->places_restantes }} place{{ $creneau->places_restantes > 1 ? 's' : '' }}
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1.5 text-[12px] font-semibold text-red-600">
                                        <span class="w-1.5 h-1.5 rounded-full bg-red-400"></span>Complet
                                    </span>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-20">
                    <svg class="w-14 h-14 text-beige-200 mx-auto mb-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1"><rect x="3" y="4" width="18" height="18" rx="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                    <h3 class="text-xl font-bold text-dark mb-2">Aucun atelier à venir</h3>
                    <p class="text-[14px] text-beige-400">Contactez l'administrateur pour être assigné à de nouveaux créneaux.</p>
                </div>
            @endif
        </div>
    </section>

@endsection