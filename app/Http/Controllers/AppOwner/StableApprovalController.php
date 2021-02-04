<?php

namespace App\Http\Controllers\AppOwner;

use App\Http\Controllers\Controller;
use App\Mail\SendKeyStableMail;
use App\Mail\StableApproveStep2;
use App\Mail\StableDecline;
use Illuminate\Http\Request;

use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

// load model
use App\Models\{User,Stable, Coach, Horse, Package, Slot, Province, City, District, Village};
class StableApprovalController extends Controller
{
    // Stable Approval 1
    public function step_1()
    {
        return view('app-owner.stable.approval-step-1');
    }
    public function jsonApproved1()
    {
        $data = Stable::where('approval_status', 'Email Sent')->get();
        return datatables()->of($data)
        ->addIndexColumn()
        ->addColumn('created_at', function($data){
            return date('D, M d, Y', strtotime($data->created_at));
        })
        ->addColumn('approval_status', function ($data) {
            return $data->approval_status == 'Email Sent' ?
                "<span class='label font-weight-bold label-lg  label-light-success label-inline'>
                    ".$data->approval_status."
                </span>" : "";
        })
        ->addColumn('action', function ($data) {
            return 
            "
            <a href='javascript:void(0)' data-toggle='modal' data-id='".$data->id."' class='btn btn-info text-center mr-2' id='openBtn'>
                <i class='fas fa-eye'></i>
            </a>
            ";
        })
        ->rawColumns(['approval_status','action'])
        ->make(true);
    }
    public function jsonUnapproved1()
    {
        $data = Stable::where('approval_status', null)->get();
        return datatables()->of($data)
        ->addIndexColumn()
        ->addColumn('created_at', function($data){
            return date('D, M d, Y', strtotime($data->created_at));
        })
        ->addColumn('approval_status', function () {
            return "<span class='label font-weight-bold label-lg  label-light-warning label-inline'>Pending</span>";
        })
        ->addColumn('action', function ($data) {
            return 
            "
            <a href='javascript:void(0)' data-toggle='modal' data-id='".$data->id."' class='btn btn-clean btn-icon mr-2' id='openBtn' data-toggle='Detail' data-placement='top' title='Detail'>
                <i class='fas fa-eye'></i>
            </a>
            <form class='d-inline' id='formAccept".$data->id."' method='post' action='" . route('app_owner.stable.approval.step_1.approve',$data->id) . "'>
            " . method_field('PUT') . csrf_field() . "
                <button class='btn btn-clean btn-icon mr-2' type='submit' id='accept".$data->id."' data-toggle='Accept' data-placement='top' title='Accept'>
                    <i class='fas fa-check-circle'></i>
                </button>
            </form>
            <form class='d-inline' id='formDecline".$data->id."' method='post' action='" . route('app_owner.stable.approval.step_1.unapprove',$data->id) . "'>
            " . method_field('PUT') . csrf_field() . "
                <button class='btn btn-clean btn-icon mr-2' type='submit' id='decline".$data->id."' data-toggle='Decline' data-placement='top' title='Decline'>
                <i class='fas fa-ban'></i>
                </button>
            </form>

            <script>
                $('tbody').on('click','#accept".$data->id."', function(e) {
        
                    e.preventDefault();
                        
                    Swal.fire({
                        title: 'Are you sure?',
                        icon: 'warning',
                        text: 'This is will be accepted the stable',
                        type: 'warning',
                        showCancelButton: true,
                        confirmButtonText: 'Accept',
                        cancelButtonText: 'Cancel',
                        closeOnConfirm: false,
                        closeOnCancel: false
                    }).then(function(getAction) {
                        if (getAction.value === true) {
                            $('#formAccept".$data->id."').submit();
                        }
                    });
                });

                $('tbody').on('click','#decline".$data->id."', function(e) {
        
                    e.preventDefault();
                        
                    Swal.fire({
                        title: 'Are you sure?',
                        icon: 'warning',
                        text: 'This is will be declined the stable',
                        type: 'warning',
                        showCancelButton: true,
                        confirmButtonText: 'Accept',
                        cancelButtonText: 'Cancel',
                        closeOnConfirm: false,
                        closeOnCancel: false
                    }).then(function(getAction) {
                        if (getAction.value === true) {
                            $('#formDecline".$data->id."').submit();
                        }
                    });
                });
            </script>
            ";
        })
        ->rawColumns(['approval_status','action'])
        ->make(true);
    }

    public function show1($id)
    {
        $stable = Stable::with(['approvalby_stable'])->find($id);
        $province = Province::find($stable->province_id);
        $city = City::find($stable->city_id);
        $district = District::find($stable->district_id);
        $village = Village::find($stable->village_id);
        return response()->json([$stable,[$province,$city,$district,$village]]);
    }

    public function approveStable1($id)
    {
        $data1 = DB::table('stable_user')->where('stable_id',$id)->first();
        $data2 = Stable::find($data1->stable_id);

        $user = User::where('id', $data1->user_id)->first();
                    $user->notify(new SendKeyStableMail($data2));

        Stable::where('id', $data2->id)->update([
            'approval_status' => 'Email Sent', 
            'approval_by' => Auth::user()->id,
            'approval_at' => Carbon::now()
        ]);
        Alert::success($data2->name.' Email Sent', 'Success.')->persistent(true)->autoClose(3600);
        return redirect()->back();
    }

    public function unapproveStable1($id)
    {
        $data1 = DB::table('stable_user')->where('stable_id',$id)->first();
        $data2 = Stable::find($data1->stable_id);

        $user = User::where('id', $data1->user_id)->first();
                    $user->notify(new StableDecline($data2));
        Stable::where('id', $data2->id)->update([
            'approval_status' => 'Decline', 
            'approval_by' => Auth::user()->id,
            'approval_at' => Carbon::now()
        ]);

        Alert::success($data2->name.' Decline', 'Success.')->persistent(true)->autoClose(3600);
        return redirect()->back();
    }


    // Stable Approval 2
    public function step_2()
    {
        return view('app-owner.stable.approval-step-2');
    }

    public function jsonApproved2()
    {
        $data = Stable::where('approval_status', 'Accepted')->get();
        return datatables()->of($data)
        ->addIndexColumn()
        ->addColumn('created_at', function($data){
            return date('D, M d, Y', strtotime($data->created_at));
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
            <a href='" . route('app_owner.stable.approval.step_1.show',$data->id) . "' class='btn btn-clear mr-2' id='openBtn' data-toggle='Detail' data-placement='top' title='Detail'>
                <i class='fas fa-eye'></i>
            </a>
            ";
        })
        ->rawColumns(['approval_status','action'])
        ->make(true);
    }

    public function jsonUnapproved2()
    {
        $data = Stable::where('approval_status', 'Email Sent')->get();
        return datatables()->of($data)
        ->addIndexColumn()
        ->addColumn('created_at', function($data){
            return date('D, M d, Y', strtotime($data->created_at));
        })
        ->addColumn('approval_status', function ($data) {
            return $data->approval_status == 'Email Sent' ?
                "<span class='label font-weight-bold label-lg  label-light-warning label-inline'>
                    Pending second Approval
                </span>" : "";
        })
        ->addColumn('action', function ($data) {
            return 
            "
            <a href='" . route('app_owner.stable.approval.step_1.show',$data->id) . "' class='btn btn-clear mr-2' id='openBtn' data-toggle='Detail' data-placement='top' title='Detail'>
                <i class='fas fa-eye'></i>
            </a>
            ";
        })
        ->rawColumns(['approval_status','action'])
        ->make(true);
    }

    public function show2($id)
    {
        $data = Stable::with(['user'])->where('user_id', $id)->first();
        $province = Province::all();
        $city = City::find($data->city_id);
        $district = District::find($data->district_id);
        $village = Village::find($data->village_id);
        $horse_count = Horse::where('stable_id',$data->id)->where('user_id',$id)->count();
        $coach_count = Coach::where('stable_id',$data->id)->where('user_id',$id)->count();
        $package_count = Package::where('stable_id',$data->id)->where('user_id',$id)->count();
        $slot_count = Slot::where('user_id',$id)->count();
        $data_stable = Stable::with(['user','horse'])->where('user_id', $id)->first();
        if($data_stable->capacity_of_stable > 0 and  $data_stable->number_of_coach > 0 and $data_stable->capacity_of_arena > 0){
            $data_setup = 1;
        }else{
            $data_setup = 0;
        }
        return view('app-owner.preview.stable.index',
        compact(
            'data', 
            'province',
            'city',
            'district',
            'village',
            'horse_count',
            'coach_count',
            'package_count',
            'slot_count',
            'data_setup'
        ));
    }

    public function approveStable2($id)
    {
        $data1 = DB::table('stable_user')->where('stable_id',$id)->first();
        $data2 = Stable::find($data1->stable_id);

        $user = User::where('id', $data1->user_id)->first();
                    $user->notify(new StableApproveStep2($data2));

        Stable::where('id', $data2->id)->update([
            'approval_status' => 'Accepted', 
            'approval_by' => Auth::user()->id,
            'approval_at' => Carbon::now()
        ]);
        
        $dataPackage = Package::where('stable_id', $id)->get();

        foreach($dataPackage as $package)
        {
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
        $data = DB::table('stable_user')->where('stable_id',$id)->first();
        $user = User::where('id', $data->user_id)->first();
                    $user->notify(new StableDecline($data));                                        
        Stable::where('id', $data->id)->update([
            'approval_status' => 'Decline', 
            'approval_by' => Auth::user()->id,
            'approval_at' => Carbon::now()
        ]);

        Alert::success($data->name.' Decline', 'Success.')->persistent(true)->autoClose(3600);
        return redirect()->back();
    }

    // Horse Owner Preview
    public function horse($id)
    {
        return view('app-owner.preview.horse.index', compact('id'));
    }

    public function horseListJson($id)
    {
        $data = Horse::with(['stable'])->where('user_id', $id);
        return datatables()->of($data)
            ->addColumn('profile', function ($data) {
                return "<img src='assets/media/branchsto/horse.png' width='40px' height='40px' alt=''> ";
            })
            ->addColumn('horse_name', function ($data) {
                return $data->name;
            })
            ->addColumn('birth_date', function ($data) {
                return $data->birth_date;
            })
            ->addColumn('age', function ($data) {
                $dateOfBirth = $data->birth_date;
                return Carbon::parse($dateOfBirth)->age;
            })
            ->addColumn('sex', function ($data) {
                return $data->sex->name;
            })
            ->addColumn('passport_number', function ($data) {
                return $data->passport_number;
            })
            ->addColumn('horse_owner', function ($data) {
                return $data->owner;
            })
            ->addColumn('horse_breeds', function ($data) {
                return $data->breed->name;
            })
            ->rawColumns(['profile'])
            ->make(true);
    }

    // Package Owner Preview
    public function package($id)
    {
        return view('app-owner.preview.package.index',compact('id'));
    }
    public function packageListJson($id)
    {
        $data = Package::where('user_id', $id)->with(['user']);
        return datatables()->of($data)
            ->addColumn('profile', function ($data) {
                return "<img src='assets/media/branchsto/horse.png' width='40px' height='40px' alt=''>";
            })
            ->addColumn('price', function ($data) {
                return number_format($data->price);
            })
            ->addColumn('approval_status', function ($data) {
            
                if($data->approval_status == null){
                    return "<span class='label label-lg label-light-warning label-inline'>Pending.</span>";
                }else{
                    return "<span class='label label-lg label-light-success label-inline'>".$data->approval_status.".</span>";
                }
            })
            ->addColumn('package_status', function ($data) {
            
                if($data->package_status == null){
                    return "<span class='label label-lg label-light-danger label-inline'>No Publish.</span>";
                }else{
                    return "<span class='label label-lg label-light-success label-inline'>".$data->approval_status." Publish.</span>";
                }
            })
            ->rawColumns(['profile','approval_status','package_status'])
            ->make(true);
    }

    // Schedule Owner Preview

    public function schedule($id)
    {
        return view('app-owner.preview.schedule.index', compact('id'));
    }
    public function scheduleListJson($id)
    {
        $data = Slot::where('user_id',$id)->orderBy('time_start', 'asc')->get();
        return datatables()->of($data)
        ->addColumn('start_date', function ($data) {
            return $data->date;
        })
        ->addColumn('time_start', function ($data) {
            return date('H:i', strtotime($data->time_start));
        })
        ->addColumn('time_end', function ($data) {
            return date('H:i', strtotime($data->time_end));
        })
        ->addColumn('capacity', function ($data) {
            return $data->capacity;
        })
        ->addColumn('capacity_booked', function ($data) {
            return $data->capacity_booked;
        })
        ->rawColumns(['profile'])
        ->make(true);
    }

    // Coach Owner Preview

    public function coach($id)
    {
        return view('app-owner.preview.coach.index', compact('id'));
    }
    public function coachListJson($id)
    {
        $data = Coach::with(['stable'])->where('user_id', $id);
        return datatables()->of($data)
            ->addColumn('profile', function ($data) {
                return "<img src='assets/media/branchsto/user.svg' width='40px' height='40px' alt=''>";
            })
            ->addColumn('coach_name', function ($data) {
                return $data->name;
            })
            ->addColumn('birth_date', function ($data) {
                return $data->birth_date;
            })
            ->addColumn('age', function ($data) {
                $dateOfBirth = $data->birth_date;
                return Carbon::parse($dateOfBirth)->age;
            })
            ->addColumn('sex', function ($data) {
                return $data->sex;
            })
            ->addColumn('experience', function ($data) {
                return $data->experience;
            })
            ->addColumn('certified', function ($data) {
                return $data->certified;
            })
            ->rawColumns(['profile'])
            ->make(true);
    }
}
