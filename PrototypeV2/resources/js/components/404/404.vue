<template>
    <div class="not-found">
      <h1>404 - Page non trouvée</h1>
      <p>Oups ! La page que vous recherchez n'existe pas.</p>
      <router-link to="/dashboard">Retour à l'accueil</router-link>
    </div>
  </template>

  <style scoped>
  .not-found {
    text-align: center;
    margin-top: 50px;
  }
  </style>
