<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

// load model
use App\Models\Booking;

// load plugin
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Facades\Storage;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $booking = Booking::all();
        
        return response()->json([
            "success" => true,
            "message" => "Booking List show successfully.",
            "data"    => $booking
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
    public function store(Request $request, Booking $booking)
    {
        $validator = Validator::make($request->all(), [
            'user_id'     => 'required',
            'price_total' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors()
            ], 400);
        }
        
        $booking->user_id     = $request->user_id;
        $booking->price_total = $request->price_total;

        $booking->save();

        return response()->json([
            'success' => true,
            'message' => "Booking created successfully.",
            'data'    => $booking
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Booking $booking)
    {
        return response()->json([
            "success" => true,
            "message" => "Booking show successfully.",
            "data"    => $booking
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

    public function payment(Request $request, Booking $booking)
    {
        $validator = Validator::make($request->all(), [
            'photo'      => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors()
            ], 400);
        }

        $booking->updated_at = date('Y-m-d H:i:s');

        if ($request->file('photo')) {
            $booking->photo = $request->file('photo')->getClientOriginalName();
            $image_path = $request->file('photo')->storeAs('booking/photo', $booking->photo, 'public');
        }

        $booking->save();

        return response()->json([
            'success' => true,
            'message' => "Booking payment created successfully.",
            'data'    => $booking
        ]);
    }

    public function approval(Request $request, Booking $booking)
    {
        $validator = Validator::make($request->all(), [
            'approval_by'     => 'required',
            'approval_status' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors()
            ], 400);
        }

        $booking->approval_by     = $request->approval_by;
        $booking->approval_at     = date('Y-m-d H:i:s');
        $booking->approval_status = $request->approval_status;

        $booking->save();

        // generate QrCode for each sloton package that have been ordered
        foreach ($booking->booking_detail as $key => $booking_detail) {
            foreach ($booking_detail->package->slot as $key_slot => $slot) {
                $image = QrCode::format('png')
                ->size(200)
                ->generate(url("/api/slot/{$slot->id}/user/{$booking->user_id}/confirmation"));

                $output_file = '/img/qr-code/img-' . time() . '.png';

                Storage::disk('local')->put($output_file, $image);
                
                $slot->users()->attach(
                    $booking->user_id,
                    [
                        'qr_code'        => $output_file,
                        'qr_code_status' => "available"
                    ]
                );

                sleep(1); // add delay 1 seconds
            }
        }

        return response()->json([
            'success' => true,
            'message' => "Booking approval updated successfully.",
            'data'    => $booking
        ]);
    }
}
