<template>
    <div>
        <nav>
            <router-link to="/">Accueil</router-link> |
            <router-link to="/about">À Propos</router-link>
        </nav>
        <router-view></router-view>
    </div>
</template>

<style>
nav a {
    margin: 10px;
    text-decoration: none;
    font-weight: bold;
}
</style>
