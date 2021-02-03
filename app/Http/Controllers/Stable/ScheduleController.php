<?php

namespace App\Http\Controllers\Stable;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use RealRashid\SweetAlert\Facades\Alert;
use Carbon\Carbon;

// load model
use App\Models\Slot;
use App\Models\Stable;

//load form request (for validation)
use App\Http\Requests\PackageStore;
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
            if(!empty($request->input('from_date')))
            {
                //Jika tanggal awal(input('from_date')) hingga tanggal akhir(input('end_date')) adalah sama maka
                if($request->input('from_date') === $request->input('end_date')){
                    //kita filter tanggalnya sesuai dengan request input('from_date')
                    $query = Slot::where('user_id',Auth::user()->id)->whereDate('date','=', $request->input('from_date'))->orderBy('date', 'asc')->get();
                }
                else{
                    //kita filter dari tanggal awal ke akhir
                    $query = Slot::where('user_id',Auth::user()->id)->whereBetween('date', array($request->input('from_date'), $request->input('end_date')))->orderBy('date', 'asc')->get();
                }
            }else{
                $query = Slot::where('user_id',Auth::user()->id)->orderBy('date', 'asc')->get();
            }

            return Datatables::of($query)
            ->addIndexColumn()
            ->addColumn('date', function($item){
                return date('D, M d, Y', strtotime($item->date));
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
                        <a href="javascript:;" data-time="'.$query->id.'" class="btn btn-clean btn-icon mr-2" title="Edit details">
                            <i class="la la-edit icon-xl"></i>
                        </a>
                        <a href="javascript:;" class="btn btn-clean btn-icon mr-2" data-id="'.$query->id.'" title="Delete details" id="deleteHorse">
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
}
