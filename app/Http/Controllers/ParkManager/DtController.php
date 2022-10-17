<?php

namespace App\Http\Controllers\ParkManager;


use App\Dt;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\MoreNotifs;
use App\Notifications\DtVNotification;
use App\Staff;
use App\Unit;
use App\Vehicule;
use Carbon\Carbon;
use Illuminate\Http\Request;

use Illuminate\Support\Str;

class DtController extends Controller
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

        $maintenances=Dt::all();
        $drivers=Staff::all()->where('person_type','=','Conducteur');
        $units=Unit::all();
        $vehicules=Vehicule::all();
        $staffs=Staff::all()->where('person_type','=','Personnel du parc');
        $current_date=Carbon::now()->format('Y-m-d') ;
foreach($vehicules as $vehicule){
foreach($maintenances as $maintenance)
{
    if($vehicule->id==$maintenance->vehicule_id){


$a=date('Y-m-d', strtotime($current_date));
$b=date('Y-m-d', strtotime($maintenance->enter_date));

if($a==$b && $maintenance->state=='en attente'&& $vehicule->vehicle_state!='en maintenance'){
$vehicule->vehicle_state='en maintenance';
$vehicule->save();
$maintenance->state='en cours';
$maintenance->save();

}

}}}
        return view('ParkManager.dts.index', compact(  'current_date','maintenances','units','vehicules','drivers','staffs'));


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $dt = new Dt();
        $units=Unit::all();
        $minibuses=Vehicule::all()->where('vehicle_type','=','minibus');
        $fourgonnettes=Vehicule::all()->where('vehicle_type','=','mini-fourgonnettes');
        $pickups=Vehicule::all()->where('vehicle_type','=','pick-up');
        $drivers=Staff::all()->where('person_type','=','Conducteur')->where('staff_state','=','au travail');
        $staffs=Staff::all()->where('person_type','=','Personnel du parc')->where('staff_state','=','au travail');
        $vehicule1=' ';
        $vehicule2=' ';
        $vehicule3=' ';
        return view('ParkManager.dts.create', compact('dt',
        'units' ,'drivers','minibuses','fourgonnettes','pickups',
        'vehicule1','vehicule2','vehicule3','staffs'));

        }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $dt=Dt:: create($request->only('unit_id','staff_id' ,'perso_id',1,
        'action','observation','type_maintenance','type_panne','nature_panne','user_id',
        'enter_time', 'enter_date','driver_id','code_dt' ));
        $year = substr($dt->enter_date, 2, 2);
        $month = substr($dt->enter_date, 5, 2);
        if(Str::length($dt->id)==1){  $zero='000'; }
        if(Str::length($dt->id)==2){ $zero='00'; }
        if(Str::length($dt->id)==3){ $zero='0'; }
        $code='DT'.$zero.$dt->id.$month.$year;
        $dt->code_dt=$code;
        $dt->save();
        if( $request->vehicule1 !=null){
            $dt->vehicule_id= $request->vehicule1;
            $dt->save();}elseif
                    ( $request->vehicule2 !=null ){
                        $dt->vehicule_id= $request->vehicule2;
                        $dt->save();
                    }else{
                        $dt->vehicule_id= $request->vehicule3;
                        $dt->save();  }
                        $vehicule=Vehicule::find($dt->vehicule_id);
                        if($dt->action!='A programmer mais opérationnel'){
                            $vehicule->previous_state=$vehicule->vehicle_state;
                            $vehicule->vehicle_state='en maintenance';
                            $vehicule->save();
                        }

                   $current_date=Carbon::now()->format('Y-m-d') ;
                   $a=date('Y-m-d', strtotime($current_date));
                   $b=date('Y-m-d', strtotime($dt->enter_date));
                   if($a==$b ){

                       $dt->state='en cours';
                       $dt->save();
                       $vehicule=Vehicule::find($dt->vehicule_id);
                       $vehicule->previous_state=$vehicule->vehicle_state;
                       $vehicule->vehicle_state='en maintenance';
                       $vehicule->save();
                       }

                       $usersA = User::all()->where('type', '=', 'Gestionnaire parc');

                       $notif = new MoreNotifs();
                       $notif->details = 'une demandes de travaux pour vehicule: ' . $dt->vehicule_id . ' est créé';
                       $notif->save();
                       foreach ($usersA as $user) {
                           $user->notify(new DtVNotification($dt, $notif));
                       }

        return redirect()->route ('ParkManager.dts.index')->with('success',"vous avez ajouter une demandes de travaux avec succès");

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $maintenance=Dt::find($id);
        $driver=Staff::find($maintenance->driver_id);
        $unit=Unit::find($maintenance->unit_id);
        $vehicule=Vehicule::find($maintenance->vehicule_id);
        $staff=Staff::find($maintenance->staff_id);
        return view('ParkManager.dts.view', compact('maintenance','unit','vehicule','driver','staff'));


    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $dt = Dt::find($id);

        return view('ParkManager.dts.edit', compact('dt'));

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


        $dt = Dt::find($id);
        $dt->update($request->only('unit_id','staff_id' ,'perso_id','vehicule_id',
        'action','observation','type_maintenance','type_panne','nature_panne',
       'driver_id','code_dt','enter_time', 'enter_date',
        ));     return redirect()->route ('ParkManager.dts.index')->with('success',"vous avez modifier une demandes de travaux avec succès");

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $maintenance=Dt::find($id);
        $vehicule=Vehicule::find($maintenance->vehicule_id);
        $vehicule->vehicle_state=$vehicule->previous_state;
        $vehicule->save();
        $maintenance->delete();
        return redirect()->route ('ParkManager.dts.index')
        ->with('success',"vous avez supprimer une demandes de travaux avec succès");

    }
}
