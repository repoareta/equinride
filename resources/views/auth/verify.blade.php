@extends('layouts-frontend.app')

@section('content')
<!--begin::Forgot-->
<div class="login-form">
    <!--begin::Form-->

    <!--begin::Title-->
    <div class="py-5 pt-lg-0">
        <h3 class="font-weight-bolder text-dark font-size-h4 font-size-h1-lg">{{ __('Verify Your Email Address') }}</h3>
        <p class="text-muted font-weight-bold font-size-h4">
            {{ __('Before proceeding, please check your email for a verification link.') }}
            {{ __('If you did not receive the email') }},
        </p>
    </div>
    <!--end::Title-->

    <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
        @csrf
        <button type="submit" class="btn btn-primary font-weight-bolder font-size-h6 px-8 py-4 my-3 mr-4">{{ __('Click here to request another') }}</button>.
    </form>
    <!--end::Form-->

    
</div>
<!--end::Forgot-->

@endsection