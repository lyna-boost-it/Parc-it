<?php

namespace App\Http\Controllers\ParkManager;

use App\Attendance;
use App\GasPipe;
use App\Http\Controllers\Controller;
use App\Shift;
use App\Shift_Staff;
use App\Staff;
use App\Unit;
use Attribute;
use Illuminate\Http\Request;
class GasPipeController extends Controller
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
        $gaspipes=GasPipe::all();
        $drivers=Staff::all()->where("person_type",'=','Conducteur');
         $staffs=Staff::all()->where("person_type",'=','Personnel du parc');
         $units=Unit::all();

        return view('ParkManager.gasPipes.index')
        ->with('gaspipes',$gaspipes) ->with('staffs',$staffs)
        ->with('drivers',$drivers)
       ->with('units',$units);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $gaspipe = new GasPipe();
        $drivers=Staff::all()->where('person_type','=','Conducteur');

        $staffs=Staff::all()->where("person_type",'=','Personnel du parc');
        $units=Unit::all();

        return view('ParkManager.gasPipes.create',
        compact('gaspipe'
        ,'drivers','staffs','units'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {


        $gaspipe=GasPipe:: create($request->only(   'id',
        'driver_id','staff_id','unit_id','ticket','price','litter','litter_price'
        ));
        return redirect()->route ('ParkManager.gasPipes.index')
        ->with('success',"vous avez ajouté une consommations de carburant pour équipements motorisés avec succès");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
 $gaspipe=GasPipe::find($id);
 $driver=Staff::find($gaspipe->driver_id);
  $staff=Staff::find($gaspipe->staff_id);
  $unit=Unit::find($gaspipe->unit_id);

 return view('ParkManager.gasPipes.view')
 ->with('gaspipe',$gaspipe) ->with('staff',$staff)
 ->with('driver',$driver)
->with('unit',$unit);


    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $gaspipe=GasPipe::find($id);

        return view("ParkManager.gasPipes.edit", compact('gaspipe') );
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
        $gaspipe=GasPipe::find($id);
        $gaspipe->update($request->only('id',
        'id',
        'driver_id','staff_id','unit_id','ticket','price','litter_price','litter'
        ));

                return redirect('/ParkManager/gasPipes')->with('success',"vous avez modifié une consommations de carburant pour équipements motorisés avec succès");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $gaspipe=GasPipe::find($id);

        $gaspipe->delete();
        return redirect('/ParkManager/gasPipes')->with('success',"vous avez supprimé une consommations de carburant pour équipements motorisés avec succès");;
    }
}
