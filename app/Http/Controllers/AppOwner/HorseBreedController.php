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
        return view('app-owner.horse-breed.index');
    }

    public function listJson()
    {
        $data = HorseBreed::all();
        return datatables()->of($data)
        ->addColumn('horse_name', function ($data) {
            return $data->name;
        })->addColumn('action', function ($data) {
            return 
            "
                <a href='javascript:void(0)' data-toggle='modal' data-id='".$data->id."' class='mr-2' id='editData'>
                    <i class='fas fa-pen edit-horse pointer-link'></i>                    
                </a>
                <i class='fas fa-trash delete-horse pointer-link' data-id='".$data->id."'></i>
            ";
        })
        ->rawColumns(['profile','action'])
        ->make(true);
    }

    public function edit($id)
    {
        $horseBreed = HorseBreed::find($id);
        return response()->json($horseBreed);
    }

    public function store(HorseBreedStore $request, HorseBreed $horseBreed)
    {        
        $horseBreed->name            = $request->name;
        $horseBreed->user_id         = Auth::user()->id;
        
        $horseBreed->save();
        
        Alert::success('Create Data Success.', 'Success.')->persistent(true)->autoClose(3600);
        return redirect()->route('owner.horse-breed');
    }

    public function update(HorseBreedStore $request, HorseBreed $horseBreed)
    {
        $horseBreed = HorseBreed::find($request->id);
        $horseBreed->name            = $request->name;
        $horseBreed->user_id         = Auth::user()->id;
        
        $horseBreed->update();
        
        Alert::success('Update Data Success.', 'Success.')->persistent(true)->autoClose(3600);
        return redirect()->route('owner.horse-breed');
    }

    public function delete(Request $request)
    {
        HorseBreed::find($request->id)->delete();
        return response()->json();
    }
}
