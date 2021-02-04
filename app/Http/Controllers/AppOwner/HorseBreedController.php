<?php

namespace App\Http\Controllers\AppOwner;

use App\Http\Controllers\Controller;
use App\Http\Requests\HorseBreedStore;
use Illuminate\Http\Request;

// Call Models
use App\Models\HorseBreed;

use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Auth;
class HorseBreedController extends Controller
{
    public function index()
    {
        if(request()->ajax())
        {
            $data = HorseBreed::all();
            return datatables()->of($data)
            ->addIndexColumn()
            ->addColumn('breed', function ($data) {
                return $data->name;
            })
            ->addColumn('action', function ($data) {
                return 
                "
                <a href='". route('app_owner.horse.horse_breed.edit', $data->id) ."' class='btn btn-clean btn-icon mr-2' id='editData'>
                    <i class='fas fa-pen edit-horse pointer-link'></i>
                </a>
                <a href='javascript:void(0)' class='btn btn-clean btn-icon mr-2' data-id=".$data->id." id='deleteData'>
                    <i class='fas fa-trash pointer-link'></i>
                </a>
                ";
            })
            ->rawColumns(['action'])
            ->make(true);        
        }
        return view('app-owner.horse-setting-breed.index');
    }

    public function create()
    {
        return view('app-owner.horse-setting-breed.create');
    }

    public function edit($id)
    {
        $item = HorseBreed::find($id);
        return view('app-owner.horse-setting-breed.edit', compact('item'));
    }

    public function store(HorseBreedStore $request, HorseBreed $horseBreed)
    {        
        $horseBreed->name            = $request->name;
        $horseBreed->user_id         = Auth::user()->id;
        
        $horseBreed->save();
        
        Alert::success('Create Data Success.', 'Success.')->persistent(true)->autoClose(3600);
        return redirect()->route('app_owner.horse.horse_breed.index');
    }

    public function update(HorseBreedStore $request, HorseBreed $horseBreed)
    {
        $horseBreed = HorseBreed::find($request->id);
        $horseBreed->name            = $request->name;
        $horseBreed->user_id         = Auth::user()->id;
        
        $horseBreed->update();
        
        Alert::success('Update Data Success.', 'Success.')->persistent(true)->autoClose(3600);
        return redirect()->route('app_owner.horse.horse_breed.index');
    }

    public function destroy(Request $request)
    {
        HorseBreed::find($request->id)->delete();
        return response()->json();
    }
}
