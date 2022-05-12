@extends('layouts.app')

@section('content')

<!-- ================ category section start ================= -->
<section class="section-margin--small mb-5">
    <div class="container">
        <div class="row">
            <div class="col-xl-3 col-lg-4 col-md-5">
                <div class="sidebar-categories">
                    <div class="head">Browse Categories</div>
                    <ul class="main-categories">
                        @foreach ($categories as $category )
                        <li class="filter-list dropdown-btn">
                            <label> <a class="text-uppercase" href="{{ route('shop.index', ['category' => $category->id])}}"> {{ $category->name }}</a> </label>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="col-xl-9 col-lg-8 col-md-7">
                <!-- Start Filter Bar -->
                <div class="filter-bar d-flex flex-wrap align-items-center">
                    <div class="sorting">
                        <h2>
                            @if(isset( $searchName))
                            <a class="icon_btn " href="{{ route('shop.index') }}"><i class="fas fa-arrow-left text-black"></i></a>
                            <span class=" section-intro__style">{{$searchName}} </span>
                        </h2>
                        @else
                        <span class=" section-intro__style">{{$categoryName}} </span></h2>
                        @endif
                    </div>
                    <div class="sorting mr-auto">
                    </div>
                    <div>
                        <form action="{{ route('search') }}" method="get">
                            <div class="input-group filter-bar-search">
                                {{ csrf_field() }}
                                <input type="text" placeholder="Search" name="search" id="search">
                                <div class="input-group-append">
                                    <button type="submit"><i class="ti-search"></i></button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- End Filter Bar -->

                <!-- Start Best Seller -->
                <section class="lattest-product-area pb-40 category-list">
                    <div class="row">
                        @forelse ($products as $product)
                        <div class="col-md-6 col-lg-3 col-xl-3">
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
                                    <!-- <p>Product</p> -->
                                    <h4 class="card-product__title"><a href="{{ route('shop.details', $product ->id) }}">{{ $product ->title }} - {{ $product ->sizes[0]->size }}</a></h4>
                                    <p class="card-product__price">{{ $product ->sizes[0]->presentPrice() }}</p>
                                </div>
                            </div>
                        </div>
                        @empty
                        <div class="container">
                            <p class="text-center billing-alert text-danger">No items found!.</p>
                        </div>
                        @endforelse
                    </div>
                    <nav class="justify-content-center d-flex">
                        {{-- {{ $products->links() }} --}}
                        {{ $products->appends(request()->input())->links() }}
                    </nav>
                </section>
                <!-- End Best Seller -->
            </div>
        </div>
    </div>
</section>
<!-- ================ category section end ================= -->

@endsection