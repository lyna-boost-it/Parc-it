<?php

namespace App\Http\Controllers\ParkManager;

use App\Driver;
use App\Http\Controllers\Controller;
use App\MaintenanceCenter;
use App\Staff;
use App\Unit;
use Illuminate\Http\Request;

class StaffController extends Controller
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
        $staffs=Staff::all();
        $units=Unit::all();
        return view('ParkManager.staffs.index')->with('staffs',$staffs)->with('units',$units);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {$units=Unit::all();
        $staff = new Staff();
        $diploma="";
        $driver_license_number="";
        $driver_license_type="";
        $driver_license_date="";
        return view('ParkManager.staffs.create',
        compact('staff','diploma','driver_license_number','driver_license_type','driver_license_date','units'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request
)
    {

        $staff=Staff:: create($request->only('id',
        'id',
        'name',
        'last_name',
        'serial_numbers',
        'number_ss',
        'sex',
        'date_of_birth',
        'place_of_birth',
        'family_situation',
        'address',
        'date_of_recruitment',
        'function',
        'phone',
        'unit_id',
        'person_type'
        ,'driver_license_number',
        'driver_license_type',
        'driver_license_date',
        'diploma'
        ));
$type=$request->person_type;
if($type=='Personnel du centre de maintenance'){
    $staff->function=$request->function1;
    $staff->save();

}
if($type=='Personnel du parc'){
    $staff->function=$request->function2;
    $staff->save();

}

        return redirect()->route ('ParkManager.staffs.index')->with('success', "vous avez ajouté un personnel avec succès");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $staff=Staff::find($id);
        $unit=Unit::find($staff->unit_id);
        return view('ParkManager.staffs.viewStaff')->with('staff',$staff)->with('unit',$unit);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Staff $staff)
    {
        $units=Unit::all();
        return view('ParkManager.staffs.edit')->with('staff',$staff)->with('units',$units);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,Staff $staff)
    {
        $staff->update($request->only('id',
        'id',
        'name',
        'last_name',
        'serial_numbers',
        'number_ss',
        'sex',
        'date_of_birth',
        'place_of_birth',
        'family_situation',
        'address',
        'date_of_recruitment',
        'function',
        'phone',
        'unit_id',
        'person_type'
        ,'driver_license_number',
        'driver_license_type',
        'driver_license_date',
        'diploma'
        ));
        return redirect('/ParkManager/staffs')->with('success', "vous avez modifié un personnel avec succès");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Staff $staff)
    {
        $staff->delete();
        return redirect('/ParkManager/staffs')->with('success',"vous avez supprimé un personnel avec succès");

    }
}
