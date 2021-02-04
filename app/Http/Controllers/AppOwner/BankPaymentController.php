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
        if(request()->ajax())
        {
            $data = BankPayment::all();
            return datatables()->of($data)
            ->addIndexColumn()
            ->editColumn('photo', function ($data) {
                return $data->photo ? '<img src="' . asset($data->photo) . '" style="max-width: 200px">' : 'Photo not available';
            })
            ->addColumn('action', function ($data) {
                return 
                "
                    <a href='". route('app_owner.bank.edit', $data->id) ."' class='btn btn-clean btn-icon mr-2' id='editData'>
                        <i class='fas fa-pen edit-horse pointer-link'></i>
                    </a>
                    <a href='javascript:void(0)' data-toggle='modal' data-id='".$data->id."' class='btn btn-clean btn-icon mr-2' id='deleteData'>
                        <i class='fas fa-trash pointer-link'></i>
                    </a>
                ";
            })
            ->rawColumns(['photo','action'])
            ->make(true);
        }
        return view('app-owner.payment-setting-bank.index');
    }

    public function create()
    {
        return view('app-wner.payment-setting-bank.create');
    }    

    public function store(BankPaymentStore $request, BankPayment $bankPayment)
    {        
        $bankPayment->account_number    = $request->account_number;
        $bankPayment->account_name      = $request->account_name;
        $bankPayment->branch            = $request->branch;
        $bankPayment->photo             = $request->photo;
        if($request->hasFile('photo')){
            File::delete(public_path($bankPayment->photo));
            $dir = $request->file('photo')->store('bank_payment/photo', 'public');
            $bankPayment->photo = 'storage/'.$dir;
        }
        $bankPayment->user_id         = Auth::user()->id;    

        $bankPayment->save();
        
        Alert::success('Create Data Success.', 'Success.')->persistent(true)->autoClose(3600);
        return redirect()->route('app_owner.bank.index');
    }

    public function edit($id)
    {
        $item = BankPayment::find($id);
        return view('app-wner.payment-setting-bank.edit', compact('item'));
    }

    public function update(BankPaymentStore $request, BankPayment $bankPayment)
    {
        // $bankPayment = BankPayment::find($request->id);
        $bankPayment->account_number    = $request->account_number;
        $bankPayment->account_name      = $request->account_name;
        $bankPayment->branch            = $request->branch;
        $bankPayment->photo             = $request->photo;
        if ($request->hasFile('photo')) {
            File::delete(public_path($bankPayment->photo));
            $dir = $request->file('photo')->store('bank_payment/photo', 'public');
            $bankPayment->photo = 'storage/'.$dir;
        }
        $bankPayment->user_id         = Auth::user()->id;
        
        $bankPayment->update();
        
        Alert::success('Update Data Success.', 'Success.')->persistent(true)->autoClose(3600);
        return redirect()->route('app_owner.bank.index');
    }

    public function delete(Request $request)
    {
        $bankPayment = BankPayment::find($request->id);
        if ($bankPayment->photo) {
            File::delete(public_path($bankPayment->photo));
            $bankPayment->delete();
        }
        $bankPayment->delete();
        return response()->json();
    }
}