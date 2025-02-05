<script setup>

import { ref, onMounted } from "vue";
import axios from "axios";
import { useRoute, useRouter } from 'vue-router';
const route = useRoute();
const router = useRouter();

// get product api
const product = ref({
    title:'',
    price:'',
    stock:'',
    content:'',
})
const loading = ref(true);
const erroreditProduct = ref(null);




onMounted(async () => {
    try {
      const response = await axios.get(`http://127.0.0.1:8000/products/${route.params.id}`)
      product.value = response.data.product;

        }
    catch (error) {
            router.push('/dashboard/produit');
        }
    finally {
    loading.value = false;
  }
});


const updateProduct = async () => {

  try {
    const response = await axios.put(`http://127.0.0.1:8000/products/${route.params.id}`, {
      title: product.value.title,
      price: product.value.price,
      stock: product.value.stock,
      content: product.value.content,
    });
    router.push('/dashboard/produits');

  } catch (err) {
    // erroreditProduct.value = "Erreur lors de l'ajout du produit.";
    erroreditProduct.value = err.response.data.errors;
    // console.error(err.response.data.errors);
    // console.error(err.response.data.errors.title);
  }
};



</script>

<template>
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div>
                    <h1>Modifier le produit</h1>
                </div>
            </div>
        </section>
        <section class="content">
            <div class="container-fluid w-75">
                <div v-if="loading" class="d-flex justify-content-center align-items-center" style="height: 200px;">
                    <div class="spinner-border text-primary" role="status"></div>
                </div>
                <form @submit.prevent="updateProduct" v-else>
                    <div class="form-group">
                        <label for="nom">Nom du Produit :</label>
                        <input type="text" v-model="product.title" id="nom" class="form-control" placeholder="Entrez le nom du produit" required>
                    </div>
                    <div class="form-group">
                        <label for="prix">Prix :</label>
                        <input type="number" v-model="product.price" id="prix" class="form-control" placeholder="Entrez le prix" step="0.01" required>
                    </div>
                    <div class="form-group">
                        <label for="stock">Stock :</label>
                        <input type="number" v-model="product.stock" id="stock" class="form-control" placeholder="Entrez la quantité en stock" required>
                    </div>
                    <div class="form-group">
                        <label for="description">Description :</label>
                        <textarea v-model="product.content" id="description" class="form-control" placeholder="Entrez une description du produit"></textarea>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-warning" id="add_product">
                            <i class="fas fa-edit"></i>Modifier
                        </button>
                    </div>
                    <div>
                        <p v-for="error in erroreditProduct"  class="text-danger">{{ error[0]     }}</p>
                    </div>
                </form>
            </div>
        </section>
        </div>
    <!-- <h1>Edit page</h1> -->


</template>
