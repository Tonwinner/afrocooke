@extends('layouts.app')
@section('title', 'Réserver — AfroCook Experience')

@section('content')

    {{-- Header --}}
    <section class="relative py-14 sm:py-16 text-center overflow-hidden">
        <div class="absolute inset-0">
            <img src="https://images.unsplash.com/photo-1556910103-1c02745aae4d?w=1200&q=80" alt="" class="w-full h-full object-cover">
            <div class="absolute inset-0 bg-dark/75"></div>
        </div>
        <div class="relative z-10 max-w-7xl mx-auto px-5 sm:px-8 lg:px-10">
            <h1 class="text-3xl sm:text-4xl font-extrabold text-white tracking-tight mb-3">Réservation</h1>
            <p class="text-[15px] text-white/50 max-w-md mx-auto">Finalisez votre réservation pour cet atelier</p>
        </div>
    </section>

    <section class="bg-beige-50 py-10 sm:py-14">
        <div class="max-w-7xl mx-auto px-5 sm:px-8 lg:px-10">

            {{-- Lien retour --}}
            <a href="{{ route('ateliers.show', $creneau->atelier->slug) }}" class="inline-flex items-center gap-2 text-sm text-beige-500 hover:text-brand-500 transition-colors mb-6 group">
                <svg class="w-4 h-4 transition-transform group-hover:-translate-x-0.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M19 12H5"/><polyline points="12 19 5 12 12 5"/></svg>
                Retour à l'atelier
            </a>

            <div class="grid grid-cols-1 lg:grid-cols-5 gap-8 items-start">

                {{-- Formulaire (3 colonnes) --}}
                <div class="lg:col-span-3 bg-white rounded-2xl border border-beige-200/60 p-6 sm:p-8">
                    <div class="flex items-center gap-3 mb-6 pb-5 border-b border-beige-100">
                        <div class="w-10 h-10 rounded-xl bg-brand-50 flex items-center justify-center">
                            <svg class="w-5 h-5 text-brand-500" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/></svg>
                        </div>
                        <div>
                            <h2 class="text-lg font-bold text-dark">Détails de la réservation</h2>
                            <p class="text-[12px] text-beige-400">Remplissez les informations ci-dessous</p>
                        </div>
                    </div>

                    {{-- Note info --}}
                    <div class="flex items-start gap-3 px-4 py-3 bg-brand-50 rounded-xl mb-6">
                        <svg class="w-5 h-5 text-brand-500 flex-shrink-0 mt-0.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
                        <p class="text-[13px] text-brand-700">Les ateliers sont conçus pour des duos. Le nombre minimum de participants est de 2 personnes.</p>
                    </div>

                    <form action="{{ route('reservation.store') }}" method="POST" class="space-y-5">
                        @csrf
                        <input type="hidden" name="creneau_id" value="{{ $creneau->id }}">

                        {{-- Nombre de participants --}}
                        <div>
                            <label for="nombre_personnes" class="block text-sm font-medium text-dark-50 mb-1.5">Nombre de participants</label>
                            <select id="nombre_personnes" name="nombre_personnes" required
                                class="w-full px-4 py-3 rounded-xl border border-beige-200 bg-beige-50 text-[14px] text-dark focus:outline-none focus:border-brand-500 focus:ring-2 focus:ring-brand-500/10 focus:bg-white transition duration-200">
                                @foreach([2, 4, 6] as $nb)
                                    @if($nb <= $creneau->places_restantes)
                                        <option value="{{ $nb }}" {{ old('nombre_personnes', 2) == $nb ? 'selected' : '' }}>{{ $nb }} personnes</option>
                                    @endif
                                @endforeach
                            </select>
                            <p class="mt-1.5 text-[12px] text-beige-400">Les réservations se font par duo (2, 4 ou 6 personnes).</p>
                            @error('nombre_personnes') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                        </div>

                        {{-- Code promo --}}
                        <div>
                            <label for="code_promo" class="block text-sm font-medium text-dark-50 mb-1.5">Code promo <span class="text-beige-400 font-normal">(optionnel)</span></label>
                            <input type="text" id="code_promo" name="code_promo" value="{{ old('code_promo') }}" placeholder="Ex: BIENVENUE20"
                                class="w-full px-4 py-3 rounded-xl border border-beige-200 bg-beige-50 text-[14px] text-dark placeholder:text-beige-400 focus:outline-none focus:border-brand-500 focus:ring-2 focus:ring-brand-500/10 focus:bg-white transition duration-200 uppercase">
                            @error('code_promo') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                        </div>

                        {{-- Notes --}}
                        <div>
                            <label for="notes" class="block text-sm font-medium text-dark-50 mb-1.5">Notes <span class="text-beige-400 font-normal">(optionnel)</span></label>
                            <textarea id="notes" name="notes" rows="3" placeholder="Allergies, préférences alimentaires..."
                                class="w-full px-4 py-3 rounded-xl border border-beige-200 bg-beige-50 text-[14px] text-dark placeholder:text-beige-400 focus:outline-none focus:border-brand-500 focus:ring-2 focus:ring-brand-500/10 focus:bg-white transition duration-200 resize-none">{{ old('notes') }}</textarea>
                            @error('notes') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                        </div>

                        {{-- Bouton --}}
                        <button type="submit"
                            class="w-full flex items-center justify-center gap-2 py-4 bg-brand-500 hover:bg-brand-600 text-white text-[15px] font-semibold rounded-xl transition-all duration-200 hover:shadow-lg hover:shadow-brand-500/20">
                            <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
                            Passer au paiement
                        </button>
                    </form>
                </div>

                {{-- Récapitulatif (2 colonnes, sticky) --}}
                <div class="lg:col-span-2 lg:sticky lg:top-24">
                    <div class="bg-white rounded-2xl border border-beige-200/60 overflow-hidden">
                        {{-- Image atelier --}}
                        <div class="relative h-48 overflow-hidden">
                            @if($creneau->atelier->photo)
                                <img src="{{ asset('storage/' . $creneau->atelier->photo) }}" alt="{{ $creneau->atelier->titre }}" class="w-full h-full object-cover">
                            @else
                                <div class="w-full h-full bg-gradient-to-br from-beige-100 to-beige-200 flex items-center justify-center">
                                    <svg class="w-12 h-12 text-beige-300" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1"><path d="M18 8h1a4 4 0 0 1 0 8h-1"/><path d="M2 8h16v9a4 4 0 0 1-4 4H6a4 4 0 0 1-4-4V8z"/></svg>
                                </div>
                            @endif
                            @php
                                $drapeaux = ['Bénin'=>'bj','Sénégal'=>'sn','Cameroun'=>'cm','Togo'=>'tg','Nigeria'=>'ng','Ghana'=>'gh',"Côte d'Ivoire"=>'ci','Mali'=>'ml','Niger'=>'ne','Guinée'=>'gn'];
                                $iso = $drapeaux[$creneau->atelier->origine_pays] ?? null;
                            @endphp
                            <span class="absolute top-3 left-3 inline-flex items-center gap-1.5 px-2.5 py-1 bg-white/90 backdrop-blur-sm text-dark text-[11px] font-bold rounded-lg">
                                @if($iso)
                                    <img src="https://flagcdn.com/w20/{{ $iso }}.png" alt="" class="w-4 h-3 rounded-sm object-cover">
                                @endif
                                {{ $creneau->atelier->origine_pays }}
                            </span>
                        </div>

                        <div class="p-5">
                            <h3 class="text-[17px] font-bold text-dark mb-4">{{ $creneau->atelier->titre }}</h3>

                            {{-- Détails du créneau --}}
                            <div class="space-y-2.5 mb-5">
                                <div class="flex items-center gap-2.5 text-[13px] text-beige-500">
                                    <svg class="w-4 h-4 text-brand-500 flex-shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><rect x="3" y="4" width="18" height="18" rx="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                                    {{ \Carbon\Carbon::parse($creneau->date)->translatedFormat('l d F Y') }}
                                </div>
                                <div class="flex items-center gap-2.5 text-[13px] text-beige-500">
                                    <svg class="w-4 h-4 text-brand-500 flex-shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                                    {{ \Carbon\Carbon::parse($creneau->heure_debut)->format('H:i') }} — {{ \Carbon\Carbon::parse($creneau->heure_fin)->format('H:i') }} ({{ $creneau->atelier->duree_minutes }} min)
                                </div>
                                @if($creneau->chef)
                                    <div class="flex items-center gap-2.5 text-[13px] text-beige-500">
                                        <svg class="w-4 h-4 text-brand-500 flex-shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                                        Chef {{ $creneau->chef->name }}
                                    </div>
                                @endif
                            </div>

                            {{-- Calcul prix --}}
                            <div class="border-t border-beige-100 pt-4 space-y-2">
                                <div class="flex justify-between text-[13px] text-beige-500">
                                    <span>Prix par personne</span>
                                    <span>{{ number_format($creneau->atelier->prix, 0, ',', ' ') }} FCFA</span>
                                </div>
                                <div class="flex justify-between text-[13px] text-beige-500">
                                    <span>Participants</span>
                                    <span id="recapNb">2</span>
                                </div>
                            </div>

                            {{-- Total --}}
                            <div class="border-t border-beige-100 mt-3 pt-3">
                                <div class="flex justify-between items-center">
                                    <span class="text-[15px] font-bold text-dark">Total</span>
                                    <span id="recapTotal" class="text-xl font-extrabold text-brand-600">{{ number_format($creneau->atelier->prix * 2, 0, ',', ' ') }} FCFA</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection

@push('scripts')
<script>
(function() {
    /* Mise à jour du récap en temps réel */
    var prix = {{ $creneau->atelier->prix }};
    var select = document.getElementById('nombre_personnes');
    var nbEl = document.getElementById('recapNb');
    var totalEl = document.getElementById('recapTotal');

    select.addEventListener('change', function() {
        var nb = parseInt(this.value);
        nbEl.textContent = nb;
        var total = prix * nb;
        totalEl.textContent = total.toLocaleString('fr-FR') + ' FCFA';
    });
})();
</script>
@endpush