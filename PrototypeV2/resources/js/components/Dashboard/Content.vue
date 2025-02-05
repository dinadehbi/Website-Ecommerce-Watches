<script setup>
import { ref, onMounted } from "vue";
import axios from "axios";
const products = ref(0);
const loading = ref(true);
const error = ref(null);
const fetchProducts = async () => {
  try {
    const response = await axios.get("http://127.0.0.1:8000/products");
    products.value = response.data.length
  } catch (err) {
    error.value = "Erreur lors du chargement des produits";
    console.error(err);
  } finally {
    loading.value = false;
  }
};
onMounted(fetchProducts);

</script>

<template>
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <h1>Bienvenue sur le Dashboard</h1>
            </div>
        </section>
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <!-- Carte Statistique -->
                    <div class="col-lg-3 col-6">
                        <div class="small-box bg-info">
                            <div class="inner">
                                <h3>150</h3>
                                <p>Nouveaux Utilisateurs</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-user"></i>
                            </div>
                            <a href="#" class="small-box-footer">Plus d'infos <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>

                    <div class="col-lg-3 col-6">
                        <div class="small-box bg-success">
                            <div class="inner">
                                <h3 v-if="loading">
                                    <i  class="fa fa-spinner spinerAnimation" aria-hidden="true"></i>
                                </h3>
                                <h3 v-else>{{ products }}</h3>
                                <p>Produits</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-box"></i>
                            </div>
                            <a href="#" class="small-box-footer">Plus d'infos <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>

                    <div class="col-lg-3 col-6">
                        <div class="small-box bg-warning">
                            <div class="inner">
                                <h3>44</h3>
                                <p>Messages non lus</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-envelope"></i>
                            </div>
                            <a href="#" class="small-box-footer">Plus d'infos <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</template>


<style scoped>

.spinerAnimation
{
    animation: spin 1.5s linear infinite;
}
@keyframes spin {
  0% {
    transform: rotate(0deg);
  }
  100% {
    transform: rotate(360deg);
  }
}


</style>

