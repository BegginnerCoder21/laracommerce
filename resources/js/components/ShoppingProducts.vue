<script setup>

import  ShoppingList from "@/components/ShoppingList.vue";
import {computed, onMounted, ref} from "vue";
import useProduct from "@/composables/products";
import emitter from 'tiny-emitter/instance';
const total = ref(0)

const {
    cartCount,
    getProducts,
    shoppingProducts,
    totalPrice
} = useProduct();

const cartIsNotEmpty = ref(false);

emitter.on('totalPriceUpdated', (count) => {
  total.value = count
  console.log(total.value);
});


onMounted(async () => {
   await getProducts();
   if (cartCount.value !== 0){
       cartIsNotEmpty.value = true;
   }
});
</script>

<template>

  <body>
  <div class="h-screen bg-gray-100 pt-20" v-if="cartIsNotEmpty">
    <h1 class="mb-10 text-center text-2xl font-bold">PANIER</h1>
    <div class="mx-auto max-w-5xl justify-center px-6 md:flex md:space-x-6 xl:px-0">
      <div class="rounded-lg md:w-2/3">
      <shopping-list :shopping-products="shoppingProducts"></shopping-list>
      </div>
      <!-- Sub total -->
      <div class="mt-6 h-full rounded-lg border bg-white p-6 shadow-md md:mt-0 md:w-1/3">
        <div class="flex justify-between">
          <p class="text-lg font-bold">Total</p>
          <div class="">
            <p class="mb-1 text-lg font-bold">{{total}} fcfa</p>
          </div>
        </div>
        <button class="mt-6 w-full rounded-md bg-blue-500 py-1.5 font-medium text-blue-50 hover:bg-blue-600">Check out</button>
      </div>
    </div>
  </div>
  <div v-else>
      <h2 class="text-gray-600 text-2xl text-center mt-10">Aucun produit n'a été ajouté au panier</h2>
  </div>
  </body>
</template>

<style scoped>


</style>
