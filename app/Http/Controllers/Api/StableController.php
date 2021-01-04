<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

// load model
use App\Models\Stable;
use App\Models\User;

class StableController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $stable = Stable::all();
        
        return response()->json([
            "success" => true,
            "message" => "Stable List show successfully.",
            "data"    => $stable
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
    public function store(Request $request, Stable $stable)
    {
        $validator = Validator::make($request->all(), [
            'name'               => 'required',
            'owner'              => 'required',
            'manager'            => 'required',
            'contact_person'     => 'required',
            'contact_number'     => 'required',
            'capacity_of_stable' => 'required',
            'capacity_of_arena'  => 'required',
            'number_of_coach'    => 'required',
            'address'            => 'required',
            'user_id'            => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors()
            ], 400);
        }
        
        $stable->name = $request->name;
        $stable->owner = $request->owner;
        $stable->manager = $request->manager;
        $stable->contact_person = $request->contact_person;
        $stable->contact_number = $request->contact_number;
        $stable->capacity_of_stable = $request->capacity_of_stable;
        $stable->capacity_of_arena = $request->capacity_of_arena;
        $stable->number_of_coach = $request->number_of_coach;
        $stable->address = $request->address;
        $stable->user_id = $request->user_id;

        if ($request->file('logo')) {
            $stable->logo = $request->file('logo')->getClientOriginalName();
            $logo_new_path = $request->file('logo')->storeAs('stable/logo', $stable->logo, 'public');
        }

        $stable->save();

        return response()->json([
            'success' => true,
            'message' => "Stable created successfully.",
            'data'    => $stable
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Stable $stable)
    {
        return response()->json([
            "success" => true,
            "message" => "Stable show successfully.",
            "data" => $stable
        ]);
    }

    public function showByUserId(User $user)
    {
        return response()->json([
            "success" => true,
            "message" => "Stable by user id show successfully.",
            "data"    => $user->stable
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
    public function update(Request $request, Stable $stable)
    {
        $validator = Validator::make($request->all(), [
            'name'               => 'required',
            'owner'              => 'required',
            'manager'            => 'required',
            'contact_person'     => 'required',
            'contact_number'     => 'required',
            'capacity_of_stable' => 'required',
            'capacity_of_arena'  => 'required',
            'number_of_coach'    => 'required',
            'address'            => 'required',
            'user_id'            => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors()
            ], 400);
        }
        
        $stable->name = $request->name;
        $stable->owner = $request->owner;
        $stable->manager = $request->manager;
        $stable->contact_person = $request->contact_person;
        $stable->contact_number = $request->contact_number;
        $stable->capacity_of_stable = $request->capacity_of_stable;
        $stable->capacity_of_arena = $request->capacity_of_arena;
        $stable->number_of_coach = $request->number_of_coach;
        $stable->address = $request->address;
        $stable->user_id = $request->user_id;

        $stable->save();

        return response()->json([
            'success' => true,
            'message' => "Stable updated successfully.",
            'data'    => $stable
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Stable $stable)
    {
        $stable->delete();

        return response()->json([
            "success" => true,
            "message" => "Stable deleted successfully."
        ]);
    }
}
