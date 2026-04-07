
@extends('layouts.admin')
@section('page-title', 'Messages de Contact')

@section('content')

    {{-- Stats rapides --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-5">
        <div class="bg-white rounded-xl px-5 py-4 border border-beige-200/60 flex items-center gap-4">
            <div class="w-10 h-10 rounded-lg bg-blue-50 flex items-center justify-center flex-shrink-0">
                <svg class="w-5 h-5 text-blue-600" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
            </div>
            <div>
                <p class="text-2xl font-extrabold text-dark leading-tight">{{ $messages->total() }}</p>
                <p class="text-[11px] text-beige-400">messages au total</p>
            </div>
        </div>
        <div class="bg-white rounded-xl px-5 py-4 border border-beige-200/60 flex items-center gap-4">
            <div class="w-10 h-10 rounded-lg {{ $nonLus > 0 ? 'bg-amber-50' : 'bg-emerald-50' }} flex items-center justify-center flex-shrink-0">
                <svg class="w-5 h-5 {{ $nonLus > 0 ? 'text-amber-600' : 'text-emerald-600' }}" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
            </div>
            <div>
                <p class="text-2xl font-extrabold text-dark leading-tight">{{ $nonLus }}</p>
                <p class="text-[11px] text-beige-400">non lu{{ $nonLus > 1 ? 's' : '' }}</p>
            </div>
        </div>
    </div>

    {{-- Tableau des messages --}}
    <div class="bg-white rounded-xl border border-beige-200/60 overflow-hidden">
        <div class="flex items-center justify-between px-6 py-4 border-b border-beige-100">
            <div class="flex items-center gap-3">
                <div class="w-9 h-9 rounded-lg bg-brand-50 flex items-center justify-center">
                    <svg class="w-4 h-4 text-brand-500" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
                </div>
                <div>
                    <h2 class="text-[15px] font-bold text-dark">Messages de contact</h2>
                    <p class="text-[11px] text-beige-400">Tous les messages envoyés via le formulaire</p>
                </div>
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr>
                        <th class="px-5 py-3 text-left text-[10px] font-bold uppercase tracking-widest text-beige-400 bg-beige-50/50">Expéditeur</th>
                        <th class="px-5 py-3 text-left text-[10px] font-bold uppercase tracking-widest text-beige-400 bg-beige-50/50">Message</th>
                        <th class="px-5 py-3 text-left text-[10px] font-bold uppercase tracking-widest text-beige-400 bg-beige-50/50">Date</th>
                        <th class="px-5 py-3 text-left text-[10px] font-bold uppercase tracking-widest text-beige-400 bg-beige-50/50">Statut</th>
                        <th class="px-5 py-3 text-right text-[10px] font-bold uppercase tracking-widest text-beige-400 bg-beige-50/50">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($messages as $msg)
                        <tr class="border-b border-beige-50 transition-colors duration-100 {{ !$msg->lu ? 'bg-brand-50/20' : 'hover:bg-beige-50/40' }}">
                            {{-- Expéditeur --}}
                            <td class="px-5 py-3">
                                <div class="flex items-center gap-2.5">
                                    <div class="w-8 h-8 rounded-lg {{ !$msg->lu ? 'bg-brand-50' : 'bg-beige-100' }} flex items-center justify-center flex-shrink-0">
                                        <span class="text-[10px] font-bold {{ !$msg->lu ? 'text-brand-600' : 'text-beige-400' }}">{{ strtoupper(mb_substr($msg->nom, 0, 2)) }}</span>
                                    </div>
                                    <div class="min-w-0">
                                        <p class="text-[13px] font-semibold text-dark truncate {{ !$msg->lu ? 'font-bold' : '' }}">{{ $msg->nom }}</p>
                                        <p class="text-[11px] text-beige-400 truncate">{{ $msg->email }}</p>
                                    </div>
                                </div>
                            </td>
                            {{-- Message (tronqué) --}}
                            <td class="px-5 py-3" style="max-width: 300px;">
                                <p class="text-[13px] text-dark-50 truncate {{ !$msg->lu ? 'font-semibold' : '' }}">{{ Str::limit($msg->message, 80) }}</p>
                            </td>
                            {{-- Date --}}
                            <td class="px-5 py-3 text-[13px] text-beige-500 whitespace-nowrap">{{ $msg->created_at->translatedFormat('d M Y à H:i') }}</td>
                            {{-- Statut lu/non-lu --}}
                            <td class="px-5 py-3">
                                @if($msg->lu)
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-md text-[11px] font-semibold bg-emerald-50 text-emerald-700">
                                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-400"></span>Lu
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-md text-[11px] font-semibold bg-amber-50 text-amber-700">
                                        <span class="w-1.5 h-1.5 rounded-full bg-amber-400"></span>Non lu
                                    </span>
                                @endif
                            </td>
                            {{-- Actions --}}
                            <td class="px-5 py-3">
                                <div class="flex items-center justify-end gap-1.5">
                                    {{-- Voir le message --}}
                                    <a href="{{ route('admin.messages.show', $msg) }}"
                                       class="w-7 h-7 rounded-md flex items-center justify-center text-beige-400 hover:text-brand-600 hover:bg-brand-50 transition-all duration-200" title="Lire">
                                        <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
                                    </a>
                                    {{-- Toggle lu/non-lu --}}
                                    <form action="{{ route('admin.messages.toggle', $msg) }}" method="POST">
                                        @csrf @method('PUT')
                                        <button type="submit" title="{{ $msg->lu ? 'Marquer non lu' : 'Marquer lu' }}"
                                            class="w-7 h-7 rounded-md flex items-center justify-center text-beige-400 hover:text-amber-600 hover:bg-amber-50 transition-all duration-200">
                                            <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
                                        </button>
                                    </form>
                                    {{-- Supprimer --}}
                                    <form action="{{ route('admin.messages.destroy', $msg) }}" method="POST" data-confirm="Supprimer ce message ?">
                                        @csrf @method('DELETE')
                                        <button type="submit"
                                            class="w-7 h-7 rounded-md flex items-center justify-center text-beige-400 hover:text-red-600 hover:bg-red-50 transition-all duration-200" title="Supprimer">
                                            <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><polyline points="3 6 5 6 21 6"/><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/></svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-16 text-center">
                                <svg class="w-10 h-10 text-beige-200 mx-auto mb-3" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
                                <p class="text-sm text-beige-400">Aucun message reçu</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($messages->hasPages())
            <div class="px-6 py-4 border-t border-beige-100">
                {{ $messages->links() }}
            </div>
        @endif
    </div>

@endsection