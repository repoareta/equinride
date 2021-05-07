<?php

namespace App\Http\Controllers\AppOwner;

use App\Http\Controllers\Controller;
use App\Mail\SendNotifUserPaymentApproveMail;
use App\Mail\SendNotifUserPaymentDeclineMail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

// load model
use App\Models\Booking;
use App\Models\Package;
use App\Models\User;

// load plugin
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;

class UserPaymentApprovalController extends Controller
{
    public function index()
    {
        return view('app-owner.payment.verification');
    }

    public function jsonPending()
    {
        $data = Booking::where('approval_status', null)
                ->with('booking_detail.package')
                ->with('booking_detail.package.stable')->get();
        return datatables()->of($data)
        ->addIndexColumn()
        ->addColumn('package', function ($data) {            
            return
            '
            <div class="d-flex align-items-center">
                <div class="symbol symbol-50 flex-shrink-0">
                    <img src="'. asset($data->booking_detail->package->photo) .'" alt="photo">
                </div>
                <div class="ml-3">
                    <span class="text-dark-75 font-weight-bold line-height-sm d-block pb-2">
                    '.$data->booking_detail->package->name.'
                    </span>
                    <a href="#" class="text-muted text-hover-primary">
                    '.$data->booking_detail->package->stable->name.' | Rp. '.$data->price_total.'
                    </a>
                </div>
            </div>
            ';
        })
        ->addColumn('name', function ($data) {
            return $data->user->name;
        })     
        ->addColumn('pay_date', function($data){
            return date('D, M d Y', strtotime($data->created_at));
        })   
        ->editColumn('photo', function ($data) {
            return $data->photo ? '
                <a href="' . asset($data->photo) . '" target="_blank"><img src="' 
                . asset($data->photo) . '" class="max-w-200px h-40px"></a>
            ' : '';
        })
        ->addColumn('approval_status', function () {
            return 
                "<span class='label font-weight-bold label-lg  label-light-warning label-inline'>
                    Pending
                </span>";
        })
        ->addColumn('account_name', function ($data) {
            return $data->bank->account_name;
        })
        ->addColumn('account_number', function ($data) {
            return $data->bank->account_number;
        })
        ->addColumn('action', function ($data) {
            return 
            "
            <a href='javascript:void(0)' data-toggle='modal' data-id='".$data->id."' class='btn btn-clean btn-icon mr-2' id='openBtn' data-toggle='Detail' data-placement='top' title='Detail'>
                <i class='fas fa-eye'></i>
            </a>
            <form class='d-inline' id='formAccept".$data->id."' method='post' action='" . route('app_owner.payment.approve',$data->id) . "'>
            " . method_field('PUT') . csrf_field() . "
                <button class='btn btn-clean btn-icon mr-2' type='submit' id='accept".$data->id."' data-toggle='Accept' data-placement='top' title='Accept'>
                    <i class='fas fa-check-circle'></i>
                </button>
            </form>
            <form class='d-inline' id='formDecline".$data->id."' method='post' action='" . route('app_owner.payment.unapprove',$data->id) . "'>
            " . method_field('PUT') . csrf_field() . "
                <button class='btn btn-clean btn-icon mr-2' type='submit' id='decline".$data->id."' data-toggle='Decline' data-placement='top' title='Decline'>
                <i class='fas fa-ban'></i>
                </button>
            </form>

            <script>
                $('tbody').on('click','#accept".$data->id."', function(e) {
        
                    e.preventDefault();
                        
                    Swal.fire({
                        title: 'Are you sure?',
                        icon: 'warning',
                        text: 'This is will be accepted the stable',
                        type: 'warning',
                        showCancelButton: true,
                        confirmButtonText: 'Accept',
                        cancelButtonText: 'Cancel',
                        closeOnConfirm: false,
                        closeOnCancel: false
                    }).then(function(getAction) {
                        if (getAction.value === true) {
                            $('#formAccept".$data->id."').submit();
                        }
                    });
                });

                $('tbody').on('click','#decline".$data->id."', function(e) {
        
                    e.preventDefault();
                        
                    Swal.fire({
                        title: 'Are you sure?',
                        icon: 'warning',
                        text: 'This is will be declined the stable',
                        type: 'warning',
                        showCancelButton: true,
                        confirmButtonText: 'Accept',
                        cancelButtonText: 'Cancel',
                        closeOnConfirm: false,
                        closeOnCancel: false
                    }).then(function(getAction) {
                        if (getAction.value === true) {
                            $('#formDecline".$data->id."').submit();
                        }
                    });
                });
            </script>
            ";
        })
        
        ->rawColumns(['photo','action','approval_status','package'])
        ->make(true);
    }
    public function jsonApproved()
    {
        $data = Booking::where('approval_status', 'Accepted')
                ->with('booking_detail.package')
                ->with('booking_detail.package.stable')->get();
        return datatables()->of($data)
        ->addIndexColumn()
        ->addColumn('package', function ($data) {            
            return
            '
            <div class="d-flex align-items-center">
                <div class="symbol symbol-50 flex-shrink-0">
                    <img src="'. asset($data->booking_detail->package->photo) .'" alt="photo">
                </div>
                <div class="ml-3">
                    <span class="text-dark-75 font-weight-bold line-height-sm d-block pb-2">
                    '.$data->booking_detail->package->name.'
                    </span>
                    <a href="#" class="text-muted text-hover-primary">
                    '.$data->booking_detail->package->stable->name.' | Rp. '.$data->price_total.'
                    </a>
                </div>
            </div>
            ';
        })
        ->addColumn('name', function ($data) {
            return $data->user->name;
        })     
        ->addColumn('pay_date', function($data){
            return date('D, M d Y', strtotime($data->created_at));
        })   
        ->editColumn('photo', function ($data) {
            return $data->photo ? '
                <a href="' . asset($data->photo) . '" target="_blank"><img src="' 
                . asset($data->photo) . '" class="max-w-200px h-40px"></a>
            ' : '';
        })
        ->addColumn('approval_status', function () {
            return 
                "<span class='label font-weight-bold label-lg  label-light-success label-inline'>
                    Accepted
                </span>";
        })
        ->addColumn('account_name', function ($data) {
            return $data->bank->account_name;
        })
        ->addColumn('account_number', function ($data) {
            return $data->bank->account_number;
        })
        ->addColumn('action', function ($data) {
            return
            "
            <a href='javascript:void(0)' data-toggle='modal' data-id='".$data->id."' class='btn btn-clean btn-icon mr-2' id='openBtn'>
                <i class='fas fa-eye'></i>
            </a>
            ";
        })
        
        ->rawColumns(['photo','action','approval_status','package'])
        ->make(true);
    }
    public function jsonUnapproved()
    {
        $data = Booking::where('approval_status', 'Decline')
                ->with('booking_detail.package')
                ->with('booking_detail.package.stable')->get();
        return datatables()->of($data)
        ->addIndexColumn()
        ->addColumn('package', function ($data) {            
            return
            '
            <div class="d-flex align-items-center">
                <div class="symbol symbol-50 flex-shrink-0">
                    <img src="'. asset($data->booking_detail->package->photo) .'" alt="photo">
                </div>
                <div class="ml-3">
                    <span class="text-dark-75 font-weight-bold line-height-sm d-block pb-2">
                    '.$data->booking_detail->package->name.'
                    </span>
                    <a href="#" class="text-muted text-hover-primary">
                    '.$data->booking_detail->package->stable->name.' | Rp. '.$data->price_total.'
                    </a>
                </div>
            </div>
            ';
        })
        ->addColumn('name', function ($data) {
            return $data->user->name;
        })        
        ->addColumn('pay_date', function($data){
            return date('D, M d Y', strtotime($data->created_at));
        })
        ->editColumn('photo', function ($data) {
            return $data->photo ? '
                <a href="' . asset($data->photo) . '" target="_blank"><img src="' 
                . asset($data->photo) . '" class="max-w-200px h-40px"></a>
            ' : '';
        })
        ->addColumn('approval_status', function () {
            return 
                "<span class='label font-weight-bold label-lg  label-light-danger label-inline'>
                    Decline
                </span>";
        })        
        ->addColumn('account_name', function ($data) {
            return $data->bank->account_name;
        })
        ->addColumn('account_number', function ($data) {
            return $data->bank->account_number;
        })
        ->addColumn('action', function ($data) {
            return
            "
            <a href='javascript:void(0)' data-toggle='modal' data-id='".$data->id."' class='btn btn-clean btn-icon mr-2' id='openBtn'>
                <i class='fas fa-eye'></i>
            </a>
            ";
        })
        
        ->rawColumns(['photo','action','approval_status','package'])
        ->make(true);
    }

    public function show($id)
    {
        $booking = Booking::with(['bank','user','approvalby_booking'])
                    ->with('booking_detail.package')
                    ->with('booking_detail.package.stable')->find($id);
        return response()->json($booking);
    }

    public function approveBooking($id)
    {
        $data = Booking::find($id);
        Booking::where('id', $data->id)->update([
                'approval_status' => 'Accepted',
                'approval_by' => Auth::user()->id,
                'approval_at' => Carbon::now()
            ]);
        $bookingDetail = $data->booking_detail;
        $cek_package = Package::find($bookingDetail->package_id); 

        // Cek Package Regular atau Pony Ride
        if($cek_package->session_usage == null){
            $image = QrCode::format('png')
                ->size(200)
                ->generate(url("/booking-detail/$bookingDetail->id/confirmation"));

            $output_file = '/img/qr-code/img-' . time() . $bookingDetail->id . '.png';

            Storage::disk('public')->put($output_file, $image);

            $bookingDetail->qr_code = $output_file;
            $bookingDetail->save();
        }else{
            
            $slot_user = DB::table('slot_user')
            ->where('booking_detail_id', $bookingDetail->id)
            ->get();
            
            $user = User::find($data->user_id);
            $user->notify(new SendNotifUserPaymentApproveMail($cek_package));

            foreach($slot_user as $user){
                DB::table('slot_user')->where('id',$user->id)->update([
                    'qr_code_status' => 'Accepted'
                ]);
            }                
        }

        Alert::success($data->name.' Accepted', 'Success.')->persistent(true)->autoClose(3600);
        return redirect()->back();
    }
    public function unapproveBooking($id)
    {
        $data = Booking::find($id);
        Booking::where('id', $data->id)->update([
            'approval_status' => 'Decline',
            'approval_by' => Auth::user()->id,
            'approval_at' => Carbon::now()
        ]);

        $bookingDetail = $data->booking_detail;
        $cek_package = Package::find($bookingDetail->package_id); 

        $user = User::find($data->user_id);
            $user->notify(new SendNotifUserPaymentDeclineMail($cek_package));

        Alert::success($data->name.' Decline', 'Success.')->persistent(true)->autoClose(3600);
        return redirect()->back();
    }
}
