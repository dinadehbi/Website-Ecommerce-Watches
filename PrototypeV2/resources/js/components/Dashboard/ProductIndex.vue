<script setup>
import { ref, onMounted } from "vue";
import axios from "axios";


const products = ref([]);
const loading = ref(true);
const error = ref(null);


// les champs de produit
const title = ref("");
const price = ref("");
const stock = ref("");
const content = ref("");
const messageAddProduct = ref(null);
const errorAddProduct = ref(null);

// ajouter produit ...
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
    getElements();
    getPages();

  } catch (err) {
    // errorAddProduct.value = "Erreur lors de l'ajout du produit.";
    errorAddProduct.value = err.response.data.errors;
    // console.error(err.response.data.errors);
    // console.error(err.response.data.errors.title);
  }
};

// Supprimer produit ...
const DeleteProduct = async (productId) => {
    try {

        const response = await axios.delete(`http://127.0.0.1:8000/products/${productId}`);
        products.value = products.value.filter(product => product.id !== productId);
        getElements();
        getPages();
        console.log(response.data.message);

    } catch (error) {
        console.error("Erreur lors de la suppression du produit :", err);
    }

}


const fetchProducts = async () => {
  try {
    const response = await axios.get("http://127.0.0.1:8000/products");
    products.value = response.data;
    getElements();
    getPages();
  } catch (err) {
    error.value = "Erreur lors du chargement des produits";
    console.error(err);
  } finally {
    loading.value = false;
  }
};
onMounted(fetchProducts);



//pagination

    const currentPage = ref(1);
    const itemsPerPage = 3;
    const paginatedProducts = ref([]);
    const totalPages = ref(1);
    const getElements = () =>{
        const start = (currentPage.value - 1) * itemsPerPage;
        const end = start + itemsPerPage;
        paginatedProducts.value = products.value.slice(start, end);
    }
    const getPages = () =>{
        totalPages.value = Math.ceil(products.value.length / itemsPerPage)
    }
    const nextPage = () => {
    if (currentPage.value < totalPages.value)
    {
        currentPage.value++;
        getElements();
    }
    };
    const prevPage = () => {
    if (currentPage.value > 1){
        currentPage.value--;
        getElements();
    }
    };
    const ChangecurrentPage= (value)=>
    {
        if(value>0 && value <= totalPages.value){
            currentPage.value = value
            getElements();
        }
    }



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
                                        <tr v-for="product in paginatedProducts" :key="product.id">
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
                                                <button @click="DeleteProduct(product.id)" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div v-if="totalPages > 1" class="d-flex justify-content-center" style="gap: 10px; padding: 5px;">
                    <button @click="prevPage" :disabled="currentPage === 1" style="border: none;padding:0">
                        <i class="fas fa-angle-double-left"></i>
                    </button>
                    <div v-if="totalPages < 4" class="d-flex justify-content-center" style="gap:10px;" >
                        <button v-for="n in totalPages" :key="n" @click="ChangecurrentPage(n)"
                        :class="'btn btn-outline-primary ' + (n === currentPage ? 'active' : '')" >{{ n }}</button>
                    </div>
                    <div v-else class="d-flex justify-content-center" style="gap:10px;">
                        <button  @click="ChangecurrentPage(1)"
                        :class="'btn btn-outline-primary ' + (currentPage === 1 ? 'active' : '')" >{{ 1 }}</button>
                        <button v-if="!([1, totalPages,2].includes(currentPage))"
                        class="btn btn-outline-primary " >...</button>
                        <button v-if="!([1, totalPages].includes(currentPage))"
                        class="btn btn-outline-primary active" >{{ currentPage }}</button>
                        <button v-if="!([totalPages-1].includes(currentPage))"
                        class="btn btn-outline-primary " >...</button>
                        <button  @click="ChangecurrentPage(totalPages)"
                        :class="'btn btn-outline-primary ' + (currentPage === totalPages ? 'active' : '')" >{{ totalPages }}</button>
                    </div>
                    <!-- <span @click="ChangecurrentPage(2)"> Page {{ currentPage }} / {{ totalPages }} </span> -->
                    <button @click="nextPage" :disabled="currentPage === totalPages" style="border: none;padding:0">
                        <i class="fas fa-angle-double-right"></i>
                    </button>
                </div>
            </div>
        </section>
    </div>
</template>

