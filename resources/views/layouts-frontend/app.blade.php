
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
	<!--begin::Head-->
	<head><base href="../../../">
		<meta charset="utf-8" />
		<title>{{ config('app.name', 'EQUINRIDE') }}</title>
		<meta name="description" content="Amazing Equinride" />
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
		<link rel="canonical" href="{{ config('app.url', url()) }}" />
		<!-- CSRF Token -->
		<meta name="csrf-token" content="{{ csrf_token() }}">

		@include('layouts.styles')
        
        <!--begin::Page Custom Styles(used by this page)-->
		<link href="{{ asset('assets/css/pages/login/login-1.css') }}" rel="stylesheet" type="text/css" />
        <!--end::Page Custom Styles-->
        
        <style>
            @media (max-width: 1399.98px) and (min-width: 992px){
                .login.login-1 .login-aside {
                    width: 100%;
                    max-width: 650px;
                }
            }

			.invalid-feedback {
				display: block;
			}
        </style>
	</head>
	<!--end::Head-->
	<!--begin::Body-->
	<body id="kt_body" class="header-fixed header-mobile-fixed subheader-enabled page-loading">
		<!--begin::Main-->
		<div class="d-flex flex-column flex-root">
			<!--begin::Login-->
			<div class="login login-1 login-signin-on d-flex flex-column flex-lg-row flex-column-fluid bg-white" id="kt_login">
				<!--begin::Aside-->
				<div class="login-aside d-flex flex-column flex-row-auto" 
				style="
				background-image: url(assets/media/branchsto/bg-front-min.png); 
				background-size: cover;
				background-repeat: no-repeat;
				background-position: center center;">
					<!--begin::Aside Top-->
					<div class="d-flex flex-column-auto flex-column pt-lg-40 pt-15">
						<!--begin::Aside header-->
						<a href="#" class="text-center mb-10">
							<img src="{{ asset('assets/media/branchsto/logo-branchsto.svg') }}" class="max-h-250px w-250px" alt="" />
						</a>
						<!--end::Aside header-->
						<!--begin::Aside title-->
						<h3 class="font-weight-bolder text-center font-size-h4 font-size-h1-lg mb-20" style="color: #ffa152;">AMAZING EQUINRIDE</h3>
						<!--end::Aside title-->
					</div>
					<!--end::Aside Top-->
					<!--begin::Aside Bottom-->
					{{-- <div class="aside-img d-flex flex-row-fluid bgi-no-repeat bgi-position-y-bottom bgi-position-x-center" style="background-image: url(assets/media/branchsto/bg-front.png);"></div> --}}
					<!--end::Aside Bottom-->
				</div>
				<!--begin::Aside-->
				<!--begin::Content-->
				<div class="login-content flex-row-fluid d-flex flex-column justify-content-center position-relative overflow-hidden p-7 mx-auto">
					<!--begin::Content body-->
					<div class="d-flex flex-column-fluid flex-center">
						@yield('content')
					</div>
					<!--end::Content body-->
					<!--begin::Content footer-->
					<div class="d-flex justify-content-lg-start justify-content-center align-items-end py-7 py-lg-0">
						<div class="text-dark-50 font-size-lg font-weight-bolder mr-10">
							<span class="mr-1">2020©</span>
							<a href="{{ config('app.url', url()) }}" target="_blank" class="text-dark-75 text-hover-primary">{{ config('app.name', 'Equinride') }}</a>
						</div>
						<a href="#" class="text-primary font-weight-bolder font-size-lg">Privacy Policy</a>
						<a href="#" class="text-primary ml-5 font-weight-bolder font-size-lg">Terms</a>
						<a href="#" class="text-primary ml-5 font-weight-bolder font-size-lg">Contact Us</a>
					</div>
					<!--end::Content footer-->
				</div>
				<!--end::Content-->
			</div>
			<!--end::Login-->
		</div>
		<!--end::Main-->
		<!--begin::Global Config(global config for global JS scripts)-->
		@include('layouts.scripts')
		<!--end::Global Theme Bundle-->
	</body>
	<!--end::Body-->
</html>