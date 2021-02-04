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
        if(request()->ajax())
        {
            $data = HorseSex::all();
            return datatables()->of($data)
            ->addIndexColumn()
            ->addColumn('sex', function ($data) {
                return $data->name;
            })->addColumn('action', function ($data) {
                return 
                "
                    <a href='javascript:void(0)' data-toggle='modal' data-id='".$data->id."' class='btn btn-clean btn-icon mr-2' id='editData'>
                        <i class='fas fa-pen edit-horse pointer-link'></i>
                    </a>
                    <a href='javascript:void(0)' data-toggle='modal' data-id='".$data->id."' class='btn btn-clean btn-icon mr-2 delete-horse' id='editData'>
                        <i class='fas fa-trash pointer-link'></i>
                    </a>
                ";
            })
            ->rawColumns(['action'])
            ->make(true);
        }        
        return view('app-owner.horse-setting-sex.index');
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
        return redirect()->route('app_owner.horse.horse_sex.index');
    }

    public function update(HorseSexStore $request, HorseSex $horsesex)
    {
        $horsesex = HorseSex::find($request->id);
        $horsesex->name            = $request->name;
        $horsesex->user_id         = Auth::user()->id;
        
        $horsesex->update();
        
        Alert::success('Update Data Success.', 'Success.')->persistent(true)->autoClose(3600);
        return redirect()->route('app_owner.horse.horse_sex.index');
    }

    public function delete(Request $request)
    {
        HorseSex::find($request->id)->delete();
        return response()->json();
    }
}
