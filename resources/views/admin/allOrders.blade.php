@extends('layouts.admin')

@section('adminBody')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Dashboard</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Dashboard</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-6">
                    <div class="card">
                        <div class="card-header border-transparent">
                            <h3 class="card-title">Orders</h3>

                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table m-0">
                                    <thead>
                                        <tr>
                                            <th>Order ID</th>
                                            <th>Item</th>
                                            <th>Status</th>
                                            <th>Date</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($checkouts as $ckout)
                                            {{-- @foreach($ckout->products as $product) --}}
                                            <tr>
                                                <td><a href="pages/examples/invoice.html">{{ $ckout->id }}</a></td>
                                                <td>{{ $ckout->firstName }}</td>
                                                <td><span class="badge badge-success">New</span></td>
                                                <td><span
                                                        class="badge badge-info">{{ $ckout->created_at->toDateString() }}</span>
                                                </td>
                                                <td>
                                                    <a href="{{ route('checkout.details', $ckout->id) }}"
                                                        class="btn btn-sm bg-warning">
                                                        <i class="fas fa-eye"></i>
                                                    </a>
                                                    <a href="{{ route('checkout.delete', $ckout ->id) }}" class="btn btn-sm bg-warning">
                                                        <i class="fas fa-trash"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                            {{-- @endforeach --}}
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.table-responsive -->
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer clearfix">
                            <a href="{{ route('checkoutall') }}"
                                class="btn btn-sm btn-secondary float-right">View All Orders</a>
                        </div>
                        <!-- /.card-footer -->
                    </div>
                </div>

            
            </div>

        </div><!-- /.container-fluid -->
    </section>




</div>

@endsection
