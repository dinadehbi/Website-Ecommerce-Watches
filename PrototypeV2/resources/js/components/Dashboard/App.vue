<script setup>
import { useRoute } from 'vue-router';
const route = useRoute();
import navBar from './nav.vue';
import NavBarLinks from './NavBarLinks.vue';
import Footer from './Footer.vue';

</script>

<template>
    <navBar v-if="route.name !== 'NotFound'"></navBar>
    <NavBarLinks v-if="route.name !== 'NotFound'"></NavBarLinks>
    <router-view></router-view>
    <Footer v-if="route.name !== 'NotFound'"></Footer>
</template>


