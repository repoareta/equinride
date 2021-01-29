
<!--begin::Header-->
<div id="kt_header" class="header bg-white header-fixed">

	<!--begin::Container-->
	<div class="container-fluid d-flex align-items-stretch justify-content-between">

		<!--begin::Left-->
		<div class="d-flex align-items-stretch mr-2 scroll">

			<!--begin::Page Title-->
			<h3 class="d-none text-dark d-lg-flex align-items-center mr-10 mb-0">EQUINRIDE</h3>

			<!--end::Page Title-->

			<!--begin::Header Menu Wrapper-->
			<div class="header-menu-wrapper header-menu-wrapper-left" id="kt_header_menu_wrapper">

				<!--begin::Header Menu-->
				<div id="kt_header_menu" class="header-menu header-menu-mobile header-menu-layout-default header-menu-root-arrow">

					<!--begin::Header Nav-->
					<ul class="menu-nav">
						<li class="menu-item {{ Route::is('home') ? 'menu-item-active' : '' }}" aria-haspopup="true">
							<a href="{{ route('home') }}" class="menu-link">
								<span class="menu-text">HOME</span>
							</a>
						</li>

						<li class="menu-item 
						{{ Route::is('riding_class.*') || Route::is('riding_class') ? 'menu-item-active' : '' }}" aria-haspopup="true">
							<a href="{{ route('riding_class') }}" class="menu-link">
								<span class="menu-text">RIDING CLASS</span>
							</a>
						</li>

						<li class="menu-item" aria-haspopup="true">
							<a href="#" class="menu-link">
								<span class="menu-text">COMPETITIONS</span>
								<span class="label label-inline label-danger">Coming Soon</span>
							</a>
						</li>

						<li class="menu-item" aria-haspopup="true">
							<a href="#" class="menu-link">
								<span class="menu-text">VIRTUAL STABLING</span>
								<span class="label label-inline label-danger">Coming Soon</span>
							</a>
						</li>

						<li class="menu-item" aria-haspopup="true">
							<a href="#" class="menu-link">
								<span class="menu-text">HORSE DEAL</span>
								<span class="label label-inline label-danger">Coming Soon</span>
							</a>
						</li>

						<li class="menu-item" aria-haspopup="true">
							<a href="#" class="menu-link">
								<span class="menu-text">MARKETPLACE</span>
								<span class="label label-inline label-danger">Coming Soon</span>
							</a>
						</li>
						
					</ul>

					<!--end::Header Nav-->
				</div>

				<!--end::Header Menu-->
			</div>

			<!--end::Header Menu Wrapper-->
		</div>

		<!--end::Left-->

		<!--begin::Topbar-->
		<div class="topbar">

			<!--begin::Search-->
			<div class="topbar-item mr-3">
				<div class="btn btn-icon btn-clean btn-lg" id="kt_quick_search_toggle">
					<span class="svg-icon svg-icon-xl">

						<!--begin::Svg Icon | path:assets/media/svg/icons/General/Search.svg-->
						<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
							<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
								<rect x="0" y="0" width="24" height="24" />
								<path d="M14.2928932,16.7071068 C13.9023689,16.3165825 13.9023689,15.6834175 14.2928932,15.2928932 C14.6834175,14.9023689 15.3165825,14.9023689 15.7071068,15.2928932 L19.7071068,19.2928932 C20.0976311,19.6834175 20.0976311,20.3165825 19.7071068,20.7071068 C19.3165825,21.0976311 18.6834175,21.0976311 18.2928932,20.7071068 L14.2928932,16.7071068 Z" fill="#000000" fill-rule="nonzero" opacity="0.3" />
								<path d="M11,16 C13.7614237,16 16,13.7614237 16,11 C16,8.23857625 13.7614237,6 11,6 C8.23857625,6 6,8.23857625 6,11 C6,13.7614237 8.23857625,16 11,16 Z M11,18 C7.13400675,18 4,14.8659932 4,11 C4,7.13400675 7.13400675,4 11,4 C14.8659932,4 18,7.13400675 18,11 C18,14.8659932 14.8659932,18 11,18 Z" fill="#000000" fill-rule="nonzero" />
							</g>
						</svg>

						<!--end::Svg Icon-->
					</span>
				</div>
			</div>

			<!--end::Search-->

			<!--begin::Notifications-->
			<div class="dropdown">

				<!--begin::Toggle-->
				<div class="topbar-item mr-3" data-toggle="dropdown" data-offset="10px,0px">
					<div class="btn btn-icon btn-clean btn-dropdown btn-lg pulse pulse-primary">
						<span class="svg-icon svg-icon-xl">

							<i class="far fa-bell"></i>

							<!--end::Svg Icon-->
						</span>
						<span class="pulse-ring"></span>
					</div>
				</div>

				<!--end::Toggle-->

				<!--begin::Dropdown-->
				<div class="dropdown-menu p-0 m-0 dropdown-menu-right dropdown-menu-anim-up dropdown-menu-lg">
					<form>

						<!--[html-partial:include:{"file":"partials/_extras/dropdown/notifications.html"}]/-->
						@include('layouts.partials._extras.dropdown.notifications')
					</form>
				</div>

				<!--end::Dropdown-->
			</div>

			<!--end::Notifications-->

			<!--begin::Quick Actions-->
			<div class="dropdown">

				<!--begin::Toggle-->
				<div class="topbar-item mr-3" data-toggle="dropdown" data-offset="10px,0px">
					<div class="btn btn-icon btn-clean btn-dropdown btn-lg">
						<span class="svg-icon svg-icon-xl">

							<!--begin::Svg Icon | path:assets/media/svg/icons/Media/Equalizer.svg-->
							<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
								<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
									<rect x="0" y="0" width="24" height="24" />
									<rect fill="#000000" opacity="0.3" x="13" y="4" width="3" height="16" rx="1.5" />
									<rect fill="#000000" x="8" y="9" width="3" height="11" rx="1.5" />
									<rect fill="#000000" x="18" y="11" width="3" height="9" rx="1.5" />
									<rect fill="#000000" x="3" y="13" width="3" height="7" rx="1.5" />
								</g>
							</svg>

							<!--end::Svg Icon-->
						</span>
					</div>
				</div>

				<!--end::Toggle-->

				<!--begin::Dropdown-->
				<div class="dropdown-menu p-0 m-0 dropdown-menu-right dropdown-menu-anim-up dropdown-menu-lg">

					<!--[html-partial:include:{"file":"partials/_extras/dropdown/quick-actions.html"}]/-->
					@include('layouts.partials._extras.dropdown.quick-actions')
				</div>

				<!--end::Dropdown-->
			</div>

			<!--end::Quick Actions-->

			{{-- <!--begin::Chat-->
			<div class="topbar-item mr-5">
				<div class="btn btn-icon btn-clean btn-lg" data-toggle="modal" data-target="#kt_chat_modal">
					<span class="svg-icon svg-icon-xl">

						<!--begin::Svg Icon | path:assets/media/svg/icons/Communication/Group-chat.svg-->
						<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
							<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
								<rect x="0" y="0" width="24" height="24" />
								<path d="M16,15.6315789 L16,12 C16,10.3431458 14.6568542,9 13,9 L6.16183229,9 L6.16183229,5.52631579 C6.16183229,4.13107011 7.29290239,3 8.68814808,3 L20.4776218,3 C21.8728674,3 23.0039375,4.13107011 23.0039375,5.52631579 L23.0039375,13.1052632 L23.0206157,17.786793 C23.0215995,18.0629336 22.7985408,18.2875874 22.5224001,18.2885711 C22.3891754,18.2890457 22.2612702,18.2363324 22.1670655,18.1421277 L19.6565168,15.6315789 L16,15.6315789 Z" fill="#000000" />
								<path d="M1.98505595,18 L1.98505595,13 C1.98505595,11.8954305 2.88048645,11 3.98505595,11 L11.9850559,11 C13.0896254,11 13.9850559,11.8954305 13.9850559,13 L13.9850559,18 C13.9850559,19.1045695 13.0896254,20 11.9850559,20 L4.10078614,20 L2.85693427,21.1905292 C2.65744295,21.3814685 2.34093638,21.3745358 2.14999706,21.1750444 C2.06092565,21.0819836 2.01120804,20.958136 2.01120804,20.8293182 L2.01120804,18.32426 C1.99400175,18.2187196 1.98505595,18.1104045 1.98505595,18 Z M6.5,14 C6.22385763,14 6,14.2238576 6,14.5 C6,14.7761424 6.22385763,15 6.5,15 L11.5,15 C11.7761424,15 12,14.7761424 12,14.5 C12,14.2238576 11.7761424,14 11.5,14 L6.5,14 Z M9.5,16 C9.22385763,16 9,16.2238576 9,16.5 C9,16.7761424 9.22385763,17 9.5,17 L11.5,17 C11.7761424,17 12,16.7761424 12,16.5 C12,16.2238576 11.7761424,16 11.5,16 L9.5,16 Z" fill="#000000" opacity="0.3" />
							</g>
						</svg>

						<!--end::Svg Icon-->
					</span>
				</div>
			</div>

			<!--end::Chat--> --}}

			<!--begin::User-->
			<div class="topbar-item">
				<div class="btn btn-icon btn-icon-mobile w-auto btn-clean d-flex align-items-center btn-lg px-2" id="kt_quick_user_toggle">
					<span class="text-muted font-weight-bold font-size-base d-none d-md-inline mr-1">Hi,</span>
					<span class="text-dark-50 font-weight-bolder font-size-base d-none d-md-inline mr-3">{{ ucfirst(strtok(auth()->user()->name, " ")) }}</span>
					<span class="symbol symbol-lg-35 symbol-25 symbol-light-success">
						<span class="symbol-label font-size-h5 font-weight-bold">
							{{ substr(ucfirst(strtok(auth()->user()->name, " ")), 0, 1) }}
						</span>
					</span>
				</div>
			</div>

			<!--end::User-->
		</div>

		<!--end::Topbar-->
	</div>

	<!--end::Container-->
</div>

<!--end::Header-->