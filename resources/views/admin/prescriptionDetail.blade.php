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
                                    <strong>{{$prescriptionDetails->firstName}} {{$prescriptionDetails->lastName}}</strong><br>
                                    {{$prescriptionDetails->address}}<br>
                                    Phone: {{$prescriptionDetails->phone}}<br>
                                    Email: {{$prescriptionDetails->email}}<br>
                                    NIC: {{$prescriptionDetails->nic}}<br>
                                </address>
                            </div>
                            <!-- /.col -->
                            <div class="col-sm-4 invoice-col">
                                <b>Invoice #{{$prescriptionDetails->id}}</b><br>
                                <b>Date:</b> {{ $prescriptionDetails->created_at->toDateString() }}<br>
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
                                            <th>Prescription</th>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <td>
                                            <div class="product-img">
                                                <img src="{{ asset($prescriptionDetails->image) }}" alt="Product Image" >
                                            </div>
                                        </td>
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
                                    {{$prescriptionDetails->orderNotes}}
                                </p>
                            </div>
                            <!-- /.col -->
                            <div class="col-6">
                                <p class="lead">Date {{ $prescriptionDetails->updated_at->toDateString() }}</p>

                                <div class="table-responsive">
                                    <table class="table">

                                    </table>
                                </div>
                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- /.row -->

                        <!-- this row will not appear when printing -->
                        @if($prescriptionDetails->delivered === 0 )
                        <div class="row no-print">
                            <div class="col-12">
                                <a href="{{ route('PrescriptionDelivered', $prescriptionDetails->id) }}" class="btn btn-primary float-right" style="margin-right: 5px;">
                                    Delivered </a>
                            </div>
                        </div>
                        @endif
                    </div>
                    <!-- /.invoice -->
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>

@endsection