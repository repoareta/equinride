<?php

namespace App\Http\Controllers\AppOwner;

use App\Http\Controllers\Controller;
use App\Http\Requests\HorseSexStore;
use Illuminate\Http\Request;

// Call Models
use App\Models\HorseSex;

use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Auth;
class HorseSexController extends Controller
{
    public function index()
    {        
        return view('app-owner.horse-sex.index');
    }

    public function listJson()
    {
        $data = HorseSex::all();
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
        $horsesex = HorseSex::find($id);
        return response()->json($horsesex);
    }

    public function store(HorseSexStore $request, HorseSex $horsesex)
    {        
        $horsesex->name            = $request->name;
        $horsesex->user_id         = Auth::user()->id;
        
        $horsesex->save();
        
        Alert::success('Create Data Success.', 'Success.')->persistent(true)->autoClose(3600);
        return redirect()->route('owner.horse-sex');
    }

    public function update(HorseSexStore $request, HorseSex $horsesex)
    {
        $horsesex = HorseSex::find($request->id);
        $horsesex->name            = $request->name;
        $horsesex->user_id         = Auth::user()->id;
        
        $horsesex->update();
        
        Alert::success('Update Data Success.', 'Success.')->persistent(true)->autoClose(3600);
        return redirect()->route('owner.horse-sex');
    }

    public function delete(Request $request)
    {
        HorseSex::find($request->id)->delete();
        return response()->json();
    }
}
