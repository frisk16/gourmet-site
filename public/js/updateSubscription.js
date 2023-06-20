const stripe = Stripe('pk_test_51N7CdjFDQyVJGiMWcK4jAn34Ec3OeGA7mB5guX7HptNza4246ldq8Q78PQZvQXKGDv4u8vs1Y1noRodDDivDq2BO00phehY15m');

const elements = stripe.elements();
const cardElement = elements.create('card');
cardElement.mount('#card-form');

const cardHolderName = document.getElementById('card-holder-name');
const cardButton = document.getElementById('card-button');
const clientSecret = cardButton.dataset.secret;

cardButton.addEventListener('click', async(e) => {
    e.preventDefault();
    const { setupIntent, error } = await stripe.confirmCardSetup(clientSecret, {
        payment_method: {
            card: cardElement,
            billing_details: {
                name: cardHolderName.value,
            },
        },
    });

    if(error) {
        console.log(error);
    } else {
        document.querySelector('.back-ground').style.display = 'block';
        document.querySelector('.loading').style.display = 'block';
        document.forms.submitForm.paymentMethodId.value = setupIntent.payment_method;
        document.forms.submitForm.submit();
    }
});
