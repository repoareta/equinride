<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;

// Load models
use App\Models\User;

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
        // $user->height     = $request->height;
        // $user->weight     = $request->weight;
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
            $validator = \Validator::make($request->all(), [
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
        return view('booking.booking-history');
    }
}
