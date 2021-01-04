<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

// load model
use App\Models\BookingDetail;
use App\Models\Booking;

class BookingDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $booking_detail = BookingDetail::all();
        
        return response()->json([
            "success" => true,
            "message" => "Booking Detail List show successfully.",
            "data"    => $booking_detail
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, BookingDetail $booking_detail)
    {
        $validator = Validator::make($request->all(), [
            'package_id'     => 'required',
            'booking_id'     => 'required',
            'price_subtotal' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors()
            ], 400);
        }
        
        $booking_detail->package_id     = $request->package_id;
        $booking_detail->booking_id     = $request->booking_id;
        $booking_detail->price_subtotal = $request->price_subtotal;

        $booking_detail->save();

        return response()->json([
            'success' => true,
            'message' => "Booking detail created successfully.",
            'data'    => $booking_detail
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    public function showByBookingId(Booking $booking)
    {
        return response()->json([
            "success" => true,
            "message" => "Booking detail by booking id show successfully.",
            "data"    => $booking->booking_detail
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
