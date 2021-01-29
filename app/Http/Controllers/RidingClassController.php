<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


//load models
use App\Models\Package;
use App\Models\Stable;

class RidingClassController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $stables = Stable::all();
        $stables_footer = Stable::paginate(8);
        return view('riding-class.index', compact(
            'stables',
            'stables_footer'
        ));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        // dd(\Carbon\Carbon::parse('Tue, 02 Mar 2021')->format('Y-m-d'));
        $stables = Stable::all();
        $packages = Package::paginate(10);
        return view('riding-class.search', compact(
            'stables',
            'packages'
        ));
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
    public function store(Request $request)
    {
        //
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

    // Payment Method
    public function payment_method(Package $package)
    {
        return view('payment-method');
    }

    // Transfer Payment
    public function payment(Package $package)
    {
        return view('transfer-payment');
    }
}
