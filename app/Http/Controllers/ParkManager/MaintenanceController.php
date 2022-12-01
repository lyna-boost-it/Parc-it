<?php

namespace App\Http\Controllers\ParkManager;

use App\Dt;
use App\Http\Controllers\Controller;
use App\Maintenance;
use App\Maintenance_Staff;
use App\Models\User;
use App\MoreNotifs;
use App\Notifications\MaintenaceNotification;
use App\Staff;
use App\Vehicule;
use Illuminate\Http\Request;
class MaintenanceController extends Controller
{ public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexMaintenance()
    {
        $dts=Dt::all()->where('type_maintenance','=','Entretien')->where('answer','=','Acceptée');

        $maintenances=Maintenance::all();
        $vehicules=Vehicule::all();
        $drivers=Staff::all()->where('person_type','=','Conducteur');

        return view('ParkManager.maintenances.index')
        ->with('maintenances',$maintenances)->with('vehicules',$vehicules)->with('drivers',$drivers)->with('dts',$dts);


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createMaintenance($id)
    {   $dt=Dt::find($id);
        $vehicule=Vehicule::find($dt->vehicle_id);
        $maintenance = new Maintenance();
        $staffs=Staff::all()->where('person_type','=','Personnel du centre de maintenance')->where('function','!=','Mécanicien spécialisé (matériel motorisé)');
        $drivers=Staff::all()->where('person_type','=','Conducteur');
          return view('ParkManager.maintenances.create',
          compact('maintenance','dt'
          , 'drivers', 'staffs', 'vehicule' ));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeMaintenance(Request $request)
    {
        $maintenance=Maintenance:: create($request->only(
            'id', 'dt_code','designation','vehicule_id','km', 'driver_id'
        ));
$staffs=$request['staff'];

    foreach($staffs as $s){
        $staff=Staff::find($s);
$maintenance_staff=new Maintenance_Staff();
$maintenance_staff->staff_id=$staff->id;
$maintenance_staff->maintenance_id=$maintenance->id;
$maintenance_staff->save();
    }
    $dt=Dt::find($maintenance->dt_code);
    $dt->previous_state=$dt->state;

$vehicule=Vehicule::find($maintenance->vehicule_id);
$vehicule->previous_state=$vehicule->vehicle_state;
$vehicule->vehicle_state='Libre';
$vehicule->save();
$usersA = User::all()->where('type', '=', 'Gestionnaire parc');
$usersB = User::all()->where('type', '=', 'Utilisateur');

$currentUser=User::find($dt->user_id);
$notif = new MoreNotifs();
$notif->details = 'l\'entretien de vehcule: ' . $maintenance->vehicule_id . ' est fait';
$notif->save();
foreach ($usersA as $user) {
    $user->notify(new MaintenaceNotification($maintenance, $notif));
}
foreach ($usersB as $user) {
    $user->notify(new MaintenaceNotification($maintenance, $notif));
}
$currentUser->notify(new MaintenaceNotification($maintenance, $notif));





if($request->action=='more'){
    if ($dt->state=='en attente'  || $dt->state == 'en cours' ){
        $dt->state = '2';
        $dt->save();
    }else{
        $dt->state = $dt->state.'2';
        $dt->save();
    }
    return view('ParkManager.validation.choice1', compact('dt' ));

     }



else{     $dt->previous_state = $dt->state;
    $dt->state = 'fait';
    $dt->save();

    return redirect ('/ParkManager/dts')->with('success',"vous avez ajouté un Entretien avec succès");

}








    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showMaintenance($id)
    {
        $maintenance =Maintenance::find($id);
        $dt=Dt::find($maintenance->dt_code);
        $vehicule=Vehicule::find($maintenance->vehicule_id);
        $staffs=Staff::all()->where('person_type','=','Personnel du parc');
        $driver=Staff::find($maintenance->driver_id);
        $maintenance_staffs=Maintenance_Staff::all()->where('maintenance_id','=',$maintenance->id);
        return view('ParkManager.maintenances.view',
        compact('maintenance','dt'
        , 'driver', 'maintenance_staffs', 'vehicule','staffs'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function editMaintenance($id)
    {
        $maintenance =Maintenance::find($id);
        $dt=Dt::find($maintenance->dt_code);
        $vehicule=Vehicule::find($maintenance->vehicule_id);
        $staffs=Staff::all()->where('person_type','=','Personnel du parc');
        $drivers=Staff::all()->where('person_type','=','Conducteur');
          return view('ParkManager.maintenances.edit',
          compact('maintenance','dt'
          , 'drivers', 'staffs', 'vehicule'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateMaintenance(Request $request, $id)
    {$maintenance =Maintenance::find($id);
        $maintenance->update($request->only(
            'id', 'dt_code','designation','vehicle_id','km' ,'driver_id'
        ));
    return redirect ('/ParkManager/maintenances')->with('success',"vous avez modifié un Entretien avec succès");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroyMaintenance($id)
    {
        $maintenance=Maintenance::find($id);
        $dt=Dt::find($maintenance->dt_code);
        $dt->state=$dt->previous_state;
        $dt->save();
    $vehicule=Vehicule::find($maintenance->vehicule_id);
    $vehicule->vehicle_state=    $vehicule->previous_state;
    $vehicule->save();

    $maintenance_staffs=Maintenance_Staff::all()->where('maintenance_id','=',$maintenance->id);
    foreach($maintenance_staffs as $maintenance_staff){
        $maintenance_staff->delete();
    }
        $maintenance->delete();
        return redirect('/ParkManager/maintenances')->with('success',"vous avez supprimé un Entretien avec succès");
    }
}
