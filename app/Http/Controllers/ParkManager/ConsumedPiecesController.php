<?php

namespace App\Http\Controllers\ParkManager;

use App\ConsumedPieces;
use App\Dt;
use App\Http\Controllers\Controller;
use App\Staff;
use App\Vehicule;
use Illuminate\Http\Request;
class ConsumedPiecesController extends Controller
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
        $dts=Dt::all()->where('type_maintenance','=','Pieces Consommees');

        $cps=ConsumedPieces::all();
        $vehicules=Vehicule::all();
        $drivers=Staff::all()->where('person_type','=','Conducteur');

        return view('ParkManager.cps.index')
        ->with('cps',$cps)->with('vehicules',$vehicules)->with('drivers',$drivers)->with('dts',$dts);


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createCps($id)
    {
        $dt=Dt::find($id);
        $vehicule=Vehicule::find($dt->vehicule_id);
        $cp = new ConsumedPieces();
       $staffs=Staff::all()->where('person_type','=','Personnel du parc');
        $drivers=Staff::all()->where('person_type','=','Conducteur');
          return view('ParkManager.cps.create',
          compact('cp','dt'
          , 'drivers', 'staffs', 'vehicule'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeCps(Request $request)
    {
        $cp=ConsumedPieces:: create($request->only(
            'id', 'dt_code' ,'reference','quantity',
            'price','designation','receip','vehicule_id'   ));
   $cp->full_price=$cp->price*$cp->quantity;
   $cp->save();
    $dt=Dt::find($cp->dt_code);
    $dt->previous_state=$dt->state;
    $dt->state='fait';
    $dt->save();
$vehicule=Vehicule::find($cp->vehicule_id);
$vehicule->previous_state=$vehicule->vehicle_state;
$vehicule->vehicle_state='Libre';
$vehicule->save();
    return redirect ('/ParkManager/cps');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showCps($id)
    {
        $cp =ConsumedPieces::find($id);
        $dt=Dt::find($cp->dt_code);
        $vehicule=Vehicule::find($cp->vehicule_id);
        $staffs=Staff::all()->where('person_type','=','Personnel du parc');
        $driver=Staff::find($cp->driver_id);
        return view('ParkManager.cps.view',
        compact('cp','dt'
        , 'driver',  'vehicule','staffs'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function editCps($id)
    {
        $cp =ConsumedPieces::find($id);
        $dt=Dt::find($cp->dt_code);
        $vehicule=Vehicule::find($cp->vehicule_id);
        $staffs=Staff::all()->where('person_type','=','Personnel du parc');
        $drivers=Staff::all()->where('person_type','=','Conducteur');
          return view('ParkManager.cps.edit',
          compact('cp','dt'
          , 'drivers', 'staffs', 'vehicule'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateCps(Request $request, $id)
    { $cp =ConsumedPieces::find($id);
        $cp->update($request->only(
            'id', 'dt_code' ,'reference','quantity',
            'price','designation','receip','vehicule_id'
           ));
           $cp->full_price=$cp->price*$cp->quantity;
           $cp->save();
    return redirect ('/ParkManager/cps');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroyCps($id)
    {
        $cp=ConsumedPieces::find($id);
        $dt=Dt::find($cp->dt_code);
        $dt->state=$dt->previous_state;
        $dt->save();
    $vehicule=Vehicule::find($cp->vehicule_id);
    $vehicule->vehicle_state=    $vehicule->previous_state;
    $vehicule->save();

        $cp->delete();
        return redirect('/ParkManager/cps');
    }
}
