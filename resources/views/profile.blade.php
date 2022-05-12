@extends('layouts.app')

@section('content')


<!-- ================ contact section start ================= -->
<section class="section-margin--small">
    <!--================Order Details Area =================-->
    <section class="order_details section-margin--small">
        <div class="container">
            @if($checkout)    
            <div class="order_details_table">
                <h2 class="m-0">Your recent order details  #{{$checkout->id}}</h2>
                <p class="m-0 mb-4">{{date('d-m-Y', strtotime($checkout->created_at))}}</p>
                <div class="table-responsive">
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
                </div>
            </div>
            @endif
        </div>
    </section>
    <!--================End Order Details Area =================-->
</section>
<!-- ================ contact section end ================= -->

@endsection