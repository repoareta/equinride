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
        $packages = Package::where('session_usage', 'Yes')
        ->whereHas('stable', function ($q) use ($request) {
            $q->where('approval_status', 'Accepted');
            $q->when(request('stable_name'), function ($query) use ($request) {
                return $query->where('name', $request->stable_name);
            });
        })
        ->whereHas('stable.slots', function ($q) use ($request) {
            $q->when(request('date_start'), function ($query) use ($request) {
                return $query->where('date', $request->date_start);
            });
            $q->when(request('time_start'), function ($query) use ($request) {
                return $query->where('time_start', $request->time_start);
            });
            $q->whereColumn('capacity_booked', '<', 'capacity');
        })
        ->latest()
        ->paginate(10);

        return view('riding-class.search', compact(
            'stables',
            'packages'
        ));
    }
}
