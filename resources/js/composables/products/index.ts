import axios from "axios";
import {ref} from "vue";
import emitter from 'tiny-emitter/instance';
export default function useProduct(){


    const add = async (productId : number) => {
        let response = await axios.post('api/products',{
            productId : productId
        });

        return response.data.count

    }

    const shoppingProducts = ref();
    const cartCount = ref(0);

    const getProducts = async () => {

        let response = await axios.get('api/products');

        shoppingProducts.value = response.data.products
        cartCount.value = response.data.cartCount;

    }

    const getCount = async () => {
        //probleme rencontré car dans api.php apiResources venais apres /products/count
        let response = await axios.get('api/products/count');

        return response.data.count;

    }

    const destroyProduct = async (id : string) => {

        await axios.delete('/shopping-products/destroy/' + id);
        await getProducts();
        emitter.emit('cartCountUpdated',cartCount.value);

    }

    const increaseQuantity = async (id : string) => {
         await axios.get('/shopping-products/increase/' + id);
         await getProducts();
        emitter.emit('cartCountUpdated',cartCount.value)
    }
    const decreaseQuantity = async (id : string) => {
         await axios.get('/shopping-products/decrease/' + id);
         await getProducts();
         emitter.emit('cartCountUpdated',cartCount.value);
    }

    return {
        getCount,
        add,
        getProducts,
        shoppingProducts,
        increaseQuantity,
        decreaseQuantity,
        destroyProduct
    }
}
