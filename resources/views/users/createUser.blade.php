@extends('layouts.app')

@section('content')


<!-- ================ start banner area ================= -->
<section class="blog-banner-area" id="category">
    <div class="container h-100">
        <div class="blog-banner">
            <div class="text-center">
                <h1>Register</h1>
                <nav aria-label="breadcrumb" class="banner-breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Register</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</section>
<!-- ================ end banner area ================= -->

<!--================Login Box Area =================-->
<section class="login_box_area section-margin">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="login_box_img">
                    <div class="hover">
                        <h4>Already have an account?</h4>
                        <p></p>
                        <a class="button button-account" href="{{url('/login')}}">Login Now</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="login_form_inner register_form_inner">
                    <h3>Create an account
                        <br />
						@include('shared.alert')

						<ul>
						@if($errors->any())
							@foreach($errors->all() as $error)
							<li>
								<span style="font-size: 12px; color: red;">	{{$error}}</span>
							</li>
							@endforeach
						@endif
						</ul>
					
                    </h3>

                    <form class="row login_form" action="{{route('createuser')}}" id="register_form" method="post">
                        @csrf

                        <div class="col-md-12 form-group">
                            <input type="text" class="form-control" id="uname" name="uname" placeholder="Username"
                                 value="{{old('uname')}}">
                        </div>

                        <div class="col-md-12 form-group">
                            <input type="text" class="form-control" id="fname" name="fname" placeholder="Firstname"
                                 value="{{old('fname')}}">
                        </div>

                        <div class="col-md-12 form-group">
                            <input type="text" class="form-control" id="lname" name="lname" placeholder="Lastname"
                                 value="{{old('lname')}}">
                        </div>

                        <div class="col-md-12 form-group">
                            <input type="text" class="form-control" id="email" name="email" placeholder="Email Address"
                                 value="{{old('email')}}">
                        </div>
                        <div class="col-md-12 form-group">
                            <input type="password" class="form-control" id="password" name="password"
                                placeholder="Password" >
                        </div>
                        <!-- <div class="col-md-12 form-group">
                            <input type="text" class="form-control" id="confirmPassword" name="confirmPassword"
                                placeholder="Confirm Password" onfocus="this.placeholder = ''"
                                onblur="this.placeholder = 'Confirm Password'">
                        </div> -->
                        <!-- <div class="col-md-12 form-group">
                            <div class="creat_account">
                                <input type="checkbox" id="f-option2" name="selector">
                                <label for="f-option2">Keep me logged in</label>
                            </div>
                        </div> -->
                        <div class="col-md-12 form-group">
                            <button type="submit" value="submit" class="button button-register w-100">Register</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<!--================End Login Box Area =================-->


@endsection