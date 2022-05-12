@extends('layouts.admin')

@section('adminBody')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    @if(isset($productDetail))
                    <h1>
                        Edit Product
                    </h1>
                    @else
                    <h1>
                        Add Product
                    </h1>
                    @endif

                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
                        <li class="breadcrumb-item active">
                            @if(isset($productDetail))
                            Edit Product
                            @else
                            Add Product
                            @endif
                        </li>
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
                <!-- general form elements -->
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Medicine Details</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    @if(isset($productDetail))
                    <form method="post" action="{{ route('EditMedicine', $productDetail->id)}}" name="add_product" id="add_product" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="card-body">
                            <div class="form-group">
                                <label for="ProductTitle">Generic Name</label>
                                <input type="text" class="form-control @error('ProductTitle') is-invalid @enderror" id="ProductTitle" name="ProductTitle" placeholder="Enter title" value="{{ $productDetail->title }}">
                                @error('ProductTitle')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="BrandName">Brand</label>
                                <select class="form-control" id="BrandName" name="BrandName">
                                    <?php echo $brands_dropdown; ?>
                                </select>
                                @error('BrandName')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="MainCategoryName">Category</label>
                                <select class="form-control" id="MainCategoryName" name="MainCategoryName">
                                    <?php echo $categories_dropdown; ?>
                                </select>
                                @error('MainCategoryName')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="dosage">Dosage</label>
                                <input type="text" class="form-control @error('dosage') is-invalid @enderror" id="dosage" name="dosage" placeholder="Enter the dosage amount" value="{{ $productDetail->dosage }}">
                                @error('dosage')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="age">Age Category</label>
                                <input type="text" class="form-control @error('age') is-invalid @enderror" id="age" name="age" placeholder="Enter the age category" value="{{ $productDetail->age }}">
                                @error('age')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="disease">Disease</label>
                                <input type="text" class="form-control @error('disease') is-invalid @enderror" id="disease" name="disease" placeholder="Enter the disease" value="{{ $productDetail->disease }}">
                                @error('disease')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="description">Product Description</label>
                                <textarea id="description" name="description" class="form-control @error('description') is-invalid @enderror" rows="4" placeholder="Enter description">{{ $productDetail->description }}</textarea>
                                @error('description')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="exampleInputFile">Product Images</label>
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="inputGroupFile02" name="image">
                                        <label class="custom-file-label" for="image">Choose file</label>
                                    </div>
                                    <div class="input-group-append">
                                        <span class="input-group-text">Upload</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-body -->

                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                    @else

                    <form method="post" action="{{ route('AddMedicine')}}" name="add_product" id="add_product" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="card-body">
                            <div class="form-group">
                                <label for="ProductTitle">Generic Name</label>
                                <input type="text" class="form-control @error('ProductTitle') is-invalid @enderror" id="ProductTitle" name="ProductTitle" placeholder="Enter title" value="{{ old('ProductTitle') }}">
                                @error('ProductTitle')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="BrandName">Brand</label>
                                <select class="form-control @error('BrandName') is-invalid @enderror" id="BrandName" name="BrandName" value="{{ old('BrandName') }}">
                                    <?php echo $brands_dropdown; ?>
                                </select>
                                @error('BrandName')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="MainCategoryName">Category</label>
                                <select class="form-control @error('MainCategoryName') is-invalid @enderror" id="MainCategoryName" name="MainCategoryName" value="{{ old('MainCategoryName') }}">
                                    <?php echo $categories_dropdown; ?>
                                </select>
                                @error('MainCategoryName')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="dosage">Dosage</label>
                                <input type="text" class="form-control @error('dosage') is-invalid @enderror" id="dosage" name="dosage" placeholder="Enter the dosage amount" value="{{ old('dosage') }}">
                                @error('dosage')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="age">Age Category</label>
                                <input type="text" class="form-control @error('age') is-invalid @enderror" id="age" name="age" placeholder="Enter the age category" value="{{ old('age') }}">
                                @error('age')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="disease">Disease</label>
                                <input type="text" class="form-control @error('disease') is-invalid @enderror" id="disease" name="disease" placeholder="Enter the disease" value="{{ old('disease') }}">
                                @error('disease')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea id="description" name="description" class="form-control @error('description') is-invalid @enderror" rows="4" placeholder="Enter description" value="{{ old('description') }}"></textarea>
                                @error('description')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="exampleInputFile">Product Images</label>
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="inputGroupFile02" name="image">
                                        <label class="custom-file-label" for="image">Choose file</label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- /.card-body -->

                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                    @endif
                </div>
                <!-- /.card -->
            </div>

            @if(isset($productDetail))
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h2 class="card-title">Images</h2>

                    </div>
                    <!-- /.card-header -->
                    <div class="card-body table-responsive p-0">
                        <table class="product-table table table-hover text-nowrap">
                            <thead>
                                <tr>
                                    <th>Image</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($images as $img)
                                <tr>
                                    <td>
                                        <img src="{{ asset($img->ImageName) }}" alt="" class="img-fluid">
                                    </td>
                                    <td>
                                        <a href="{{ route('DeleteMedicineImage', $img ->id) }}" class="btn btn-sm bg-warning">
                                            <i class="fas fa-trash"></i>
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
            @endif
        </div>

    </section>

    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

@endsection