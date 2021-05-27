@extends('layouts.app')

@section('breadcrumbs')
    {{ Breadcrumbs::render('order-history-show') }}
@endsection

@section('content')
<div class="d-flex flex-row">
    <!--begin::Aside-->
    @include('user._aside')
    <!--end::Aside-->
    <!--begin::Content-->
    <div class="flex-row-fluid ml-lg-8">
        <!--begin::Card-->
        <div class="card card-custom">
            
            <!--begin::Header-->
            <div class="card-header py-3 d-flex justify-content-between">
                <div class="card-title align-items-start flex-column mb-0">
                    <h3 class="card-label font-weight-bolder text-dark">Order History Detail</h3>
                    <span class="text-muted font-weight-bold font-size-sm mt-1">This is your order history detail</span>
                </div>
            </div>
            <!--end::Header-->
            <div class="card card-custom gutter-b">
                <div class="card-body p-0">
                    <!-- begin: Invoice-->
                    <!-- begin: Invoice header-->
                    <div class="row justify-content-center py-8 px-8 py-md-27 px-md-0">
                        <div class="col-md-10">
                            <div class="d-flex justify-content-between pb-10 pb-md-20 flex-column flex-md-row">
                                <h1 class="display-4 font-weight-boldest mb-10">ORDER DETAILS</h1>                                   
                                <div class="d-flex flex-column align-items-md-end px-0">
                                    <span class="d-flex flex-column align-items-md-end">
                                        @if ($data->approval_status == 'Accepted')
                                            <img src="{{ asset($slot_user->qr_code) }}" class="h-200px w-200px" alt="">                                                                                    
                                        @endif
                                    </span>
                                </div>
                            </div>
                            <div class="border-bottom w-100"></div>
                            <div class="d-flex justify-content-between pt-6">
                                <div class="d-flex flex-column flex-root">
                                    <span class="font-weight-bolder mb-2">Package</span>
                                    <span class="opacity-70">{{ $data->booking_detail->package->name }}</span>
                                </div>
                                <div class="d-flex flex-column flex-root">
                                    <span class="font-weight-bolder mb-2">Stable</span>
                                    <span class="opacity-70">{{ $data->booking_detail->package->stable->name }}</span>
                                </div>
                                <div class="d-flex flex-column flex-root">
                                    <span class="font-weight-bolder mb-2">Date & Time</span>
                                    <span class="opacity-70">
                                        Date : {{ date('D, M d Y', strtotime($slot->date)) }}
                                    </span>
                                    <span class="opacity-70">
                                        Time : {{ date('H:i', strtotime($slot->time_start)) . ' - ' . date('H:i', strtotime($slot->time_end)) }}
                                    </span>
                                    @php
                                        $data_slot = DB::table('slot_user')->where('booking_detail_id', $data->booking_detail->id)->count();
                                    @endphp
                                    @if ($data->approval_status == 'Accepted')                                        
                                        @if ($data_slot > 1)
                                            <button class="btn btn-primary mt-3" disabled>You Cannot Reschedule Again</button>
                                        @else
                                            <a href="javascript:;" data-toggle="modal" data-target="#modalReschedule" class="btn btn-primary mt-3">Reschedule</a>                                            
                                        @endif
                                    @endif
                                </div>
                            </div>
                            <div class="d-flex justify-content-between pt-6">
                                <div class="d-flex flex-column flex-root">
                                    <span class="font-weight-bolder mb-2">ORDER DATE</span>
                                    <span class="opacity-70">{{ date('D, M d Y', strtotime($data->created_at)) }}</span>
                                </div>
                                <div class="d-flex flex-column flex-root">
                                    <span class="font-weight-bolder mb-2">ORDER NO.</span>
                                    <span class="opacity-70">{{ $data->id }}</span>
                                </div>
                                <div class="d-flex flex-column flex-root">
                                    <span class="font-weight-bolder mb-2">Stable Address</span>
                                    <span class="opacity-70">{{ $data->booking_detail->package->stable->address }},</span>
                                    <span class="opacity-70">{{ $data->booking_detail->package->stable->village->name }},</span>
                                    <span class="opacity-70">{{ $data->booking_detail->package->stable->district->name }},</span>
                                    <span class="opacity-70">{{ $data->booking_detail->package->stable->city->name }},</span>
                                    <span class="opacity-70">{{ $data->booking_detail->package->stable->province->name }}.</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end: Invoice header-->
                    <!-- begin: Invoice footer-->
                    <div class="row justify-content-center bg-gray-100 py-8 px-8 py-md-10 px-md-0 mx-0">
                        <div class="col-md-10">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th class="font-weight-bold text-muted text-uppercase">PAYMENT BRANCH</th>
                                            <th class="font-weight-bold text-muted text-uppercase">PAYMENT ACCOUNT NUMBER</th>
                                            <th class="font-weight-bold text-muted text-uppercase">PAYMENT STATUS</th>
                                            <th class="font-weight-bold text-muted text-uppercase text-right">TOTAL PAID</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr class="font-weight-bolder">
                                            <td>{{ $data->bank->branch }}</td>
                                            <td>{{ $data->bank->account_number }}</td>
                                            <td>
                                                @if ($data->approval_status == NULL)
                                                    Pending Approval
                                                @else
                                                    {{ $data->approval_status }}                                            
                                                @endif
                                            </td>
                                            <td class="text-primary font-size-h3 font-weight-boldest text-right">Rp. {{number_format($data->price_total, 0,',', '.') }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!-- end: Invoice footer-->
                    <!-- end: Invoice-->

                </div>
            </div>
        </div>
    </div>
    <!--end::Content-->
</div>
<!-- Modal -->
<div class="modal fade" id="modalReschedule" tabindex="-1" role="dialog" aria-labelledby="modalReschedulePony" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header justify-content-end">										
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <div class="modal-body justify-content-center">
                <h2 class="title-text ">
                    RESCHEDULE
                </h2>
                <p class="title-desc">
                    You have only one chance to rescheduling package
                </p>
                <form method="POST" action="{{route('user.order_history.reschedule')}}">
                    @csrf
                    @if($slot)
                            <input type="hidden" name="id" value="{{ $slot_user->id }}">
                            <input type="hidden" name="bkid" value="{{ $data->id }}">
                            <input type="hidden" name="uid" value="{{ Auth::user()->id }}">
                            <div class="form-group d-flex justify-content-center">
                                <div id="datePicker" data-id="{{$slot->user_id}}">                                        
                                    <input type="hidden" name="date" value="" id="my_hidden_input">
                                </div>
                            </div>
                            <div class="form-group d-flex justify-content-center">
                                <select name="time" id="selectTime" class="form-control w-100">
                                </select>
                            </div>             
                    @else
                    @endif
                </div>
                <div class="modal-footer">											
                    <button class="btn btn-secondary" data-dismiss="modal">RESET</button>
                    <button type="submit" class="btn btn-primary font-weight-bold">SAVE</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
@push('page-scripts')
<script>
    $('#datePicker').datepicker({
        format   : 'yyyy-mm-dd',
        startDate: new Date(),
    }).on('changeDate', function(e) {
        var id = $(this).data('id');       
        var $time = $("#selectTime");
        $.ajax({
            type: "GET",
            url: '{{ route("user.order_history.index") }}/slots',
            data: {
                date: e.date.toDateString(),
                id: id
            },
            dataType: 'json',
            success: function(data) {
                $time.empty();
                console.log(data);
                var len = 0;
                if(data != null){
                    len = data.length;
                }

                if(len > 0){
                // Read data and create <option >
                for(var i=0; i<len; i++){

                    var start = data[i].time_start;
                    var end = data[i].time_end;

                    var option = "<option value='"+start+"-"+end+"'>"+start+"-"+end+"</option>"; 

                    $time.append(option); 
                }
                $time.select2();
                }
            },
            error: function (error) {
                console.log(error);
            }
        });
    });
    $('#selectTime').select2({
        dropdownParent: $('#modalReschedule')
    });
</script>
@endpush
