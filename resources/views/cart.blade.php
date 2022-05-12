@extends('layouts.app')


@section('content')


<!-- ================ start banner area ================= -->
<!-- <section class="blog-banner-area" id="category">
    <div class="container h-100">
        <div class="blog-banner">
            <div class="text-center">
                <h1>Shopping Cart</h1>
                <nav aria-label="breadcrumb" class="banner-breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Shopping Cart</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</section> -->
<!-- ================ end banner area ================= -->



<!--================Cart Area =================-->
<section class="cart_area">

    <div class="container">
        @if(session()->has('success_message'))
        <h4 style="color: green; text-align: center; padding-bottom: 20px">
            {{ session()->get('success_message') }}
        </h4>
        @endif

        @if(count($errors) > 0)
        <ul>
            @foreach ($errors->all() as $error)
            <li>
                <h4 style="color: rgb(255, 0, 0); text-align: center; padding-bottom: 20px">
                    {{ $error }}
                </h4>
            </li>
            @endforeach
        </ul>
        @endif

        @if(Cart::count() > 0)

        <div class="cart_inner">
            <div class="table-responsive">
                <table class="table table-sm">
                    <h5 class="mb-4">{{ Cart::count() }} item(s) in Shopping Cart</h5>
                    <thead >
                        <tr>
                            <th>#</th>
                            <th scope="col">Product</th>
                            <th scope="col">Price</th>
                            <th scope="col">Size</th>
                            <th scope="col">Quantity</th>
                            <th scope="col">Total</th>
                            <th></th>

                        </tr>
                    </thead>
                    <tbody>


                        @foreach(Cart::content() as $item)
                        <tr>
                            <td>{{$loop->index +1}}</td>
                            <td>
                                <a href="{{ route('shop.details', $item->model->id) }}">
                                    <div class="media">
                                        <div class="media-body">
                                            <p style="font-size: 15px; font-weight: 600; color: black;">{{ $item->model->title }}</p>
                                        </div>
                                    </div>
                                </a>
                            </td>
                            <td>
                                <h5>{{ presentPrice($item->price) }}</h5>
                            </td>
                            <td>
                                <h5>
                                    <?php echo ($item->options->has('size') ? $item->options->size : ''); ?>
                                </h5>
                            </td>

                            <td>
                                <select class="quantity" data-id="{{ $item->rowId }}">
                                    @for($i = 1; $i < 5 + 1; $i++) <option {{ $item->qty == $i ? 'selected' : '' }}>{{ $i }}</option>
                                        @endfor
                                </select>
                            </td>

                            <td>
                                <h5>{{ presentPrice($item->subtotal) }}</h5>
                            </td>
                            <td>
                                <form action="{{ route('cart.destroy', $item->rowId) }}" method="POST">
                                    {{ csrf_field() }}
                                    {{ method_field ('DELETE') }}

                                    <button style="border: none; background-color: transparent; font-size: 20px">
                                        <i class="ti-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach



                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>
                                <h5>Subtotal</h5>
                            </td>
                            <td>
                                <h5>{{ presentPrice(Cart::subtotal())  }}</h5>
                            </td>
                        </tr>


                        <tr class="shipping_area">
                            <td class="d-none d-md-block"></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>

                            </td>
                            <td>
                                <div class="shipping_box">
                                    <ul class="list">
                                        <!-- <li>Tax(13%) : {{ presentPrice(Cart::tax()) }}</li> -->
                                        <!-- <li class="active">Local Delivery: $2.00</li> -->
                                    </ul>
                                    <h4 style="font-size: 2em; margin-top: 1em">Total: {{ presentPrice(Cart::total()) }}</h4>
                                </div>
                            </td>
                        </tr>


                        <tr class="out_button_area">
                            <td class="d-none-l"></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>
                                <div class="checkout_btn_inner d-flex align-items-center">
                                    <a class="gray_btn" href="{{ route('shop.index') }}">Continue
                                        Shopping</a>
                                    <a class="ml-2 primary-btn" href="{{ route('checkout.index') }}">Proceed to
                                        checkout</a>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        @else

        <h4 style="color: green; text-align: center; padding-bottom: 20px"> No items in Cart</h4>
        <div class="cupon_text d-flex align-items-center">
            <a style="align-item: center" class="button primary-btn" href="{{ route('shop.index') }}">Continue Shopping</a>
        </div>
        @endif
    </div>
</section>
<!--================End Cart Area =================-->

@endsection


@section('extra-js')
<script src="{{ mix('/js/app.js') }}" defer></script>

<script>
    (function() {
        const classname = document.querySelectorAll('.quantity')

        Array.from(classname).forEach(function(element) {
            element.addEventListener('change', function() {

                const id = element.getAttribute('data-id')

                axios.patch(`/cart/${id}`, {
                        quantity: this.value
                    })
                    .then(function(response) {
                        window.location.href = '{{ route("cart.index") }}'
                    })
                    .catch(function(error) {
                        window.location.href = '{{ route("cart.index") }}'
                    });
            })
        })
    })();
</script>
@endsection