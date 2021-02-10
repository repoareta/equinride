<?php

namespace App\Http\Controllers\Stable;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;
use Carbon\Carbon;

// load model
use App\Models\Coach;
use App\Models\Stable;
class CoachController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(request()->ajax()){
            $stable = Auth::user()->stables->first()->pivot;
            $query = Coach::where('user_id', $stable->user_id)->get();
            return Datatables::of($query)
                ->addIndexColumn()
                ->addColumn('coach', function ($item) {
                    return
                    '
                    <div class="d-flex align-items-center">
                        <div class="symbol symbol-50 symbol-sm flex-shrink-0">
                            <div class="symbol-label">
                                <img class="h-75 align-self-end" src="'. asset($item->photo) .'" alt="photo">
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
                ->addColumn('experience', function($item){
                    return $item->experience.' Years';
                })
                ->addColumn('action', function($item){
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
                ->rawColumns(['coach','action'])
                ->make();
        }
        return view('stable.coach.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $stable    = Auth::user()->stables->first()->pivot;
        $coachNum1 = Coach::where('stable_id', $stable->stable_id)->get()->count();
        $coachNum2 = Stable::find($stable->stable_id)->number_of_coach;        

        if($coachNum1 == $coachNum2)
        {
            Alert::error('Error', 'Number of coach full')->persistent(true)->autoClose(3600);
            return redirect()->back();
        }

        return view('stable.coach.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Coach $coach)
    {
        try {
            // Check Stable
            $stable = Auth::user()->stables->first()->pivot;

            $coach->name            = $request->name;            
            $coach->birth_date      = $request->birth_date;
            $coach->sex             = $request->sex;
            $coach->experience      = $request->experience;
            $coach->contact_number  = $request->contact_number;
            $coach->certified       = $request->certified;            
            $coach->stable_id       = $stable->stable_id;
            $coach->user_id         = $stable->user_id;

            $coach->save();

            return response()->json(['status'=>"success", 'coachid'=>$coach->id]);
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
        $item = Coach::find($id);
        return view('stable.coach.edit', compact('item'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Coach $coach)
    {
        try {
            // Check Stable
            $stable = Auth::user()->stables->first()->pivot;

            $coach->name            = $request->name;            
            $coach->birth_date      = $request->birth_date;
            $coach->sex             = $request->sex;
            $coach->experience      = $request->experience;
            $coach->contact_number  = $request->contact_number;
            $coach->certified       = $request->certified;            
            $coach->stable_id       = $stable->stable_id;
            $coach->user_id         = $stable->user_id;
            
            $coach->save();
            return response()->json(['status'=>"success", 'coachid'=>$coach->id]);
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
        $data = Coach::find($request->id);
        File::delete(public_path($data->photo));
        $data->delete();
        return response()->json();
    }

    // Store image to database and directory from dropZone
    public function storeImage(Request $request)
    {
        if($request->file('photo')){
            
            //here we are geeting coachid align with an image
            $coach = Coach::find($request->coachid);
            File::delete(public_path($coach->photo));
            $name = $request->file('photo')->getClientOriginalName();
            $dir = $request->file('photo')->storeAs('coach/photo', $name, 'public');
            $nameDir = 'storage/'.$dir;
            $coach->photo = $nameDir;
            $coach->update();

            return response()->json(['status'=>"success",'imgdata'=>$nameDir,'coachid'=>$coach->id]);
        }
    }
}
