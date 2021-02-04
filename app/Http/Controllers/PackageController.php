<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

//load models
use App\Models\Package;
use App\Models\Stable;
use App\Models\BankPayment;
use App\Models\Booking;
use App\Models\BookingDetail;
use Illuminate\Support\Facades\Auth;

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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
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

        // CEK BOOKED CAPACITY IN STABLE SLOT
        // IF BOOKED CAPACITY > CAPACITY
        // THEN REDIRECT TO RIDING-CLASS SEARCH
        // ADD INFO IF SCHEDULE IS FULLY BOOKED

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

        // CREATE SLOT USER
        Auth::user()->slots->attach(Auth::user()->id, [
            'booking_detail_id' => $booking_detail->id,
            'slot_id'           => $package->stable->slot->first()->id
        ]);

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
    public function paymentConfirmationSubmit(Request $request, Package $package)
    {
        $package = Package::where('id', $package->id)
        ->with(['stable.slots' => function ($q) use ($request) {
            $q->where('date', $request->date_start);
            $q->where('time_start', $request->time_start);
        }])
        ->firstOrFail();

        $booking = Booking::find($request->booking_id);

        return redirect()->route('user.order_history');
    }
}
