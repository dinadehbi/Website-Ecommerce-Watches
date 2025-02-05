<script setup>
import { ref, onMounted } from "vue";
import axios from "axios";


const products = ref([]); // Etat ...
const loading = ref(true);
const error = ref(null);


// les champs de produit....
const title = ref("");
const price = ref("");
const stock = ref("");
const content = ref("");
const messageAddProduct = ref(null);
const errorAddProduct = ref(null);

// ajouter produit........//..
const addProduct = async () => {
    messageAddProduct.value = null;
    errorAddProduct.value = null;

  try {
    const response = await axios.post("http://127.0.0.1:8000/products", {
      title: title.value,
      price: price.value,
      stock: stock.value,
      content: content.value,
    });

    messageAddProduct.value = response.data.message;
    title.value = "";
    price.value = "";
    stock.value = "";
    content.value = "";
    products.value.push(response.data.product);


  } catch (err) {
    // errorAddProduct.value = "Erreur lors de l'ajout du produit.";
    errorAddProduct.value = err.response.data.errors;
    // console.error(err.response.data.errors);
    // console.error(err.response.data.errors.title);
  }
};


const fetchProducts = async () => {
  try {
    const response = await axios.get("http://127.0.0.1:8000/products");
    products.value = response.data;
  } catch (err) {
    error.value = "Erreur lors du chargement des produits";
    console.error(err);
  } finally {
    loading.value = false;
  }
};
onMounted(fetchProducts);


// -------------------//
</script>

<template>
    <!-- Modal  -->
    <div class="modal fade" id="AddProductModel" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalLabel">Ajouter un Produit</h1>
            <button type="button" style="background-color: none;border:none" data-bs-dismiss="modal" aria-label="Close"><i class="fas fa-times"></i></button>
            </div>
            <div class="modal-body">
                <form @submit.prevent="addProduct">
                    <div id="Errors">
                    </div>
                    <div class="form-group">
                        <label for="nom">Nom du Produit :</label>
                        <input type="text" v-model="title" id="nom" class="form-control" placeholder="Entrez le nom du produit" >
                    </div>
                    <div class="form-group">
                        <label for="prix">Prix :</label>
                        <input type="number" v-model="price" id="prix" class="form-control" placeholder="Entrez le prix" step="0.01" required>
                    </div>
                    <div class="form-group">
                        <label for="stock">Stock :</label>
                        <input type="number" v-model="stock" id="stock" class="form-control" placeholder="Entrez la quantité en stock" >
                    </div>
                    <div class="form-group">
                        <label for="description">Description :</label>
                        <textarea v-model="content" id="description" class="form-control" placeholder="Entrez une description du produit"></textarea>
                    </div>
                    <p v-if="messageAddProduct" style="color: green;">{{ messageAddProduct }}</p>
                    <!-- <p v-if="errorAddProduct"  class="text-danger">{{ errorAddProduct }}</p> -->
                    <p v-for="error in errorAddProduct"  class="text-danger">{{ error[0]     }}</p>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary btn-flat" id="add_product">
                            <i class="fas fa-lg fa-save"></i>Ajouter
                        </button>
                    </div>
                </form>
            </div>
        </div>
        </div>
    </div>
<!-- table des produits -->
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div style="display: flex; justify-content: space-between; align-items: center;">
                    <h1>Les Produits</h1>
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#AddProductModel">
                    <i class="fas fa-plus"></i>Ajouter un produit
                </button>
                </div>
            </div>
        </section>
        <section class="content">
            <div class="container-fluid">
                <div class="row" style="height:310px">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Liste des Produits</h3>
                            </div>
                            <div class="card-body">
                                <div v-if="loading" class="d-flex justify-content-center align-items-center" >
                                    <div class="spinner-border text-primary" role="status">
                                </div>
                                </div>
                                <div v-else-if="error">{{ error }}</div>
                                <table v-else class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th style="width: 5%">id</th>
                                            <th style="width: 40%">Titre</th>
                                            <th style="width: 20%">Prix</th>
                                            <th style="width: 20%">Stock</th>
                                            <th style="width: 15%">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="product in products" :key="product.id">
                                            <td>{{ product.id }}</td>
                                            <td>{{ product.title }}</td>
                                            <td>{{ product.price }} €</td>
                                            <td>{{ product.stock }}</td>
                                            <td class="d-flex" style="gap: 5px;">
                                                <a href="#" class="btn btn-info btn-sm"><i class="fas fa-eye"></i></a>
                                                <!-- <a href="#" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i></a> -->
                                                <router-link :to="`/dashboard/produit/${product.id}/edit`" class="btn btn-warning btn-sm">
                                                    <i class="fas fa-edit"></i>
                                                </router-link>
                                                <button  class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</template>

