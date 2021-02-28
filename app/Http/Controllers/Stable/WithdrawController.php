<?php

namespace App\Http\Controllers\Stable;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class WithdrawController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('stable.withdraw.index');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('stable.withdraw.create');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return view('stable.withdraw.create');
    }


    /**
     * Undocumented function
     *
     * @return void
     */
    public function withdrawSetting()
    {
        return view('stable.withdraw.setting');
    }

    /**
     * Undocumented function
     *
     * @return void
     */
    public function withdrawSettingStore(Request $request)
    {
        $stable = Auth::user()->stables->first();

        $stable->account_name   = $request->account_name;
        $stable->account_number = $request->account_number;
        $stable->branch         = $request->branch;

        $stable->save();

        Alert::success('Withdraw Settings Update Success.')
        ->persistent(true)
        ->autoClose(3600);

        return redirect()->route('stable.withdraw.setting');
    }
}
