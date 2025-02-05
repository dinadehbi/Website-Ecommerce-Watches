<script setup>
    import { computed } from 'vue';
    import { useRoute } from 'vue-router';
    const route = useRoute();
    const dashboardClass = (link) =>
            {
            if (route.path === link)
                return 'active'
            else
                return ""
            };

</script>

<template>
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <a href="#" class="brand-link">
            <span class="brand-text font-weight-light">AdminLTE</span>
        </a>
        <div class="sidebar">
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu">
                    <li class="nav-item">
                        <router-link to="/dashboard" :class=" 'nav-link ' + dashboardClass('/dashboard')">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>Dashboard</p>
                        </router-link>
                    </li>
                    <li class="nav-item">
                        <router-link to="/dashboard/produits" :class=" 'nav-link ' + dashboardClass('/dashboard/produits')">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>Produits</p>
                        </router-link>
                    </li>
                </ul>
            </nav>
        </div>
    </aside>
</template>



