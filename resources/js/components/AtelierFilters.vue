<template>
    <div class="bg-white rounded-2xl p-5 sm:p-6 border border-beige-200/60 -mt-14 relative z-20 shadow-xl shadow-dark/5 mb-10">
        <div class="flex flex-wrap items-end gap-4">

            <!-- Select Pays -->
            <div class="flex-1 min-w-[180px]">
                <label class="block text-[11px] font-bold uppercase tracking-[1.5px] text-[#bfab93] mb-2">Pays d'origine</label>
                <div class="relative" ref="paysDropdown">
                    <button type="button" @click="togglePays"
                        class="w-full flex items-center justify-between px-4 py-3 rounded-xl border border-[#e6ddd0] bg-[#faf8f4] text-[14px] text-[#15302a] cursor-pointer hover:border-[#1a9e7a]/30 focus:outline-none focus:border-[#1a9e7a] focus:ring-2 focus:ring-[#1a9e7a]/10 transition-all duration-200">
                        <span class="flex items-center gap-2.5">
                            <img v-if="selectedPaysIso" :src="'https://flagcdn.com/w20/' + selectedPaysIso + '.png'" class="w-5 h-3.5 rounded-sm object-cover">
                            <svg v-else class="w-4 h-4 text-[#bfab93]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><circle cx="12" cy="12" r="10"/><path d="M2 12h20"/></svg>
                            <span :class="selectedPays ? 'text-[#15302a]' : 'text-[#bfab93]'">{{ selectedPays || 'Tous les pays' }}</span>
                        </span>
                        <svg class="w-4 h-4 text-[#bfab93] transition-transform duration-200" :class="{ 'rotate-180': paysOpen }" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="6 9 12 15 18 9"/></svg>
                    </button>

                    <!-- Dropdown pays -->
                    <transition name="dropdown">
                        <div v-if="paysOpen" class="absolute top-full left-0 right-0 mt-2 bg-white rounded-xl border border-[#e6ddd0]/60 shadow-xl z-50 overflow-hidden">
                            <div class="px-3 py-2.5 border-b border-[#f2ede4]">
                                <input type="text" v-model="paysSearch" placeholder="Rechercher un pays..." ref="paysSearchInput"
                                    class="w-full px-3 py-2 rounded-lg border border-[#e6ddd0] bg-[#faf8f4] text-[13px] placeholder:text-[#bfab93] focus:outline-none focus:border-[#1a9e7a] transition duration-200">
                            </div>
                            <div class="max-h-56 overflow-y-auto py-1.5">
                                <div @click="selectPays('')"
                                    class="flex items-center gap-3 px-4 py-2.5 text-[13px] cursor-pointer hover:bg-[#faf8f4] transition-colors"
                                    :class="!selectedPays ? 'bg-[#edfbf6] text-[#1a9e7a] font-semibold' : 'text-[#15302a]'">
                                    <svg class="w-4 h-4 text-[#bfab93]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><circle cx="12" cy="12" r="10"/><path d="M2 12h20"/></svg>
                                    Tous les pays
                                </div>
                                <div v-for="p in filteredPays" :key="p.name" @click="selectPays(p.name)"
                                    class="flex items-center gap-3 px-4 py-2.5 text-[13px] cursor-pointer hover:bg-[#faf8f4] transition-colors"
                                    :class="selectedPays === p.name ? 'bg-[#edfbf6] text-[#1a9e7a] font-semibold' : 'text-[#15302a]'">
                                    <img :src="'https://flagcdn.com/w20/' + p.iso + '.png'" class="w-5 h-3.5 rounded-sm object-cover">
                                    {{ p.name }}
                                </div>
                            </div>
                        </div>
                    </transition>
                </div>
            </div>

            <!-- Recherche plat -->
            <div class="flex-1 min-w-[180px]">
                <label class="block text-[11px] font-bold uppercase tracking-[1.5px] text-[#bfab93] mb-2">Rechercher un plat</label>
                <div class="relative">
                    <svg class="absolute left-3.5 top-1/2 -translate-y-1/2 w-4 h-4 text-[#bfab93] pointer-events-none" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
                    <input type="text" v-model="searchPlat" placeholder="Ex: Jollof, Poulet..."
                        class="w-full pl-10 pr-4 py-3 rounded-xl border border-[#e6ddd0] bg-[#faf8f4] text-[14px] text-[#15302a] placeholder:text-[#bfab93] focus:outline-none focus:border-[#1a9e7a] focus:ring-2 focus:ring-[#1a9e7a]/10 focus:bg-white transition-all duration-200">
                </div>
            </div>

            <!-- Prix max -->
            <div class="flex-1 min-w-[150px]">
                <label class="block text-[11px] font-bold uppercase tracking-[1.5px] text-[#bfab93] mb-2">Prix maximum</label>
                <div class="relative">
                    <svg class="absolute left-3.5 top-1/2 -translate-y-1/2 w-4 h-4 text-[#bfab93] pointer-events-none" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><line x1="12" y1="1" x2="12" y2="23"/><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"/></svg>
                    <input type="text" v-model="prixMax" placeholder="Ex: 20 000 FCFA"
                        class="w-full pl-10 pr-4 py-3 rounded-xl border border-[#e6ddd0] bg-[#faf8f4] text-[14px] text-[#15302a] placeholder:text-[#bfab93] focus:outline-none focus:border-[#1a9e7a] focus:ring-2 focus:ring-[#1a9e7a]/10 focus:bg-white transition-all duration-200">
                </div>
            </div>

            <!-- Boutons -->
            <div class="flex gap-2">
                <button @click="applyFilters" class="flex items-center gap-2 px-6 py-3 bg-[#1a9e7a] hover:bg-[#148063] text-white text-[14px] font-semibold rounded-xl transition-all duration-200 hover:shadow-md hover:shadow-[#1a9e7a]/20 active:scale-[0.98]">
                    <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
                    Rechercher
                </button>
                <button @click="resetFilters" class="flex items-center gap-2 px-5 py-3 text-[14px] font-semibold text-[#a89278] hover:text-[#15302a] rounded-xl border border-[#e6ddd0] hover:border-[#d4c7b3] transition-all duration-200">
                    <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><polyline points="23 4 23 10 17 10"/><path d="M20.49 15a9 9 0 1 1-2.12-9.36L23 10"/></svg>
                    Réinitialiser
                </button>
            </div>
        </div>

        <!-- Résultats compteur -->
        <div v-if="totalResults !== null" class="mt-4 pt-4 border-t border-[#f2ede4]">
            <p class="text-[13px] text-[#a89278]">
                <span class="font-semibold text-[#15302a]">{{ totalResults }}</span> atelier{{ totalResults > 1 ? 's' : '' }} trouvé{{ totalResults > 1 ? 's' : '' }}
            </p>
        </div>
    </div>
</template>

<script>
import { ref, computed, onMounted, onBeforeUnmount, nextTick } from 'vue';

export default {
    name: 'AtelierFilters',
    props: {
        pays: { type: Array, default: () => [] },
        initialPays: { type: String, default: '' },
        initialPlat: { type: String, default: '' },
        initialPrixMax: { type: String, default: '' },
        totalResults: { type: Number, default: null },
    },
    setup(props) {
        const drapeaux = {
            'Bénin': 'bj', 'Sénégal': 'sn', 'Cameroun': 'cm', 'Togo': 'tg',
            'Nigeria': 'ng', 'Ghana': 'gh', "Côte d'Ivoire": 'ci', 'Mali': 'ml',
            'Niger': 'ne', 'Guinée': 'gn', 'Gabon': 'ga', 'Congo': 'cg',
            'Maroc': 'ma', 'Tunisie': 'tn', 'Algérie': 'dz',
        };

        const paysOpen = ref(false);
        const paysSearch = ref('');
        const selectedPays = ref(props.initialPays);
        const searchPlat = ref(props.initialPlat);
        const prixMax = ref(props.initialPrixMax);
        const paysDropdown = ref(null);
        const paysSearchInput = ref(null);

        const paysList = computed(() => {
            return props.pays.map(name => ({
                name,
                iso: drapeaux[name] || null,
            }));
        });

        const filteredPays = computed(() => {
            const term = paysSearch.value.toLowerCase();
            if (!term) return paysList.value;
            return paysList.value.filter(p => p.name.toLowerCase().includes(term));
        });

        const selectedPaysIso = computed(() => {
            return selectedPays.value ? (drapeaux[selectedPays.value] || null) : null;
        });

        function togglePays() {
            paysOpen.value = !paysOpen.value;
            if (paysOpen.value) {
                paysSearch.value = '';
                nextTick(() => {
                    if (paysSearchInput.value) paysSearchInput.value.focus();
                });
            }
        }

        function selectPays(name) {
            selectedPays.value = name;
            paysOpen.value = false;
        }

        function applyFilters() {
            const params = new URLSearchParams();
            if (selectedPays.value) params.set('pays', selectedPays.value);
            if (searchPlat.value) params.set('plat', searchPlat.value);
            if (prixMax.value) params.set('prix_max', prixMax.value.replace(/\s/g, ''));
            window.location.href = window.location.pathname + '?' + params.toString();
        }

        function resetFilters() {
            window.location.href = window.location.pathname;
        }

        // Fermer dropdown au clic extérieur
        function handleClickOutside(e) {
            if (paysDropdown.value && !paysDropdown.value.contains(e.target)) {
                paysOpen.value = false;
            }
        }

        // Fermer avec Echap
        function handleEscape(e) {
            if (e.key === 'Escape') paysOpen.value = false;
        }

        onMounted(() => {
            document.addEventListener('click', handleClickOutside);
            document.addEventListener('keydown', handleEscape);
        });

        onBeforeUnmount(() => {
            document.removeEventListener('click', handleClickOutside);
            document.removeEventListener('keydown', handleEscape);
        });

        return {
            paysOpen, paysSearch, selectedPays, searchPlat, prixMax,
            filteredPays, selectedPaysIso, paysDropdown, paysSearchInput,
            togglePays, selectPays, applyFilters, resetFilters,
        };
    },
};
</script>

<style scoped>
.dropdown-enter-active, .dropdown-leave-active {
    transition: opacity 0.15s ease, transform 0.15s ease;
}
.dropdown-enter-from, .dropdown-leave-to {
    opacity: 0;
    transform: translateY(-4px);
}
</style>