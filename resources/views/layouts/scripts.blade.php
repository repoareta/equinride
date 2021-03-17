<!--begin::Global Config(global config for global JS scripts)-->
<script>
    var KTAppSettings = {
        "breakpoints": {
            "sm": 576,
            "md": 768,
            "lg": 992,
            "xl": 1200,
            "xxl": 1200
        },
        "colors": {
            "theme": {
                "base": {
                    "white": "#ffffff",
                    "primary": "#8950FC",
                    "secondary": "#E5EAEE",
                    "success": "#1BC5BD",
                    "info": "#8950FC",
                    "warning": "#FFA800",
                    "danger": "#F64E60",
                    "light": "#F3F6F9",
                    "dark": "#212121"
                },
                "light": {
                    "white": "#ffffff",
                    "primary": "#E1E9FF",
                    "secondary": "#ECF0F3",
                    "success": "#C9F7F5",
                    "info": "#EEE5FF",
                    "warning": "#FFF4DE",
                    "danger": "#FFE2E5",
                    "light": "#F3F6F9",
                    "dark": "#D6D6E0"
                },
                "inverse": {
                    "white": "#ffffff",
                    "primary": "#ffffff",
                    "secondary": "#212121",
                    "success": "#ffffff",
                    "info": "#ffffff",
                    "warning": "#ffffff",
                    "danger": "#ffffff",
                    "light": "#464E5F",
                    "dark": "#ffffff"
                }
            },
            "gray": {
                "gray-100": "#F3F6F9",
                "gray-200": "#ECF0F3",
                "gray-300": "#E5EAEE",
                "gray-400": "#D6D6E0",
                "gray-500": "#B5B5C3",
                "gray-600": "#80808F",
                "gray-700": "#464E5F",
                "gray-800": "#1B283F",
                "gray-900": "#212121"
            }
        },
        "font-family": "Poppins"
    };
</script>

<!--end::Global Config-->

<!--begin::Global Theme Bundle(used by all pages)-->
<script src="{{ asset('assets/plugins/global/plugins.bundle.js') }}"></script>
<script src="{{ asset('assets/plugins/custom/prismjs/prismjs.bundle.js') }}"></script>
<script src="{{ asset('assets/js/scripts.bundle.js') }}"></script>

<!--end::Global Theme Bundle-->
{{-- 
<!--begin::Page Vendors(used by this page)-->
<script src="assets/plugins/custom/fullcalendar/fullcalendar.bundle.js"></script>
<script src="assets/plugins/custom/leaflet/leaflet.bundle.js"></script> 
<!--end::Page Vendors-->
--}}
<!--begin::Page Scripts(used by this page)-->
<script src="{{ asset('assets/js/pages/widgets.js') }}"></script>
<script src="{{ asset('assets/js/pages/custom/profile/profile.js') }}"></script>
<script src="{{ asset('js/app.js') }}"></script>

<script>
    Echo.channel('events')
        .listen('RealTimeMessage', (e) => console.log('RealTimeMessage: ' + e.message));
</script>

@php
foreach(DB::table('bookings')->where('photo', null)->where('approval_status', null)->get() as $item)
{
    $time_start = strtotime($item->created_at);
    $time_end   = strtotime(now());

    //menghitung selisih dengan hasil detik
    $diff =$time_end - $time_start;
    if ($diff > 3600) {
        DB::table('bookings')->where('id',$item->id)
        ->update([
            'approval_status' => "Expired"
        ]);
        foreach(DB::table('booking_details')->where('booking_id',$item->id)->get() as $row)
        {
            $data_slot = DB::table('slot_user')->select('slot_id')->where('booking_detail_id',  $row->id)->groupBy('slot_id')->get();
            foreach($data_slot as $item)
            {  
                $data_slots = DB::table('slots')->select('capacity_booked')->where('id', $item->slot_id)->get();
                foreach ($data_slots as $row1) {
                    # code...
                    $count = DB::table('slot_user')->where('slot_id',  $item->slot_id)->where('booking_detail_id',  $row->id)->count();
                    $slot = DB::table('slots')->where('id',$item->slot_id)
                    ->update([
                        'capacity_booked' => $row1->capacity_booked - $count,
                    ]);
                }
            }     
            DB::table('slot_user')->where('booking_detail_id',$row->id)->delete();
        }
    }
}
@endphp
@stack("page-scripts")

<!--end::Page Scripts-->
