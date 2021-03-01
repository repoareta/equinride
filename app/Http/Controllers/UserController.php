<?php

namespace App\Http\Controllers;

use App\Http\Traits\MediaUploadingTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Storage;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;
use Yajra\DataTables\Facades\DataTables;
use Carbon\Carbon;

// Load models
use App\Models\User;
use App\Models\Booking;
use App\Models\BookingDetail;
use App\Models\Package;
use App\Models\Slot;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    use MediaUploadingTrait;

    // Personal Information page index
    public function index()
    {
        return view('user.personal-information');
    }

    // Personal Information update data
    public function update(Request $request)
    {
        $user = User::find(Auth::user()->id);

        $user->name       = $request->name;
        $user->sex        = $request->sex;
        $user->phone      = $request->phone;
        $user->height     = $request->height;
        $user->weight     = $request->weight;
        $user->birth_date = $request->birth_date;
        $user->address    = $request->address;

        if ($request->photo) {
            // delete old photo
            File::delete($user->photo);
            $user->photo = $request->photo;
        }
        
        $user->save();

        Alert::success('Update Profile Success.', 'Success.')->persistent(true)->autoClose(3600);
        return redirect()->back();
    }

    // Change Password page index
    public function changePassword()
    {
        return view('user.change-password');
    }

    // Change Password update data
    public function changePasswordUpdate(Request $request)
    {
        $user = User::where('id', Auth::user()->id)->first();
        
        if (Hash::check($request->old_password, $user->password)) {
            $validator = Validator::make($request->all(), [
                'password' => 'required|confirmed|min:8',
            ]);

            if ($validator->fails()) {
                Alert::error('Something wrong.', 'Decline.')->persistent(true)->autoClose(3600);
                return redirect()->back();
            }

            $user->password = Hash::make($request->password);
            $user->update();

            Alert::success('Password Updated', 'Success.')->persistent(true)->autoClose(3600);
            return redirect()->back();
        }

        Alert::error('Something wrong.', 'Decline.')->persistent(true)->autoClose(3600);
        return redirect()->back();
    }

    // Order History page index
    public function orderHistory()
    {
        $bookingDetails = BookingDetail::whereHas('booking', function ($q) {
            $q->where('user_id', Auth::user()->id);
        })
        ->with('booking')
        ->with('package')
        ->with('package.stable')
        ->orderBy('id', 'desc')
        ->get();

        if (request()->ajax()) {
            return Datatables::of($bookingDetails)
                ->addIndexColumn()
                ->addColumn('package', function ($row) {
                    return
                    '
                    <div class="d-flex align-items-center">
                        <div class="symbol symbol-50 symbol-sm flex-shrink-0">
                            <div class="symbol-label">
                                <img class="h-100 w-100 align-self-center" src="'. asset($row->package->photo) .'" alt="photo">
                            </div>
                        </div>
                        <div class="d-flex flex-column ml-3">
                            <div class="text-primary font-weight-bolder font-size-lg">'.$row->package->name.'</div>
                            <span class="text-muted font-weight-bold font-size-sm">
                            '.$row->package->stable->name.'
                            </span>
                        </div>
                    </div>
                    ';
                })
                ->addColumn('created_at', function ($row) {
                    return date('D, M d Y', strtotime($row->created_at));
                })
                ->addColumn('approval_status', function ($row) {
                    $status = $row->booking->approval_status;
                    if ($status == null) {
                        return "<span class='label font-weight-bold label-lg  label-light-warning label-inline'>Pending</span>";
                    } elseif ($status == 'Accepted') {
                        return "<span class='label font-weight-bold label-lg  label-light-success label-inline'>".$status."</span>";
                    } else {
                        return "<span class='label font-weight-bold label-lg  label-light-danger label-inline'>".$status."</span>";
                    }
                })
                ->addColumn('order_location', function ($row) {
                    return $row->package->stable->address;
                })
                ->addColumn('price_total', function ($row) {
                    $price = number_format($row->booking->price_total, 0, ',', '.');
                    return '<span class="float-right">Rp. '.$price.'</span>';
                })
                ->addColumn('action', function ($item) {
                    if ($item->approval_status == 'Close') {
                        return
                            '
                            <td nowrap="nowrap">
                                <a href="#" class="btn btn-clean btn-icon mr-2" title="Edit">
                                    <i class="la la-eye icon-xl"></i>
                                </a>
                                <a href="#" class="btn btn-clean btn-icon mr-2" title="Detail">
                                    <i class="far fa-star"></i>
                                </a>
                            </td>
                            ';
                    } else {
                        if ($item->photo == null) {
                            if ($item->approval_status == null) {
                                return '
                                    <td nowrap="nowrap">
                                        <a href="'. route('user.order_history.pay',$item->booking->id) .'" class="label font-weight-bold label-lg  label-light-danger label-inline mr-2">
                                            Pay
                                        </a>
                                    </td>
                                    ';
                            } else {
                                return '
                                    <td nowrap="nowrap">
                                        <a href="#" class="btn btn-danger btn-icon mr-2" disabled>
                                            <i class="fa fa-ban"></i>
                                        </a>
                                    </td>
                                    ';
                            }
                        } else {
                            return '
                                <td nowrap="nowrap">
                                    <a href="'. route('user.order_history.show', $item->booking->id) .'" class="btn btn-clean btn-icon mr-2" title="Edit">
                                        <i class="la la-eye icon-xl"></i>
                                    </a>
                                </td>
                                ';
                        }
                    }
                })
                ->rawColumns(['action', 'approval_status', 'package', 'price_total'])
                ->make();
        }
        return view('booking.booking-history');
    }

    // Order History Detail
    public function orderHistoryShow($id)
    {
        $data = Booking::with(['bank','booking_detail', 'booking_detail.package', 'booking_detail.package.stable'])->find($id);
        $slot_user = DB::table('slot_user')->where('booking_detail_id', $data->booking_detail->id)->count();
        if ($slot_user > 1) {
            $slot_user = DB::table('slot_user')->where('booking_detail_id', $data->booking_detail->id)->get()->last();
            $slot = Slot::find($slot_user->slot_id);
            return view('booking.booking-history-detail', compact('data', 'slot_user', 'slot'));
        }
        if ($slot_user = 1) {
            $slot_user = DB::table('slot_user')->where('booking_detail_id', $data->booking_detail->id)->first();
            $slot = Slot::find($slot_user->slot_id);
            return view('booking.booking-history-detail', compact('data', 'slot_user', 'slot'));
        }
    }

    public function slots(Request $request)
    {
        if ($request->ajax()) {
            $slot = Slot::where('date', $request->date)->where('user_id', $request->id)->get();
            return response()->json($slot);
        }
    }

    public function reschedule(Request $request)
    {
        DB::beginTransaction();
        $booking = Booking::find($request->bkid);

        if ($booking->user_id != $request->uid) {
            Alert::error('Reschedule Error.', 'Check your own data.');
            return redirect()->back();
        }
        
        if ($booking->booking_detail->package->session_usage == null) {
            $booking->booking_detail->queue_status = 'Reschedule';
            $booking->booking_detail->update();

            if (!$booking->booking_detail) {
                DB::rollback();
                Alert::error('Reschedule Error.', 'Check your own data 1.');
                return redirect()->back();
            }

            $noUrutAkhir = BookingDetail::where('package_id', $booking->booking_detail->package->id)->whereDate('booking_at', '=', Carbon::parse($request->date)->toDateString())->max('queue_no');
            if ($noUrutAkhir) {
                $noUrutAkhir  = sprintf("%03s", abs($noUrutAkhir + 1));
            } else {
                $noUrutAkhir = sprintf("%03s", 1);
            }
            $Query1 = new BookingDetail();
            $Query1->package_id = $booking->booking_detail->package_id;
            $Query1->price_subtotal = $booking->booking_detail->price_subtotal;
            $Query1->booking_id = $booking->booking_detail->booking_id;
            $Query1->queue_no = $noUrutAkhir;
            if (date('Y-m-d', strtotime($booking->booking_detail->booking_at)) == Carbon::parse($request->date)->toDateString()) {
                DB::rollback();
                Alert::error('Reschedule Error.', 'Cannot choose same date.');
                return redirect()->back();
            }
            $Query1->booking_at = Carbon::parse($request->date)->toDateString();

            $Query1->save();

            if (!$Query1) {
                DB::rollback();
                Alert::error('Reschedule Error.', 'Check your own data 2.');
                return redirect()->back();
            }
            
            $image = QrCode::format('png')
                ->size(200)
                ->generate(url("/booking-detail/$Query1->id/confirmation"));

            $output_file = '/img/qr-code/img-' . time() . $Query1->id .'.png';

            Storage::disk('public')->put($output_file, $image);

            $Query1->qr_code = $output_file;
            $Query1->update();

            if (!$Query1) {
                DB::rollback();
                Alert::error('Reschedule Error.', 'Check your own data 3.');
                return redirect()->back();
            }
            if ($Query1) {
                DB::commit();
                Alert::success('Reschedule Success.', 'Success.')->persistent(true)->autoClose(3600);
                return redirect()->back();
            }
        } else {
            $sid = $request->id;
            DB::table('slot_user')
            ->where('id', $sid)
            ->update([
                'qr_code_status' => "Reschedule"
            ]);
            $slots = DB::table('slot_user')
                    ->where('id', $sid)
                    ->first();
            $slot = Slot::find($slots->slot_id);
            $slotCapacity = $slot->capacity_booked - 1;
            $slot->capacity_booked = $slotCapacity;
            $slot->update();
                        
            $start = substr($request->time, 0, 8);
            $end = substr($request->time, 9);
            $slotID = Slot::where('user_id', $slot->user_id)->where('date', $request->date)
            ->where('time_start', $start)->where('time_end', $end)->first();

            if ($slot->id == $slotID->id) {
                DB::rollback();
                Alert::error('Reschedule Error.', 'Cannot choose same date and time.');
                return redirect()->back();
            }
            
            
            // generate QrCode for each sloton package that have been ordered
            $image = QrCode::format('png')
            ->size(200)
            ->generate(url("/api/slot/{$slot->id}/user/{$booking->user_id}/confirmation"));

            $image_qr_code = 'user/package/qr-code/web-'.time().'.png';

            $image_name = 'storage/'.$image_qr_code;

            Storage::disk('public')->put($image_qr_code, $image);

            DB::table('slot_user')->insert([
                'slot_id'           => $slotID->id,
                'user_id'           => Auth::user()->id,
                'booking_detail_id' => $booking->booking_detail->id,
                'qr_code_status'    => 'Accepted',
                'qr_code'           => $image_name
            ]);

            $slot = Slot::find($slotID->id);
            $slotCapacity = $slot->capacity_booked + 1;
            $slot->capacity_booked = $slotCapacity;
            $slot->update();

            if (!$slot) {
                DB::rollback();
                Alert::error('Reschedule Error.', 'Check your own data 4.');
                return redirect()->back();
            }
            DB::commit();
            Alert::success('Reschedule Success.', 'Success.')->persistent(true)->autoClose(3600);
            return redirect()->back();
        }
    }

    public function pay($id)
    {
        $booking = Booking::find($id);

        if ($booking->approval_status == "Expired") {
            Alert::error('Something wrong.', 'Decline.')->persistent(true)->autoClose(3600);
            return redirect()->back();
        }
        $bank_payment = $booking->bank;
        $package = $booking->booking_detail->package;

        return view('payment.payment-confirmation', compact(
            'package',
            'bank_payment',
            'booking'
        ));
    }
}
