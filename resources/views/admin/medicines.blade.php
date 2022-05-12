@extends('layouts.admin')

@section('adminBody')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Manage Medicines</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
                        <li class="breadcrumb-item active">Manage Medicines</li>
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
                            <h2 class="card-title">Medicines</h2>

                            <div class="card-tools">
                                <a class="btn btn-block bg-gradient-info"
                                    href="{{ route('AddMedicine') }}">
                                    <i style="margin-right: 8px" class="fas fa-folder-plus"></i> Add Medicine</a>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body table-responsive p-0">
                            <table class="product-table table table-hover text-wrap table-fixed">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Generic Name</th>
                                        <th>Brand</th>
                                        <th>Category</th>
                                        <th>Dosage</th>
                                        <th>Age</th>
                                        <th>Disease</th>
                                        <th style="width: 400px">Description</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($products as $product)
                                        <tr>
                                            <td>{{ $loop->index+1}}</td>
                                            <td>{{ $product ->title }}</td>
                                            <td>{{ $product ->brand->name }}</td>
                                            <td>{{ $product ->category->name }}</td>
                                            <td>{{ $product ->dosage }}</td>
                                            <td>{{ $product ->age }}</td>
                                            <td>{{ $product ->disease }}</td>
                                            <td >{{ $product ->description }}</td>
                                            <td style="text-align: right;">
                                                <a href="{{ route('medicine.details', $product ->id) }}"
                                                    class="btn btn-sm bg-warning">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                                <a href="{{ route('EditMedicine', $product ->id) }}"
                                                    class="btn btn-sm bg-warning">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <a href="{{ route('DeleteMedicine', $product ->id) }}" class="btn btn-sm bg-warning">
                                                    <i class="fas fa-trash"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach

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
@endsection