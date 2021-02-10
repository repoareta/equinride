<?php

namespace App\Http\Controllers\Stable;

use App\Http\Controllers\Controller;
use App\Http\Traits\MediaUploadingTrait;
use App\Mail\StableAdminSendSubmitApproval;
use App\Models\City;
use App\Models\District;
use App\Models\Province;
use Illuminate\Http\Request;

// load models
use App\Models\Stable;
use App\Models\User;
use App\Models\Coach;
use App\Models\Horse;
use App\Models\Village;
use App\Notifications\StableRegisteredToStableOwner;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Notification;
use RealRashid\SweetAlert\Facades\Alert;

class StableController extends Controller
{
    use MediaUploadingTrait;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('stable.dashboard');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function register()
    {
        $provinces = Province::all();
        return view('stable.register', compact('provinces'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function registerSubmit(Request $request, Stable $stable)
    {
        // CREATE STABLE
        DB::transaction(function () use ($request, $stable) {
            $key_stable             = Carbon::now()->format('YmdHi');

            $stable->name           = $request->name;
            $stable->contact_person = $request->contact_phone_name;
            $stable->contact_number = $request->contact_phone_number;
            $stable->address        = $request->address;
            $stable->province_id    = $request->province;
            $stable->city_id        = $request->city;
            $stable->district_id    = $request->district;
            $stable->village_id     = $request->village;

            $stable->key_stable     = $key_stable;

            $stable->save();

            // INSERT TO PIVOT
            $stable->users()->attach(Auth::user()->id);
        });
        
        // SET AS STABLE OWNER ROLE
        Auth::user()->assignRole('stable-owner');


        Alert::success('Stable Register Success.', 'Success')->persistent(true)->autoClose(3600);
        return redirect()->route('stable.index');
    }

    /**
     * Undocumented function
     *
     * @return void
     */
    public function edit()
    {
        $stable = Auth::user()->stables->first();

        $provinces = Province::all();

        $cities    = City::whereHas('province', function ($q) use ($stable) {
            $q->where('province_id', $stable->province_id);
        })->get();

        $districts = District::whereHas('city', function ($q) use ($stable) {
            $q->where('city_id', $stable->city_id);
        })->get();

        $villages  = Village::whereHas('district', function ($q) use ($stable) {
            $q->where('district_id', $stable->district_id);
        })->get();

        return view('stable.edit', compact(
            'provinces',
            'cities',
            'districts',
            'villages'
        ));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $stable = Auth::user()->stables->first();

        $stable->name               = $request->name;
        $stable->contact_person     = $request->contact_phone_name;
        $stable->contact_number     = $request->contact_phone_number;
        $stable->address            = $request->address;
        $stable->province_id        = $request->province;
        $stable->city_id            = $request->city;
        $stable->district_id        = $request->district;
        $stable->village_id         = $request->village;
        $stable->owner              = $request->owner;
        $stable->manager            = $request->manager;        
        $stable->facilities         = $request->facilities;    
        $stable->capacity_of_stable = $request->capacity_of_stable;
        $stable->capacity_of_arena  = $request->capacity_of_arena;
        $stable->number_of_coach    = $request->number_of_coach;    
        
        $coachNum1 = Coach::where('stable_id', $stable->id)->get()->count();
        $coachNum2 = $stable->number_of_coach; 
        if($coachNum1 > $coachNum2)
        {
            Alert::error('Error', 'Number of coach cannot smaller than coach data')->persistent(true)->autoClose(3600);
            return redirect()->back();
        }

        $horseNum1      = Horse::where('stable_id', $stable->id)->get()->count();
        $stableCapacity = $stable->capacity_of_stable;                
        if($horseNum1 > $stableCapacity)
        {
            Alert::error('Error', 'Capacity of stable full')->persistent(true)->autoClose(3600);
            return redirect()->back();
        }
        
        if ($request->logo) {
            // delete old logo
            File::delete($stable->logo);
            $stable->logo = $request->logo;
        }

        $stable->save();

        Alert::success('Stable Profile Update Success.', 'Success')->persistent(true)->autoClose(3600);
        return redirect()->route('stable.edit');
    }

    public function stableKeyConfirm()
    {
        return view('stable.stable-key-confirm');
    }

    public function stableKeyConfirmStore(Request $request)
    {
        // CEK JIKA INPUT STABLE KEY BENAR
        $stable = Auth::user()->stables->first();
        // dd($stable->key_stable);die;
        if ($request->stable_key == $stable->key_stable) {
            // SET SESSION stable_key_expired_at = TIME NOW + 3 JAM
            $stable_key_expired_at = Carbon::now()->add(3, 'hours');
            session(['stable_key_expired_at' => $stable_key_expired_at]);

            return redirect()->route('stable.index');
        }

        Alert::error('Stable key not match.')->persistent(true)->autoClose(3600);
        return redirect()->route('stable.stable_key.confirm');
    }

    public function submitApproval($id)
    {
        $data = Stable::find($id);

        $users1 = User::whereHas("roles", function($q){
                            $q->where("name", "app-owner"); 
                        })->get();

        $users2 = User::whereHas("roles", function($q){
                            $q->where("name", "app-admin"); 
                        })->get();
        
        foreach($users1 as $user)
        {
            $send = User::where('id', $user->id)->first();
            $send->notify(new StableAdminSendSubmitApproval($data));
        }

        foreach($users2 as $user)
        {
            $send = User::where('id', $user->id)->first();
            $send->notify(new StableAdminSendSubmitApproval($data));
        }

        Stable::where('id', $data->id)->update([
            'approval_status' => 'Need Approval'
        ]);
        Alert::success($data->name.' Submit Approval Sent', 'Success.')->persistent(true)->autoClose(3600);
        return redirect()->back();
    }
}
