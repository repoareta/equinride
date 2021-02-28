<?php

namespace App\Http\Controllers\AppOwner;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Mail\StableApproveStep2;
use App\Mail\StableDeclineStep1;
use App\Mail\StableDeclineStep2;
use App\Notifications\StableRegisteredToStableOwner;

use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

// load model
use App\Models\User;
use App\Models\Stable;
use App\Models\Coach;
use App\Models\Horse;
use App\Models\Package;
use App\Models\Slot;
use App\Models\Province;
use App\Models\City;
use App\Models\District;
use App\Models\Village;

class StableApprovalController extends Controller
{
    // Stable Approval 1
    public function step_1()
    {
        return view('app-owner.stable.approval-step-1');
    }

    /**
     * Undocumented function
     *
     * @param [type] $approvalStatus
     * @return void
     */
    public function jsonApprovalStepOne($approvalStatus = null)
    {
        $stables = Stable::where('approval_status', $approvalStatus);

        return $stables;
    }

    public function jsonPending1()
    {
        $stables = $this->jsonApprovalStepOne();

        return datatables()->of($stables)
        ->addIndexColumn()
        ->addColumn('created_at', function ($row) {
            return date('D, M d Y', strtotime($row->created_at));
        })
        ->addColumn('approval_status', function () {
            return
                "<span class='label font-weight-bold label-lg  label-light-warning label-inline'>
                    Pending
                </span>";
        })
        ->addColumn('action', function ($row) {
            return
            "
            <a href='".route('app_owner.stable.approval.step_1.show', ['stable' => $row->id])."' class='btn btn-clean btn-icon mr-2' title='Detail'>
                <i class='fas fa-eye'></i>
            </a>

            <form class='d-inline' id='formDecline".$row->id."' method='post' action='#'>
            " . method_field('PUT') . csrf_field() . "
                <button class='btn btn-clean btn-icon mr-2' type='submit' id='decline".$row->id."' data-toggle='Decline' data-placement='top' title='Decline'>
                <i class='fas fa-ban'></i>
                </button>
            </form>
            ";
        })
        ->rawColumns(['approval_status','action'])
        ->make(true);
    }

    public function jsonApproved1()
    {
        $stables = $this->jsonApprovalStepOne('Email Sent');
        
        return datatables()->of($stables)
        ->addIndexColumn()
        ->addColumn('created_at', function ($row) {
            return date('D, M d Y', strtotime($row->created_at));
        })
        ->addColumn('approval_status', function ($row) {
            return $row->approval_status == 'Email Sent' ?
                "<span class='label font-weight-bold label-lg  label-light-success label-inline'>
                    Approved
                </span>" : "";
        })
        ->addColumn('action', function ($row) {
            return
            "
            <a href='".route('app_owner.stable.approval.step_1.show', ['stable' => $row])."' target='_blank' class='btn btn-clean btn-icon mr-2'>
                <i class='fas fa-eye'></i>
            </a>
            ";
        })
        ->rawColumns(['approval_status','action'])
        ->make(true);
    }

    public function show(Stable $stable)
    {
        return view('app-owner.stable.review.index', compact('stable'));
    }

    public function stepOneApproval(Request $request, Stable $stable)
    {
        if ($request->approval == 'decline') {
            $this->stepOneDeclineStable($stable);
        }

        $stable->approval_status = 'Email Sent';
        $stable->approval_by = Auth::user()->id;
        $stable->approval_at = Carbon::now();

        $stable->save();

        $data1 = DB::table('stable_user')->where('stable_id', $stable->id)->first();

        $user = User::where('id', $data1->user_id)->first();
        $user->notify(new StableRegisteredToStableOwner($stable));
        
        Alert::success($stable->name.' Email Sent', 'Success.')->persistent(true)->autoClose(3600);
        return redirect()->route('app_owner.stable.approval.step_1.index');
    }

    public function stepOneDeclineStable(Stable $stable)
    {
        $data1 = DB::table('stable_user')->where('stable_id', $stable->id)->first();
        $user = User::where('id', $data1->user_id)->first();

        // Remove Stable Picture
        File::delete(public_path($stable->photo));

        // Delete Stable User
        $stable->users()->detach();

        // Remove Stable Owner Role
        $user->removeRole('stable-owner');

        // Notify Email
        $user->notify(new StableDeclineStep1($stable));

        //Delete Stable
        $stable->delete();

        Alert::success('Stable Decline', 'Success.')->persistent(true)->autoClose(3600);
        return redirect()->back();
    }


    // Stable Approval 2
    public function step_2()
    {
        return view('app-owner.stable.approval-step-2');
    }

    public function jsonPending2()
    {
        $data = Stable::where('approval_status', 'Need Approval')->get();
        return datatables()->of($data)
        ->addIndexColumn()
        ->addColumn('created_at', function ($data) {
            return date('D, M d Y', strtotime($data->created_at));
        })
        ->addColumn('approval_status', function ($data) {
            return $data->approval_status == 'Need Approval' ?
                "<span class='label font-weight-bold label-lg  label-light-warning label-inline'>
                    Pending
                </span>" : "";
        })
        ->addColumn('action', function ($data) {
            return
            "
            <a href='" . route('app_owner.stable.approval.step_2.show', $data->id) . "' class='btn btn-clear mr-2' id='openBtn' data-toggle='Detail' data-placement='top' title='Detail'>
                <i class='fas fa-eye'></i>
            </a>
            ";
        })
        ->rawColumns(['approval_status','action'])
        ->make(true);
    }

    public function jsonApproved2()
    {
        $data = Stable::where('approval_status', 'Accepted')->get();
        return datatables()->of($data)
        ->addIndexColumn()
        ->addColumn('created_at', function ($data) {
            return date('D, M d Y', strtotime($data->created_at));
        })
        ->addColumn('approval_status', function ($data) {
            return $data->approval_status == 'Accepted' ?
                "<span class='label font-weight-bold label-lg  label-light-success label-inline'>
                    ".$data->approval_status."
                </span>" : "";
        })
        ->addColumn('action', function ($data) {
            return
            "
            <a href='" . route('app_owner.stable.approval.step_2.show', $data->id) . "' class='btn btn-clear mr-2' id='openBtn' data-toggle='Detail' data-placement='top' title='Detail'>
                <i class='fas fa-eye'></i>
            </a>
            ";
        })
        ->rawColumns(['approval_status','action'])
        ->make(true);
    }

    public function jsonUnapproved2()
    {
        $data = Stable::where('approval_status', 'Decline')->get();
        return datatables()->of($data)
        ->addIndexColumn()
        ->addColumn('created_at', function ($data) {
            return date('D, M d Y', strtotime($data->created_at));
        })
        ->addColumn('approval_status', function ($data) {
            return $data->approval_status == 'Email Sent' ?
                "<span class='label font-weight-bold label-lg  label-light-danger label-inline'>
                    Decline
                </span>" : "";
        })
        ->addColumn('action', function ($data) {
            return
            "
            <a href='" . route('app_owner.stable.approval.step_2.show', $data->id) . "' class='btn btn-clear mr-2' id='openBtn' data-toggle='Detail' data-placement='top' title='Detail'>
                <i class='fas fa-eye'></i>
            </a>
            ";
        })
        ->rawColumns(['approval_status','action'])
        ->make(true);
    }

    public function show2($id)
    {
        $stable = Stable::where('id', $id)->first();
        $stableUser = DB::table('stable_user')->where('stable_id', $id)->first();
        $province = Province::all();
        $city = City::find($stable->city_id);
        $district = District::find($stable->district_id);
        $village = Village::find($stable->village_id);
        $horse_count = Horse::where('stable_id', $stableUser->stable_id)->where('user_id', $stableUser->user_id)->count();
        $coach_count = Coach::where('stable_id', $stableUser->stable_id)->where('user_id', $stableUser->user_id)->count();
        $package_count = Package::where('stable_id', $stableUser->stable_id)->where('user_id', $stableUser->user_id)->count();
        $slot_count = Slot::where('user_id', $stableUser->user_id)->count();
        if ($stable->capacity_of_stable > 0 and  $stable->number_of_coach > 0 and $stable->capacity_of_arena > 0) {
            $data_setup = 1;
        } else {
            $data_setup = 0;
        }
        return view(
            'app-owner.stable.review.index',
            compact(
                'stable',
                'province',
                'city',
                'district',
                'village',
                'horse_count',
                'coach_count',
                'package_count',
                'slot_count',
                'data_setup'
            )
        );
    }

    public function approveStable2($id)
    {
        $data1 = DB::table('stable_user')->where('stable_id', $id)->first();
        $data2 = Stable::find($data1->stable_id);

        $user = User::where('id', $data1->user_id)->first();
        $user->notify(new StableApproveStep2($data2));

        Stable::where('id', $data2->id)->update([
            'approval_status' => 'Accepted',
            'approval_by' => Auth::user()->id,
            'approval_at' => Carbon::now()
        ]);
        
        $dataPackage = Package::where('stable_id', $id)->get();

        foreach ($dataPackage as $package) {
            Package::where('stable_id', $id)->update([
                'approval_status' => 'Accepted',
                'approval_by' => Auth::user()->id,
                'approval_at' => Carbon::now()
            ]);
        }

        $user = User::where('id', $data1->user_id)->first();
        $user->notify(new StableApproveStep2($data2));
        Alert::success($data2->name.' Accepted', 'Success.')->persistent(true)->autoClose(3600);
        return redirect()->back();
    }

    public function unapproveStable2($id)
    {
        $data = DB::table('stable_user')->where('stable_id', $id)->first();
        $user = User::where('id', $data->user_id)->first();
        $user->notify(new StableDeclineStep2($data));
        Stable::where('id', $data->id)->update([
            'approval_status' => 'Decline',
            'approval_by' => Auth::user()->id,
            'approval_at' => Carbon::now()
        ]);

        Alert::success($data->name.' Decline', 'Success.')->persistent(true)->autoClose(3600);
        return redirect()->back();
    }

    public function approvalStepOne(Request $request, Stable $stable)
    {
        dd($request->all());
    }

    public function approvalStepTwo(Request $request, Stable $stable)
    {
        dd($request->all());
    }
}
