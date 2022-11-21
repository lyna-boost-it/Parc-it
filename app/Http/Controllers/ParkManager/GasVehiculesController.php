<?php

namespace App\Http\Controllers\ParkManager;

use App\Attendance;
use App\Http\Controllers\Controller;
use App\GasVehicules;
use App\GazPrice;
use App\Shift_Staff;
use App\Staff;
use App\Unit;
use App\Vehicule;
use Attribute;
use Illuminate\Http\Request;
class GasVehiculesController extends Controller
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
        $gasvehicules=GasVehicules::all();
        $drivers=Staff::all()->where("person_type",'=','Conducteur');
         $staffs=Staff::all()->where("person_type",'=','Personnel du parc');
         $vehicules=Vehicule::all();

        return view('ParkManager.gasVehicules.index')
        ->with('gasvehicules',$gasvehicules) ->with('staffs',$staffs)
        ->with('drivers',$drivers)
       ->with('vehicules',$vehicules);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $gasvehicule = new GasVehicules();
        $drivers=Staff::all()->where('person_type','=','Conducteur');
        $vehicules=Vehicule::all();
        $staffs=Staff::all()->where("person_type",'=','Personnel du parc');
$gases=GazPrice::all();
        return view('ParkManager.gasVehicules.create',
        compact('gasvehicule'
        ,'drivers','vehicules' ,'staffs' ,'gases'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $gasvehicule=GasVehicules:: create($request->only('id',

       'driver_id','staff_id','date','km','type','ticket','price','litter','litter_price','vehicle_id'


    ));
$type=GazPrice::where('name','=',$gasvehicule->type)->first();
$gasvehicule->litter_price=$type->price;
$gasvehicule->save();


       return redirect()->route ('ParkManager.gasVehicules.index')->with('success',"vous avez ajouteré une consommations de carburant pour vehicule avec succès");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $gasvehicules=GasVehicules::find($id);
        $driver=Staff::find($gasvehicules->driver_id);
         $staff=Staff::find($gasvehicules->staff_id);
         $vehicule=Vehicule::find($gasvehicules->vehicle_id);

        return view('ParkManager.gasVehicules.view')
        ->with('gasvehicules',$gasvehicules) ->with('staff',$staff)
        ->with('driver',$driver)
       ->with('vehicule',$vehicule);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit( $id)
    {

 $gasvehicule=GasVehicules::find($id);

        return view("ParkManager.gasVehicules.edit", compact('gasvehicule') );

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,  $id)
    { $gasvehicule=GasVehicules::find($id);
        $gasvehicule->update($request->only('id',

        'driver_id','staff_id','date','km','type','ticket','price','litter','litter_price','vehicle_id'));

                return redirect('/ParkManager/gasVehicules')->with('success',"vous avez modifié une consommations de carburant pour vehicule avec succès");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $gasvehicule=GasVehicules::find($id);

        $gasvehicule->delete();
        return redirect('/ParkManager/gasVehicules')->with('success',"vous avez supprimé une consommations de carburant pour vehicule avec succès");
    }
}
