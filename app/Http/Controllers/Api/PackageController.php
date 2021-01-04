<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

// load model
use App\Models\Package;
use App\Models\Stable;

class PackageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $package = Package::all();
        
        return response()->json([
            "success" => true,
            "message" => "package List show successfully.",
            "data"    => $package
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
    public function store(Request $request, Package $package)
    {
        $validator = Validator::make($request->all(), [
            'package_number' => 'required',
            'name'           => 'required',
            'description'    => 'required',
            'price'          => 'required',
            'user_id'        => 'required',
            'stable_id'      => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors()
            ], 400);
        }
        
        $package->package_number = $request->package_number;
        $package->name           = $request->name;
        $package->description    = $request->description;
        $package->price          = $request->price;
        $package->user_id        = $request->user_id;
        $package->stable_id      = $request->stable_id;

        if ($request->file('photo')) {
            $package->photo = $request->file('photo')->getClientOriginalName();
            $photo_new_path = $request->file('photo')->storeAs('package/photo', $package->photo, 'public');
        }

        $package->save();

        return response()->json([
            'success' => true,
            'message' => "Package created successfully.",
            'data'    => $package
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Package $package)
    {
        return response()->json([
            "success" => true,
            "message" => "Package show successfully.",
            "data"    => $package
        ]);
    }

    public function showByStableId(Stable $stable)
    {
        return response()->json([
            "success" => true,
            "message" => "Package by stable id show successfully.",
            "data"    => $stable->package
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
    public function update(Request $request, Package $package)
    {
        $validator = Validator::make($request->all(), [
            'package_number' => 'required',
            'name'           => 'required',
            'description'    => 'required',
            'price'          => 'required',
            'user_id'        => 'required',
            'stable_id'      => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors()
            ], 400);
        }
        
        $package->package_number = $request->package_number;
        $package->name           = $request->name;
        $package->description    = $request->description;
        $package->price          = $request->price;
        $package->user_id        = $request->user_id;
        $package->stable_id      = $request->stable_id;

        if ($request->file('photo')) {
            $package->photo = $request->file('photo')->getClientOriginalName();
            $photo_new_path = $request->file('photo')->storeAs('package/photo', $package->photo, 'public');
        }

        $package->save();

        return response()->json([
            'success' => true,
            'message' => "Package created successfully.",
            'data'    => $package
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Package $package)
    {
        $package->delete();

        return response()->json([
            "success" => true,
            "message" => "Package deleted successfully."
        ]);
    }
}
