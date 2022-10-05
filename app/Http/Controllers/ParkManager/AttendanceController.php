<?php

namespace App\Http\Controllers\ParkManager;

use App\Attendance;
use App\Hours;
use App\Http\Controllers\Controller;
use App\Mission;
use App\Shift;
use App\Shift_Staff;
use App\Staff;
use App\Unit;
use Attribute;
use DateTime;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $units = Unit::all();
        $staffs = Staff::all();
$attendences=Attendance::all()->where('left_at_time','=',null);
        Absence_cheker();

        return view('ParkManager.attendances.index')->with('units', $units)->with('staffs', $staffs)->with('attendences', $attendences);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createAttendance($id)
    {
        $staff = Staff::find($id);
        $attendance = new Attendance();
        $ldate = date('Y-m-d');
        return view(
            'ParkManager.attendances.create',
            compact('attendance', 'staff', 'ldate')
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeAttendance(Request $request)
    {
        $attendance = Attendance::create($request->only('id', 'arrived_at_time',
        'arrived_at_date', 'left_at_time', 'left_at_date', 'arrived_note', 'left_note',
        'observation', 'work_place', 'work_type', 'staff_id'));

        $staff = Staff::find($attendance->staff_id);
        $day_type = $request->day_type;
        $hour = new Hours();
        $hour->staff_id = $attendance->staff_id;
        $hour->attendance_id = $attendance->id;
        $hour->type_days = $day_type;
        $hour->save();
        $staff->staff_state = "au travail";
        $staff->save();
        return redirect()->route('ParkManager.attendances.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Attendance  $attendance
     * @return \Illuminate\Http\Response
     */
    public function showAttendance($id)
    {

        $staff = Staff::find($id);
        $attendances = Attendance::all()->where('staff_id', '=', $staff->id);
        $day = 0;
        $night = 0;
        $hours = Hours::all()->where('staff_id', '=', $staff->id);
        foreach ($hours as $hour) {

            $day = $day + $hour->day_hours;
            $night = $night + $hour->night_hours;
        }
        return view(
            'ParkManager.attendances.view',
            compact('attendances', 'staff', 'day', 'night', 'hours')
        );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Attendance  $attendance
     * @return \Illuminate\Http\Response
     */
    public function editAttendance($id)
    {
        $attendance = Attendance::find($id);
        $staff = Staff::find($attendance->staff_id);
        $ldate = date('Y-m-d');
        return view(
            'ParkManager.attendances.edit',
            compact('attendance', 'staff', 'ldate')
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Attendance  $attendance
     * @return \Illuminate\Http\Response
     */
    public function updateAttendance($id, Request $request)
    {
        $attendance = Attendance::find($id);
        $attendance->update($request->only(
            'id',

            'arrived_at_time',
            'arrived_at_date',
            'left_at_time',
            'left_at_date',
            'arrived_note',
            'left_note',
            'observation',
            'work_place',
            'work_type',
            'staff_id'
        ));

        $staff = Staff::find($attendance->staff_id);
        $hour = Hours::where('attendance_id', '=', $attendance->id)->first();
        CalculateHours($attendance->arrived_at_time,$attendance->left_at_time,$hour);
        $staff->staff_state = "pas au travail";
        $staff->save();
        return redirect('/ParkManager/attendances');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Attendance  $attendance
     * @return \Illuminate\Http\Response
     */
    public function destroyAttendance($id)
    {
        return view('ParkManager.attendances.spcifics');
    }
}
