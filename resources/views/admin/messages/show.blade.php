
@extends('layouts.admin')
@section('page-title', 'Message de ' . $message->nom)

@section('content')

    {{-- Lien retour --}}
    <a href="{{ route('admin.messages.index') }}" class="inline-flex items-center gap-2 text-sm text-beige-500 hover:text-brand-500 transition-colors mb-5 group">
        <svg class="w-4 h-4 transition-transform group-hover:-translate-x-0.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M19 12H5"/><polyline points="12 19 5 12 12 5"/></svg>
        Retour aux messages
    </a>

    <div class="bg-white rounded-xl border border-beige-200/60 overflow-hidden">
        {{-- En-tête --}}
        <div class="px-6 py-5 border-b border-beige-100">
            <div class="flex items-start justify-between gap-4">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-lg bg-brand-50 flex items-center justify-center flex-shrink-0">
                        <span class="text-sm font-bold text-brand-600">{{ strtoupper(mb_substr($message->nom, 0, 2)) }}</span>
                    </div>
                    <div>
                        <h2 class="text-[16px] font-bold text-dark">{{ $message->nom }}</h2>
                        <p class="text-[13px] text-beige-400">{{ $message->email }}</p>
                    </div>
                </div>
                <div class="text-right flex-shrink-0">
                    <p class="text-[13px] text-beige-500">{{ $message->created_at->translatedFormat('d F Y à H:i') }}</p>
                    @if($message->lu)
                        <span class="inline-flex items-center gap-1.5 px-2 py-0.5 rounded-md text-[11px] font-semibold bg-emerald-50 text-emerald-700 mt-1">
                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-400"></span>Lu
                        </span>
                    @endif
                </div>
            </div>
        </div>

        {{-- Contenu du message --}}
        <div class="px-6 py-6">
            <p class="text-[15px] text-dark-50 leading-relaxed whitespace-pre-line">{{ $message->message }}</p>
        </div>

        {{-- Actions --}}
        <div class="px-6 py-4 border-t border-beige-100 flex items-center gap-3">
            {{-- Répondre par email --}}
            <a href="mailto:{{ $message->email }}?subject=Re: Message depuis Atelier à Deux"
               class="flex items-center gap-2 px-4 py-2.5 bg-brand-500 hover:bg-brand-600 text-white text-[13px] font-semibold rounded-lg transition-all duration-200">
                <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="9 17 4 12 9 7"/><path d="M20 18v-2a4 4 0 0 0-4-4H4"/></svg>
                Répondre par email
            </a>
            {{-- Toggle lu --}}
            <form action="{{ route('admin.messages.toggle', $message) }}" method="POST">
                @csrf @method('PUT')
                <button type="submit"
                    class="flex items-center gap-2 px-4 py-2.5 text-[13px] font-semibold text-beige-500 border border-beige-300 hover:border-beige-400 rounded-lg transition-all duration-200">
                    <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
                    {{ $message->lu ? 'Marquer non lu' : 'Marquer lu' }}
                </button>
            </form>
            {{-- Supprimer --}}
            <form action="{{ route('admin.messages.destroy', $message) }}" method="POST" data-confirm="Supprimer ce message définitivement ?">
                @csrf @method('DELETE')
                <button type="submit"
                    class="flex items-center gap-2 px-4 py-2.5 text-[13px] font-semibold text-red-500 border border-red-200 hover:bg-red-50 rounded-lg transition-all duration-200">
                    <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><polyline points="3 6 5 6 21 6"/><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/></svg>
                    Supprimer
                </button>
            </form>
        </div>
    </div>

@endsection