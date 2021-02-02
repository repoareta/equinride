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
use App\Models\Horse;
use App\Models\Stable;
use App\Models\HorseSex;
use App\Models\HorseBreed;

//load form request (for validation)
use App\Http\Requests\HorseStore;
class HorseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(request()->ajax()){

            $query = Horse::where('user_id', Auth::user()->id)->get();
            return Datatables::of($query)
                ->addIndexColumn()
                ->addColumn('age', function($item){
                    $dateOfBirth = $item->birth_date;
                    return Carbon::parse($dateOfBirth)->age;
                })
                ->addColumn('birth_date', function($item){
                    return date('D, M d, Y', strtotime($item->birth_date));
                })
                ->addColumn('horse_sex', function($item){
                    return $item->sex->name;
                })
                ->addColumn('horse_breed', function($item){
                    return $item->breed->name;
                })
                ->addColumn('passport_number', function($item){
                    return $item->passport_number == null ? 
                    "<span class='label font-weight-bold label-lg  label-light-danger label-inline'>Not Found</span>" : 
                    $item->passport_number;
                })
                ->addColumn('pedigree_male', function($item){
                    return $item->pedigree_male == null ? 
                    "<span class='label font-weight-bold label-lg  label-light-danger label-inline'>Not Found</span>" : 
                    $item->pedigree_male;
                })
                ->addColumn('pedigree_female', function($item){
                    return $item->pedigree_female == null ? 
                    "<span class='label font-weight-bold label-lg  label-light-danger label-inline'>Not Found</span>" : 
                    $item->pedigree_female;
                })
                ->addColumn('action', function($item){
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
                ->rawColumns(['action', 'pedigree_female', 'pedigree_male', 'passport_number'])
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
        $sexs = HorseSex::all();
        $breeds = HorseBreed::all();

        return view('stable.horse.create', compact('sexs', 'breeds'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(HorseStore $request, Horse $horse)
    {
        if($request->hasFile('photo')){
            File::delete(public_path('/storage/horse/photo/'.$request->photo));
            $horse->photo = $request->file('photo')->getClientOriginalName();
            $dir = $request->file('photo')->storeAs('horse/photo', $horse->photo, 'public');
            $horse->photo = 'storage/'.$dir;
        }

        // Check Stable
        $stable = Stable::where('user_id', Auth::user()->id)->first();

        $horse->name            = $request->name;
        $horse->owner           = $request->owner;
        $horse->birth_date      = $request->birth_date;
        $horse->horse_sex_id    = $request->horse_sex_id;
        $horse->horse_breed_id  = $request->horse_breed_id;
        $horse->passport_number = $request->passport_number;
        $horse->pedigree_male   = $request->pedigree_male;
        $horse->pedigree_female = $request->pedigree_female;
        $horse->stable_id       = $stable->id;
        $horse->user_id         = Auth::user()->id;

        if(!$horse){
            Alert::error('Create Horse Error.', 'Please complete your form.');
            return redirect()->back();
        }
        
        $horse->save();

        Alert::success('Create Horse Success.', 'Success.')->persistent(true)->autoClose(3600);
        return redirect()->route('stable.horse.index');  
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
        if($request->hasFile('photo')){
            File::delete(public_path('/storage/horse/photo/'.$request->photo));
            $horse->photo = $request->file('photo')->getClientOriginalName();
            $dir = $request->file('photo')->storeAs('horse/photo', $horse->photo, 'public');
            $horse->photo = 'storage/'.$dir;
        }

        // Check Stable
        $stable = Stable::where('user_id', Auth::user()->id)->first();

        $horse->name            = $request->name;
        $horse->owner           = $request->owner;
        $horse->birth_date      = $request->birth_date;
        $horse->horse_sex_id    = $request->horse_sex_id;
        $horse->horse_breed_id  = $request->horse_breed_id;
        $horse->passport_number = $request->passport_number;
        $horse->pedigree_male   = $request->pedigree_male;
        $horse->pedigree_female = $request->pedigree_female;
        $horse->stable_id       = $stable->id;
        $horse->user_id         = Auth::user()->id;

        if(!$horse){
            Alert::error('Create Horse Error.', 'Please complete your form.');
            return redirect()->back();
        }
        
        $horse->save();

        Alert::success('Create Horse Success.', 'Success.')->persistent(true)->autoClose(3600);
        return redirect()->route('stable.horse.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        Horse::find($request->id)->delete();
        return response()->json();
    }
}
