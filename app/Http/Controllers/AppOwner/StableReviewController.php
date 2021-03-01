<?php

namespace App\Http\Controllers\AppOwner;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;

// Load Models
use App\Models\Stable;
use App\Models\Horse;
use App\Models\Coach;
use App\Models\Package;
use App\Models\Slot;

class StableReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function horse($id)
    {
        $stable = Stable::find($id);
        if (request()->ajax()) {
            $query = Horse::where('stable_id', $id)->orderBy('id', 'desc')->get();
            return datatables()->of($query)
                ->addIndexColumn()
                ->addColumn('horse', function ($item) {
                    return
                    '
                    <div class="d-flex align-items-center">
                        <div class="symbol symbol-50 symbol-sm flex-shrink-0">
                            <div class="symbol-label">
                                <img class="h-100 w-100 align-self-center" src="'. asset($item->photo) .'" alt="photo">
                            </div>
                        </div>
                        <div class="d-flex flex-column ml-3">
                            <div class="text-primary font-weight-bolder font-size-lg">'.$item->name.'</div>
                            <span class="text-muted font-weight-bold font-size-sm">
                                '.date('D, M d Y', strtotime($item->birth_date)).', '.Carbon::parse($item->birth_date)->age.' years
                            </span>
                        </div>
                    </div>                    
                    ';
                })
                ->addColumn('horse_sex', function ($item) {
                    return $item->sex->name;
                })
                ->addColumn('horse_breed', function ($item) {
                    return $item->breed->name;
                })
                ->addColumn('passport_number', function ($item) {
                    return $item->passport_number == null ?
                    "<span class='label font-weight-bold label-lg  label-light-danger label-inline'>Not Found</span>" :
                    $item->passport_number;
                })
                ->addColumn('pedigree_male', function ($item) {
                    return $item->pedigree_male == null ?
                    "<span class='label font-weight-bold label-lg  label-light-danger label-inline'>Not Found</span>" :
                    $item->pedigree_male;
                })
                ->addColumn('pedigree_female', function ($item) {
                    return $item->pedigree_female == null ?
                    "<span class='label font-weight-bold label-lg  label-light-danger label-inline'>Not Found</span>" :
                    $item->pedigree_female;
                })
                ->rawColumns(['horse' ,'pedigree_female', 'pedigree_male', 'passport_number'])
                ->make();
        }
        return view('app-owner.stable.review.horse.index', compact('stable'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function coach($id)
    {
        $stable = Stable::find($id);
        if (request()->ajax()) {
            $query = Coach::where('stable_id', $id)->get();
            return datatables()->of($query)
                ->addIndexColumn()
                ->addColumn('coach', function ($item) {
                    return
                    '
                    <div class="d-flex align-items-center">
                        <div class="symbol symbol-50 symbol-sm flex-shrink-0">
                            <div class="symbol-label">
                                <img class="h-100 w-100 align-self-center" src="'. asset($item->photo) .'" alt="photo">
                            </div>
                        </div>
                        <div class="d-flex flex-column ml-3">
                            <div class="text-primary font-weight-bolder font-size-lg">'.$item->name.'</div>
                            <span class="text-muted font-weight-bold font-size-sm">
                                '.date('D, M d Y', strtotime($item->birth_date)).', '.Carbon::parse($item->birth_date)->age.' years
                            </span>
                        </div>
                    </div>                    
                    ';
                })
                ->addColumn('experience', function ($item) {
                    return $item->experience.' Years';
                })
                ->addColumn('action', function ($item) {
                    return '
                    <td nowrap="nowrap">
                        <a href="'. route("stable.coach.edit", $item->id) . '" class="btn btn-clean btn-icon mr-2" title="Edit details">
                            <i class="la la-edit icon-xl"></i>
                        </a>
                        <a href="javascript:;" class="btn btn-clean btn-icon mr-2" data-id="'.$item->id.'" title="Delete details" id="deleteCoach">
                            <i class="la la-trash icon-lg"></i>
                        </a>
                    </td>
                    ';
                })
                ->rawColumns(['coach'])
                ->make();
        }
        return view('app-owner.stable.review.coach.index', compact('stable'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function package($id)
    {
        $stable = Stable::find($id);
        if (request()->ajax()) {
            $query = Package::where('stable_id', $stable->id)->orderBy('id', 'desc')->get();
            return datatables()->of($query)
                ->addIndexColumn()
                ->addColumn('package', function ($item) {
                    return
                    '
                    <div class="d-flex align-items-center">
                        <div class="symbol symbol-50 symbol-sm flex-shrink-0">
                            <div class="symbol-label">
                                <img class="h-100 w-100 align-self-center" src="'. asset($item->photo) .'" alt="photo">
                            </div>
                        </div>
                        <div class="d-flex flex-column ml-3">
                            <div class="text-primary font-weight-bolder font-size-lg">'.$item->name.'</div>
                            <span class="text-muted font-weight-bold font-size-sm">
                                Number : '.$item->package_number.'
                            </span>
                        </div>
                    </div>                    
                    ';
                })
                ->addColumn('price', function ($item) {
                    $price = number_format(($item->price/100), 2);
                    return 'RP. '.$price;
                })
                ->addColumn('package_number', function ($item) {
                    return $item->package_number == null ?
                    "<span class='label font-weight-bold label-lg  label-light-danger label-inline'>Not Found</span>" :
                    $item->package_number;
                })
                ->addColumn('package_status', function ($item) {
                    return $item->package_status == 'Yes' ?
                    "<span class='label font-weight-bold label-lg  label-light-success label-inline'>Publish</span>" :
                    "<span class='label font-weight-bold label-lg  label-light-danger label-inline'>Unpublish</span>";
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
                ->rawColumns(['package','package_status', 'approval_status', 'package_number'])
                ->make();
        }
        return view('app-owner.stable.review.package.index', compact('stable'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function schedule(Request $request, $id)
    {
        $stable = Stable::find($id);
        if (request()->ajax()) {
            if (!empty($request->input('from_date'))) {
                //Jika tanggal awal(input('from_date')) hingga tanggal akhir(input('end_date')) adalah sama maka
                if ($request->input('from_date') === $request->input('end_date')) {
                    //kita filter tanggalnya sesuai dengan request input('from_date')
                    $from = date('Y-m-d', strtotime($request->input('from_date')));
                    $query = Slot::where('stable_id', $stable->id)
                            ->whereDate('date', '=', $from)
                            ->orderBy('time_start', 'asc')
                            ->get();
                } else {
                    //kita filter dari tanggal awal ke akhir
                    $from = date('Y-m-d', strtotime($request->input('from_date')));
                    $end = date('Y-m-d', strtotime($request->input('end_date')));
                    $query = Slot::where('stable_id', $stable->id)
                    ->whereBetween('date', array($from, $end))
                    ->orderBy('time_start', 'asc')
                    ->get();
                }
            } else {
                $query = Slot::where('stable_id', $stable->id)->orderBy('date', 'asc')->orderBy('time_start', 'asc')->get();
            }

            return datatables()->of($query)
                ->addIndexColumn()
                ->addColumn('date', function ($item) {
                    return date('D, M d Y', strtotime($item->date));
                })
                ->addColumn('time_start', function ($query) {
                    return date('H:i', strtotime($query->time_start));
                })
                ->addColumn('time_end', function ($query) {
                    return date('H:i', strtotime($query->time_end));
                })
                ->make(true);
        }
        return view('app-owner.stable.review.schedule.index', compact('stable'));
    }
}
