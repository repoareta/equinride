<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;
use Yajra\DataTables\Facades\DataTables;
use Carbon\Carbon;

// Load models
use App\Models\User;
use App\Models\Booking;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    // Personal Information page index
    public function personalInformation()
    {
        return view('user.personal-information');
    }

    // Personal Information update data
    public function personalInformationUpdate(Request $request)
    {
        $user = User::find(Auth::user()->id);

        $user->name       = $request->name;
        $user->sex        = $request->sex;
        $user->phone      = $request->phone;
        $user->height     = $request->height;
        $user->weight     = $request->weight;
        $user->birth_date = $request->birth_date;
        $user->address    = $request->address;

        if ($request->hasFile('photo')) {
            // delete old photo
            File::delete(public_path('/storage/user/photo/'.$request->photo));
            $user->photo = $request->file('photo')->getClientOriginalName();
            $dir = $request->file('photo')->storeAs('user/photo', $user->photo, 'public');
            $user->photo = 'storage/'.$dir;
        }
        
        $user->save();

        Alert::success('Update Success.', 'Success.')->persistent(true)->autoClose(3600);
        return redirect()->back();
    }

    // Change Password page index
    public function changePassword()
    {
        return view('user.change-password');
    }

    // Change Password update data
    public function changePasswordUpdate(Request $request)
    {
        $data = User::where('id', Auth::user()->id)->first();
        
        if (Hash::check($request->old_password, $data->password)) {
            $validator = Validator::make($request->all(), [
                            'password' => 'required|confirmed|min:8',
                        ]);
            if ($validator->fails()) {
                Alert::error('Something wrong.', 'Decline.')->persistent(true)->autoClose(3600);
                return redirect()->back();
            }

            $data->password = Hash::make($request->password);
            $data->update();

            Alert::success('Password Updated', 'Success.')->persistent(true)->autoClose(3600);
            return redirect()->back();
        }

        Alert::error('Something wrong.', 'Decline.')->persistent(true)->autoClose(3600);
        return redirect()->back();
    }

    // Order History page index
    public function orderHistory()
    {
        $query = Booking::where('user_id', Auth::user()->id)->get();
        if (request()->ajax()) {
            return Datatables::of($query)
                ->addIndexColumn()
                ->addColumn('package', function ($item) {
                    return
                    '
                    <div class="d-flex align-items-center">
                        <div class="symbol symbol-50 symbol-sm flex-shrink-0">
                            <div class="symbol-label">
                                <img class="h-75 align-self-end" src="'. asset('assets/media/products/6.png') .'" alt="photo">
                            </div>
                        </div>
                        <div class="d-flex flex-column ml-3">
                            <div class="text-primary font-weight-bolder font-size-lg">'.$item->booking_detail->package_name.'</div>
                            <span class="text-muted font-weight-bold font-size-sm">'.$item->booking_detail->stable_name.'</span>
                        </div>
                    </div>                    
                    ';
                })
                ->addColumn('created_at', function ($item) {
                    return date('D, M d, Y', strtotime($item->created_at));
                })
                ->addColumn('approval_status', function ($item) {
                    if ($item->approval_status == null) {
                        return "<span class='label font-weight-bold label-lg  label-light-warning label-inline'>Pending</span>";
                    } elseif ($item->approval_status == 'Accepted') {
                        return "<span class='label font-weight-bold label-lg  label-light-success label-inline'>".$item->approval_status."</span>";
                    } else {
                        return "<span class='label font-weight-bold label-lg  label-light-danger label-inline'>".$item->approval_status."</span>";
                    }
                })
                ->addColumn('order_location', function ($item) {
                    return $item->booking_detail->stable_location;
                })
                ->addColumn('action', function () {
                    return '
                    <td nowrap="nowrap">
                        <a href="#" class="btn btn-clean btn-icon mr-2" title="Edit details">
                            <i class="la la-eye icon-xl"></i>
                        </a>
                    </td>
                    ';
                })
                ->rawColumns(['action', 'approval_status', 'package'])
                ->make();
        }
        return view('booking.booking-history');
    }
}
