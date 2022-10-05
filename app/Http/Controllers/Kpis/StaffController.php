<?php

namespace App\Http\Controllers\Kpis;

use App\Absence;
use App\Hours;
use App\Http\Controllers\Controller;
use App\Staff;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StaffController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    $date=Carbon::now();
    $staffs=Staff::all();
    $totalstaff=Staff::all()->count();
    $drivers=Staff::where('person_type','=','Conducteur')->count();
    $pParck=Staff::where('person_type','=','Personnel du parc')->count();
    $pCentre=Staff::where('person_type','=','Personnel du centre de maintenance')->count();
    $driversList=Staff::all()->where('person_type','=','Conducteur');
    $pParckList=Staff::all()->where('person_type','=','Personnel du parc');
    $pCentreList=Staff::all()->where('person_type','=','Personnel du centre de maintenance');

        return view('Kpis.staff.index',compact('date','staffs','totalstaff','drivers','pParck','pCentre','driversList','pParckList','pCentreList'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {Absence_cheker();
        $monthStaff=$request->monthStaff;
        $month=$request->month;
        $year=$request->year;
        $yearStaff=$request->yearStaff;
        $id=$request->id;

        $totalAbsences=Absence::all()->count();
        $absence =Absence ::whereYear('created_at',$yearStaff)->whereMonth('created_at',$monthStaff)->count();
        $absenceP=number_format((float)$absence/$totalAbsences*100, 2, '.', '');

        if($id){
            $lateHours=Hours::all()->where('staff_id','=',$id)->sum('late_hours');
            $earlyHours=Hours::all()->where('staff_id','=',$id)->sum('early_hours');
            $lateHours=substr($lateHours,0,-2) ;
            $earlyHours=substr($earlyHours,0,-2) ;
            $staff=Staff::find($id);
            $absence_staff=Absence::all()->where('staff_id','=',$id)->count();
            if($earlyHours==false){$earlyHours=0;}
            if($lateHours==false){$lateHours=0;}

        return view('Kpis.staff.stats',
        compact( 'monthStaff','yearStaff','month','year','absenceP','absence','totalAbsences' ,'absence_staff','earlyHours','lateHours'
    ,'staff','absence_staff','id'));
        }




        return view('Kpis.staff.stats',
        compact( 'monthStaff','yearStaff','month','year','absenceP','absence','totalAbsences'
     ,'id'));


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
    public function show(Request $request,$id)
    {
        $month=$request->month;
        $year=$request->year;
        $staff=DB::table('staff')->find($id);
        $hours=DB::table('hours')->whereYear('created_at', $year)->whereMonth('created_at', $month)->where('staff_id', '=', $staff->id)->where('type_days', '=', 'Journée de travail')->sum('day_hours');
        $fridays=DB::table('hours')->whereYear('created_at', $year)->whereMonth('created_at', $month)->where('staff_id', '=', $staff->id)->where('type_days', '=', 'Vendredi')->count();
        $freedays=DB::table('hours')->whereYear('created_at', $year)->whereMonth('created_at', $month)->where('staff_id', '=', $staff->id)->where('type_days', '=', 'Jour férié')->count();
        $days= round(($hours+((($fridays+$freedays)*8)))/8);
       // dd($month,$year,$staff, $hours,$fridays,$freedays,$days);
        return view('Kpis.staff.counts',
        compact( 'month','year' ,'staff','hours','fridays','freedays','days' ));
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
