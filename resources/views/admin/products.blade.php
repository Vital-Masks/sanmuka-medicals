@extends('layouts.admin')

@section('adminBody')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Manage Products</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
                        <li class="breadcrumb-item active">Manage Products</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h2 class="card-title">Products</h2>

                            <div class="card-tools">
                                <a class="btn btn-block bg-gradient-info" href="{{ route('AddProduct') }}">
                                    <i style="margin-right: 8px" class="fas fa-folder-plus"></i> Add Product</a>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body table-responsive p-0">
                            <table class="product-table table table-hover text-wrap table-fixed">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Title</th>
                                        <th style="width: 400px">Description</th>
                                        <th>Brand</th>
                                        <th>Category</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($products as $product)
                                    <tr>
                                        <td>{{ $loop->index+1}}</td>
                                        <td>{{ $product ->title }}</td>
                                        <td>{{ $product ->description }}</td>
                                        <td>{{ $product ->brand->name }}</td>
                                        <td>{{ $product ->category->name }}</td>
                                        <td style="text-align: right;">
                                            <a href="{{ route('product.details', $product ->id) }}" class="btn btn-sm bg-warning">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="{{ route('EditProduct', $product ->id) }}" class="btn btn-sm bg-warning">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <a href="{{ route('DeleteProduct', $product ->id) }}" class="btn btn-sm bg-warning">
                                                <i class="fas fa-trash"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    @empty
                                        <tr>
                                           <td colspan="6"><p class="text-center billing-alert text-danger">No items found!.</p></td>
                                        </tr>
                                        @endforelse

                                </tbody>
                            </table>
                        </div>
                        <div class="card-footer clearfix">
                            <ul class="m-0 float-right">
                                {{ $products->appends(request()->input())->links() }}
                            </ul>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
            </div>


        </div>
    </section>
</div>
</div>
@endsection