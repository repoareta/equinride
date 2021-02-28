<?php

namespace App\Http\Controllers\AppOwner;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Stable;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $stables_count = Stable::all()->count();
        $bookings_count = Booking::all()->count();

        return view('app-owner.dashboard', compact(
            'stables_count',
            'bookings_count'
        ));
    }
}
