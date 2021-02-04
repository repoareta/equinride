<?php

namespace App\Http\Controllers\Stable;

use App\Http\Controllers\Controller;
use App\Models\Province;
use Illuminate\Http\Request;

// load models
use App\Models\Stable;
use Illuminate\Support\Facades\Auth;

class StableController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('stable.dashboard');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function register()
    {
        $provinces = Province::all();
        return view('stable.register', compact('provinces'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function registerSubmit(Request $request, Stable $stable)
    {
        $stable->name           = $request->name;
        $stable->contact_person = $request->contact_phone_name;
        $stable->contact_number = $request->contact_phone_number;
        $stable->address        = $request->address;
        $stable->province_id    = $request->province;
        $stable->city_id        = $request->city;
        $stable->district_id    = $request->district;
        $stable->village_id     = $request->village;
        $stable->user_id        = Auth::user()->id;

        $stable->save();

        Auth::user()->assignRole('stable-owner');

        return redirect()->route('stable.index');
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
