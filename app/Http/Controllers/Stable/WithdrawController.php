<?php

namespace App\Http\Controllers\Stable;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

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
        return route('stable.withdraw.setting');
    }
}
