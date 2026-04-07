@extends('layouts.app')
@section('title', $atelier->titre . ' — AfroCook Experience')

@section('content')

    {{-- Hero atelier avec image de fond --}}
    <section class="relative bg-dark overflow-hidden">
        <div class="absolute inset-0">
            @if($atelier->photo)
                <img src="{{ asset('storage/' . $atelier->photo) }}" alt="" class="w-full h-full object-cover opacity-20">
            @else
                <img src="https://images.unsplash.com/photo-1504674900247-0877df9cc836?w=1200&q=80" alt="" class="w-full h-full object-cover opacity-15">
            @endif
            <div class="absolute inset-0 bg-gradient-to-t from-dark via-dark/80 to-dark/60"></div>
        </div>

        <div class="relative z-10 max-w-7xl mx-auto px-5 sm:px-8 lg:px-10 py-14 sm:py-20">
            {{-- Lien retour --}}
            <a href="{{ route('ateliers.index') }}" class="inline-flex items-center gap-2 text-sm text-white/40 hover:text-white/70 transition-colors mb-8 group">
                <svg class="w-4 h-4 transition-transform group-hover:-translate-x-0.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M19 12H5"/><polyline points="12 19 5 12 12 5"/></svg>
                Retour aux ateliers
            </a>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-10 items-center">
                {{-- Image --}}
                <div class="relative rounded-2xl overflow-hidden h-72 sm:h-80 lg:h-96 shadow-2xl shadow-dark/50">
                    @if($atelier->photo)
                        <img src="{{ asset('storage/' . $atelier->photo) }}" alt="{{ $atelier->titre }}" class="w-full h-full object-cover">
                    @else
                        <div class="w-full h-full bg-gradient-to-br from-dark-50 to-dark flex items-center justify-center">
                            <svg class="w-20 h-20 text-white/10" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1"><path d="M18 8h1a4 4 0 0 1 0 8h-1"/><path d="M2 8h16v9a4 4 0 0 1-4 4H6a4 4 0 0 1-4-4V8z"/></svg>
                        </div>
                    @endif
                </div>

                {{-- Infos --}}
                <div>
                    @php
                        $drapeaux = ['Bénin'=>'bj','Sénégal'=>'sn','Cameroun'=>'cm','Togo'=>'tg','Nigeria'=>'ng','Ghana'=>'gh',"Côte d'Ivoire"=>'ci','Mali'=>'ml','Niger'=>'ne','Guinée'=>'gn'];
                        $iso = $drapeaux[$atelier->origine_pays] ?? null;
                    @endphp
                    <span class="inline-flex items-center gap-2 px-3 py-1.5 rounded-lg bg-white/5 border border-white/10 text-white/70 text-[13px] font-semibold mb-5">
                        @if($iso)
                            <img src="https://flagcdn.com/w20/{{ $iso }}.png" alt="" class="w-5 h-3.5 rounded-sm object-cover">
                        @endif
                        {{ $atelier->origine_pays }}
                    </span>

                    <h1 class="text-3xl sm:text-4xl font-extrabold text-white tracking-tight mb-4 leading-tight">{{ $atelier->titre }}</h1>
                    <p class="text-[15px] text-white/45 leading-relaxed mb-8">{{ $atelier->description }}</p>

                    <div class="flex flex-wrap gap-5 mb-8">
                        <span class="flex items-center gap-2 text-[14px] text-white/60">
                            <svg class="w-[18px] h-[18px] text-brand-400" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                            {{ $atelier->duree_minutes }} minutes
                        </span>
                        <span class="flex items-center gap-2 text-[14px] text-white/60">
                            <svg class="w-[18px] h-[18px] text-brand-400" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/></svg>
                            Max {{ $atelier->max_participants }} personnes
                        </span>
                        <span class="flex items-center gap-2 text-[14px] text-white/60">
                            <svg class="w-[18px] h-[18px] text-brand-400" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M18 8h1a4 4 0 0 1 0 8h-1"/><path d="M2 8h16v9a4 4 0 0 1-4 4H6a4 4 0 0 1-4-4V8z"/></svg>
                            {{ $atelier->plat }}
                        </span>
                    </div>

                    <div class="flex items-end gap-4 mb-8">
                        <p class="text-4xl font-extrabold text-brand-400 tracking-tight">{{ number_format($atelier->prix, 0, ',', ' ') }}</p>
                        <span class="text-[15px] text-white/30 pb-1">FCFA / personne</span>
                    </div>

                    {{-- Bouton réserver --}}
                    @if($creneaux->count() > 0)
                        <a href="#creneaux" class="inline-flex items-center gap-2 px-8 py-4 bg-brand-500 hover:bg-brand-600 text-white text-[15px] font-semibold rounded-xl transition-all duration-200 hover:shadow-lg hover:shadow-brand-500/25">
                            Réserver cet atelier
                            <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 12h14"/><polyline points="12 5 19 12 12 19"/></svg>
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </section>

    {{-- Créneaux --}}
    <section id="creneaux" class="bg-white py-16 sm:py-20">
        <div class="max-w-7xl mx-auto px-5 sm:px-8 lg:px-10">
            <div class="text-center mb-12">
                <p class="text-[11px] font-bold uppercase tracking-[3px] text-brand-500 mb-3">Réservation</p>
                <h2 class="text-2xl sm:text-3xl font-extrabold text-dark tracking-tight">Créneaux disponibles</h2>
                <p class="text-[14px] text-beige-500 mt-2">Choisissez la date et l'heure qui vous conviennent</p>
            </div>

            @if($creneaux->count() > 0)
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5">
                    @foreach($creneaux as $creneau)
                        <div class="rounded-2xl border border-beige-200/60 p-6 hover:border-brand-200 hover:shadow-lg hover:shadow-brand-500/5 transition-all duration-300">
                            <p class="text-[17px] font-bold text-dark mb-3">{{ \Carbon\Carbon::parse($creneau->date)->translatedFormat('l d F Y') }}</p>
                            <div class="flex items-center gap-2 text-[14px] text-beige-500 mb-2">
                                <svg class="w-4 h-4 text-brand-500" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                                {{ \Carbon\Carbon::parse($creneau->heure_debut)->format('H:i') }} — {{ \Carbon\Carbon::parse($creneau->heure_fin)->format('H:i') }}
                            </div>
                            @if($creneau->chef)
                                <div class="flex items-center gap-2 text-[14px] text-beige-500 mb-3">
                                    <svg class="w-4 h-4 text-brand-500" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                                    Chef {{ $creneau->chef->name }}
                                </div>
                            @endif
                            <div class="mb-5">
                                @if($creneau->places_restantes >= 4)
                                    <span class="inline-flex items-center gap-1.5 text-[13px] font-semibold text-emerald-600">
                                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-400"></span>{{ $creneau->places_restantes }} places restantes
                                    </span>
                                @elseif($creneau->places_restantes >= 2)
                                    <span class="inline-flex items-center gap-1.5 text-[13px] font-semibold text-amber-600">
                                        <span class="w-1.5 h-1.5 rounded-full bg-amber-400"></span>{{ $creneau->places_restantes }} places restantes — Dernières places !
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1.5 text-[13px] font-semibold text-red-600 group cursor-default">
                                        <span class="w-1.5 h-1.5 rounded-full bg-red-400"></span>
                                        <span class="group-hover:underline">Nombre de personnes pour ce créneau atteint</span>
                                    </span>
                                @endif
                            </div>
                            @if($creneau->places_restantes >= 2)
                                <a href="{{ route('reservation.create', $creneau) }}" class="block w-full py-3 text-center bg-brand-500 hover:bg-brand-600 text-white text-[14px] font-semibold rounded-xl transition-all duration-200 hover:shadow-md hover:shadow-brand-500/20">
                                    Réserver ce créneau
                                </a>
                            @else
                                <span class="block w-full py-3 text-center bg-red-50 text-red-400 text-[14px] font-semibold rounded-xl cursor-not-allowed border border-red-100">Complet</span>
                            @endif
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-16">
                    <svg class="w-12 h-12 text-beige-200 mx-auto mb-3" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1"><rect x="3" y="4" width="18" height="18" rx="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/></svg>
                    <h3 class="text-lg font-bold text-dark mb-2">Aucun créneau disponible</h3>
                    <p class="text-[14px] text-beige-400">Revenez bientôt, de nouveaux créneaux seront publiés.</p>
                </div>
            @endif
        </div>
    </section>

    {{-- Avis --}}
    @if($avis->count() > 0)
    <section class="bg-beige-50 py-16 sm:py-20">
        <div class="max-w-7xl mx-auto px-5 sm:px-8 lg:px-10">
            <div class="flex flex-col sm:flex-row sm:items-center justify-between mb-10 gap-4">
                <div>
                    <p class="text-[11px] font-bold uppercase tracking-[3px] text-brand-500 mb-2">Avis</p>
                    <h2 class="text-2xl font-extrabold text-dark tracking-tight">Ce que disent les participants</h2>
                </div>
                <div class="flex items-center gap-3">
                    <span class="text-4xl font-extrabold text-dark">{{ number_format($noteMoyenne, 1) }}</span>
                    <div>
                        <div class="flex gap-0.5">
                            @for($i = 1; $i <= 5; $i++)
                                <svg class="w-4 h-4 {{ $i <= round($noteMoyenne) ? 'text-amber-400' : 'text-beige-200' }}" viewBox="0 0 24 24" fill="currentColor"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
                            @endfor
                        </div>
                        <p class="text-[12px] text-beige-400 mt-0.5">{{ $avis->count() }} avis</p>
                    </div>
                </div>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5">
                @foreach($avis as $unAvis)
                    <div class="bg-white rounded-2xl p-6 border border-beige-200/60">
                        <div class="flex gap-0.5 mb-4">
                            @for($i = 1; $i <= 5; $i++)
                                <svg class="w-4 h-4 {{ $i <= $unAvis->note ? 'text-amber-400' : 'text-beige-200' }}" viewBox="0 0 24 24" fill="currentColor"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
                            @endfor
                        </div>
                        <p class="text-[14px] text-dark-50 leading-relaxed italic mb-5">« {{ $unAvis->commentaire }} »</p>
                        <div class="flex items-center gap-3 pt-4 border-t border-beige-100">
                            <div class="w-9 h-9 rounded-lg bg-brand-50 flex items-center justify-center">
                                <span class="text-[11px] font-bold text-brand-600">{{ strtoupper(mb_substr($unAvis->user->name, 0, 2)) }}</span>
                            </div>
                            <div>
                                <p class="text-sm font-semibold text-dark">{{ $unAvis->user->name }}</p>
                                <p class="text-[11px] text-beige-400">{{ $unAvis->created_at->translatedFormat('d F Y') }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    @endif

    {{-- CTA bien séparé du footer --}}
    <section class="bg-dark py-16 sm:py-20 text-center">
        <div class="max-w-7xl mx-auto px-5 sm:px-8 lg:px-10">
            <h2 class="text-2xl sm:text-3xl font-extrabold text-white tracking-tight mb-3">Envie de découvrir d'autres ateliers ?</h2>
            <p class="text-[15px] text-white/40 mb-8 max-w-md mx-auto">Explorez notre catalogue complet d'expériences culinaires africaines.</p>
            <a href="{{ route('ateliers.index') }}" class="inline-flex items-center gap-2 px-7 py-3.5 bg-brand-500 hover:bg-brand-600 text-white text-[14px] font-semibold rounded-xl transition-all duration-200 hover:shadow-lg hover:shadow-brand-500/20">
                Voir tous les ateliers
                <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 12h14"/><polyline points="12 5 19 12 12 19"/></svg>
            </a>
        </div>
    </section>

    {{-- Séparation avant le footer --}}
    <div class="h-px bg-white/5"></div>

@endsection