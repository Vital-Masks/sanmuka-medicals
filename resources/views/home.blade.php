@extends('layouts.app')

@section('content')

<main class="site-main">

    <!--================ Hero banner start =================-->
    <section class="">
        <div id="owl-demo" class="owl-carousel owl-theme">
            <div class="item">
                <div class="carousel-caption">
                    <h3>Running out of Medicines?
                        <br>Contact Us and Fulfill your Needs
                    </h3>
                </div>
                <div class="overlay"></div>
                <img src="/assets/images/banner/img1.jpg" alt="banner">
            </div>
            <div class="item">
                <div class="carousel-caption">
                    <h3>Facing Hassle to Wait & Buy?
                        <br>Few steps in Door Delivery
                    </h3>
                </div>
                <div class="overlay"></div>
                <img src="/assets/images/banner/img2.jpg" alt="banner">
            </div>
            <div class="item">
                <div class="carousel-caption">
                    <h3>Need to Wait in Queue to buy Medicines ?
                        <br>Order Through our Website & Collect it Instantly
                    </h3>
                </div>
                <div class="overlay"></div>
                <img src="/assets/images/banner/img3.jpg" alt="banner">
            </div>
            <div class="item">
                <div class="carousel-caption">
                    <h3>Unable to find and buy your medicine?
                        <br>Visit our Products section and Order it
                    </h3>
                </div>
                <div class="overlay"></div>
                <img src="/assets/images/banner/img4.jpg" alt="banner">
            </div>
        </div>
    </section>
    <!--================ Hero banner start =================-->

    <!-- ================ trending product section start ================= -->
    <section class="section-margin calc-60px">
        <div class="container">
            <div class="section-intro pb-60px">
                <h2>Shop <span class="section-intro__style">Now</span></h2>

            </div>
            <div class="row">
                @foreach($products1 as $product)
                <div class="col-md-6 col-lg-3 col-xl-2">
                    <div class="card text-center card-product">
                        <div class="card-product__img">
                            @if($product->images->count())
                            <img class="card-img" src="{{ asset($product->images[0]->ImageName) }}" alt="">
                            @else
                            <img class="card-img" src="/img/products/no-image.png" alt="">
                            @endif
                            <ul class="card-product__imgOverlay">
                                <li>
                                    <a href="{{ route('shop.details', $product ->id) }}">
                                        <button><i class="ti-eye"></i></button>
                                    </a>
                                </li>

                                <li>
                                    <form action="{{ route('cart.store') }}" method="post">
                                        {{ csrf_field() }}
                                        <input type="hidden" name="id" value="{{ $product->id }}">
                                        <input type="hidden" name="title" value="{{ $product->title }}">
                                        <input type="hidden" name="sizeId" value="{{ $product ->sizes[0]->id }}">
                                        <button type="submit"><i class="ti-shopping-cart"></i></button>
                                    </form>
                                </li>

                            </ul>
                        </div>
                        <div class="card-body">
                            <h4 class="card-product__title"><a href="{{ route('shop.details', $product ->id) }}">{{ $product ->title }} - {{ $product ->sizes[0]->size }}</a></h4>
                            <p class="card-product__price">{{ $product ->sizes[0]->presentPrice() }}</p>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
    <!-- ================ trending product section end ================= -->

    <!-- ================ offer section start ================= -->
    <section class="offer" id="parallax-1" data-anchor-target="#parallax-1" data-300-top="background-position: 20px 30px" data-top-bottom="background-position: 0 20px">
        <div class="container">
            <div class="row">
                <div class="col-xl-5">
                    <div class="offer__content text-center">
                        <h3>ABOUT US</h3>
                        <p>We are best known as experts in the Medical Industry. We have earned our reputation through decades of excellence in the industry. Fulfilling your medication needs is our primary goal. In order to serve you more conveniently and gratify your medication needs, we have extended services through this website. We deliver what you need when you need it. With valid verification and a prescription, get yourself a hassle free home delivery where we will ensure that your requested medication has all the necessary packaging while following safe health practices.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ================ offer section end ================= -->

    <!-- ================ trending product section start ================= -->
    <section class="section-margin calc-60px">
        <div class="container">
            <div class="section-intro pb-60px">
                <h2>Shop <span class="section-intro__style">Now</span></h2>
            </div>
            <div class="row">
                @foreach($products2 as $product)
                <div class="col-md-6 col-lg-3 col-xl-2">
                    <div class="card text-center card-product">
                        <div class="card-product__img">
                            @if($product->images->count())
                            <img class="card-img" src="{{ asset($product->images[0]->ImageName) }}" alt="">
                            @else
                            <img class="card-img" src="/img/products/no-image.png" alt="">
                            @endif
                            <ul class="card-product__imgOverlay">
                                <li>
                                    <a href="{{ route('shop.details', $product ->id) }}">
                                        <button><i class="ti-eye"></i></button>
                                    </a>
                                </li>

                                <li>
                                    <form action="{{ route('cart.store') }}" method="post">
                                        {{ csrf_field() }}
                                        <input type="hidden" name="id" value="{{ $product->id }}">
                                        <input type="hidden" name="title" value="{{ $product->title }}">
                                        <input type="hidden" name="sizeId" value="{{ $product ->sizes[0]->id }}">
                                        <button type="submit"><i class="ti-shopping-cart"></i></button>
                                    </form>
                                </li>

                            </ul>
                        </div>
                        <div class="card-body">
                            <h4 class="card-product__title"><a href="{{ route('shop.details', $product ->id) }}">{{ $product ->title }} - {{ $product ->sizes[0]->size }}</a></h4>
                            <p class="card-product__price">{{ $product ->sizes[0]->presentPrice() }}</p>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
    <!-- ================ trending product section end ================= -->

</main>

@endsection