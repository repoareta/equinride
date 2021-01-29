@extends('layouts-frontend.app')

@section('content')
	<!--begin::Signup-->
	<div class="login-form">
		<!--begin::Form-->
		<form class="form" novalidate="novalidate" method="POST" action="{{ route('register') }}">
			@csrf
			<!--begin::Title-->
			<div class="pb-13 pt-lg-0 pt-5">
				<h3 class="font-weight-bolder text-dark font-size-h4 font-size-h1-lg">Sign Up</h3>
				<p class="text-muted font-weight-bold font-size-h4">Enter your details to create your account</p>
			</div>
			<!--end::Title-->
			<!--begin::Form group-->
			<div class="form-group">
				<input class="form-control form-control-solid h-auto py-3 px-5 rounded-lg font-size-h3 @error('name') is-invalid @enderror" type="text" placeholder="Fullname" name="name" autocomplete="off" value="{{ old('name') }}" required />
				@error('name')
					<span class="invalid-feedback d-block" role="alert">
						<strong>{{ $message }}</strong>
					</span>
				@enderror
			</div>
			
			<!--end::Form group-->
			<!--begin::Form group-->
			<div class="form-group">
				<input class="form-control form-control-solid h-auto py-3 px-5 rounded-lg font-size-h3 @error('email') is-invalid @enderror" type="email" placeholder="Email" name="email" autocomplete="off" value="{{ old('name') }}" required />
				@error('email')
					<span class="invalid-feedback d-block" role="alert">
						<strong>{{ $message }}</strong>
					</span>
				@enderror
			</div>
			
			<!--end::Form group-->
			<!--begin::Form group-->
			<div class="form-group">
				<input class="form-control form-control-solid h-auto py-3 px-5 rounded-lg font-size-h3 @error('password') is-invalid @enderror" type="password" placeholder="Password" name="password" autocomplete="off" value="{{ old('name') }}" required />
				@error('password')
					<span class="invalid-feedback d-block" role="alert">
						<strong>{{ $message }}</strong>
					</span>
				@enderror
			</div>
			
			<!--end::Form group-->
			<!--begin::Form group-->
			<div class="form-group">
				<input class="form-control form-control-solid h-auto py-3 px-5 rounded-lg font-size-h3" type="password" placeholder="Confirm password" name="password_confirmation" autocomplete="off" value="{{ old('name') }}" required />
			</div>
			<!--end::Form group-->
			<!--begin::Form group-->
			<div class="form-group">
				<label class="checkbox mb-0">
					<input type="checkbox" name="agree" />
					<span></span>
					<div class="ml-2">I Agree the
					<a href="#">terms and conditions</a>.</div>
				</label>
			</div>
			<!--end::Form group-->
			<!--begin::Form group-->
			<div class="form-group d-flex flex-wrap pb-lg-0 pb-3">
				<button type="submit" id="kt_login_signup_submit" class="btn btn-primary font-weight-bolder font-size-h6 px-8 py-4 my-3 mr-4">Submit</button>
				<a href="{{ url('/') }}" type="button" class="btn btn-light-primary font-weight-bolder font-size-h6 px-8 py-4 my-3">Cancel</a>
			</div>
			<!--end::Form group-->
		</form>
		<!--end::Form-->
	</div>
	<!--end::Signup-->
@endsection