<?php

namespace App\Http\Controllers\ParkManager;

use App\Dt;
use App\Http\Controllers\Controller;
use App\Mission;
use App\Staff;
use App\Unit;
use App\Vehicule;
use Carbon\Carbon;
use Illuminate\Http\Request;

class MissionController extends Controller
{ public function __construct()
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
        $missions=Mission::all();
        $drivers=Staff::all();
        $vehicules=Vehicule::all();
        Missions_cheker();
        return view('ParkManager.missions.index')->with('missions',$missions)->with('drivers',$drivers)->with('vehicules',$vehicules);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $mission = new Mission();
        Absence_cheker();
        $drivers=Staff::all()->where('person_type','=','Conducteur')->where('staff_state','=','au travail');
        //Maintenance checker
        $vehicules=Vehicule::all();


        return view('ParkManager.missions.create',
        compact('drivers'
        ,'vehicules' ,'mission'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $mission=Mission:: create($request->only('id',
        'driver_id',
        'p_name',
        'p_last_name',
        'effective_date',
        'expiration_date',
        'start_date',
        'end_date',
        'reason',
        'vehicle_id',
        'description',
        'to',
        'from',
        'territory',
        'mission_state'));

        return redirect()->route ('ParkManager.missions.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $mission=Mission::find($id);
        Absence_cheker_forOne($mission );
        $driver=Staff::find($mission->driver_id);
        $vehicule=Vehicule::find($mission->vehicle_id);
        return view('ParkManager.missions.view')
        ->with('mission',$mission)
  ->with('driver',$driver)
  ->with('vehicule',$vehicule);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Mission $mission)
    {
        Absence_cheker_forOne($mission );
        return view("ParkManager.missions.edit", compact('mission') );

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,Mission $mission)
    {
        $mission->update($request->only(

        'driver_id',
        'p_name',
        'p_last_name',
        'effective_date',
        'expiration_date',
        'start_date',
        'end_date',
        'reason',
        'vehicle_id',
        'description',
        'to',
        'from',
        'territory',
        'mission_state'));
        return redirect('/ParkManager/missions');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $mission=Mission::find($id);
        $vehicule=Vehicule::find($mission->vehicle_id);
        $vehicule->vehicle_state=$vehicule->previous_state;
        $vehicule->save();
        $mission->delete();
        return redirect('/ParkManager/missions');
    }
}
