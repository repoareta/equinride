<?php

namespace App\Http\Controllers\AppOwner;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

// load model
use App\Models\Booking;

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
        $data = Booking::where('approval_status', null)->get();
        return datatables()->of($data)
        ->addIndexColumn()
        ->addColumn('name', function ($data) {
            return $data->user->name;
        })        
        ->editColumn('photo', function ($data) {
            return $data->photo ? '
                <a href="' . asset('storage/booking/photo/'.$data->photo) . '" target="_blank"><img src="' 
                . asset('storage/booking/photo/'.$data->photo) . '" class="max-w-200px h-40px"></a>
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
        
        ->rawColumns(['photo','action','approval_status'])
        ->make(true);
    }
    public function jsonApproved()
    {
        $data = Booking::where('approval_status', 'Accepted')->get();
        return datatables()->of($data)
        ->addIndexColumn()
        ->addColumn('name', function ($data) {
            return $data->user->name;
        })        
        ->editColumn('photo', function ($data) {
            return $data->photo ? '
                <a href="' . asset('storage/booking/photo/'.$data->photo) . '" target="_blank"><img src="' 
                . asset('storage/booking/photo/'.$data->photo) . '" class="max-w-200px h-40px"></a>
            ' : '';
        })
        ->addColumn('approval_status', function () {
            return 
                "<span class='label font-weight-bold label-lg  label-light-success label-inline'>
                    Accepted
                </span>";
        })
        ->addColumn('bank', function ($data) {
            return $data->bank->account_name;
        })
        ->addColumn('action', function ($data) {
            return
            "
            <a href='javascript:void(0)' data-toggle='modal' data-id='".$data->id."' class='btn btn-info text-center mr-2' id='openBtn'>
                <i class='fas fa-eye'></i>
            </a>
            ";
        })
        
        ->rawColumns(['photo','action','approval_status'])
        ->make(true);
    }
    public function jsonUnapproved()
    {
        $data = Booking::where('approval_status', 'Decline')->get();
        return datatables()->of($data)
        ->addIndexColumn()
        ->addColumn('name', function ($data) {
            return $data->user->name;
        })        
        ->editColumn('photo', function ($data) {
            return $data->photo ? '
                <a href="' . asset('storage/booking/photo/'.$data->photo) . '" target="_blank"><img src="' 
                . asset('storage/booking/photo/'.$data->photo) . '" class="max-w-200px h-40px"></a>
            ' : '';
        })
        ->addColumn('approval_status', function () {
            return 
                "<span class='label font-weight-bold label-lg  label-light-danger label-inline'>
                    Decline
                </span>";
        })
        ->addColumn('bank', function ($data) {
            return $data->bank->account_name;
        })
        ->addColumn('action', function ($data) {
            return
            "
            <a href='javascript:void(0)' data-toggle='modal' data-id='".$data->id."' class='btn btn-info text-center mr-2' id='openBtn'>
                <i class='fas fa-eye'></i>
            </a>
            ";
        })
        
        ->rawColumns(['photo','action','approval_status'])
        ->make(true);
    }

    public function show($id)
    {
        $booking = Booking::with(['bank','user','approvalby_booking'])->find($id);
        return response()->json($booking);
    }

    public function approvBooking($id)
    {
        $data = Booking::find($id);
        Booking::where('id', $data->id)->update([
            'approval_status' => 'Accepted',
            'approval_by' => Auth::user()->id,
            'approval_at' => Carbon::now()
        ]);

        foreach ($data->booking_detail as $key => $row) {
            $image = QrCode::format('png')
                ->size(200)
                ->generate(url("/booking-detail/$row->id/confirmation"));

            $output_file = '/img/qr-code/img-' . time() . '.png';

            Storage::disk('public')->put($output_file, $image);

            $row->qr_code = $output_file;
            $row->save();

            sleep(1); // add delay 1 seconds
        }

        

        Alert::success($data->name.' Accepted', 'Success.')->persistent(true)->autoClose(3600);
        return redirect()->back();
    }
    public function unapprovBooking($id)
    {
        $data = Booking::find($id);
        Booking::where('id', $data->id)->update([
            'approval_status' => 'Decline',
            'approval_by' => Auth::user()->id,
            'approval_at' => Carbon::now()
        ]);

        Alert::success($data->name.' Decline', 'Success.')->persistent(true)->autoClose(3600);
        return redirect()->back();
    }
}
