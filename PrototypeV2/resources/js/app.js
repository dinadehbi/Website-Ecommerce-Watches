import 'admin-lte/plugins/jquery/jquery.min.js';
import 'admin-lte/plugins/bootstrap/js/bootstrap.bundle.min.js';
import 'admin-lte/dist/js/adminlte.min.js';

// Importer les styles d'AdminLTE
import 'admin-lte/dist/css/adminlte.min.css';
import 'admin-lte/plugins/fontawesome-free/css/all.min.css';



import './bootstrap';
import App from './components/App.vue';
import { createApp } from 'vue';
import router from './router';


const app = createApp(App);

app.use(router);

app.mount('#app');
