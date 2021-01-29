@extends('layouts-frontend.app')

@section('content')
<!--begin::Forgot-->
<div class="login-form">
    <!--begin::Form-->
    <form class="form" method="POST" action="{{ route('password.update') }}" novalidate="novalidate" id="kt_login_forgot_form">
        @csrf

        <input type="hidden" name="token" value="{{ $token }}">

        <!--begin::Form group-->
        <div class="form-group">
			<label class="font-size-h6 font-weight-bolder text-dark">{{ __('E-Mail Address') }}</label>
			<input class="form-control form-control-solid h-auto px-5 py-3 rounded-lg font-size-h3 @error('email') is-invalid @enderror" type="text" name="email" autocomplete="email" autofocus value="{{ $email ?? old('email') }}" />

			@error('email')
				<span class="invalid-feedback" role="alert">
					<strong>{{ $message }}</strong>
				</span>
			@enderror
        </div>
        <!--end::Form group-->

        <!--begin::Form group-->
        <div class="form-group">
			<label class="font-size-h6 font-weight-bolder text-dark">{{ __('Password') }}</label>
			<input class="form-control form-control-solid h-auto px-5 py-3 rounded-lg font-size-h3 @error('password') is-invalid @enderror" name="password" type="password" id="password" autocomplete="new-password" />

			@error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <!--end::Form group-->

        <!--begin::Form group-->
        <div class="form-group">
			<label class="font-size-h6 font-weight-bolder text-dark">{{ __('Confirm Password') }}</label>
			<input class="form-control form-control-solid h-auto px-5 py-3 rounded-lg font-size-h3" name="password_confirmation" type="password" id="password-confirm" autocomplete="new-password" />
        </div>
        <!--end::Form group-->

        <!--begin::Form group-->
        <div class="form-group d-flex flex-wrap pb-lg-0">
            <button type="submit" id="kt_login_forgot_submit" class="btn btn-primary font-weight-bolder font-size-h6 px-8 py-4 my-3 mr-4">{{ __('Reset Password') }}</button>
            <a href="{{ url('/') }}" type="button" class="btn btn-light-primary font-weight-bolder font-size-h6 px-8 py-4 my-3">Cancel</a>
        </div>
        <!--end::Form group-->
    </form>
    <!--end::Form-->
</div>
<!--end::Forgot-->

@endsection