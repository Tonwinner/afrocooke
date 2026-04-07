import './bootstrap';

/* ═══ Alpine.js (conservé pour les micro-interactions Blade) ═══ */
import Alpine from 'alpinejs';
window.Alpine = Alpine;
Alpine.start();

/* ═══ Vue 3 + PrimeVue ═══ */
import { createApp } from 'vue';
import PrimeVue from 'primevue/config';
import 'primeicons/primeicons.css';

/*
 * Rendre createApp disponible globalement.
 * Chaque page Blade pourra monter ses propres composants Vue
 * en appelant window.createVueApp() dans un <script>.
 */
window.Vue = { createApp };
window.PrimeVue = PrimeVue;

/*
 * Import des composants PrimeVue utilisés dans le projet.
 * On les rend disponibles globalement pour les pages Blade.
 */
import DatePicker from 'primevue/datepicker';
import Select from 'primevue/select';
import InputText from 'primevue/inputtext';
import Button from 'primevue/button';
import Dialog from 'primevue/dialog';
import Toast from 'primevue/toast';
import ToastService from 'primevue/toastservice';
import DataTable from 'primevue/datatable';
import Column from 'primevue/column';
import Tag from 'primevue/tag';
import InputNumber from 'primevue/inputnumber';

window.PrimeComponents = {
    DatePicker,
    Select,
    InputText,
    Button,
    Dialog,
    Toast,
    DataTable,
    Column,
    Tag,
    InputNumber,
    ToastService,
};

/* ═══ Composants Vue pour les pages Blade ═══ */
import AtelierFilters from './components/AtelierFilters.vue';
window.VueComponents = {
    AtelierFilters,
};