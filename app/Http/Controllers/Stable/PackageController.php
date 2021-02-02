<?php

namespace App\Http\Controllers\Stable;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use RealRashid\SweetAlert\Facades\Alert;
use Carbon\Carbon;

// load model
use App\Models\Package;
use App\Models\Stable;

//load form request (for validation)
use App\Http\Requests\PackageStore;

class PackageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(request()->ajax()){

            $query = Package::where('user_id', Auth::user()->id)->get();
            return Datatables::of($query)
                ->addIndexColumn()
                ->addColumn('price', function($item){
                    $price = number_format(($item->price/100), 2);
                    return 'RP. '.$price;
                })  
                ->addColumn('price', function($item){
                    $price = number_format(($item->price/100), 2);
                    return 'RP. '.$price;
                })
                ->addColumn('package_number', function($item){
                    return $item->package_number == null ? 
                    "<span class='label font-weight-bold label-lg  label-light-danger label-inline'>Not Found</span>" : 
                    $item->package_number;
                })
                ->addColumn('package_status', function($item){
                    return $item->package_status == 'Yes' ? 
                    "<span class='label font-weight-bold label-lg  label-light-success label-inline'>Publish</span>" : 
                    "<span class='label font-weight-bold label-lg  label-light-danger label-inline'>Unpublish</span>";
                })
                ->addColumn('approval_status', function($item){
                    return $item->approval_status == 'Accepted' ? 
                    "<span class='label font-weight-bold label-lg  label-light-success label-inline'>".$item->approval_status."</span>" : 
                    "<span class='label font-weight-bold label-lg  label-light-danger label-inline'>".$item->approval_status."</span>";
                })
                ->addColumn('action', function($item){
                    return '
                    <td nowrap="nowrap">
                        <a href="'. route("stable.package.edit", $item->id) . '" class="btn btn-clean btn-icon mr-2" title="Edit details">
                            <i class="la la-edit icon-xl"></i>
                        </a>
                        <a href="javascript:;" class="btn btn-clean btn-icon mr-2" data-id="'.$item->id.'" title="Delete details" id="deletePackage">
                            <i class="la la-trash icon-lg"></i>
                        </a>
                    </td>
                    ';
                })
                ->rawColumns(['action', 'package_status', 'approval_status', 'package_number'])
                ->make();
        }        
        return view('stable.package.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('stable.package.create');
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
        return view('stable.package.edit');
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
