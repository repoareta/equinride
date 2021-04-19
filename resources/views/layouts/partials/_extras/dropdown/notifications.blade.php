
<!--begin::Header-->
<div class="d-flex flex-column pt-12 bgi-size-cover bgi-no-repeat rounded-top" style="background-image: url({{ asset('assets/media/misc/bg-1.jpg') }})">

	<!--begin::Title-->
	{{-- <h4 class="d-flex flex-center rounded-top">
		<span class="text-white">User Notifications</span>
		<span class="btn btn-text btn-success btn-sm font-weight-bold btn-font-md ml-2">23 new</span>
	</h4> --}}

	<!--end::Title-->

	<!--begin::Tabs-->
	<ul class="nav nav-bold nav-tabs nav-tabs-line nav-tabs-line-3x nav-tabs-line-transparent-white nav-tabs-line-active-border-success mt-3 px-8" role="tablist">
		<li class="nav-item">
			<a class="nav-link active show" data-toggle="tab" href="#topbar_notifications_notifications">Notifications</a>
		</li>
		{{-- <li class="nav-item">
			<a class="nav-link" data-toggle="tab" href="#topbar_notifications_events">Events</a>
		</li> --}}
	</ul>

	<!--end::Tabs-->
</div>

<!--end::Header-->

<!--begin::Content-->
<div class="tab-content">

	<!--begin::Tabpane-->
	<div class="tab-pane active show" id="topbar_notifications_notifications" role="tabpanel">

		@if(count(Auth::user()->unreadNotifications) == 0)
		<!--begin::Nav-->
			<div class="d-flex flex-center text-center text-muted min-h-200px">All caught up!
				<br>No new notifications.
			</div>
		<!--end::Nav-->
		@else

		<!--begin::Nav-->
		<div class="navi navi-hover scroll my-4" data-scroll="true" data-height="300" data-mobile-height="200">

			
			@foreach(Auth::user()->unreadNotifications as $notification)
		
			<!--begin::Item-->
			<a href="#" class="navi-item">
				<div class="navi-link">
					<div class="navi-icon mr-2">
						<i class="la la-horse-head text-success"></i>
					</div>
					<div class="navi-text">
						<div class="font-weight-bold">
							{{ $notification->data['message'] }}
						</div>
						<div class="text-muted">
							{{ \Carbon\Carbon::createFromTimeStamp(strtotime($notification->created_at))->diffForHumans()  }}
						</div>
					</div>
				</div>
			</a>

			<!--end::Item-->
			@endforeach
		</div>
		<!--end::Nav-->
		@endif
	</div>

	<!--end::Tabpane-->
</div>

<!--end::Content-->