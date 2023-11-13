<script setup>

import  ShoppingList from "@/components/ShoppingList.vue";
import {onMounted} from "vue";
import useProduct from "@/composables/products";

const {
  getProducts,
  shoppingProducts
} = useProduct();
onMounted(async () => {
   await getProducts();
})
</script>

<template>

  <body>
  <div class="h-screen bg-gray-100 pt-20">
    <h1 class="mb-10 text-center text-2xl font-bold">Cart Items</h1>
    <div class="mx-auto max-w-5xl justify-center px-6 md:flex md:space-x-6 xl:px-0">
      <div class="rounded-lg md:w-2/3">
      <shopping-list :shopping-products="shoppingProducts"></shopping-list>
      </div>
      <!-- Sub total -->
      <div class="mt-6 h-full rounded-lg border bg-white p-6 shadow-md md:mt-0 md:w-1/3">
        <div class="flex justify-between">
          <p class="text-lg font-bold">Total</p>
          <div class="">
            <p class="mb-1 text-lg font-bold">{{cartCount}} fcfa</p>
          </div>
        </div>
        <button class="mt-6 w-full rounded-md bg-blue-500 py-1.5 font-medium text-blue-50 hover:bg-blue-600">Check out</button>
      </div>
    </div>
  </div>
  </body>
</template>

<style scoped>


</style>
