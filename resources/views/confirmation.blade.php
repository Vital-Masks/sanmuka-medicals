@extends('layouts.app')

@section('content')

<!-- ================ start banner area ================= -->
<!-- <section class="blog-banner-area" id="category">
		<div class="container h-100">
			<div class="blog-banner">
				<div class="text-center">
					<h1>Order Confirmation</h1>
					<nav aria-label="breadcrumb" class="banner-breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active" aria-current="page">Shop Category</li>
            </ol>
          </nav>
				</div>
			</div>
    </div>
	</section> -->
<!-- ================ end banner area ================= -->

<!--================Order Details Area =================-->
<section class="order_details section-margin--small">
  <div class="container">
    <p class="text-center billing-alert">Thank you. Your order has been received.</p>

    <div class="order_details_table">
      <h2>Order Details</h2>
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
          <tbody>
            @php
            $total = 0;
            @endphp
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
  </div>
</section>
<!--================End Order Details Area =================-->

@endsection