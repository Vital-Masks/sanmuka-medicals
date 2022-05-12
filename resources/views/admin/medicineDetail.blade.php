@extends('layouts.admin')

@section('adminBody')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Product Detail</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Product Detail</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <!-- Main content -->
  <section class="content">

    <!-- Default box -->
    <div class="card card-solid">
      <div class="card-body">
        <div class="row">
          <div class="col-12 col-sm-6">
            <h3 class="d-inline-block d-sm-none">{{ $product ->title }}</h3>
            <div class="single-prd-item col-12">
              @if($img != null)
              <img src="{{ asset($img->ImageName) }}" class="product-image" alt="Product Image">
              @else
              <img src="/img/products/noimage.png" class="product-image" alt="Product Image">
              @endif

            </div>
            <div class="col-12 product-image-thumbs">
              @foreach($images as $img)
              <div class="product-image-thumb active">
                <img src="{{ asset($img->ImageName) }}" alt="Product Image">
              </div>
              @endforeach
            </div>
          </div>
          <div class="col-12 col-sm-6">
            <h3 class="my-3">{{ $product ->title }}</h3>
            <hr>
            <P>{{ $product ->description }}</P>
            <P> <b>Brand:</b> {{ $product ->brand->name }}</P>
            <P> <b>Disease:</b> {{ $product ->disease }}</P>
            <P> <b>Dosage:</b> {{ $product ->dosage }}</P>
            <P> <b>Age Category:</b> {{ $product ->age }}</P>

          
            </table>

            <div class="mt-4">
              <a href="{{ route('EditMedicine', $product ->id)}}" class="btn btn-primary btn-lg btn-flat">
                <i class="fas fa-edit fa-lg mr-2"></i>
                Edit
              </a>

              <a href="{{ route('DeleteMedicine', $product ->id) }}" class="btn btn-danger btn-lg btn-flat">
                <i class="fas fa-trash fa-lg mr-2"></i>
                Delete
              </a>
            </div>
          </div>
        </div>
      </div>
      <!-- /.card-body -->
    </div>
    <!-- /.card -->

  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->
@endsection