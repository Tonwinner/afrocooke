@extends('layouts.app')
@section('title', 'Nos Ateliers — AfroCook Experience')

@section('content')

    {{-- Header avec images défilantes --}}
    <section class="relative h-56 sm:h-64 overflow-hidden" id="headerSlider">
        {{-- Images de fond (4 images qui défilent) --}}
        <div class="slide-img absolute inset-0 opacity-100 transition-opacity duration-1000">
            <img src="https://images.unsplash.com/photo-1504674900247-0877df9cc836?w=1200&q=80" alt="" class="w-full h-full object-cover">
        </div>
        <div class="slide-img absolute inset-0 opacity-0 transition-opacity duration-1000">
            <img src="https://images.unsplash.com/photo-1556910103-1c02745aae4d?w=1200&q=80" alt="" class="w-full h-full object-cover">
        </div>
        <div class="slide-img absolute inset-0 opacity-0 transition-opacity duration-1000">
            <img src="https://images.unsplash.com/photo-1414235077428-338989a2e8c0?w=1200&q=80" alt="" class="w-full h-full object-cover">
        </div>
        <div class="slide-img absolute inset-0 opacity-0 transition-opacity duration-1000">
            <img src="https://images.unsplash.com/photo-1528712306091-ed0763094c98?w=1200&q=80" alt="" class="w-full h-full object-cover">
        </div>
        {{-- Overlay sombre --}}
        <div class="absolute inset-0 bg-dark/70"></div>
        {{-- Texte --}}
        <div class="relative z-10 h-full flex flex-col items-center justify-center text-center px-5">
            <h1 class="text-3xl sm:text-4xl font-extrabold text-white tracking-tight mb-3">Nos Ateliers</h1>
            <p class="text-[15px] text-white/50 max-w-md">Découvrez toutes nos expériences culinaires africaines</p>
        </div>
    </section>

    <section class="bg-beige-50 py-10 sm:py-14">
        <div class="max-w-7xl mx-auto px-5 sm:px-8 lg:px-10">

            {{-- Filtres Vue.js --}}
            <div id="vue-filters"></div>
            <script>
            document.addEventListener('DOMContentLoaded', function() {
                var app = window.Vue.createApp({
                    components: { AtelierFilters: window.VueComponents.AtelierFilters },
                    template: '<AtelierFilters :pays="pays" initial-pays="{{ request('pays') }}" initial-plat="{{ request('plat') }}" initial-prix-max="{{ request('prix_max') }}" :total-results="{{ $ateliers->total() }}" />',
                    data() {
                        return {
                            pays: @json($pays),
                        };
                    },
                });
                app.mount('#vue-filters');
            });
            </script>
            

            {{-- Grille des ateliers --}}
            @if($ateliers->count() > 0)
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-5">
                    @foreach($ateliers as $atelier)
                        <a href="{{ route('ateliers.show', $atelier->slug) }}" class="block bg-white rounded-xl overflow-hidden border border-beige-200/60 group hover:shadow-2xl hover:shadow-brand-500/10 hover:border-brand-300 transition-all duration-300 hover:-translate-y-1.5 cursor-pointer">
                            {{-- Image compacte --}}
                            <div class="relative h-44 overflow-hidden">
                                @if($atelier->photo)
                                    <img src="{{ asset('storage/' . $atelier->photo) }}" alt="{{ $atelier->titre }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                                @else
                                    <div class="w-full h-full bg-gradient-to-br from-beige-100 to-beige-200 flex items-center justify-center">
                                        <svg class="w-10 h-10 text-beige-300" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1"><path d="M18 8h1a4 4 0 0 1 0 8h-1"/><path d="M2 8h16v9a4 4 0 0 1-4 4H6a4 4 0 0 1-4-4V8z"/></svg>
                                    </div>
                                @endif
                                @php
                                    $drapeaux = ['Bénin'=>'bj','Sénégal'=>'sn','Cameroun'=>'cm','Togo'=>'tg','Nigeria'=>'ng','Ghana'=>'gh',"Côte d'Ivoire"=>'ci','Mali'=>'ml','Niger'=>'ne','Guinée'=>'gn'];
                                    $iso = $drapeaux[$atelier->origine_pays] ?? null;
                                @endphp
                                <span class="absolute top-2.5 left-2.5 inline-flex items-center gap-1.5 px-2.5 py-1 bg-white/90 backdrop-blur-sm text-dark text-[11px] font-bold rounded-lg">
                                    @if($iso)
                                        <img src="https://flagcdn.com/w20/{{ $iso }}.png" alt="" class="w-4 h-3 rounded-sm object-cover">
                                    @endif
                                    {{ $atelier->origine_pays }}
                                </span>
                            </div>
                            {{-- Contenu compact --}}
                            <div class="p-4">
                                <h3 class="text-[15px] font-bold text-dark mb-1 truncate">{{ $atelier->titre }}</h3>
                                <p class="text-[12px] text-beige-500 leading-relaxed mb-3 line-clamp-2">{{ Str::limit($atelier->description, 75) }}</p>
                                <div class="flex items-center gap-4 mb-3">
                                    <span class="flex items-center gap-1 text-[11px] text-beige-400">
                                        <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                                        {{ $atelier->duree_minutes }}min
                                    </span>
                                    <span class="flex items-center gap-1 text-[11px] text-beige-400">
                                        <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/></svg>
                                        {{ $atelier->max_participants }} pers.
                                    </span>
                                </div>
                                <div class="flex items-center justify-between pt-3 border-t border-beige-100">
                                    <span class="text-lg font-extrabold text-brand-600">{{ number_format($atelier->prix, 0, ',', ' ') }} <span class="text-[11px] font-semibold text-beige-400">FCFA</span></span>
                                    <span class="text-[12px] font-semibold text-brand-500 group-hover:text-brand-700 transition-colors">Voir →</span>
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>

                @if($ateliers->hasPages())
                    <div class="mt-10 flex justify-center">{{ $ateliers->withQueryString()->links() }}</div>
                @endif
            @else
                <div class="text-center py-20">
                    <svg class="w-14 h-14 text-beige-200 mx-auto mb-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1"><circle cx="12" cy="12" r="10"/><path d="M8 15h8"/><path d="M9 9h.01"/><path d="M15 9h.01"/></svg>
                    <h3 class="text-xl font-bold text-dark mb-2">Aucun atelier trouvé</h3>
                    <p class="text-[14px] text-beige-400 mb-6">Essayez de modifier vos filtres.</p>
                    <a href="{{ route('ateliers.index') }}" class="px-6 py-3 bg-brand-500 hover:bg-brand-600 text-white text-sm font-semibold rounded-xl transition-all duration-200">Voir tous les ateliers</a>
                </div>
            @endif
        </div>
    </section>

    {{-- Avis défilants (statiques + dynamiques) --}}
    <section class="bg-white py-12 overflow-hidden border-t border-beige-200/60">
        <div class="max-w-7xl mx-auto px-5 sm:px-8 lg:px-10 mb-8">
            <p class="text-[11px] font-bold uppercase tracking-[3px] text-brand-500 mb-2">Témoignages</p>
            <h3 class="text-xl font-extrabold text-dark tracking-tight">Avis de nos participants</h3>
        </div>
        <div class="relative overflow-hidden">
            <div id="scrollTrack" class="flex gap-5 animate-scroll">
                @for($loop_i = 0; $loop_i < 2; $loop_i++)
                    {{-- Avis statiques (toujours visibles) --}}
                    <div class="flex-shrink-0 w-80 bg-beige-50 rounded-xl p-5 border border-beige-200/60">
                        <div class="flex gap-0.5 mb-3">
                            @for($i=0;$i<5;$i++)<svg class="w-3.5 h-3.5 text-amber-400" viewBox="0 0 24 24" fill="currentColor"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>@endfor
                        </div>
                        <p class="text-[13px] text-dark-50 italic leading-relaxed mb-4">« Le Jollof Rice était incroyable ! Le chef nous a guidés pas à pas. »</p>
                        <p class="text-[13px] font-semibold text-dark">Fatou M. <span class="text-beige-400 font-normal">— Jollof Rice</span></p>
                    </div>
                    <div class="flex-shrink-0 w-80 bg-beige-50 rounded-xl p-5 border border-beige-200/60">
                        <div class="flex gap-0.5 mb-3">
                            @for($i=0;$i<5;$i++)<svg class="w-3.5 h-3.5 text-amber-400" viewBox="0 0 24 24" fill="currentColor"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>@endfor
                        </div>
                        <p class="text-[13px] text-dark-50 italic leading-relaxed mb-4">« Une expérience en couple mémorable. Le Poulet DG était parfait ! »</p>
                        <p class="text-[13px] font-semibold text-dark">Arnaud K. <span class="text-beige-400 font-normal">— Poulet DG</span></p>
                    </div>
                    <div class="flex-shrink-0 w-80 bg-beige-50 rounded-xl p-5 border border-beige-200/60">
                        <div class="flex gap-0.5 mb-3">
                            @for($i=0;$i<4;$i++)<svg class="w-3.5 h-3.5 text-amber-400" viewBox="0 0 24 24" fill="currentColor"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>@endfor
                            <svg class="w-3.5 h-3.5 text-beige-200" viewBox="0 0 24 24" fill="currentColor"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
                        </div>
                        <p class="text-[13px] text-dark-50 italic leading-relaxed mb-4">« La Pâte Rouge était délicieuse. Ambiance chaleureuse et conviviale. »</p>
                        <p class="text-[13px] font-semibold text-dark">Marie A. <span class="text-beige-400 font-normal">— Pâte Rouge</span></p>
                    </div>
                    <div class="flex-shrink-0 w-80 bg-beige-50 rounded-xl p-5 border border-beige-200/60">
                        <div class="flex gap-0.5 mb-3">
                            @for($i=0;$i<5;$i++)<svg class="w-3.5 h-3.5 text-amber-400" viewBox="0 0 24 24" fill="currentColor"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>@endfor
                        </div>
                        <p class="text-[13px] text-dark-50 italic leading-relaxed mb-4">« Le Thieboudienne était authentique. On s'est cru au Sénégal ! »</p>
                        <p class="text-[13px] font-semibold text-dark">Séna D. <span class="text-beige-400 font-normal">— Thieboudienne</span></p>
                    </div>
                    {{-- Avis dynamiques (depuis la base, ajoutés par les clients) --}}
                    @if(isset($avisClients))
                        @foreach($avisClients as $unAvis)
                            <div class="flex-shrink-0 w-80 bg-beige-50 rounded-xl p-5 border border-beige-200/60">
                                <div class="flex gap-0.5 mb-3">
                                    @for($i = 1; $i <= 5; $i++)
                                        <svg class="w-3.5 h-3.5 {{ $i <= $unAvis->note ? 'text-amber-400' : 'text-beige-200' }}" viewBox="0 0 24 24" fill="currentColor"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
                                    @endfor
                                </div>
                                <p class="text-[13px] text-dark-50 italic leading-relaxed mb-4">« {{ Str::limit($unAvis->commentaire, 120) }} »</p>
                                <p class="text-[13px] font-semibold text-dark">{{ $unAvis->user->name }} <span class="text-beige-400 font-normal">— {{ $unAvis->atelier->titre }}</span></p>
                            </div>
                        @endforeach
                    @endif
                @endfor
            </div>
        </div>
    </section>
    

@endsection

@push('styles')
<style>
    /* Animation défilement continu */
    @keyframes scrollLeft {
        0% { transform: translateX(0); }
        100% { transform: translateX(-50%); }
    }
    .animate-scroll {
        animation: scrollLeft 30s linear infinite;
        width: max-content;
    }
    .animate-scroll:hover { animation-play-state: paused; }
</style>
@endpush

@push('scripts')
<script>
(function() {
    /* ═══ Slider header ═══ */
    var slides = document.querySelectorAll('.slide-img');
    var current = 0;
    setInterval(function() {
        slides[current].classList.remove('opacity-100');
        slides[current].classList.add('opacity-0');
        current = (current + 1) % slides.length;
        slides[current].classList.remove('opacity-0');
        slides[current].classList.add('opacity-100');
    }, 5000);

    /* ═══ Custom Select Premium ═══ */
    document.querySelectorAll('[data-custom-select]').forEach(function(select) {
        var trigger   = select.querySelector('[data-select-trigger]');
        var dropdown  = select.querySelector('[data-select-dropdown]');
        var chevron   = select.querySelector('[data-select-chevron]');
        var search    = select.querySelector('[data-select-search]');
        var options   = select.querySelectorAll('[data-select-option]');
        var hiddenInp = select.querySelector('input[type="hidden"]');
        var labelEl   = select.querySelector('[data-select-label]');
        var isOpen    = false;

        /* Ouvrir / fermer le dropdown */
        function open() {
            dropdown.classList.remove('hidden');
            chevron.classList.add('rotate-180');
            isOpen = true;
            if (search) { search.value = ''; filterOptions(''); search.focus(); }
        }

        function close() {
            dropdown.classList.add('hidden');
            chevron.classList.remove('rotate-180');
            isOpen = false;
        }

        trigger.addEventListener('click', function(e) {
            e.preventDefault();
            e.stopPropagation();
            isOpen ? close() : open();
        });

        /* Fermer au clic en dehors */
        document.addEventListener('click', function(e) {
            if (!select.contains(e.target)) close();
        });

        /* Fermer avec Echap */
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape' && isOpen) close();
        });

        /* Recherche dans les options */
        function filterOptions(term) {
            var lower = term.toLowerCase();
            options.forEach(function(opt) {
                var text = opt.textContent.toLowerCase();
                opt.style.display = text.indexOf(lower) !== -1 ? '' : 'none';
            });
        }

        if (search) {
            search.addEventListener('input', function() {
                filterOptions(this.value);
            });
        }

        /* Sélectionner une option */
        options.forEach(function(opt) {
            opt.addEventListener('click', function() {
                var value = this.dataset.value;
                hiddenInp.value = value;

                /* Mettre à jour le label affiché */
                if (value) {
                    labelEl.innerHTML = this.innerHTML;
                } else {
                    labelEl.innerHTML = '<svg class="w-4 h-4 text-beige-400" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><circle cx="12" cy="12" r="10"/><path d="M2 12h20"/><path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"/></svg><span class="text-beige-400">Tous les pays</span>';
                }

                /* Surligner l'option active */
                options.forEach(function(o) {
                    o.classList.remove('bg-brand-50', 'text-brand-600', 'font-semibold');
                });
                this.classList.add('bg-brand-50', 'text-brand-600', 'font-semibold');

                close();
            });
        });
    });
})();
</script>
@endpush