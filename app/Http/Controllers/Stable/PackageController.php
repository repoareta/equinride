<?php

namespace App\Http\Controllers\Stable;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

// load model
use App\Models\Package;

class PackageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->ajax()) {
            $stable = Auth::user()->stables->first();
            $packages = Package::where('stable_id', $stable->id)->orderBy('id', 'desc')->get();
            return Datatables::of($packages)
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
                    $price = number_format($item->price, 0, ',', '.');
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
                ->addColumn('action', function ($item) {
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
                ->rawColumns(['package','action', 'package_status', 'approval_status', 'package_number'])
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
    public function store(Request $request, Package $package)
    {
        try {
            // Check Stable
            $stable = Auth::user()->stables->first()->pivot;

            $package->name            = $request->name;
            $package->package_number  = $request->package_number;
            $package->attendance      = 1;
            $package->description     = $request->description;
            $package->price           = $request->price;
            $package->session_usage   = $request->session_usage;
            $package->package_status  = $request->status;
            $package->user_id         = $stable->user_id;
            $package->stable_id       = $stable->stable_id;

            $package->save();

            return response()->json(['status'=>"success", 'packageid'=>$package->id]);
        } catch (\Exception $e) {
            return response()->json(['status'=>'exception', 'msg'=>$e->getMessage()]);
        }
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
        $item = Package::find($id);

        return view('stable.package.edit', compact('item'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Package $package)
    {
        try {
            // Check Stable
            $stable = Auth::user()->stables->first()->pivot;
            
            $package->name            = $request->name;
            $package->package_number  = $request->package_number;
            $package->attendance      = 1;
            $package->description     = $request->description;
            $package->price           = $request->price;
            $package->session_usage   = $request->session_usage;
            $package->package_status  = $request->status;
            $package->user_id         = $stable->user_id;
            $package->stable_id       = $stable->stable_id;
            
            $package->save();
            return response()->json(['status'=>"success", 'packageid'=>$package->id]);
        } catch (\Exception $e) {
            return response()->json(['status'=>'exception', 'msg'=>$e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $data = Package::find($request->id);
        File::delete(public_path($data->photo));
        $data->delete();
        return response()->json();
    }

    // Store image to database and directory from dropZone
    public function storeImage(Request $request)
    {
        if ($request->file('photo')) {
            
            //here we are geeting packageid align with an image
            $package = Package::find($request->packageid);
            File::delete(public_path('/storage/package/photo/'.$request->photo));
            $name = $request->file('photo')->getClientOriginalName();
            $dir = $request->file('photo')->storeAs('package/photo', $name, 'public');
            $nameDir = 'storage/'.$dir;
            $package->photo = $nameDir;
            $package->update();

            return response()->json(['status'=>"success",'imgdata'=>$nameDir,'packageid'=>$package->id]);
        }
    }
}
