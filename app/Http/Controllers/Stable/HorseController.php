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
use App\Models\Horse;
use App\Models\Stable;
use App\Models\HorseSex;
use App\Models\HorseBreed;

class HorseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->ajax()) {
            $horses = Horse::where('stable_id', Auth::user()->stables->first()->id)->orderBy('id', 'desc');
            return Datatables::of($horses)
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
                ->addColumn('action', function ($item) {
                    return '
                    <td nowrap="nowrap">
                        <a href="'. route("stable.horse.edit", $item->id) . '" class="btn btn-clean btn-icon mr-2" title="Edit details">
                            <i class="la la-edit icon-xl"></i>
                        </a>
                        <a href="javascript:;" class="btn btn-clean btn-icon mr-2" data-id="'.$item->id.'" title="Delete details" id="deleteHorse">
                            <i class="la la-trash icon-lg"></i>
                        </a>
                    </td>
                    ';
                })
                ->rawColumns(['action', 'horse' ,'pedigree_female', 'pedigree_male', 'passport_number'])
                ->make();
        }
        return view('stable.horse.index');
    }
    
    /**
     * To Display data on datatables
     *
     * @return \Illuminate\Http\Response
     */

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $sexes  = HorseSex::all();
        $breeds = HorseBreed::all();

        $stable         = Auth::user()->stables->first()->pivot;
        $horseNum1      = Horse::where('stable_id', $stable->stable_id)->get()->count();
        $stableCapacity = Stable::find($stable->stable_id)->capacity_of_stable;

        if ($horseNum1 == $stableCapacity) {
            Alert::error('Error', 'Capacity of stable full')->persistent(true)->autoClose(3600);
            return redirect()->back();
        }
        
        return view('stable.horse.create', compact('sexes', 'breeds'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Horse $horse)
    {
        try {
            // Check Stable
            $stable = Auth::user()->stables->first()->pivot;

            $horse->name            = $request->name;
            $horse->owner           = $request->owner;
            $horse->birth_date      = $request->birth_date;
            $horse->horse_sex_id    = $request->horse_sex_id;
            $horse->horse_breed_id  = $request->horse_breed_id;
            $horse->passport_number = $request->passport_number;
            $horse->pedigree_male   = $request->pedigree_male;
            $horse->pedigree_female = $request->pedigree_female;
            $horse->stable_id       = $stable->stable_id;
            $horse->user_id         = $stable->user_id;

            $horse->save();

            return response()->json(['status'=>"success", 'horseid'=>$horse->id]);
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
        $item = Horse::find($id);
        $sexes = HorseSex::all();
        $breeds = HorseBreed::all();

        return view('stable.horse.edit', compact('item', 'sexes', 'breeds'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Horse $horse)
    {
        try {
            // Check Stable
            $stable = Auth::user()->stables->first()->pivot;
            
            $horse->name            = $request->name;
            $horse->owner           = $request->owner;
            $horse->birth_date      = $request->birth_date;
            $horse->horse_sex_id    = $request->horse_sex_id;
            $horse->horse_breed_id  = $request->horse_breed_id;
            $horse->passport_number = $request->passport_number;
            $horse->pedigree_male   = $request->pedigree_male;
            $horse->pedigree_female = $request->pedigree_female;
            $horse->stable_id       = $stable->stable_id;
            $horse->user_id         = $stable->user_id;
            
            $horse->save();
            return response()->json(['status'=>"success", 'horseid'=>$horse->id]);
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
        $data = Horse::find($request->id);
        File::delete(public_path($data->photo));
        $data->delete();
        return response()->json();
    }

    // Store image to database and directory from dropZone
    public function storeImage(Request $request)
    {
        if ($request->file('photo')) {
            
            //here we are geeting horseid align with an image
            $horse = Horse::find($request->horseid);
            File::delete(public_path('/storage/horse/photo/'.$request->photo));
            $name = $request->file('photo')->getClientOriginalName();
            $dir = $request->file('photo')->storeAs('horse/photo', $name, 'public');
            $nameDir = 'storage/'.$dir;
            $horse->photo = $nameDir;
            $horse->update();

            return response()->json(['status'=>"success",'imgdata'=>$nameDir,'horseid'=>$horse->id]);
        }
    }
}
