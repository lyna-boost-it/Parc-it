<?php

namespace App\Http\Controllers\Kpis;

use App\Absence;
use App\Hours;
use App\Http\Controllers\Controller;
use App\Staff;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;
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
        $date = Carbon::now();
        $staffs = Staff::all();
        $totalstaff = Staff::all()->count();
        $drivers = Staff::where('person_type', '=', 'Conducteur')->count();
        $pParck = Staff::where('person_type', '=', 'Personnel du parc')->count();
        $pCentre = Staff::where('person_type', '=', 'Personnel du centre de maintenance')->count();
        $driversList = Staff::all()->where('person_type', '=', 'Conducteur');
        $pParckList = Staff::all()->where('person_type', '=', 'Personnel du parc');
        $pCentreList = Staff::all()->where('person_type', '=', 'Personnel du centre de maintenance');
        //dd($totalstaff,$drivers,$pParck,$pCentre);
        return view('Kpis.staff.index', compact('date', 'staffs', 'totalstaff', 'drivers', 'pParck', 'pCentre', 'driversList', 'pParckList', 'pCentreList'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        Absence_cheker();
        $monthStaff = $request->monthStaff;
        $month = $request->month;
        $year = $request->year;
        $yearStaff = $request->yearStaff;
        $id = $request->staff_id;

        $totalAbsences = Absence::all()->count();
        $absence = Absence::whereYear('created_at', $yearStaff)->whereMonth('created_at', $monthStaff)->count();
        $absenceP = number_format((float)$absence / $totalAbsences * 100, 2, '.', '');

        if ($id) {
            $lateHours = Hours::all()->where('staff_id', '=', $id)->sum('late_hours');
            $earlyHours = Hours::all()->where('staff_id', '=', $id)->sum('early_hours');
            $lateHours = substr($lateHours, 0, -2);
            $earlyHours = substr($earlyHours, 0, -2);
            $staff = Staff::find($id);
            $absence_staff = Absence::all()->where('staff_id', '=', $id)->count();
            if ($earlyHours == false) {
                $earlyHours = 0;
            }
            if ($lateHours == false) {
                $lateHours = 0;
            }

            return view(
                'Kpis.staff.stats',
                compact(
                    'monthStaff',
                    'yearStaff',
                    'month',
                    'year',
                    'absenceP',
                    'absence',
                    'totalAbsences',
                    'absence_staff',
                    'earlyHours',
                    'lateHours',
                    'staff',
                    'absence_staff',
                    'id'
                )
            );
        }




        return view(
            'Kpis.staff.stats',
            compact(
                'monthStaff',
                'yearStaff',
                'month',
                'year',
                'absenceP',
                'absence',
                'totalAbsences',
                'id'
            )
        );
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
    public function show(Request $request, $id)
    {
        $date1 = $request->date1;
        $date2 = $request->date2;
        $type = $request->type;
        $absences = null;
        $date1_ = new Date($date1);
        $date2_ = new Date($date2);
        $nbr = 0;
        $dayhs = 0;
        if ($type == 'abs') {
            $absences = Absence::all();
            foreach ($absences as $absence) {
                $created_date = new Date($absence->created_at);
                if ($created_date >= $date1_ && $created_date <= $date2_) {
                    $nbr = $nbr + 1;
                }
            }
            $staff = DB::table('staff')->find($id);
            $hours = DB::table('hours')->where('staff_id', '=', $staff->id)->where('type_days', '=', 'Journée de travail')->sum('day_hours');
            $Nhours = DB::table('hours')->where('staff_id', '=', $staff->id)->where('type_days', '=', 'Journée de travail')->sum('night_hours');
            $fridays = DB::table('hours')->where('staff_id', '=', $staff->id)->where('type_days', '=', 'Vendredi')->count();
            $freedays = DB::table('hours')->where('staff_id', '=', $staff->id)->where('type_days', '=', 'Jour férié')->count();
            $dayhs = round(((CheckDayHours($hours)) + ($Nhours * 2) + ((($fridays + $freedays) * 8))) / 8);
            if ($dayhs != 0) {
                $abs = $nbr / $dayhs;
            }
            return view(
                'Kpis.staff.stats',
                compact('date1', 'date2', 'staff',  'abs','type'));
        }
        if ($type == 'stat') {
            $hours=0;
            $Nhours=0;
            $fridays=0;
            $freedays=0;
            $days=0;
        $staff = DB::table('staff')->find($id);
        $Hours=Hours::all()->where('staff_id', '=', $staff->id);
foreach($Hours as $Hour){
    $created_date = new Date($Hour->created_at);
    if ($created_date >= $date1_ && $created_date <= $date2_) {
        if($Hour->type_days=='Journée de travail'){
            $hours = $hours +$Hour->day_hours;
            $Nhours = $Nhours +$Hour->night_hours;
                    }
        if($Hour->type_days=='Vendredi'){
            $fridays =$fridays +1;
        }
        if($Hour->type_days=='Jour férié'){
            $freedays =$freedays +1;
        }
        $days =$days+ round(((CheckDayHours($hours)) + ($Nhours * 2) + ((($fridays + $freedays) * 8))) / 8);

    }
}


        return view(
            'Kpis.staff.counts',
            compact('date1', 'date2', 'staff', 'hours', 'Nhours', 'fridays', 'freedays', 'days')
        );
    }
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
