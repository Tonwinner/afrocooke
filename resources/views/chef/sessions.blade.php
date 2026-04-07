@extends('layouts.app')
@section('title', 'Sessions Passées — AfroCook Experience')

@section('content')

    {{-- Header --}}
    <section class="relative py-14 sm:py-16 text-center overflow-hidden">
        <div class="absolute inset-0">
            <img src="https://images.unsplash.com/photo-1507048331197-7d4ac70811cf?w=1200&q=80" alt="" class="w-full h-full object-cover">
            <div class="absolute inset-0 bg-dark/75"></div>
        </div>
        <div class="relative z-10 max-w-7xl mx-auto px-5 sm:px-8 lg:px-10">
            <h1 class="text-3xl sm:text-4xl font-extrabold text-white tracking-tight mb-3">Sessions Passées</h1>
            <p class="text-[15px] text-white/50 max-w-md mx-auto">Historique de vos ateliers animés</p>
        </div>
    </section>

    <section class="bg-beige-50 py-10 sm:py-14">
        <div class="max-w-7xl mx-auto px-5 sm:px-8 lg:px-10">

            {{-- Navigation chef --}}
            <div class="max-w-sm mx-auto -mt-20 relative z-20 mb-10">
                <div class="bg-white rounded-xl p-1.5 border border-beige-200/60 shadow-lg shadow-dark/5 flex gap-1">
                    <a href="{{ route('chef.planning') }}"
                       class="flex-1 flex items-center justify-center gap-2 py-2.5 rounded-lg text-[13px] font-semibold text-beige-500 hover:bg-beige-50 transition-colors">
                        <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><rect x="3" y="4" width="18" height="18" rx="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                        Planning
                    </a>
                    <a href="{{ route('chef.sessions') }}"
                       class="flex-1 flex items-center justify-center gap-2 py-2.5 rounded-lg text-[13px] font-semibold bg-brand-500 text-white transition-colors">
                        <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><polyline points="23 4 23 10 17 10"/><path d="M20.49 15a9 9 0 1 1-2.12-9.36L23 10"/></svg>
                        Sessions passées
                    </a>
                </div>
            </div>

            {{-- Liste des sessions --}}
            @if($sessions->count() > 0)
                <div class="space-y-5">
                    @foreach($sessions as $session)
                        <div class="bg-white rounded-2xl border border-beige-200/60 p-6 hover:shadow-lg hover:shadow-dark/5 transition-all duration-200">
                            {{-- En-tête session --}}
                            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 mb-5 pb-5 border-b border-beige-100">
                                <div>
                                    <p class="text-[17px] font-bold text-dark mb-1">{{ \Carbon\Carbon::parse($session->date)->translatedFormat('l d F Y') }}</p>
                                    <p class="text-[15px] font-semibold text-brand-600 mb-1">{{ $session->atelier->titre }}</p>
                                    <div class="flex items-center gap-2 text-[13px] text-beige-500">
                                        <svg class="w-3.5 h-3.5 text-brand-500" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                                        {{ \Carbon\Carbon::parse($session->heure_debut)->format('H:i') }} — {{ \Carbon\Carbon::parse($session->heure_fin)->format('H:i') }}
                                    </div>
                                </div>
                                <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg text-[12px] font-semibold bg-brand-50 text-brand-600 self-start">
                                    <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/></svg>
                                    {{ $session->reservations->count() }} participant{{ $session->reservations->count() > 1 ? 's' : '' }}
                                </span>
                            </div>

                            {{-- Liste des participants --}}
                            @if($session->reservations->count() > 0)
                                <div>
                                    <p class="text-[11px] font-bold uppercase tracking-[2px] text-beige-400 mb-3">Participants</p>
                                    <div class="space-y-2.5">
                                        @foreach($session->reservations as $reservation)
                                            <div class="flex items-center gap-3 py-2 px-3 rounded-xl bg-beige-50/50">
                                                <div class="w-8 h-8 rounded-lg bg-brand-50 flex items-center justify-center flex-shrink-0">
                                                    <span class="text-[10px] font-bold text-brand-600">{{ strtoupper(mb_substr($reservation->user->name, 0, 2)) }}</span>
                                                </div>
                                                <div class="min-w-0 flex-1">
                                                    <p class="text-[14px] font-semibold text-dark truncate">{{ $reservation->user->name }}</p>
                                                    <p class="text-[12px] text-beige-400 truncate">{{ $reservation->user->email }}</p>
                                                </div>
                                                <span class="text-[12px] text-beige-500 flex-shrink-0">{{ $reservation->nombre_personnes }} pers.</span>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endif
                        </div>
                    @endforeach
                </div>

                @if($sessions->hasPages())
                    <div class="mt-10 flex justify-center">{{ $sessions->links() }}</div>
                @endif
            @else
                <div class="text-center py-20">
                    <svg class="w-14 h-14 text-beige-200 mx-auto mb-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1"><polyline points="23 4 23 10 17 10"/><path d="M20.49 15a9 9 0 1 1-2.12-9.36L23 10"/></svg>
                    <h3 class="text-xl font-bold text-dark mb-2">Aucune session passée</h3>
                    <p class="text-[14px] text-beige-400">Votre historique de sessions animées apparaîtra ici.</p>
                </div>
            @endif
        </div>
    </section>

@endsection