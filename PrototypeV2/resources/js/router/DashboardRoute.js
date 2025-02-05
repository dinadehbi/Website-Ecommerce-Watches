import { createRouter, createWebHistory } from 'vue-router';

// Importe tes composants Vue
import Dashboard from '../components/Dashboard/Content.vue';
import ProductIndex from '../components/Dashboard/ProductIndex.vue';
import ProductEdit from '../components/Dashboard/editProduct.vue';
import NotFound from '../components/404/404.vue';

const routes = [
    { path: '/dashboard/',name: 'Dashboard', component: Dashboard },
    { path: '/dashboard/produits',name: 'Produits', component: ProductIndex },
    { path: '/dashboard/produit/:id/edit', component: ProductEdit },
    { path: '/dashboard/:pathMatch(.*)*',name: 'NotFound', component: NotFound }
];
const router = createRouter({
    history: createWebHistory(),
    routes,
});

export default router;
