<?php

namespace App\Http\Controllers\AppOwner;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

// Call Models
use App\Models\BankPayment;

use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Auth;
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
                return $data->photo ? '<img src="' . asset($data->photo) . '" class="max-w-200px h-35px">' : 'Photo not available';
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
        return view('app-owner.payment-setting-bank.create');
    }    

    public function store(Request $request, BankPayment $bankPayment)
    {        
        try {
            
            $bankPayment->account_number    = $request->account_number;
            $bankPayment->account_name      = $request->account_name;
            $bankPayment->branch            = $request->branch;
            $bankPayment->photo             = $request->photo;
            $bankPayment->user_id           = Auth::user()->id;    
    
            $bankPayment->save();

            return response()->json(['status'=>"success", 'bankid'=>$bankPayment->id]);
        } catch (\Exception $e) {
            return response()->json(['status'=>'exception', 'msg'=>$e->getMessage()]);
        }
    }

    public function edit($id)
    {
        $item = BankPayment::find($id);
        return view('app-owner.payment-setting-bank.edit', compact('item'));
    }

    public function update(Request $request, $id)
    {
        // $bankPayment = BankPayment::find($request->id);
        try {        
            $bankPayment                    = BankPayment::find($id);
            $bankPayment->account_number    = $request->account_number;
            $bankPayment->account_name      = $request->account_name;
            $bankPayment->branch            = $request->branch;
            $bankPayment->photo             = $request->photo;
            $bankPayment->user_id           = Auth::user()->id;
            
            $bankPayment->update();
            return response()->json(['status'=>"success", 'bankid'=>$bankPayment->id]);
        } catch (\Exception$e) {
            return response()->json(['status'=>'exception', 'msg'=>$e->getMessage()]);
        }
    }

    public function destroy(Request $request)
    {
        $bankPayment = BankPayment::find($request->id);
        if ($bankPayment->photo) {
            File::delete(public_path($bankPayment->photo));
            $bankPayment->delete();
        }
        $bankPayment->delete();
        return response()->json();
    }

    // Store image to database and directory from dropZone
    public function storeImage(Request $request)
    {
        if($request->file('photo')){
            
            //here we are geeting bankid align with an image
            $bank = BankPayment::find($request->bankid);
            File::delete(public_path($request->photo));
            $name = $request->file('photo')->getClientOriginalName();
            $dir = $request->file('photo')->storeAs('bank_payment/photo', $name, 'public');
            $nameDir = 'storage/'.$dir;
            $bank->photo = $nameDir;
            $bank->update();

            return response()->json(['status'=>"success",'imgdata'=>$nameDir,'bankid'=>$bank->id]);
        }
    }
}