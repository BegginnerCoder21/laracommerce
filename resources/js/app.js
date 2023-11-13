import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();



import {createApp} from 'vue'


const app = createApp({});
import ProductIndex from "@/components/ProductIndex.vue";
import AddToCart from "@/components/AddToCart.vue"
import NavbarCart from "@/components/NavbarCart.vue";
import {Toaster} from "@meforma/vue-toaster";
import ShoppingProducts from "@/components/ShoppingProducts.vue";
import ShoppingList from "@/components/ShoppingList.vue";

app.use(Toaster).provide('toast', app.config.globalProperties.$toast);
app.component('add-to-cart',AddToCart);
app.component('product-index',ProductIndex);
app.component('navbar-cart',NavbarCart);
app.component('shopping-products',ShoppingProducts);
app.component('shopping-list',ShoppingList);

app.mount("#app");
