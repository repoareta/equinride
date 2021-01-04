<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

// load model
use App\Models\Slot;
use App\Models\Package;
use App\Models\User;

class SlotController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $slot = Slot::all();
        
        return response()->json([
            "success" => true,
            "message" => "Slot List show successfully.",
            "data"    => $slot
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
    public function store(Request $request, Slot $slot)
    {
        $validator = Validator::make($request->all(), [
            'date_start' => 'required',
            'date_end'   => 'required',
            'capacity'   => 'required',
            'user_id'    => 'required',
            'package_id' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors()
            ], 400);
        }
        
        $slot->date_start = $request->date_start;
        $slot->date_end = $request->date_end;
        $slot->capacity = $request->capacity;
        $slot->user_id = $request->user_id;
        $slot->package_id = $request->package_id;

        $slot->save();

        return response()->json([
            'success' => true,
            'message' => "Slot created successfully.",
            'data'    => $slot
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Slot $slot)
    {
        return response()->json([
            "success" => true,
            "message" => "Slot show successfully.",
            "data" => $slot
        ]);
    }

    public function showByPackageId(Package $package)
    {
        return response()->json([
            "success" => true,
            "message" => "Slot by package id show successfully.",
            "data"    => $package->slot
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
    public function update(Request $request, Slot $slot)
    {
        $validator = Validator::make($request->all(), [
            'date_start' => 'required',
            'date_end'   => 'required',
            'capacity'   => 'required',
            'user_id'    => 'required',
            'package_id' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors()
            ], 400);
        }
        
        $slot->date_start = $request->date_start;
        $slot->date_end = $request->date_end;
        $slot->capacity = $request->capacity;
        $slot->user_id = $request->user_id;
        $slot->package_id = $request->package_id;

        $slot->save();

        return response()->json([
            'success' => true,
            'message' => "Slot updated successfully.",
            'data'    => $slot
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Slot $slot)
    {
        $slot->delete();

        return response()->json([
            "success" => true,
            "message" => "Slot deleted successfully."
        ]);
    }

    public function confirmation(Slot $slot, User $user)
    {
        $slot->users()->updateExistingPivot(
            $user->id,
            [ 'qr_code_status' => 'confirmed' ]
        );

        return "slot confirmed";
    }
}
