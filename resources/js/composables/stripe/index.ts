import {ref} from "vue";
import axios from "axios";
import {orderProductSave} from "./helpers";

export default function useStripe(){

    const stripe =ref(null);
    const elements = ref(null);

    const initialize = async () => {

        stripe.value = Stripe(import.meta.env.VITE_STRIPE_PUBLIC_KEY);
        const  clientSecret  = await axios.post('/paymentintent')
            .then((r) => r.data.clientSecret)
            .catch((err) => console.log(err));

        elements.value = stripe.value.elements({ clientSecret });

        const paymentElementOptions = {
            layout: "tabs",
        };

        const paymentElement = elements.value.create("payment", paymentElementOptions);
        paymentElement.mount("#payment-element");
    }

    const handleSubmit = async () => {
        setLoading(true);

        const { error } = await stripe.value.confirmPayment({
            elements : elements.value,
            confirmParams: {
                // Make sure to change this to your payment completion page
                return_url: "http://127.0.0.1:8000/formpayement",
            },
        });

        if (error.type === "card_error" || error.type === "validation_error") {
            showMessage(error.message);
        } else {
            showMessage("An unexpected error occurred.");
        }

        setLoading(false);
    }

    const checkStatus = async () => {
        const clientSecret = new URLSearchParams(window.location.search).get(
            "payment_intent_client_secret"
        );

        if (!clientSecret) {
            return;
        }

        const { paymentIntent } = await stripe.value.retrievePaymentIntent(clientSecret);

        switch (paymentIntent.status) {
            case "succeeded":
                showMessage("Payment succeeded!");
                await orderProductSave();
                window.location.href = '/dashboard';
                break;
            case "processing":
                showMessage("Your payment is processing.");
                break;
            case "requires_payment_method":
                showMessage("Your payment was not successful, please try again.");
                break;
            default:
                showMessage("Something went wrong.");
                break;
        }
    }

    const showMessage = (messageText) => {
        const messageContainer = document.querySelector("#payment-message");

        messageContainer.classList.remove("hidden");
        messageContainer.textContent = messageText;

        setTimeout(function () {
            messageContainer.classList.add("hidden");
            messageContainer.textContent = "";
        }, 4000);
    }

    // Show a spinner on payment submission
    const setLoading = (isLoading) => {
        if (isLoading) {
            // Disable the button and show a spinner
            document.querySelector("#submit").disabled = true;
            document.querySelector("#spinner").classList.remove("hidden");
            document.querySelector("#button-text").classList.add("hidden");
        } else {
            document.querySelector("#submit").disabled = false;
            document.querySelector("#spinner").classList.add("hidden");
            document.querySelector("#button-text").classList.remove("hidden");
        }
    }

    return {
        initialize,
        checkStatus,
        handleSubmit
    }
}
