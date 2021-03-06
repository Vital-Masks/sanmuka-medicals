@extends('layouts.app')

@section('content')
  
  <!--================Login Box Area =================-->
  <section class="login_box_area section-margin">
		<div class="container">
			<div class="row">
				<div class="col-lg-6">
					<div class="login_box_img">
						<div class="hover">
							<h4>New to our website?</h4>
							<a class="button button-account" href="{{url('/register')}}">Create an Account</a>
						</div>
					</div>
				</div>
				<div class="col-lg-6">
					<div class="login_form_inner">
						<h3>Log in to enter
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
						<form class="row login_form" action="{{route('signin')}}" method="post" id="contactForm" >
						@csrf

							<div class="col-md-12 form-group">
								<input type="text" class="form-control" id="email" name="email" placeholder="Email">
							</div>
							<div class="col-md-12 form-group">
								<input type="password" class="form-control" id="password" name="password" placeholder="Password">
							</div>
							<!-- <div class="col-md-12 form-group">
								<div class="creat_account">
									<input type="checkbox" id="f-option2" name="selector">
									<label for="f-option2">Keep me logged in</label>
								</div>
							</div> -->
							<div class="col-md-12 form-group">
								<button type="submit" value="submit" class="button button-login w-100">Log In</button>
								<a href="#">Forgot Password?</a>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</section>
    <!--================End Login Box Area =================-->
    
    @endsection