<?php

namespace App\Http\Controllers\AppOwner;

use App\Http\Controllers\Controller;
use App\Mail\AttachNewAppAdmin;
use App\Mail\DetachAppAdmin;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;
use RealRashid\SweetAlert\Facades\Alert;

// Load Models
use App\Models\User;
class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $query = User::whereHas("roles", function($q){ 
                    $q->where("name", "app-admin"); 
                })->get();   
        if (request()->ajax()) {
            return DataTables::of($query)                
                ->addIndexColumn()
                ->addColumn('user', function ($item) {
                    return
                    '
                    <div class="d-flex align-items-center">
                        <div class="symbol symbol-50 symbol-sm flex-shrink-0">
                            <div class="symbol-label">
                                <img class="h-75 align-self-center" src="'. asset($item->photo) .'" alt="photo">
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
                ->addColumn('action', function ($item) {
                    return '
                    <td nowrap="nowrap">
                        <a href="javascript:;" class="btn btn-clean btn-icon mr-2" data-id="'.$item->id.'" title="Delete" id="deleteAdmin">
                            <i class="la la-trash icon-lg"></i>
                        </a>
                    </td>
                    ';
                })
                ->rawColumns(['user','action'])
                ->make();
        }
        
        return view('app-owner.admin.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('app-owner.admin.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user   = User::where('email', $request->email)->firstOrFail();
        $userCheck = User::where('email', $request->email)->whereHas("roles", function($q){ 
            $q->where("name", "app-admin")->orWhere("name", "app-owner"); 
        })->first();

        if(!$userCheck){            
            $user->assignRole('app-admin');
            $user->notify(new AttachNewAppAdmin());

            Alert::success('Add New Admin Success.', 'Success')->persistent(true)->autoClose(3600);
            return redirect()->route('app_owner.admin.index');
        }

        Alert::error('Error', 'Something went wrong')->persistent(true)->autoClose(3600);
        return redirect()->back();
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
    public function destroy(Request $request)
    {
        $user = User::find($request->id);

        
        // Remove App Admin Role
        $user->removeRole('app-admin');
        $user->notify(new DetachAppAdmin());
        
        return response()->json('success');
    }
}
