<?php

namespace App\Http\Controllers\Stable;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;
use Carbon\Carbon;
use Carbon\CarbonPeriod;

// load model
use App\Models\Slot;
use App\Models\StableUser;

class ScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->ajax()){           
            $stable = Auth::user()->stables->first()->pivot; 
            if(!empty($request->input('from_date')))
            {
                //Jika tanggal awal(input('from_date')) hingga tanggal akhir(input('end_date')) adalah sama maka
                if($request->input('from_date') === $request->input('end_date')){
                    //kita filter tanggalnya sesuai dengan request input('from_date')
                    $from = date('Y-m-d', strtotime($request->input('from_date')));
                    $query = Slot::where('user_id',$stable->user_id)
                            ->whereDate('date','=', $from)
                            ->orderBy('time_start', 'asc')
                            ->get();
                }
                else{
                    //kita filter dari tanggal awal ke akhir
                    $from = date('Y-m-d', strtotime($request->input('from_date')));
                    $end = date('Y-m-d', strtotime($request->input('end_date')));
                    $query = Slot::where('user_id',$stable->user_id)
                    ->whereBetween('date', array($from, $end))
                    ->orderBy('time_start', 'asc')
                    ->get();
                }
                
            }else{
                $query = Slot::where('user_id',$stable->user_id)->orderBy('date', 'asc')->orderBy('time_start', 'asc')->get();
            }

            return Datatables::of($query)
            ->addIndexColumn()
            ->addColumn('date', function($item){
                return date('D, M d Y', strtotime($item->date));
            })
            ->addColumn('time_start', function ($query) {
                return date('H:i', strtotime($query->time_start));
            })
            ->addColumn('time_end', function ($query) {
                return date('H:i', strtotime($query->time_end));
            }) 
            ->addColumn('action',function ($query) {
                return 
                    '
                    <td nowrap="nowrap">
                        <a href="' . route('stable.schedule.edit', $query->id) . '" class="btn btn-clean btn-icon mr-2" title="Edit">
                            <i class="la la-edit icon-xl"></i>
                        </a>
                        <a href="javascript:;" class="btn btn-clean btn-icon mr-2" data-id="'.$query->id.'" title="Delete" id="deleteSlot">
                            <i class="la la-trash icon-lg"></i>
                        </a>
                    </td>
                    ';
            })
            ->rawColumns(['action'])
            ->make(true);
        }
        return view('stable.schedule.index');
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
        DB::beginTransaction();
        $start = date('Y-m-d',strtotime($request->start));
        $end = date('Y-m-d',strtotime($request->end));
        $dataAll = $request->all();

        $data = $dataAll['group-a'];
        // var_dump(range(intval('07:00:00'),intval('16:00:00')));die;
        $period = new CarbonPeriod($start, '1 day', $end);
        
        foreach($period as $date)
        {            
            if (count($data) > 0) {
                $previousData = null;
                foreach ($data as $item) {
                    if (!$item == null) {
                        $time1 = date("H:i", strtotime($item['time1']));
                        $time2 = date("H:i", strtotime($item['time2']));
                        $capacity = $item['capacity'];
                        if($time1 > $time2){
                            DB::rollback();
                            Alert::error('Generate Error.', 'End time always greater then start time.');
                            return redirect()->route('stable.schedule.index');
                        }
                        if($capacity == null){
                            DB::rollback();
                            Alert::error('Generate Error.', 'Capacity cannot be null.')->persistent(true)->autoClose(3600);
                            return redirect()->route('stable.schedule.index');
                        }

                        $timeStartLastest = Slot::where('user_id', Auth::user()->id)
                                    ->where('date', $date->format('Y-m-d'))
                                    ->latest('time_start')->first();

                        if($time1 == $timeStartLastest){
                            DB::rollback();
                            Alert::error('Generate Error.', 'Cannot save same time with latest time start')->persistent(true)->autoClose(3600);
                            return redirect()->route('stable.schedule.index');
                        }                        
                        $cekDB = Slot::where('user_id', Auth::user()->id)
                                    ->where('date', $date->format('Y-m-d'))
                                    ->where('time_start', $time1)
                                    ->where('time_end', $time2)
                                    ->get();
                        if(count($cekDB) > 0){
                            DB::rollback();
                            Alert::error('Generate Error.', 'Cannot save same Date & Time')->persistent(true)->autoClose(3600);
                            return redirect()->route('stable.schedule.index');
                        }else{
                            if($previousData) {
                                if($time1 == $previousData['time_start']){
                                    DB::rollback();
                                    Alert::error('Generate Error.', 'Cannot save same time with latest time start')->persistent(true)->autoClose(3600);
                                    return redirect()->route('stable.schedule.index');
                                }
                            }
                            
                            $stable = Auth::user()->stables->first()->pivot;
                            $data2 = array(
                                'user_id'    => $stable->user_id,
                                'date'       => $date->format('Y-m-d'),
                                'time_start' => $time1,
                                'time_end'   => $time2,
                                'capacity'   => $capacity,
                                'stable_id'  => $stable->stable_id,
                                'capacity_booked'   => 0,
                            );
                            Slot::create($data2);
                            $previousData = $data2;                          
                        }
                    }else{
                        DB::rollback();
                        Alert::error('Generate Error.', 'Time cannot be null.')->persistent(true)->autoClose(3600);
                        return redirect()->route('stable.schedule.index');
                    }
                }
            }else{
                DB::rollback();
                Alert::error('Generate Error.', 'Time cannot be null.')->persistent(true)->autoClose(3600);
                return redirect()->route('stable.schedule.index');
            }
            
        }

        if($data){
            DB::commit();
            Alert::success('Generate Success.', 'Success.')->persistent(true)->autoClose(3600);
            return redirect()->route('stable.schedule.index'); 
        }
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
        $item = Slot::find($id);

        return view('stable.schedule.edit', compact('item'));
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
        $slot = Slot::find($id);
        $time1 = $request->time1;
        $time2 = $request->time2;
        if($time1 > $time2){            
            Alert::error('Generate Error.', 'End time always greater then start time.');
            return redirect()->route('stable.schedule.index');
        }

        if($request->capacity == null){            
            Alert::error('Generate Error.', 'Capacity cannot be null.')->persistent(true)->autoClose(3600);
            return redirect()->route('stable.schedule.index');
        }
        
        $cekDB = Slot::where('user_id', $slot->user_id)
                    ->where('date', $slot->date)
                    ->where('time_start', $time1)
                    ->where('time_end', $time2)
                    ->where('stable_id', $slot->stable_id)
                    ->get();

        if(count($cekDB) > 0){            
            Alert::error('Generate Error.', 'Cannot save same Date & Time')->persistent(true)->autoClose(3600);
            return redirect()->route('stable.schedule.index');
        }

        $slot->time_start   =   $time1;
        $slot->time_end     =   $time2;
        $slot->capacity     =   $request->capacity;

        $slot->save();

        Alert::success('Update Success.', 'Success.')->persistent(true)->autoClose(3600);
        return redirect()->route('stable.schedule.index'); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        Slot::find($request->id)->delete();
        return response()->json('success');
    }
}
