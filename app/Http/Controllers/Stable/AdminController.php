<?php

namespace App\Http\Controllers\Stable;

use App\Http\Controllers\Controller;
use App\Mail\AttachNewStableAdmin;
use App\Mail\DetachStableAdmin;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;
use RealRashid\SweetAlert\Facades\Alert;

// Load Models
use App\Models\User;
use App\Models\Stable;
class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $stable = Auth::user()->stables->first()->pivot;
        $query = Stable::with(['users'=> function ($q){
            $q->whereHas("roles", function($q){ 
                $q->where("name", "stable-admin"); 
            });
        }])->where('id', $stable->stable_id)->first()->users;
        if (request()->ajax()) {
            return DataTables::of($query)                
                ->addIndexColumn()
                ->addColumn('user', function ($item) {
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
        
        return view('stable.admin.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('stable.admin.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $stable = Auth::user()->stables->first();

        $user   = User::where('email', $request->email)->firstOrFail();
        $userCheck = User::where('email', $request->email)->whereHas("roles", function($q){ 
            $q->where("name", "stable-admin")->orWhere("name", "stable-owner"); 
        })->first();


        if(!$userCheck){            
            $stable->users()->attach($user->id);
            $user->assignRole('stable-admin');
            $user->notify(new AttachNewStableAdmin($stable));

            Alert::success('Add New Admin Success.', 'Success')->persistent(true)->autoClose(3600);
            return redirect()->route('stable.admin.index');
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
        $stable = $user->stables->first();

        // Delete Stable User
        $user->notify(new DetachStableAdmin($stable));
        $stable->users()->detach($user->id);

        // Remove Stable Admin Role
        $user->removeRole('stable-admin');

        return response()->json('success');
    }
}
