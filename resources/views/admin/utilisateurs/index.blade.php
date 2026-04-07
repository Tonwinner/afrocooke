
@extends('layouts.admin')
@section('page-title', 'Gestion des Utilisateurs')

@section('content')

    {{-- Filtres --}}
    <div class="bg-white rounded-xl border border-beige-200/60 p-5 mb-5">
        <form action="{{ route('admin.utilisateurs.index') }}" method="GET" class="flex flex-wrap items-end gap-4">
            <div class="flex-1 min-w-[150px]">
                <label class="block text-[12px] font-semibold text-dark-50 mb-1.5">Rôle</label>
                <select name="role"
                    class="w-full px-3 py-2.5 rounded-lg border border-beige-300 bg-white text-sm text-dark focus:outline-none focus:border-brand-500 focus:ring-2 focus:ring-brand-500/10 transition duration-200">
                    <option value="">Tous les rôles</option>
                    <option value="admin" {{ request('role') == 'admin' ? 'selected' : '' }}>Administrateur</option>
                    <option value="chef" {{ request('role') == 'chef' ? 'selected' : '' }}>Chef cuisinier</option>
                    <option value="logistique" {{ request('role') == 'logistique' ? 'selected' : '' }}>Logistique</option>
                    <option value="client" {{ request('role') == 'client' ? 'selected' : '' }}>Client</option>
                </select>
            </div>
            <div class="flex-1 min-w-[200px]">
                <label class="block text-[12px] font-semibold text-dark-50 mb-1.5">Rechercher</label>
                <input type="text" name="recherche" value="{{ request('recherche') }}" placeholder="Nom ou email..."
                    class="w-full px-3 py-2.5 rounded-lg border border-beige-300 bg-white text-sm text-dark placeholder:text-beige-400 focus:outline-none focus:border-brand-500 focus:ring-2 focus:ring-brand-500/10 transition duration-200">
            </div>
            <div class="flex gap-2">
                <button type="submit"
                    class="flex items-center gap-2 px-4 py-2.5 bg-brand-500 hover:bg-brand-600 text-white text-[13px] font-semibold rounded-lg transition-all duration-200">
                    <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polygon points="22 3 2 3 10 12.46 10 19 14 21 14 12.46 22 3"/></svg>
                    Filtrer
                </button>
                <a href="{{ route('admin.utilisateurs.index') }}"
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
                <div class="w-9 h-9 rounded-lg bg-blue-50 flex items-center justify-center">
                    <svg class="w-4 h-4 text-blue-600" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/>
                        <path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/>
                    </svg>
                </div>
                <div>
                    <h2 class="text-[15px] font-bold text-dark">Utilisateurs</h2>
                    <p class="text-[11px] text-beige-400">{{ $utilisateurs->total() }} compte{{ $utilisateurs->total() > 1 ? 's' : '' }}</p>
                </div>
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr>
                        <th class="px-5 py-3 text-left text-[10px] font-bold uppercase tracking-widest text-beige-400 bg-beige-50/50">Utilisateur</th>
                        <th class="px-5 py-3 text-left text-[10px] font-bold uppercase tracking-widest text-beige-400 bg-beige-50/50">Email</th>
                        <th class="px-5 py-3 text-left text-[10px] font-bold uppercase tracking-widest text-beige-400 bg-beige-50/50">Téléphone</th>
                        <th class="px-5 py-3 text-left text-[10px] font-bold uppercase tracking-widest text-beige-400 bg-beige-50/50">Rôle</th>
                        <th class="px-5 py-3 text-left text-[10px] font-bold uppercase tracking-widest text-beige-400 bg-beige-50/50">Inscrit le</th>
                        <th class="px-5 py-3 text-right text-[10px] font-bold uppercase tracking-widest text-beige-400 bg-beige-50/50">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($utilisateurs as $utilisateur)
                        <tr class="border-b border-beige-50 hover:bg-beige-50/40 transition-colors duration-100">
                            {{-- Avatar + nom --}}
                            <td class="px-5 py-3">
                                <div class="flex items-center gap-3">
                                    <div class="w-8 h-8 rounded-lg flex items-center justify-center flex-shrink-0
                                        {{ $utilisateur->role === 'admin' ? 'bg-red-50' : ($utilisateur->role === 'chef' ? 'bg-amber-50' : ($utilisateur->role === 'logistique' ? 'bg-blue-50' : 'bg-brand-50')) }}">
                                        <span class="text-[10px] font-bold
                                            {{ $utilisateur->role === 'admin' ? 'text-red-600' : ($utilisateur->role === 'chef' ? 'text-amber-600' : ($utilisateur->role === 'logistique' ? 'text-blue-600' : 'text-brand-600')) }}">
                                            {{ strtoupper(mb_substr($utilisateur->name, 0, 2)) }}
                                        </span>
                                    </div>
                                    <div class="min-w-0">
                                        <p class="text-[13px] font-semibold text-dark truncate">{{ $utilisateur->name }}</p>
                                        <p class="text-[11px] text-beige-400 font-mono">#{{ $utilisateur->id }}</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-5 py-3 text-[13px] text-dark-50">{{ $utilisateur->email }}</td>
                            <td class="px-5 py-3 text-[13px] text-beige-500">{{ $utilisateur->telephone ?? '—' }}</td>
                            {{-- Badge rôle --}}
                            <td class="px-5 py-3">
                                @switch($utilisateur->role)
                                    @case('admin')
                                        <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-md text-[11px] font-semibold bg-red-50 text-red-700">
                                            <svg class="w-3 h-3" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
                                            Admin
                                        </span>
                                        @break
                                    @case('chef')
                                        <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-md text-[11px] font-semibold bg-amber-50 text-amber-700">
                                            <svg class="w-3 h-3" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 8h1a4 4 0 0 1 0 8h-1"/><path d="M2 8h16v9a4 4 0 0 1-4 4H6a4 4 0 0 1-4-4V8z"/></svg>
                                            Chef
                                        </span>
                                        @break
                                    @case('logistique')
                                        <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-md text-[11px] font-semibold bg-blue-50 text-blue-700">
                                            <svg class="w-3 h-3" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"/><line x1="3" y1="6" x2="21" y2="6"/></svg>
                                            Logistique
                                        </span>
                                        @break
                                    @case('client')
                                        <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-md text-[11px] font-semibold bg-emerald-50 text-emerald-700">
                                            <svg class="w-3 h-3" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                                            Client
                                        </span>
                                        @break
                                @endswitch
                            </td>
                            <td class="px-5 py-3 text-[13px] text-beige-500 whitespace-nowrap">{{ $utilisateur->created_at->translatedFormat('d M Y') }}</td>
                            {{-- Actions --}}
                            <td class="px-5 py-3">
                                <div class="flex items-center justify-end gap-2">
                                    {{-- Changement de rôle --}}
                                    <form action="{{ route('admin.utilisateurs.update', $utilisateur) }}" method="POST" class="flex items-center gap-1.5">
                                        @csrf
                                        @method('PUT')
                                        <input type="hidden" name="name" value="{{ $utilisateur->name }}">
                                        <input type="hidden" name="email" value="{{ $utilisateur->email }}">
                                        <select name="role"
                                            class="w-28 px-2 py-1.5 rounded-md border border-beige-300 bg-white text-[12px] text-dark focus:outline-none focus:border-brand-500 transition duration-200 cursor-pointer">
                                            <option value="client" {{ $utilisateur->role == 'client' ? 'selected' : '' }}>Client</option>
                                            <option value="chef" {{ $utilisateur->role == 'chef' ? 'selected' : '' }}>Chef</option>
                                            <option value="logistique" {{ $utilisateur->role == 'logistique' ? 'selected' : '' }}>Logistique</option>
                                            <option value="admin" {{ $utilisateur->role == 'admin' ? 'selected' : '' }}>Admin</option>
                                        </select>
                                        <button type="submit"
                                            class="w-7 h-7 rounded-md flex items-center justify-center bg-brand-50 text-brand-600 hover:bg-brand-500 hover:text-white transition-all duration-200" title="Valider">
                                            <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg>
                                        </button>
                                    </form>
                                    {{-- Supprimer (pas soi-même) --}}
                                    @if($utilisateur->id !== auth()->id())
                                        <form action="{{ route('admin.utilisateurs.destroy', $utilisateur) }}" method="POST" data-confirm="Supprimer cet utilisateur ? Cette action est irréversible.">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="w-7 h-7 rounded-md flex items-center justify-center text-beige-400 hover:text-red-600 hover:bg-red-50 transition-all duration-200" title="Supprimer">
                                                <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                                                    <polyline points="3 6 5 6 21 6"/><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/>
                                                    <line x1="10" y1="11" x2="10" y2="17"/><line x1="14" y1="11" x2="14" y2="17"/>
                                                </svg>
                                            </button>
                                        </form>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-16 text-center">
                                <svg class="w-10 h-10 text-beige-200 mx-auto mb-3" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                                    <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/>
                                </svg>
                                <p class="text-sm text-beige-400">Aucun utilisateur trouvé</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($utilisateurs->hasPages())
            <div class="px-6 py-4 border-t border-beige-100">
                {{ $utilisateurs->links() }}
            </div>
        @endif
    </div>

@endsection