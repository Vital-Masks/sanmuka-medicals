@extends('layouts.app')

@section('content')
<script src="https://js.stripe.com/v3/"></script>

<!-- ================ start banner area ================= -->
<!-- <section class="blog-banner-area" id="category">
    <div class="container h-100">
        <div class="blog-banner">
            <div class="text-center">
                <h1>Product Checkout</h1>
                <nav aria-label="breadcrumb" class="banner-breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Checkout</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</section> -->
<!-- ================ end banner area ================= -->


<!--================Checkout Area =================-->
<section class="checkout_area section-margin--small">
    <div class="container">
        @if(session()->has('auth_error'))
        <p style="color: red; text-align: center; padding-bottom: 20px">
            {{ session()->get('auth_error') }}
        </p>
        @endif
        <div class="billing_details" style="margin-top: 50px">
            <form action="{{ route('checkout.store') }}" method="post" novalidate="novalidate" id="payment-form">
                {{ csrf_field() }}
                <div class="row">
                    <div class="col-lg-7">
                        <h3>Billing Details</h3>
                        <div class="row contact_form">

                            <div class="col-md-6 form-group p_star">
                                <input type="text" class="form-control @error('firstName') is-invalid @enderror" id="firstName" name="firstName" placeholder="First name" value="{{ old('firstName') }}">
                                @error('firstName')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="col-md-6 form-group p_star">
                                <input type="text" class="form-control @error('lastName') is-invalid @enderror" id="lastName" name="lastName" placeholder="Last name" value="{{ old('lastName') }}">
                                @error('lastName')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="col-md-12 form-group">
                                <input type="text" class="form-control @error('nic') is-invalid @enderror" id="nic" name="nic" placeholder="NIC" value="{{ old('nic') }}">
                                @error('nic')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="col-md-6 form-group p_star">
                                <input type="text" class="form-control @error('phoneNumber') is-invalid @enderror" id="phoneNumber" name="phoneNumber" placeholder="Phone number" value="{{ old('phoneNumber') }}">
                                @error('phoneNumber')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="col-md-6 form-group p_star">
                                <input type="text" class="form-control @error('email') is-invalid @enderror" id="email" name="email" placeholder="Email Address" value="{{ old('email') }}">
                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="col-md-12 form-group p_star">
                                <input type="text" class="form-control @error('address') is-invalid @enderror" id="address" name="address" placeholder="Address" value="{{ old('address') }}">
                                @error('address')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="col-md-12 form-group p_star">
                                <input type="text" class="form-control @error('city') is-invalid @enderror" id="city" name="city" placeholder="Town/City" value="{{ old('city') }}">
                                @error('city')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="col-md-12 form-group">
                                <input type="text" class="form-control" id="zip" name="zip" placeholder="Postcode/ZIP" value="{{ old('zip') }}">
                            </div>
                            <div class="col-md-12 form-group">
                                <h3>Shipping Details</h3>
                                <textarea class="form-control" name="message" id="message" rows="1" placeholder="Order Notes"></textarea>
                            </div>

                            <!-- <div id="OnlinePayment" class="col-md-12 form-group mb-0">
                                <h3>Payment Details</h3>
                                <input type="text" class="form-control mb-2" id="name_on_card" name="name_on_card" placeholder="Name on Card">
                                <div class="form-group">
                                    <label for="card-element">Credit or debit card</label>
                                    <div id="card-element"></div>
                                    <div id="card-errors"></div>
                                    <p id="payment-result">
                                </div>
                            </div> -->
                        </div>


                    </div>


                    <div class="col-lg-5">
                        <div class="order_box">
                            <h2>Your Order</h2>
                            <ul class="list">
                                <li><a href="#">
                                        <h4>Product <span>Total</span></h4>
                                    </a>
                                </li>

                                <div class="border-bottom chechout-products-list">
                                    @foreach(Cart::content() as $item )
                                    <li>
                                        <div class="row checkout-products-det">
                                            <div class="col-6 prod-name">
                                                <a href="#">{{ $item->model->title }} - <?php echo ($item->options->has('size') ? $item->options->size : ''); ?>
                                                    <input type="hidden" name="qty" id="qty" value="{{ $item->qty }}" />
                                                    <input type="hidden" name="productid" id="productid" value="{{ $item->model->id }}" />
                                                </a>
                                            </div>
                                            <div class="col-2">
                                                <a href="" onclick='return false;' style="cursor: default;">
                                                    <span class="">x {{ $item->qty }}</span>
                                                </a>
                                            </div>
                                            <div class="col-4">
                                                <a href="" onclick='return false;' style="cursor: default;">
                                                    <span class="">{{ presentPrice($item->price) }}</span>
                                                </a>
                                            </div>
                                        </div>
                                    </li>
                                    @endforeach

                                </div>

                            </ul>
                            <ul class="list list_2 mt-2">
                                <li><a href="#">Subtotal <span>{{ presentPrice(Cart::subtotal()) }}</span></a></li>
                                <!-- <li><a href="#">Tax(13%) <span>{{ presentPrice(Cart::tax()) }}</span></a></li> -->
                                <li><a href="#">Total <span>$ {{ presentPrice(Cart::total()) }}</span></a></li>
                                <input type="hidden" name="total" id="total" value="{{ presentPrice(Cart::total()) }}" />

                                <input type="hidden" value="{{ presentPrice(Cart::subtotal()) }}" name="subtotal" id="subtotal" />
                                <input type="hidden" value="{{ presentPrice(Cart::tax())}}" name="tax" id="tax" />
                                <input type="hidden" value="{{ presentPrice(Cart::total()) }}" name="total" id="total" />
                            </ul>
                            <!-- <div class="payment_item active">
                                <div class=" mt-4">
                                    <label for="f-option6">Cash on delivery</label>
                                </div>
                                <p>Please bring you order id send to your email whil. Thank you!</p>
                            </div> -->
                            <div class="text-center">
                                <button class="button button-paypal" type="submit" id="place-order">Place Order</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>
<!--================End Checkout Area =================-->

@endsection


@section('extra-js')
<script src="https://js.braintreegateway.com/web/dropin/1.13.0/js/dropin.min.js"></script>

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
@endsection