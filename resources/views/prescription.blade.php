@extends('layouts.app')

@section('content')

<!--================Blog Categorie Area =================-->
<section class="blog_categorie_area px-3">
    <div class="max-w-2xl mx-auto">
        @if(session()->has('success_message'))
        <h4 style="color: green; text-align: center; padding-bottom: 20px">
            {{ session()->get('success_message') }}
        </h4>
        @endif
        <div class="comment-form">
            <h4>Upload Prescription</h4>
            <form method="post" action="{{ route('PostPrescription')}}" name="upload_prescription" id="upload_prescription" enctype="multipart/form-data">
                {{ csrf_field() }}

                <div class="form-group form-inline">
                    <div class="form-group col-lg-6 col-md-6 name">
                        <input type="text" class="form-control  @error('firstName') is-invalid @enderror" id="firstName" name="firstName" placeholder="Enter First Name" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter First Name'" value="{{ old('firstName') }}">
                        @error('firstName')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group col-lg-6 col-md-6 email">
                        <input type="text" class="form-control  @error('lastName') is-invalid @enderror" id="lastName" name="lastName" placeholder="Enter Last Name" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter Last Name'" value="{{ old('lastName') }}">
                        @error('lastName')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="form-group form-inline">
                    <div class="form-group col-lg-6 col-md-6 name">
                        <input type="text" class="form-control  @error('nic') is-invalid @enderror" id="nic" name="nic" placeholder="Enter NIC" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter NIC'" value="{{ old('nic') }}">
                        @error('nic')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group col-lg-6 col-md-6 email">
                        <input type="text" class="form-control  @error('phone') is-invalid @enderror" id="phone" name="phone" placeholder="Enter Phone" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter Phone'" value="{{ old('phone') }}">
                        @error('phone')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="form-group form-inline">
                    <div class="form-group col-lg-6 col-md-6 name">
                        <input type="email" class="form-control  @error('email') is-invalid @enderror" id="email" name="email" placeholder="Enter Email" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter Email'" value="{{ old('email') }}">
                        @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group col-lg-6 col-md-6 email">
                        <input type="text" class="form-control  @error('address') is-invalid @enderror" id="address" name="address" placeholder="Enter Address" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter Address'" value="{{ old('address') }}">
                        @error('address')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="form-group">
                    <textarea class="form-control mb-10" rows="5" name="orderNotes" placeholder="Order Notes" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Order Notes'"></textarea>
                </div>
                <div class="form-group">
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
                <button type="submit" class="button button-postComment button--active">UPLOAD</button>
            </form>
        </div>
    </div>
</section>
<!--================Blog Categorie Area =================-->


@endsection