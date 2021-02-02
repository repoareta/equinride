<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

//load models
use App\Models\Package;
use App\Models\Stable;
use App\Models\BankPayment;

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
        ->with(['stable.slot' => function ($q) use ($request) {
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
        ->with(['stable.slot' => function ($q) use ($request) {
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
    public function paymentConfirmation(Request $request, Package $package)
    {
        $package = Package::where('id', $package->id)
        ->with(['stable.slot' => function ($q) use ($request) {
            $q->where('date', $request->date_start);
            $q->where('time_start', $request->time_start);
        }])
        ->firstOrFail();

        
        $bank_payment = BankPayment::find($request->bank_payment_id);

        return view('payment.payment-confirmation', compact(
            'package',
            'bank_payment'
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
        ->with(['stable.slot' => function ($q) use ($request) {
            $q->where('date', $request->date_start);
            $q->where('time_start', $request->time_start);
        }])
        ->firstOrFail();

        // return view('payment.payment-confirmation-submit', compact(
        //     'package'
        // ));

        return redirect()->route('user.order_history');
    }
}
