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
use App\Models\Package;

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
     * @param Request $request
     * @return void
     */
    public function stepOneApprovalJson(Request $request)
    {
        $stables = Stable::where('approval_status', $request->approval_status);

        return datatables()->of($stables)
        ->addIndexColumn()
        ->addColumn('created_at', function ($row) {
            return date('D, M d Y', strtotime($row->created_at));
        })
        ->addColumn('approval_status', function ($row) {
            if ($row->approval_status == 'Step 1 Approved') {
                return
                    "<span class='label font-weight-bold label-lg  label-light-success label-inline'>
                        $row->approval_status
                    </span>";
            }

            // default return pending
            return
                "<span class='label font-weight-bold label-lg  label-light-warning label-inline'>
                    $row->approval_status
                </span>";
        })
        ->addColumn('action', function ($row) {
            return
                "<a href='".route('app_owner.stable.approval.step_1.show', ['stable' => $row->id])."' target='_blank' class='btn btn-clean btn-icon mr-2' title='Detail'>
                    <i class='fas fa-eye'></i>
                </a>";
        })
        ->rawColumns(['approval_status','action'])
        ->make(true);
    }

    /**
     * Stable Show Detail
     *
     * @param Stable $stable
     * @return void
     */
    public function show(Stable $stable)
    {
        return view('app-owner.stable.review.index', compact('stable'));
    }

    public function stepOneApproval(Request $request, Stable $stable)
    {
        if ($request->approval == 'decline') {
            $this->stepOneDeclineStable($stable);
        }

        $stable->approval_status = 'Step 1 Approved';
        $stable->approval_by = Auth::user()->id;
        $stable->approval_at = Carbon::now();

        $stable->save();

        $data1 = DB::table('stable_user')->where('stable_id', $stable->id)->first();

        $user = User::where('id', $data1->user_id)->first();
        $user->notify(new StableRegisteredToStableOwner($stable));
        
        Alert::success($stable->name.' Step 1 Approved', 'Success.')->persistent(true)->autoClose(3600);
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

    public function stepTwoApprovalJson(Request $request)
    {
        $stables = Stable::where('approval_status', $request->approval_status);

        return datatables()->of($stables)
        ->addIndexColumn()
        ->addColumn('created_at', function ($row) {
            return date('D, M d Y', strtotime($row->created_at));
        })
        ->addColumn('approval_status', function ($row) {
            if ($row->approval_status == 'Step 2 Approved') {
                return
                    "<span class='label font-weight-bold label-lg  label-light-success label-inline'>
                        $row->approval_status
                    </span>";
            } elseif ($row->approval_status == 'Step 2 Decline') {
                return
                    "<span class='label font-weight-bold label-lg  label-light-danger label-inline'>
                        $row->approval_status
                    </span>";
            }
            // default return Pending
            return
                    "<span class='label font-weight-bold label-lg  label-light-warning label-inline'>
                        $row->approval_status
                    </span>";
        })
        ->addColumn('action', function ($row) {
            return
                "<a href='" . route('app_owner.stable.approval.step_2.show', $row->id) . "' class='btn btn-clear mr-2' target='_blank' title='Detail'>
                    <i class='fas fa-eye'></i>
                </a>";
        })
        ->rawColumns(['approval_status','action'])
        ->make(true);
    }

    public function stepTwoApproval(Request $request, Stable $stable)
    {
        if ($request->approval == 'decline') {
            $this->stepTwoDeclineStable($stable);
        }

        $stable->approval_status = 'Step 2 Approved';
        $stable->approval_by = Auth::user()->id;
        $stable->approval_at = Carbon::now();

        $stable->save();

        $packages = Package::where('stable_id', $stable->id)->get();

        foreach ($packages as $package) {
            Package::where('stable_id', $stable->id)->update([
                'approval_status' => 'Accepted',
                'approval_by' => Auth::user()->id,
                'approval_at' => Carbon::now()
            ]);
        }

        $stableUsers = DB::table('stable_user')->where('stable_id', $stable->id)->first();

        $user = User::where('id', $stableUsers->user_id)->first();
        $user->notify(new StableApproveStep2($stable));

        Alert::success($stable->name.' Accepted', 'Success.')->persistent(true)->autoClose(3600);
        return redirect()->route('app_owner.stable.approval.step_2.index');
    }

    public function stepTwoDeclineStable(Stable $stable)
    {
        $stable->approval_status = 'Step 2 Decline';
        $stable->approval_by = Auth::user()->id;
        $stable->approval_at = Carbon::now();

        $stable->save();

        $data = DB::table('stable_user')->where('stable_id', $stable->id)->first();
        $user = User::where('id', $data->user_id)->first();
        $user->notify(new StableDeclineStep2($data));

        Alert::success($stable->name.' Decline', 'Success.')->persistent(true)->autoClose(3600);
        return redirect()->route('app_owner.stable.approval.step_2.index');
    }
}
