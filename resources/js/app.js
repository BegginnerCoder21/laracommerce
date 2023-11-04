import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();



import {createApp} from 'vue'


const app = createApp({});
import ProductIndex from "@/components/ProductIndex.vue";
app.component('product-index',ProductIndex);

app.mount("#app")
