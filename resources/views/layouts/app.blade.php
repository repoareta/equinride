<!DOCTYPE html>
<html lang="en">

	<!--begin::Head-->
	<head>
		<base href="">
		<meta charset="utf-8" />
		<title>EQUINRIDE</title>
		<meta name="description" content="Amazing Equinride" />
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
		<link rel="canonical" href="https://equinride.com/" />

		<!-- CSRF Token -->
		<meta name="csrf-token" content="{{ csrf_token() }}">

		@include('layouts.styles')
		@stack('styles')
	</head>

	<!--end::Head-->

	<!--begin::Body-->
	<body id="kt_body" class="header-fixed header-mobile-fixed subheader-enabled page-loading">

		<!--begin::Main-->

		<!--[html-partial:include:{"file":"partials/_header-mobile.html"}]/-->
		@include('layouts.partials._header-mobile')
		<div class="d-flex flex-column flex-root">

			<!--begin::Page-->
			<div class="d-flex flex-row flex-column-fluid page">

				<!--[html-partial:include:{"file":"partials/_aside.html"}]/-->
				@include('layouts.partials._aside')
				<!--begin::Wrapper-->
				<div class="d-flex flex-column flex-row-fluid wrapper" id="kt_wrapper">

					<!--[html-partial:include:{"file":"partials/_header.html"}]/-->
					@include('layouts.partials._header')
					<!--begin::Content-->
					<div class="content d-flex flex-column flex-column-fluid" id="kt_content">

						<!--[html-partial:include:{"file":"partials/_subheader/subheader-v1.html"}]/-->
						@include('layouts.partials._subheader.subheader-v1')
						<!--[html-partial:include:{"file":"partials/_content.html"}]/-->
						{{-- edit here start --}}
						<div class="d-flex flex-column-fluid">
							<!--begin::Container-->
							<div class="container-fluid">
								@yield('content')
							</div>
						</div>
						{{-- edit here end --}}
					</div>

					<!--end::Content-->

					<!--[html-partial:include:{"file":"partials/_footer.html"}]/-->
					@include('layouts.partials._footer')
				</div>

				<!--end::Wrapper-->
			</div>

			<!--end::Page-->
		</div>

		<!--end::Main-->
		
		<!--[html-partial:include:{"file":"partials/_extras/offcanvas/quick-search.html"}]/-->
		@include('layouts.partials._extras.offcanvas.quick-search')
		<!--[html-partial:include:{"file":"partials/_extras/offcanvas/quick-user.html"}]/-->
		@include('layouts.partials._extras.offcanvas.quick-user')
		<!--[html-partial:include:{"file":"partials/_extras/offcanvas/quick-panel.html"}]/-->
		@include('layouts.partials._extras.offcanvas.quick-panel')
		<!--[html-partial:include:{"file":"partials/_extras/chat.html"}]/-->
		@include('layouts.partials._extras.chat')
		<!--[html-partial:include:{"file":"partials/_extras/scrolltop.html"}]/-->
		@include('layouts.partials._extras.scrolltop')

		@include('layouts.scripts')
		
		@stack('scripts')
	</body>

	<!--end::Body-->
</html>