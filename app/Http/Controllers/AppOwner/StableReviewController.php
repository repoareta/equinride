<?php

namespace App\Http\Controllers\AppOwner;

use App\Http\Controllers\Controller;
use App\Models\Stable;
use Illuminate\Http\Request;

class StableReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function horse(Stable $stable)
    {
        // return view('app-owner.stable.review.horse');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function coach(Stable $stable)
    {
        // return view('app-owner.stable.review.coach');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function package(Stable $stable)
    {
        // return view('app-owner.stable.review.package');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function schedule(Stable $stable)
    {
        // return view('app-owner.stable.review.package');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function approval(Request $request)
    {
        //
    }
}
