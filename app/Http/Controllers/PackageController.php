<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use RealRashid\SweetAlert\Facades\Alert;

//load models
use App\Models\Package;
use App\Models\BankPayment;
use App\Models\Booking;
use App\Models\BookingDetail;
use App\Models\Slot;

class PackageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function booking(Request $request, Package $package)
    {
        $package = Package::where('id', $package->id)
        ->with(['stable.slots' => function ($q) use ($request) {
            $q->where('date', $request->date_start);
            $q->where('time_start', $request->time_start);
        }])
        ->firstOrFail();

        return view('booking.booking-review', compact(
            'package'
        ));
    }

    /**
     * Undocumented function
     *
     * @param Request $request
     * @param Package $package
     * @return void
     */
    public function paymentMethod(Request $request, Package $package)
    {
        $package = Package::where('id', $package->id)
        ->with(['stable.slots' => function ($q) use ($request) {
            $q->where('date', $request->date_start);
            $q->where('time_start', $request->time_start);
        }])
        ->firstOrFail();

        $bank_payments = BankPayment::all();

        return view('payment.payment-method', compact(
            'package',
            'bank_payments'
        ));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function paymentConfirmation(Request $request, Package $package, Booking $booking, BookingDetail $booking_detail)
    {
        $package = Package::where('id', $package->id)
        ->with(['stable.slots' => function ($q) use ($request) {
            $q->where('date', $request->date_start);
            $q->where('time_start', $request->time_start);
        }])
        ->firstOrFail();
        
        // CEK BOOKING DETAIL
        // UNTUK MENGHINDARI RE-SUBMIT FORM PEMBAYARAN
        $slot_users = Auth::user()->slots()
                        ->where('date', $request->date_start)
                        ->where('time_start', $request->time_start)
                        ->first();
        if ($slot_users) {
            if ($slot_users->pivot->qr_code_status == 'Pending') {
                Alert::error('Payment Error', 'Same package with unfinish payment detected.')->persistent(true)->autoClose(3600);
                return redirect()->route('riding_class');
            }
        }

        // CEK BOOKED CAPACITY IN STABLE SLOT
        // IF BOOKED CAPACITY > CAPACITY
        // THEN REDIRECT TO RIDING-CLASS SEARCH
        // ADD INFO IF SCHEDULE IS FULLY BOOKED
        $slots = Slot::where('date', $request->date_start)
                    ->where('time_start', $request->time_start)
                    ->first();
        if ($slots->capacity == $slots->capacity_booked) {
            Alert::error('Payment Error.', 'Capacity full on this date and time')->persistent(true)->autoClose(3600);
            return redirect()->route('riding_class');
        }

        // Add Capacity Booked slots
        $slots->capacity_booked =+ 1;
        $slots->update();

        $bank_payment = BankPayment::find($request->bank_payment_id);

        // CREATE BOOKING
        $booking->user_id = Auth::user()->id;
        $booking->price_total = $request->price_total;
        $booking->bank_payment_id = $request->bank_payment_id;

        $booking->save();

        // CREATE BOOKING DETAIL
        $booking_detail->package_id = $package->id;
        $booking_detail->price_subtotal = $package->price;

        $booking_detail = $booking->booking_detail()->save($booking_detail);

        $slot = $package->stable->slots->first();

        // generate QrCode for each sloton package that have been ordered
        $image = QrCode::format('png')
                ->size(200)
                ->generate(url("/slot/{$slot->id}/user/{$booking->user_id}/confirmation"));
        // ->generate(url("/api/slot/{$slot->id}/user/{$booking->user_id}/confirmation"));
        
        $image_qr_code = 'user/package/qr-code/web-'.time().'.png';

        $image_name = 'storage/'.$image_qr_code;

        Storage::disk('public')->put($image_qr_code, $image);

        // CREATE SLOT USER
        Auth::user()->slots()->attach(
            $slot->id,
            [
                'booking_detail_id' => $booking_detail->id,
                'qr_code'           => $image_name,
                'qr_code_status'    => 'Pending'
            ]
        );

        return view('payment.payment-confirmation', compact(
            'package',
            'bank_payment',
            'booking'
        ));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function paymentConfirmationSubmit(Request $request)
    {
        if ($request->hasFile('photo')) {
            $booking = Booking::find($request->id);
            File::delete(public_path('/storage/booking/photo/'.$request->photo));
            $name = $request->file('photo')->getClientOriginalName();
            $dir = $request->file('photo')->storeAs('booking/photo', $name, 'public');
            $nameDir = 'storage/'.$dir;
            $booking->photo = $nameDir;
            $booking->update();

            return response()->json(['status'=>"success",'imgdata'=>$nameDir]);
        }
        
        return response()->json(['status'=>"error"]);
    }
}
