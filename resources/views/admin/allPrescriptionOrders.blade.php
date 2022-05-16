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
                            <h3 class="card-title">Prescription Orders</h3>

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
                                        @forelse($orders as $order)
                                        <tr>
                                            <td>{{ $loop->index+1 }}</td>
                                            <td>{{ $order->firstName }}</td>
                                            <td><span class="badge badge-success">
                                            {{$order->delivered === 1 ? "Delivered" : ($order->viewed === 1 ? "Viewed" : "New")}}</span></td>
                                            <td><span class="badge badge-info">{{ $order->created_at->toDateString() }}</span>
                                            </td>
                                            <td>
                                                <a href="{{ route('PrescriptionDetail', $order->id) }}" class="btn btn-sm bg-warning">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                                <a href="{{ route('PrescriptionDelete', $order ->id) }}" class="btn btn-sm bg-warning">
                                                    <i class="fas fa-trash"></i>
                                                </a>
                                            </td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="5">
                                                <p class="text-center billing-alert text-danger">No items found!.</p>
                                            </td>
                                        </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.table-responsive -->
                        </div>
                        <!-- /.card-body -->
                        <div class="dashboard-card-footer">
                            {{ $orders->links() }}

                        </div>
                    </div>
                </div>


            </div>

        </div><!-- /.container-fluid -->
    </section>




</div>

@endsection