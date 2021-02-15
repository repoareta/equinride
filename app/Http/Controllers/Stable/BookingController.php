<?php

namespace App\Http\Controllers\Stable;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

// Load models
use App\Models\Booking;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {        
        
        $query = Booking::with(['booking_detail.package.stable' => function ($q){
            $q->where('id', Auth::user()->stables->first()->pivot->stable_id);
        }])->orderBy('id', 'DESC')->get();
        
        if(request()->ajax()){

        return datatables()->of($query)
                ->addIndexColumn()
                ->addColumn('package', function ($item){
                    return 
                    '
                        <div class="d-flex align-items-center">
                            <div class="symbol symbol-50 symbol-sm flex-shrink-0">
                                <div class="symbol-label">
                                    <img class="h-75 align-self-end" src="'. asset($item->booking_detail->package->photo) .'" alt="photo">
                                </div>
                            </div>
                            <div class="d-flex flex-column ml-3">
                                <div class="text-primary font-weight-bolder font-size-lg">'.$item->booking_detail->package_name.'</div>
                            </div>
                        </div>
                    ';
                })
                ->addColumn('user', function ($item){
                    return
                    '
                    <div class="d-flex align-items-center">
                        <div class="d-flex flex-column">
                            <div class="text-primary font-weight-bolder font-size-lg">'.$item->user->name.'</div>
                            <span class="text-muted font-weight-bold font-size-sm">
                                '.date('D, M d Y', strtotime($item->user->birth_date)).', '.Carbon::parse($item->user->birth_date)->age.' years
                            </span>
                        </div>
                    </div>                    
                    ';
                })
                ->addColumn('date', function ($item){
                    return date('D, M d Y', strtotime($item->birth_date));
                })
                ->addColumn('price_total', function ($item) { 
                    $price = number_format($item->price_total, 0,',', '.');
                    return '<span class="float-right">Rp. '.$price.'</span>';
                })
                ->addColumn('bank', function ($item){
                    return 
                    '
                    <div class="d-flex flex-column">
                        <div class="text-primary font-weight-bolder font-size-lg">'.$item->bank->branch.'</div>
                        <span class="text-muted font-weight-bold font-size-sm">
                            '.$item->bank->account_number.'
                        </span>
                    </div>
                    ';
                })
                ->addColumn('approval_status', function ($item) {
                    if ($item->approval_status == null) {
                        return "<span class='label font-weight-bold label-lg  label-light-warning label-inline'>Pending</span>";
                    } elseif ($item->approval_status == 'Accepted') {
                        return "<span class='label font-weight-bold label-lg  label-light-success label-inline'>".$item->approval_status."</span>";
                    } else {
                        return "<span class='label font-weight-bold label-lg  label-light-danger label-inline'>".$item->approval_status."</span>";
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
