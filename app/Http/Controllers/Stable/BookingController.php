<?php

namespace App\Http\Controllers\Stable;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

// Load models
use App\Models\Booking;
use App\Models\BookingDetail;
use Illuminate\Support\Facades\DB;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $booking_details = BookingDetail::with([
            'booking',
            'package',
            ])
            ->whereHas('package.stable', function ($q) {
                $q->where('id', Auth::user()->stables->first()->id);
            })
            ->whereHas('booking', function ($q) {
                $q->where('approval_status', 'Accepted');
            })
            ->orderBy('id', 'DESC');
        
        if (request()->ajax()) {
            return datatables()->of($booking_details)
                ->addColumn('package', function ($row) {
                    return
                    '
                        <div class="d-flex align-items-center">
                            <div class="symbol symbol-50 symbol-sm flex-shrink-0">
                                <div class="symbol-label">
                                    <img class="h-75 align-self-center" src="'. asset($row->package->photo) .'" alt="photo">
                                </div>
                            </div>
                            <div class="d-flex flex-column ml-3">
                                <div class="text-primary font-weight-bolder font-size-lg">'.$row->package->name.'</div>
                            </div>
                        </div>
                    ';
                })
                ->addColumn('user', function ($row) {
                    return
                    '
                    <div class="d-flex align-items-center">
                        <div class="d-flex flex-column">
                            <div class="text-primary font-weight-bolder font-size-lg">'.$row->booking->user->name.'</div>
                            <span class="text-muted font-weight-bold font-size-sm">
                                '.date('D, M d Y', strtotime($row->booking->user->birth_date)).', '.Carbon::parse($row->booking->user->birth_date)->age.' years
                            </span>
                        </div>
                    </div>
                    ';
                })
                ->addColumn('date', function ($row) {
                    return date('D, M d Y', strtotime($row->booking->created_at));
                })
                ->addColumn('price_total', function ($row) {
                    $price = number_format($row->price_subtotal, 0, ',', '.');
                    return '<span class="float-right">Rp. '.$price.'</span>';
                })
                ->addColumn('bank', function ($row) {
                    return
                    '
                    <div class="d-flex flex-column">
                        <div class="text-primary font-weight-bolder font-size-lg">'.$row->booking->bank->branch.'</div>
                        <span class="text-muted font-weight-bold font-size-sm">
                            '.$row->booking->bank->account_number.'
                        </span>
                    </div>
                    ';
                })
                ->addColumn('approval_status', function ($row) {
                    $status = $row->booking->approval_status;
                    if ($status == null) {
                        return "<span class='label font-weight-bold label-lg  label-light-warning label-inline'>Pending</span>";
                    } elseif ($status == 'Accepted') {
                        return "<span class='label font-weight-bold label-lg  label-light-success label-inline'>".$status."</span>";
                    } else {
                        return "<span class='label font-weight-bold label-lg  label-light-danger label-inline'>".$status."</span>";
                    }
                })
                ->rawColumns(['package', 'user', 'price_total', 'bank', 'approval_status'])
                ->make();
        }

        return view('stable.booking.index');
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
}
