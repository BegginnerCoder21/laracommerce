<script setup lang="ts">

import useProduct from "../composables/products";
import emitter from 'tiny-emitter/instance';
import {onMounted, watch} from "vue";

const {
    getProducts,
    shoppingProducts,
    increaseQuantity,
    decreaseQuantity,
    destroyProduct,
    totalPrice
} = useProduct();

onMounted(async () => {
   await getProducts()
});

watch(totalPrice,(value) => {
    emitter.emit('totalPriceUpdated', totalPrice.value);
})

</script>
<template>

  <div
      v-for="shoppingProduct in shoppingProducts" :key="shoppingProduct.id"
      class="justify-between mb-6 rounded-lg bg-white p-6 shadow-md sm:flex sm:justify-start" >
    <img :src="shoppingProduct.associatedModel.images" alt="product-image" class="w-full rounded-lg sm:w-40" />
    <div class="sm:ml-4 sm:flex sm:w-full sm:justify-between">
      <div class="mt-5 sm:mt-0">
        <h2 class="text-lg font-bold text-gray-900">{{shoppingProduct.name}}</h2>
        <p class="mt-1 text-xs text-gray-700">36EU - 4US</p>
        <p> <strong>prix unitaire: </strong>{{shoppingProduct.price}} fcfa</p>
          <strong class="cursor-pointer" @click="destroyProduct(shoppingProduct.id)">(Supprimer le produit)</strong>

      </div>
      <div class="mt-4 flex justify-between sm:space-y-12 sm:mt-0 sm:block sm:space-x-6">
        <div class="flex items-center border-gray-100 flex-col gap-6">
          <div>
            <span class="cursor-pointer rounded-l bg-gray-100 py-1 px-3.5 duration-100 hover:bg-blue-500 hover:text-blue-50" @click="decreaseQuantity(shoppingProduct.id)"> - </span>
            <input class="h-8 w-8 border bg-white text-center text-xs outline-none" type="text" readonly :value="shoppingProduct.quantity" min="1" />
            <span class="cursor-pointer rounded-r bg-gray-100 py-1 px-3 duration-100 hover:bg-blue-500 hover:text-blue-50" @click="increaseQuantity(shoppingProduct.id)"> + </span>
          </div>
          <div class="flex items-center space-x-4">
            <p class="text-sm"> <strong>prix total: </strong> {{shoppingProduct.price * shoppingProduct.quantity}} fcfa</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<style scoped>

</style>
