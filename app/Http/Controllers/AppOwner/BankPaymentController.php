<?php

namespace App\Http\Controllers\AppOwner;

use App\Http\Controllers\Controller;
use App\Http\Requests\BankPaymentStore;
use Illuminate\Http\Request;

// Call Models
use App\Models\BankPayment;

use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
class BankPaymentController extends Controller
{
    public function index()
    {
        return view('app-owner.bank.index');
    }

    public function listJson()
    {
        $data = BankPayment::all();
        return datatables()->of($data)
        ->addColumn('account_number', function ($data) {
            return $data->account_number;
        })
        ->addColumn('account_name', function ($data) {
            return $data->account_name;
        })
        ->addColumn('branch', function ($data) {
            return $data->branch;
        })
        ->editColumn('photo', function ($data) {
            return $data->photo ? '<img src="' . asset('storage/'.$data->photo) . '" style="max-width: 200px">' : '';
        })
        ->addColumn('horse_name', function ($data) {
            return $data->name;
        })->addColumn('action', function ($data) {
            return 
            "
                <a href='javascript:void(0)' data-toggle='modal' data-id='".$data->id."' class='mr-2' id='editData'>
                    <i class='fas fa-pen edit-bank pointer-link'></i>                    
                </a>
                <i class='fas fa-trash delete-bank pointer-link' data-id='".$data->id."'></i>
            ";
        })
        ->rawColumns(['photo','action'])
        ->make(true);
    }

    public function edit($id)
    {
        $bankPayment = BankPayment::find($id);
        return response()->json($bankPayment);
    }

    public function store(BankPaymentStore $request, BankPayment $bankPayment)
    {        
        $bankPayment->account_number    = $request->account_number;
        $bankPayment->account_name      = $request->account_name;
        $bankPayment->branch            = $request->branch;
        $bankPayment->photo = $request->photo;
        if($request->hasFile('photo')){
            $bankPayment->photo = $request->file('photo')->store('bank_payment/photo', 'public');
        }
        $bankPayment->user_id         = Auth::user()->id;    

        $bankPayment->save();
        
        Alert::success('Create Data Success.', 'Success.')->persistent(true)->autoClose(3600);
        return redirect()->route('owner.bank');
    }

    public function update(BankPaymentStore $request, BankPayment $bankPayment)
    {
        $bankPayment = BankPayment::find($request->id);
        $bankPayment->account_number    = $request->account_number;
        $bankPayment->account_name      = $request->account_name;
        $bankPayment->branch            = $request->branch;
        if ($request->hasFile('photo')) {
            File::delete(public_path('/storage/bank_payment/photo/'.$bankPayment->photo));
            $bankPayment->photo = $request->file('photo')->store('bank_payment/photo', 'public');
        } else {
            $bankPayment->photo = $request->file('photo')->store('bank_payment/photo', 'public');
        }
        $bankPayment->user_id         = Auth::user()->id;
        
        $bankPayment->update();
        
        Alert::success('Update Data Success.', 'Success.')->persistent(true)->autoClose(3600);
        return redirect()->route('owner.bank');
    }

    public function delete(Request $request)
    {
        $bankPayment = BankPayment::find($request->id);
        if ($bankPayment->photo) {
            File::delete(public_path('/storage/bank_payment/photo/'.$bankPayment->photo));
            $bankPayment->delete();
        }
        $bankPayment->delete();
        return response()->json();
    }
}