import axios from "axios";

export default function useProduct(){

    const add = async (productId : number) => {
        let response = await axios.post('api/products',{
            productId : productId
        });

        return response.data.count

    }

    const getCount = async () => {
        //probleme rencontré car dans api.php apiResources venais apres /products/count
        let response = await axios.get('api/products/count');

        return response.data.count;

    }

    return {
        getCount,
        add,
    }
}
