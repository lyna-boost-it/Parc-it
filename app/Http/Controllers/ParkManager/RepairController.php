<?php

namespace App\Http\Controllers\ParkManager;

use App\Dt;
use App\Http\Controllers\Controller;
use App\Liquids;
use App\Repair;
use App\Repair_Staff;
use App\Staff;
use App\Vehicule;
use Illuminate\Http\Request;
class RepairController extends Controller
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
    {   $dts=Dt::all()->where('type_maintenance','=','Reparation');
        $repairs=Repair::all();
        $vehicules=Vehicule::all();
        $drivers=Staff::all()->where('person_type','=','Conducteur');
        return view('ParkManager.repairs.index')
        ->with('repairs',$repairs)->with('vehicules',$vehicules)->with('drivers',$drivers)->with('dts',$dts);


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createRepairs($id)
    {   $dt=Dt::find($id);
        $vehicule=Vehicule::find($dt->vehicule_id);
        $repair = new Repair();
        $liquid=Liquids:: where('type','=','Liquide')->first();
        $lubrifiant=Liquids:: where('type','=','Lubrifiant')->first();
       $staffs=Staff::all()->where('person_type','=','Personnel du centre de maintenance')->where('function','!=','Mécanicien spécialisé (matériel motorisé)');

        $drivers=Staff::all()->where('person_type','=','Conducteur');
          return view('ParkManager.repairs.create',
          compact('repair','dt'
          , 'drivers', 'staffs', 'vehicule','lubrifiant','liquid'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeRepairs(Request $request)
    {
        $repair=Repair:: create($request->only(
            'id', 'dt_code', 'intervention_date',    'diagnostic', 'repaired_breakdowns', 'liquid',  'lubricant',
            'end_date', 'end_time', 'driver_id', 'observation', 'vehicule_id',
    ));
$staffs=$request['staff'];

    foreach($staffs as $s){
        $staff=Staff::find($s);
$staff_repair=new Repair_Staff();
$staff_repair->staff_id=$staff->id;
$staff_repair->repair_id=$repair->id;
$staff_repair->save();
    }

    $dt=Dt::find($repair->dt_code);
    $dt->previous_state=$dt->state;
    $dt->state='fait';

    $dt->save();
$vehicule=Vehicule::find($repair->vehicule_id);
$vehicule->previous_state=$vehicule->vehicle_state;
$vehicule->vehicle_state='Libre';

$vehicule->save();
$liquid=Liquids:: where('type','=','Liquide')->first();
$lubrifiant=Liquids:: where('type','=','Lubrifiant')->first();
$liquid->quantity=$liquid->quantity-$request->liquid;
$liquid->save();
$lubrifiant->quantity=$lubrifiant->quantity-$request->lubricant;
$lubrifiant->save();
    return redirect ('/ParkManager/repairs');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showRepairs($id)
    {
        $repair =Repair::find($id);
        $dt=Dt::find($repair->dt_code);
        $vehicule=Vehicule::find($repair->vehicule_id);
        $staffs=Staff::all()->where('person_type','=','Personnel du parc');
        $driver=Staff::find($repair->driver_id);
        $repair_staffs=Repair_Staff::all()->where('repair_id','=',$repair->id);
        return view('ParkManager.repairs.view',
        compact('repair','dt'
        , 'driver', 'repair_staffs', 'vehicule','staffs'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function editRepairs($id)
    {
        $repair =Repair::find($id);
        $dt=Dt::find($repair->dt_code);
        $vehicule=Vehicule::find($repair->vehicule_id);
        $staffs=Staff::all()->where('person_type','=','Personnel du centre de maintenance')->where('function','!=','Mécanicien spécialisé (matériel motorisé)');
        $drivers=Staff::all()->where('person_type','=','Conducteur');
          return view('ParkManager.repairs.edit',
          compact('repair','dt'
          , 'drivers', 'staffs', 'vehicule'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateRepairs(Request $request, $id)
    {$repair =Repair::find($id);
        $repair->update($request->only(
            'id', 'dt_code', 'intervention_date',    'diagnostic', 'repaired_breakdowns', 'liquid',  'lubricant',
            'end_date', 'end_time', 'driver_id', 'observation', 'vehicule_id',
    ));
    return redirect ('/ParkManager/repairs');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroyRepairs($id)
    {
        $repair=Repair::find($id);
        $dt=Dt::find($repair->dt_code);
        $dt->state=$dt->previous_state;
        $dt->save();
    $vehicule=Vehicule::find($repair->vehicule_id);
    $vehicule->vehicle_state=    $vehicule->previous_state;
    $vehicule->save();
    $repair_staffs=Repair_Staff::all()->where('repair_id','=',$repair->id);
    foreach($repair_staffs as $repair_staff){
        $repair_staff->delete();
    }
    $liquid=Liquids:: where('type','=','Liquide')->first();
$lubrifiant=Liquids:: where('type','=','Lubrifiant')->first();
$liquid->quantity=$liquid->quantity+$repair->liquid;
$liquid->save();
$lubrifiant->quantity=$lubrifiant->quantity+$repair->lubricant;
$lubrifiant->save();
        $repair->delete();
        return redirect('/ParkManager/repairs');
    }
}
