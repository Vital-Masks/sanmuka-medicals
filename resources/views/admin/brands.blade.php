@extends('layouts.admin')

@section('adminBody')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Brands</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Brands</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        @if(Session::has('flash_message_success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>{!! session('flash_message_success') !!}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        @endif
        <div class="row">
            <div class="col-md-6">
                <div class="col-md-12">
                    <!-- general form elements -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Add Brand</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->

                        @if(isset($brandDetails))
                        <form method="post" action="{{ route('EditBrand', $brandDetails->id) }}" novalidate="novalidate">
                            {{ csrf_field() }}

                            <div class="card-body">
                                <div class="form-group">
                                    <label for="BrandName">Brand Name</label>
                                    <input type="text" class="form-control @error('BrandName') is-invalid @enderror" id="BrandName" name="BrandName" placeholder="Enter Brand" value="{{$brandDetails->name}}">
                                    @error('BrandName')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            @else
                            <form method="post" action="{{ route('AddBrand') }}" novalidate="novalidate">
                                {{ csrf_field() }}

                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="BrandName">Brand Name</label>
                                        <input type="text" class="form-control @error('BrandName') is-invalid @enderror" id="BrandName" name="BrandName" placeholder="Enter Brand" value="{{ old('BrandName') }}">
                                        @error('BrandName')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                @endif
                                <!-- /.card-body -->

                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Submit</button>

                                    @if(isset($brandDetails))
                                    <a href="{{ route('AddBrand') }}" type="button" class="btn btn-primary">Cancel</a>
                                    @endif
                                </div>
                            </form>
                    </div>
                </div>
                <!-- /.card -->
            </div>

            <div class="col-md-6">
                <div class="card-body table-responsive p-0">
                    <table class="product-table table table-hover text-nowrap">
                        <thead>
                            <tr>
                                <th>Brand Name</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($brands as $brand)
                            <tr>
                                <td>
                                    <p>{{$brand->name}}</p>
                                </td>

                                <td style="text-align: right;">
                                    <a href="{{ route('EditBrand',$brand->id) }}" class="btn btn-sm bg-warning">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <a href="{{ route('DeleteBrands',$brand->id) }}" class="btn btn-sm bg-warning" id="dltCat">
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
                        {{-- {{ $categories->appends(request()->input())->links() }} --}}
                    </ul>
                </div>
                <!-- /.card-body -->
            </div>
        </div>

    </section>

    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

@endsection