import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();



import {createApp} from 'vue'


const app = createApp({});
import ProductIndex from "@/components/ProductIndex.vue";
import AddToCart from "@/components/AddToCart.vue"
import NavbarCart from "@/components/NavbarCart.vue";

app.component('add-to-cart',AddToCart);
app.component('product-index',ProductIndex);
app.component('navbar-cart',NavbarCart);

app.mount("#app");
