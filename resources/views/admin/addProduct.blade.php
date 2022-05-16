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
                        <h3 class="card-title">Product Details</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    @if(isset($productDetail))
                    <form method="post" action="{{ route('EditProduct', $productDetail->id)}}" name="add_product" id="add_product" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="card-body">
                            <div class="form-group">
                                <label for="ProductTitle">Product Title</label>
                                <input type="text" class="form-control" id="ProductTitle" name="ProductTitle" placeholder="Enter title" value="{{ $productDetail->title }}">
                            </div>


                            <div class="form-group">
                                <label for="BrandName">Brand</label>
                                <select id="BrandName" name="BrandName" class="form-control @error('BrandName') is-invalid @enderror" autocomplete="BrandName">
                                    <option value="">@lang('Choose')...</option>
                                    @ @foreach($brands as $brand)
                                    @if ($productDetail->brand->name == $brand->name)
                                    <option value="{{ $brand->id}}" selected>{{ $brand->name}}</option>
                                    @else
                                    <option value="{{ $brand->id}}">{{ $brand->name}}</option>
                                    @endif
                                    @endforeach
                                </select>
                                @error('MainCategoryName')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="MainCategoryName">Category</label>
                                <select id="MainCategoryName" name="MainCategoryName" class="form-control @error('MainCategoryName') is-invalid @enderror" autocomplete="MainCategoryName">
                                    <option value="">@lang('Choose')...</option>
                                    @ @foreach($categories as $cat)
                                    @if ($productDetail->category->name == $cat->name)
                                    <option value="{{ $cat->id}}" selected>{{ $cat->name}}</option>
                                    @else
                                    <option value="{{ $cat->id}}">{{ $cat->name}}</option>
                                    @endif
                                    @endforeach
                                </select>
                                @error('MainCategoryName')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <!-- <label for="ProductTitle">Discount</label> -->
                                <input type="hidden" class="form-control @error('discount') is-invalid @enderror" id="discount" name="discount" placeholder="Enter the discount amount" value="{{ $productDetail->discount }}" value="0">
                                <!-- @error('discount')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror -->
                            </div>
                            <div class="form-group">
                                <label for="inputDescription">Product Description</label>
                                <textarea id="inputDescription" name="inputDescription" class="form-control" rows="4" placeholder="Enter description">{{ $productDetail->description }}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputFile">Product Images</label>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input  @error('image') is-invalid @enderror" id="inputGroupFile02" name="image">
                                    <label class="custom-file-label" for="image">Choose file</label>
                                    @error('image')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <hr>

                            <h6>Product Size/Weight & Price</h6>
                            <small class="text-red">At least give one price</small>

                            <div class="mt-3">
                                @foreach($productDetail->sizes->reverse() as $size)
                                <div class="row ">
                                    <div class="col form-group">
                                        <label for="size{{ $loop->index+1}}"> Size</label>
                                        <input type="text" class="form-control @error('size{{ $loop->index+1}}') is-invalid @enderror" id="size{{ $loop->index+1}}" name="size{{ $loop->index+1}}" placeholder="25g" value="{{ $size->size }}">
                                    </div>
                                    <div class="col form-group">
                                        <label for="price{{ $loop->index+1}}">Price</label>
                                        <input type="text" class="form-control @error('price{{ $loop->index+1}}') is-invalid @enderror" name="price{{ $loop->index+1}}" placeholder="10" value="{{ $size->price }}">
                                        <input type="text" value="{{ $size->id }}" name="sizeId{{ $loop->index+1}}" hidden>
                                    </div>
                                </div>
                                @endforeach

                                @if($productDetail->sizes->count() == 1)
                                <div class="row ">
                                    <div class="col form-group">
                                        <label for="size2">Size</label>
                                        <input type="text" class="form-control @error('size2') is-invalid @enderror" id="size2" name="size2" placeholder="50g" value="{{ old('size2') }}">
                                        <input type="hidden" name="sizeId2" value="nan">
                                    </div>
                                    <div class="col form-group">
                                        <label for="price2">Price</label>
                                        <input type="text" class="form-control @error('price2') is-invalid @enderror" id="inputPrice2" name="price2" placeholder="20" value="{{ old('price2') }}">
                                    </div>
                                </div>
                                <div class="row ">
                                    <div class="col form-group">
                                        <label for="size3">Size</label>
                                        <input type="text" class="form-control @error('size3') is-invalid @enderror" id="size3" name="size3" placeholder="100g" value="{{ old('size3') }}">
                                    </div>
                                    <div class="col form-group">
                                        <label for="price3">Price </label>
                                        <input type="text" class="form-control @error('price3') is-invalid @enderror" id="inputPrice3" name="price3" placeholder="30" value="{{ old('price3') }}">
                                    </div>
                                </div>
                                @elseif ($productDetail->sizes->count() == 2)
                                <div class="row ">
                                    <div class="col form-group">
                                        <label for="size3">Size</label>
                                        <input type="text" class="form-control @error('size3') is-invalid @enderror" id="size3" name="size3" placeholder="100g" value="{{ old('size3') }}">
                                    </div>
                                    <div class="col form-group">
                                        <label for="price3">Price </label>
                                        <input type="text" class="form-control @error('price3') is-invalid @enderror" id="inputPrice3" name="price3" placeholder="30" value="{{ old('price3') }}">
                                    </div>
                                </div>
                                @endif
                            </div>

                        </div>
                        <!-- /.card-body -->

                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                    @else

                    <form method="post" action="{{ route('AddProduct')}}" name="add_product" id="add_product" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="card-body">
                            <div class="form-group">
                                <label for="ProductTitle">Product Title</label>
                                <input type="text" class="form-control @error('ProductTitle') is-invalid @enderror" id="ProductTitle" name="ProductTitle" placeholder="Enter title" value="{{ old('ProductTitle') }}">
                                @error('ProductTitle')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="BrandName">Category</label>
                                <select id="BrandName" name="BrandName" class="form-control @error('BrandName') is-invalid @enderror" autocomplete="BrandName">
                                    <option value="">@lang('Choose')...</option>
                                    @ @foreach($brands as $brand)
                                    @if (old('BrandName' ) == $brand->name)
                                    <option value="{{ $brand->name}}" selected>{{ $brand->name}}</option>
                                    @else
                                    <option value="{{ $brand->name}}">{{ $brand->name}}</option>
                                    @endif
                                    @endforeach
                                </select>
                                @error('MainCategoryName')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="MainCategoryName">Category</label>
                                <select id="MainCategoryName" name="MainCategoryName" class="form-control @error('MainCategoryName') is-invalid @enderror" autocomplete="MainCategoryName">
                                    <option value="">@lang('Choose')...</option>
                                    @ @foreach($categories as $cat)
                                    @if (old('MainCategoryName' ) == $cat->name)
                                    <option value="{{ $cat->name}}" selected>{{ $cat->name}}</option>
                                    @else
                                    <option value="{{ $cat->name}}">{{ $cat->name}}</option>
                                    @endif
                                    @endforeach
                                </select>
                                @error('MainCategoryName')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <!-- <label for="ProductTitle">Discount</label> -->
                                <input type="hidden" class="form-control @error('discount') is-invalid @enderror" id="discount" name="discount" placeholder="Enter the discount amount" value="{{ old('discount') }}" value="0">
                                <!-- @error('discount')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror -->
                            </div>
                            <div class="form-group">
                                <label for="inputDescription">Product Description</label>
                                <textarea id="inputDescription" name="inputDescription" class="form-control @error('inputDescription') is-invalid @enderror" rows="4" placeholder="Enter description" value="{{ old('inputDescription') }}">
                                {{ old('inputDescription') }}
                                </textarea>
                                @error('inputDescription')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="exampleInputFile">Product Images</label>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input  @error('image') is-invalid @enderror" id="inputGroupFile02" name="image">
                                    <label class="custom-file-label" for="image">Choose file</label>
                                    @error('image')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <hr>

                            <h6>Product Size/Weight & Price</h6>
                            <small class="text-red">At least give one price</small>

                            <div class="mt-3">
                                <div class="row ">
                                    <div class="col form-group">
                                        <label for="size1">Size 1</label>
                                        <input type="text" class="form-control @error('size1') is-invalid @enderror" id="size1" name="size1" placeholder="25g" value="{{ old('size1') }}">
                                    </div>
                                    <div class="col form-group">
                                        <label for="price1">Price</label>
                                        <input type="text" class="form-control @error('price1') is-invalid @enderror" id="inputPrice1" name="price1" placeholder="10" value="{{ old('price1') }}">
                                    </div>
                                </div>
                                <div class="row ">
                                    <div class="col form-group">
                                        <label for="size2">Size 2</label>
                                        <input type="text" class="form-control @error('size2') is-invalid @enderror" id="size2" name="size2" placeholder="50g" value="{{ old('size2') }}">
                                    </div>
                                    <div class="col form-group">
                                        <label for="price2">Price</label>
                                        <input type="text" class="form-control @error('price2') is-invalid @enderror" id="inputPrice2" name="price2" placeholder="20" value="{{ old('price2') }}">
                                    </div>
                                </div>
                                <div class="row ">
                                    <div class="col form-group">
                                        <label for="size3">Size 3</label>
                                        <input type="text" class="form-control @error('size3') is-invalid @enderror" id="size3" name="size3" placeholder="100g" value="{{ old('size3') }}">
                                    </div>
                                    <div class="col form-group">
                                        <label for="price3">Price </label>
                                        <input type="text" class="form-control @error('price3') is-invalid @enderror" id="inputPrice3" name="price3" placeholder="30" value="{{ old('price3') }}">
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
                                @foreach($productDetail->images as $img)
                                <tr>
                                    <td>
                                        <img src="{{ asset($img->ImageName) }}" alt="" class="img-fluid">
                                    </td>
                                    <td>
                                        <a href="{{ route('DeleteImage', $img ->id) }}" class="btn btn-sm bg-warning">
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