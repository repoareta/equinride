@extends('layouts-frontend.app')

@section('content')
<!--begin::Forgot-->
<div class="login-form">
    <!--begin::Form-->
    <form class="form" method="POST" action="{{ route('password.email') }}" novalidate="novalidate" id="kt_login_forgot_form">
        @csrf

        <!--begin::Title-->
        <div class="py-5 pt-lg-0">
            <h3 class="font-weight-bolder text-dark font-size-h4 font-size-h1-lg">Forgotten Password ?</h3>
            <p class="text-muted font-weight-bold font-size-h4">Enter your email to reset your password</p>
        </div>
        <!--end::Title-->
        <!--begin::Form group-->
        <div class="form-group">
            <input class="form-control form-control-solid h-auto py-3 px-5 rounded-lg font-size-h3 @error('email') is-invalid @enderror" type="email" placeholder="Email" name="email" autocomplete="email" id="email" value="{{ old('email') }}" autofocus />

            @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <!--end::Form group-->
        <!--begin::Form group-->
        <div class="form-group d-flex flex-wrap pb-lg-0">
            <button type="submit" id="kt_login_forgot_submit" class="btn btn-primary font-weight-bolder font-size-h6 px-8 py-4 my-3 mr-4">{{ __('Send Password Reset Link') }}</button>
            <a href="{{ url('/') }}" type="button" id="kt_login_forgot_cancel" class="btn btn-light-primary font-weight-bolder font-size-h6 px-8 py-4 my-3">Cancel</a>
        </div>
        <!--end::Form group-->
    </form>
    <!--end::Form-->
</div>
<!--end::Forgot-->

@endsection