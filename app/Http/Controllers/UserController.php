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
        $Query = User::find(Auth::user()->id);

        $Query->name         =   $request->name;
        $Query->sex          =   $request->sex;
        $Query->phone        =   $request->phone;
        $Query->birth_date   =   date('Y-m-d',strtotime($request->birth_date));
        $Query->address      =   $request->address;
        

        if($request->hasFile('photo')){
            File::delete(public_path('/storage/user/photo/'.$request->logo));
            $Query->photo = $request->file('photo')->getClientOriginalName();
            $dir = $request->file('photo')->storeAs('user/photo', $Query->photo, 'public');
            $Query->photo = 'storage/'.$dir;
        }else{
            File::delete(public_path('/storage/user/photo/'.$request->logo));
            $Query->photo = null;
        }

        if(!$Query){
            Alert::error('Update Profile Error.', 'Please complete your form.');
            return redirect()->back();
        }
        
        $Query->save();
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
        
        if(Hash::check($request->old_password, $data->password))
        {
            $validator = \Validator::make($request->all(), [
                            'password' => 'required|confirmed|min:8',
                        ]);
            if($validator->fails()){
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

    }
}
