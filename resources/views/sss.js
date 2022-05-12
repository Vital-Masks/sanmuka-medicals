<script>
    (function() {

        // Create a Stripe client
        var stripe = Stripe('pk_live_51IME1mGQl9CODMYbWYMTbqZkEqSOGw5wVCALbKWulJdMEJPPKCI9JebFYB2e3cYOwG0D7hG60EmJzYixEvdajT5x00USgAjPDl');
    // Create an instance of Elements
    var elements = stripe.elements();
    // Custom styling can be passed to options when creating an Element.
    // (Note that this demo uses a wider set of styles than the guide below.)
    var style = {
        base: {
        color: '#32325d',
    lineHeight: '18px',
    fontFamily: '"Roboto", Helvetica Neue", Helvetica, sans-serif',
    fontSmoothing: 'antialiased',
    fontSize: '16px',
    '::placeholder': {
        color: '#aab7c4'
                }
            },
    invalid: {
        color: '#fa755a',
    iconColor: '#fa755a'
            }
        };
    // Create an instance of the card Element
    var card = elements.create('card', {
        style: style,
    hidePostalCode: true
        });
        // Add an instance of the card Element into the `card-element` <div>
    card.mount('#card-element');
    // Handle real-time validation errors from the card Element.
    card.addEventListener('change', function(event) {
            var displayError = document.getElementById('card-errors');
    if (event.error) {
    displayError.textContent = event.error.message;
            } else {
    displayError.textContent = '';
            }
        });
    // Handle form submission
    var form = document.getElementById('payment-form');

    form.addEventListener('submit', function(event) {
    event.preventDefault();
    // Disable the submit button to prevent repeated clicks
    document.getElementById('place-order').disabled = true;
    var options = {
    name: document.getElementById('name_on_card').value,
    address_line1: document.getElementById('add1').value,
    address_city: document.getElementById('city').value,
    address_zip: document.getElementById('zip').value
            }
    stripe.createToken(card, options).then(function(result) {
                if (result.error) {
                    // Inform the user if there was an error
                    var errorElement = document.getElementById('card-errors');
    errorElement.textContent = result.error.message;
    // Enable the submit button
    document.getElementById('place-order').disabled = false;
                } else {
    // Send the token to your server
    stripeTokenHandler(result.token);
                }
            });
        });

    function stripeTokenHandler(token) {
            // Insert the token ID into the form so it gets submitted to the server
            var form = document.getElementById('payment-form');
    var hiddenInput = document.createElement('input');
    hiddenInput.setAttribute('type', 'hidden');
    hiddenInput.setAttribute('name', 'stripeToken');
    hiddenInput.setAttribute('value', token.id);
    form.appendChild(hiddenInput);
    // Submit the form
    form.submit();
        }
    })();
</script>