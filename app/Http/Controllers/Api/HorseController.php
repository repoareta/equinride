<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

// load model
use App\Models\Horse;
use App\Models\Stable;

class HorseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $horse = Horse::all();
        
        return response()->json([
            "success" => true,
            "message" => "Horse List show successfully.",
            "data"    => $horse
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
    public function store(Request $request, Horse $horse)
    {
        $validator = Validator::make($request->all(), [
            'name'            => 'required',
            'owner'           => 'required',
            'birth_date'      => 'required',
            'sex'             => 'required',
            'passport_number' => 'required',
            'breeds'          => 'required',
            'pedigree'        => 'required',
            'stable_id'       => 'required',
            'user_id'         => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors()
            ], 400);
        }
        
        $horse->name            = $request->name;
        $horse->owner           = $request->owner;
        $horse->birth_date      = $request->birth_date;
        $horse->sex             = $request->sex;
        $horse->passport_number = $request->passport_number;
        $horse->breeds          = $request->breeds;
        $horse->pedigree        = $request->pedigree;
        $horse->stable_id       = $request->stable_id;
        $horse->user_id         = $request->user_id;

        $horse->save();

        return response()->json([
            'success' => true,
            'message' => "Horse created successfully.",
            'data'    => $horse
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Horse $horse)
    {
        return response()->json([
            "success" => true,
            "message" => "Horse show successfully.",
            "data"    => $horse
        ]);
    }

    public function showByStableId(Stable $stable)
    {
        return response()->json([
            "success" => true,
            "message" => "Horse by stable id show successfully.",
            "data"    => $stable->horse
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
    public function update(Request $request, Horse $horse)
    {
        $validator = Validator::make($request->all(), [
            'name'            => 'required',
            'owner'           => 'required',
            'birth_date'      => 'required',
            'sex'             => 'required',
            'passport_number' => 'required',
            'breeds'          => 'required',
            'pedigree'        => 'required',
            'stable_id'       => 'required',
            'user_id'         => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors()
            ], 400);
        }
        
        $horse->name            = $request->name;
        $horse->owner           = $request->owner;
        $horse->birth_date      = $request->birth_date;
        $horse->sex             = $request->sex;
        $horse->passport_number = $request->passport_number;
        $horse->breeds          = $request->breeds;
        $horse->pedigree        = $request->pedigree;
        $horse->stable_id       = $request->stable_id;
        $horse->user_id         = $request->user_id;

        $horse->save();

        return response()->json([
            'success' => true,
            'message' => "Horse updated successfully.",
            'data'    => $horse
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Horse $horse)
    {
        $horse->delete();

        return response()->json([
            "success" => true,
            "message" => "Horse deleted successfully."
        ]);
    }
}
