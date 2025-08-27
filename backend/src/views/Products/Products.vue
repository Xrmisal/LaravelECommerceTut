<script setup>
import { computed, onMounted, ref } from 'vue';
import store from '../../store';
import ProductModel from './ProductModel.vue';
import ProductsTable from './ProductsTable.vue';

const products = computed(() => store.state.products)

const DEFAULT_PRODUCT = {
    id: '',
    title: '',
    description: '',
    image: '',
    price: ''
}

const productModel = ref({...DEFAULT_PRODUCT})

const showProductModel = ref(false)

function showAddNewModel() {
    showProductModel.value = true
}

function editProduct(p) {
    store.dispatch('getProduct', p.id)
        .then(({data}) => {
            productModel.value = data
            showAddNewModel()
        })
}

function onModelClose() {
    productModel.value = {...DEFAULT_PRODUCT}
}

</script>

<template>
    <div class="flex items-center justify-between mb-3">
        <h1 class="text-3xl font-semibold text-gray-300">Products</h1>
        <button
            type="button"
            @click="showAddNewModel()"
            class="py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
        >
            Add new Product
        </button>
    </div>
    <ProductsTable @clickEdit="editProduct"/>
    <ProductModel v-model="showProductModel" :product="productModel" @close="onModelClose" />
</template>