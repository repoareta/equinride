<?php

namespace App\Http\Controllers\Stable;

use App\Events\StableCreated;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

// load models
use App\Models\Stable;
use App\Models\User;
use App\Models\Coach;
use App\Models\Horse;
use App\Models\City;
use App\Models\District;
use App\Models\Province;
use App\Models\Village;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use RealRashid\SweetAlert\Facades\Alert;
use App\Http\Traits\MediaUploadingTrait;
use App\Mail\StableAdminSendSubmitApproval;
use App\Mail\StableResetKey;
use App\Models\BookingDetail;
use App\Models\Booking;
use App\Models\Slot;

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
            $key_stable              = Carbon::now()->format('YmdHi');

            $stable->name            = $request->name;
            $stable->contact_person  = $request->contact_phone_name;
            $stable->contact_number  = $request->contact_phone_number;
            $stable->address         = $request->address;
            $stable->province_id     = $request->province;
            $stable->city_id         = $request->city;
            $stable->district_id     = $request->district;
            $stable->village_id      = $request->village;

            $stable->approval_status = 'Step 1 Need Approval';
            $stable->key_stable      = $key_stable;

            $stable->save();

            // INSERT TO PIVOT
            $stable->users()->attach(
                Auth::user()->id,
                array(
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s')
                )
            );
        });
        
        // SET AS STABLE OWNER ROLE
        Auth::user()->assignRole('stable-owner');
        
        // trigger event StableCreated
        // for app-owner and app-admin
        event(new StableCreated($stable));

        Alert::success('Stable Register Success.', 'You already submit your stable. 
        Your request will be reviewed by Apps Owner. Notification will be sent to your e-mail.')->persistent(true)->autoClose(3600);

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
        if ($coachNum1 > $coachNum2) {
            Alert::error('Error', 'Number of coach cannot smaller than coach data')->persistent(true)->autoClose(3600);
            return redirect()->back();
        }

        $horse_count      = Horse::where('stable_id', $stable->id)->get()->count();
        $stableCapacity = $stable->capacity_of_stable;
        if ($horse_count > $stableCapacity) {
            Alert::error('Error', 'Capacity of stable is full')->persistent(true)->autoClose(3600);
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

    public function stableKeyForget()
    {
        return view('stable.stable-key-forget');
    }

    public function stableKeyForgetStore()
    {
        $stable = Auth::user()->stables->first();

        $key_stable              = Carbon::now()->format('YmdHi');
        $stable->key_stable      = $key_stable;
        
        $stable->update();
        
        $users = DB::table('stable_user')
                    ->where('stable_id', $stable->id)
                    ->get();
        
        foreach ($users as $user) {
            $send = User::where('id', $user->user_id)->first();
            $send->notify(new StableResetKey($stable));
        }


        if($stable){
            Alert::success('Success', 'Stable key has been reset, please check your email')->persistent(true)->autoClose(3600);
            return redirect()->route('stable.stable_key.confirm');
        }
    }

    public function stepTwoApprovalRequest(Stable $stable)
    {
        $stable->approval_status = 'Step 2 Need Approval';
        $stable->save();

        $users1 = User::whereHas("roles", function ($q) {
            $q->where("name", "app-owner");
        })->get();

        $users2 = User::whereHas("roles", function ($q) {
            $q->where("name", "app-admin");
        })->get();
        
        foreach ($users1 as $user) {
            $send = User::where('id', $user->id)->first();
            $send->notify(new StableAdminSendSubmitApproval($stable));
        }

        foreach ($users2 as $user) {
            $send = User::where('id', $user->id)->first();
            $send->notify(new StableAdminSendSubmitApproval($stable));
        }

        Alert::success($stable->name.' Step 2 Approval Request Sent', 'You already submit your info. 
        Your request will be reviewed by Apps Owner. Notification will be sent to your e-mail.')
        ->persistent(true)->autoClose(3600);

        return redirect()->back();
    }

    public function assignHorseAndCoach($slot, $user){

        $slot_user = DB::table('slot_user')
                    ->where('slot_id', $slot)
                    ->where('user_id', $user)
                    ->first();        
    
        $slot = Slot::find($slot_user->slot_id);

        $stable = Stable::with(['horses','coaches'])->find($slot->stable_id);

        $booking_detail = BookingDetail::with(['package', 'booking.user'])->find($slot_user->booking_detail_id);

        $userData = User::find($user);
        
        return view('stable.assign-horse-and-coach', [
            'booking_detail' => $booking_detail,
            'stable' => $stable,
            'slot' => $slot,
            'user' => $userData
        ]);
    }

    public function assignHorseAndCoachStore($slot, $user, Request $request){
        $slot_user = DB::table('slot_user')
                    ->where('slot_id', $slot)
                    ->where('user_id', $user)
                    ->orderByDesc('id')
                    ->first();

        DB::table('slot_user')
            ->where('id', $slot_user->id)
            ->update([
                'horse_id' => $request->horse_id,
                'coach_id' => $request->coach_id,
                'updated_at' => Carbon::now()
            ]);

        $booking_detail = BookingDetail::find($slot_user->booking_detail_id);

        $booking = Booking::find($booking_detail->booking_id);

        $booking->approval_status = "Close";
        $booking->update();

        Alert::success('Success', 'Horse and Coach assigned')->persistent(true)->autoClose(3600);
        return redirect()->route('stable.index');
    }
}
