import axios from "axios";

export const orderProductSave = async () => {
    console.log('reussi');
    await axios.post('/orderproduct').catch((err) => console.log(err));
}
