
@extends('layouts.admin')
@section('page-title', 'Gestion Newsletter')

@section('content')

    {{-- Stats abonnés --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-5">
        {{-- Abonnés actifs --}}
        <div class="bg-white rounded-xl px-5 py-4 border border-beige-200/60 flex items-center gap-4">
            <div class="w-10 h-10 rounded-lg bg-emerald-50 flex items-center justify-center flex-shrink-0">
                <svg class="w-5 h-5 text-emerald-600" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/>
                    <polyline points="22,6 12,13 2,6"/>
                </svg>
            </div>
            <div>
                <p class="text-2xl font-extrabold text-dark leading-tight">{{ $totalAbonnes }}</p>
                <p class="text-[11px] text-beige-400">abonnés actifs</p>
            </div>
        </div>
        {{-- Désinscrits --}}
        <div class="bg-white rounded-xl px-5 py-4 border border-beige-200/60 flex items-center gap-4">
            <div class="w-10 h-10 rounded-lg bg-red-50 flex items-center justify-center flex-shrink-0">
                <svg class="w-5 h-5 text-red-500" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/>
                    <line x1="9" y1="9" x2="15" y2="15"/><line x1="15" y1="9" x2="9" y2="15"/>
                </svg>
            </div>
            <div>
                <p class="text-2xl font-extrabold text-dark leading-tight">{{ $totalDesinscrits }}</p>
                <p class="text-[11px] text-beige-400">désinscrits</p>
            </div>
        </div>
    </div>

    {{-- Formulaire d'envoi --}}
    <div class="bg-white rounded-xl border border-beige-200/60 p-6 mb-5">
        <div class="flex items-center gap-3 mb-5 pb-4 border-b border-beige-100">
            <div class="w-9 h-9 rounded-lg bg-brand-50 flex items-center justify-center">
                <svg class="w-4 h-4 text-brand-500" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                    <line x1="22" y1="2" x2="11" y2="13"/>
                    <polygon points="22 2 15 22 11 13 2 9 22 2"/>
                </svg>
            </div>
            <div>
                <h2 class="text-[15px] font-bold text-dark">Envoyer une newsletter</h2>
                <p class="text-[11px] text-beige-400">Le message sera envoyé à {{ $totalAbonnes }} abonné{{ $totalAbonnes > 1 ? 's' : '' }}</p>
            </div>
        </div>

        <form action="{{ route('admin.newsletter.envoyer') }}" method="POST" id="newsletterForm" class="space-y-4">
            @csrf
            {{-- Sujet --}}
            <div>
                <label for="sujet" class="block text-sm font-medium text-dark-50 mb-1.5">Sujet</label>
                <input type="text" id="sujet" name="sujet" value="{{ old('sujet') }}" required placeholder="Ex: Nos nouveaux ateliers de mars !"
                    class="w-full px-4 py-2.5 rounded-lg border border-beige-300 bg-white text-sm text-dark placeholder:text-beige-400 focus:outline-none focus:border-brand-500 focus:ring-2 focus:ring-brand-500/10 transition duration-200">
                @error('sujet') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
            </div>
            {{-- Contenu --}}
            <div>
                <label for="contenu" class="block text-sm font-medium text-dark-50 mb-1.5">Contenu</label>
                <textarea id="contenu" name="contenu" rows="6" required placeholder="Rédigez le contenu de votre newsletter..."
                    class="w-full px-4 py-2.5 rounded-lg border border-beige-300 bg-white text-sm text-dark placeholder:text-beige-400 focus:outline-none focus:border-brand-500 focus:ring-2 focus:ring-brand-500/10 transition duration-200 resize-none">{{ old('contenu') }}</textarea>
                {{-- Compteur de caractères --}}
                <p class="mt-1 text-[11px] text-beige-400 text-right"><span id="charCount">0</span> caractères</p>
                @error('contenu') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
            </div>
            {{-- Bouton envoi --}}
            <div class="flex items-center gap-4">
                <button type="submit"
                    class="flex items-center gap-2 px-5 py-2.5 bg-brand-500 hover:bg-brand-600 text-white text-sm font-semibold rounded-lg transition-all duration-200 hover:shadow-md hover:shadow-brand-500/20">
                    <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <line x1="22" y1="2" x2="11" y2="13"/>
                        <polygon points="22 2 15 22 11 13 2 9 22 2"/>
                    </svg>
                    Envoyer à {{ $totalAbonnes }} abonné{{ $totalAbonnes > 1 ? 's' : '' }}
                </button>
                <span class="text-[12px] text-beige-400 flex items-center gap-1.5">
                    <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
                    L'envoi peut prendre quelques minutes
                </span>
            </div>
        </form>
    </div>

    {{-- Liste des abonnés --}}
    <div class="bg-white rounded-xl border border-beige-200/60 overflow-hidden">
        <div class="flex items-center justify-between px-6 py-4 border-b border-beige-100">
            <div class="flex items-center gap-3">
                <div class="w-9 h-9 rounded-lg bg-blue-50 flex items-center justify-center">
                    <svg class="w-4 h-4 text-blue-600" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/>
                        <path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/>
                    </svg>
                </div>
                <div>
                    <h2 class="text-[15px] font-bold text-dark">Abonnés actifs</h2>
                    <p class="text-[11px] text-beige-400">{{ $totalAbonnes }} adresse{{ $totalAbonnes > 1 ? 's' : '' }} email</p>
                </div>
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr>
                        <th class="px-5 py-3 text-left text-[10px] font-bold uppercase tracking-widest text-beige-400 bg-beige-50/50">Email</th>
                        <th class="px-5 py-3 text-left text-[10px] font-bold uppercase tracking-widest text-beige-400 bg-beige-50/50">Inscrit le</th>
                        <th class="px-5 py-3 text-left text-[10px] font-bold uppercase tracking-widest text-beige-400 bg-beige-50/50">Statut</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($abonnes as $abonne)
                        <tr class="border-b border-beige-50 hover:bg-beige-50/40 transition-colors duration-100">
                            <td class="px-5 py-3">
                                <div class="flex items-center gap-2.5">
                                    {{-- Icône email --}}
                                    <div class="w-7 h-7 rounded-md bg-brand-50 flex items-center justify-center flex-shrink-0">
                                        <svg class="w-3.5 h-3.5 text-brand-600" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                                            <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/>
                                            <polyline points="22,6 12,13 2,6"/>
                                        </svg>
                                    </div>
                                    <span class="text-[13px] font-semibold text-dark">{{ $abonne->email }}</span>
                                </div>
                            </td>
                            <td class="px-5 py-3 text-[13px] text-beige-500 whitespace-nowrap">{{ $abonne->created_at->translatedFormat('d F Y à H:i') }}</td>
                            <td class="px-5 py-3">
                                <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-md text-[11px] font-semibold bg-emerald-50 text-emerald-700">
                                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-400"></span>Actif
                                </span>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="px-6 py-16 text-center">
                                <svg class="w-10 h-10 text-beige-200 mx-auto mb-3" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                                    <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/>
                                    <polyline points="22,6 12,13 2,6"/>
                                </svg>
                                <p class="text-sm text-beige-400">Aucun abonné pour le moment</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($abonnes->hasPages())
            <div class="px-6 py-4 border-t border-beige-100">
                {{ $abonnes->links() }}
            </div>
        @endif
    </div>

@endsection

@push('scripts')
<script>
(function() {
    var textarea = document.getElementById('contenu');
    var counter = document.getElementById('charCount');
    var form = document.getElementById('newsletterForm');

    /* Compteur de caractères en temps réel */
    textarea.addEventListener('input', function() {
        counter.textContent = this.value.length;
    });

    /* Confirmation avant envoi */
    form.addEventListener('submit', function(e) {
        var total = '{{ $totalAbonnes }}';
        if (!confirm('Envoyer cette newsletter à ' + total + ' abonnés ?')) {
            e.preventDefault();
        }
    });
})();
</script>
@endpush