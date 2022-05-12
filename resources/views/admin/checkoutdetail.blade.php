@extends('layouts.admin')

@section('adminBody')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Invoice</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Invoice</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <!-- Main content -->
                    <div class="invoice p-3 mb-3">
                        <!-- title row -->
                        <div class="row">
                            <div class="col-12">
                                <h4>
                                    <div class="image">
                                        <img src="{{ asset('img/logo.png') }}" alt="User Image" style="width: 140px; margin-bottom:10px">
                                    </div>
                                </h4>
                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- info row -->
                        <div class="row invoice-info">
                            <div class="col-sm-4 invoice-col">
                                From
                                <address>
                                    <strong>www.sanmukamedicals.com</strong><br>
                                    No 54 K.K.S Road Chunnagam, <br />
                                    Jaffna
                                    Phone: +(21) 224 3457<br>
                                    Email: help@sanmukamedicals.com
                                </address>
                            </div>
                            <!-- /.col -->
                            <div class="col-sm-4 invoice-col">
                                To
                                <address>
                                    <strong>{{$checkoutdetail->firstName}} {{$checkoutdetail->lastName}}</strong><br>
                                    {{$checkoutdetail->address}}<br>
                                    {{$checkoutdetail->city}}<br>
                                    {{$checkoutdetail->zip}}<br>
                                    Phone: {{$checkoutdetail->phone}}<br>
                                    Email: {{$checkoutdetail->email}}
                                </address>
                            </div>
                            <!-- /.col -->
                            <div class="col-sm-4 invoice-col">
                                <b>Invoice #{{$checkoutdetail->id}}</b><br>
                                <b>Date:</b> {{ $checkoutdetail->created_at->toDateString() }}<br>
                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- /.row -->

                        <!-- Table row -->
                        <div class="row">
                            <div class="col-12 table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Product id</th>
                                            <th>Image</th>
                                            <th>Product</th>
                                            <th>Size</th>
                                            <th>Qty</th>
                                            <th>Price</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                        $total = 0;
                                        @endphp
                                        @foreach($checkoutdetail->products as $product)
                                        <tr>
                                            <td>{{$product->id}}</td>
                                            <td>
                                                <div class="product-img">
                                                    <img src="{{$product->images[0]->ImageName}}" alt="Product Image" class="img-size-50">
                                                </div>
                                            </td>
                                            <td>{{$product->title}}</td>
                                            <td>{{$product->pivot->size}}</td>
                                            <td>{{$product->pivot->qty}}</td>
                                            <td>{{presentPrice($product->pivot->subtotal)}}</td>
                                        </tr>
                                        @php
                                        $total += $product->pivot->subtotal;
                                        @endphp
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- /.row -->

                        <div class="row">
                            <!-- accepted payments column -->
                            <div class="col-6">
                                <p class="lead">Order Notes:</p>
                                <p class="text-muted well well-sm shadow-none" style="margin-top: 10px;">
                                    {{$checkoutdetail->orderNotes}}
                                </p>
                            </div>
                            <!-- /.col -->
                            <div class="col-6">
                                <p class="lead">Date {{ $checkoutdetail->updated_at->toDateString() }}</p>

                                <div class="table-responsive">
                                    <table class="table">
                                        <tr>
                                            <th>Total:</th>
                                            <td> {{presentPrice($total)}}</td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- /.row -->

                        <!-- this row will not appear when printing -->
                        <div class="row no-print">
                            <div class="col-12">
                                {{-- <a href="invoice-print.html" rel="noopener" target="_blank" class="btn btn-default"><i
                                        class="fas fa-print"></i> Print</a>
                                <button type="button" class="btn btn-success float-right"><i
                                        class="far fa-credit-card"></i> Submit
                                    Payment
                                </button> --}}



                                <a href="{{ route('delivered', $checkoutdetail->id) }}" class="btn btn-primary float-right" style="margin-right: 5px;">
                                    Delivered </a>
                            </div>
                        </div>
                    </div>
                    <!-- /.invoice -->
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>

@endsection