@extends('layouts.app')

@section('content')


<!-- ================ contact section start ================= -->
<section class="section-margin--small">
    <!--================Order Details Area =================-->
    <section class="order_details section-margin--small">
        
        <div class="container">
        <h1>hello {{ Auth::user()->name }}!</h1>
            @forelse($checkouts as $checkout)
            <div class="order_details_table">
                @if($checkout)
                <h2 class="m-0">Your recent order details #{{$checkout ? $checkout->id : ''}}</h2>
                @endif
                <p class="m-0 mb-4">{{ $checkout ? date('d-m-Y', strtotime($checkout->created_at)) : ''}}</p>
                <div class="table-responsive">
                    @if($checkout)
                    <table class="table table-sm">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th scope="col">Product</th>
                                <th scope="col">Size</th>
                                <th scope="col">Quantity</th>
                                <th scope="col">Total</th>
                            </tr>
                        </thead>
                        @php
                        $total = 0;
                        @endphp
                        <tbody>
                            <tr>
                                @foreach($checkout->products as $product )
                                <td>{{$loop->index +1}}</td>
                                <td>
                                    <p>{{$product->title}}</p>
                                </td>
                                <td>
                                    <h5>{{$product->pivot->size}}</h5>
                                </td>
                                <td>
                                    <h5>{{$product->pivot->qty}}X</h5>
                                </td>
                                <td>
                                    <p>{{presentPrice($product->pivot->subtotal)}}</p>
                                </td>
                            </tr>
                            @php
                            $total += $product->pivot->subtotal;
                            @endphp
                            @endforeach
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td>
                                    <h4>Subtotal</h4>
                                </td>
                                <td>
                                    <p>{{ presentPrice($total) }}</p>
                                </td>
                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td>
                                    <h4>Total</h4>
                                </td>
                                <td>
                                    <h4>{{ presentPrice($total) }}</h4>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    @else
                    <h2 class="text-center">Your orders will be show here!</h2>
                    @endif
                </div>

            </div>
            @empty
            <h6  style="color: red">You don't have any orders!</h6>
            @endforelse
            {{ $checkouts->links() }}
        </div>
    </section>
    <!--================End Order Details Area =================-->
</section>
<!-- ================ contact section end ================= -->

@endsection