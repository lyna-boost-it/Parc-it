<?php

namespace App\Http\Controllers\ParkManager;

use App\ConsumedPieces;
use App\Dt;
use App\DT_Piece;
use App\Http\Controllers\Controller;
use App\Liquids;
use App\Models\User;
use App\MoreNotifs;
use App\Notifications\RepairVNotification;
use App\Repair;
use App\Repair_Staff;
use App\Staff;
use App\Vehicule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
    {   $dts=Dt::all()->where('type_maintenance','=','Réparation')->where('answer','=','Accepter');
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
    {$repair=new Repair();
        $dt=Dt::find($id);
        $vehicule=Vehicule::find($dt->vehicule_id);
        $pieces=ConsumedPieces::all()->where('type','=','Véhicule');
        $lubrifiant=Liquids:: where('type','=','Lubrifiant')->first();
$liquid=Liquids:: where('type','=','Liquide')->first();
       $staffs=Staff::all()->where('person_type','=','Personnel du centre de maintenance')->where('function','!=','Mécanicien spécialisé (matériel motorisé)');

        $drivers=Staff::all()->where('person_type','=','Conducteur');
          return view('ParkManager.repairs.create',
          compact('repair','dt'
          , 'drivers', 'staffs', 'vehicule','lubrifiant','liquid','pieces'));
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


    $products = $request->input('pieces', []);
    $quantities = $request->input('quantities', []);
    for ($product=0; $product < count($products); $product++) {
        if ($products[$product] != '') {
            $dt_piece=new DT_Piece();
            $dt_piece->piece_id=$products[$product];
            $dt_piece->quantity=$quantities[$product];
            $dt_piece->dt_id=$request->dt_code;
            $dt_piece->save();
        }
    }


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

$usersA = User::all()->where('type', '=', 'Gestionnaire parc');
$usersB = User::all()->where('type', '=', 'Utilisateur');

$currentUser=User::find($dt->user_id);
$notif = new MoreNotifs();
$notif->details = 'la reparation de vehcule: ' . $repair->vehicle_id . ' est fait';
$notif->save();
foreach ($usersA as $user) {
    $user->notify(new RepairVNotification($repair, $notif));
}
foreach ($usersB as $user) {
    $user->notify(new RepairVNotification($repair, $notif));
}
$currentUser->notify(new RepairVNotification($repair, $notif));
    return redirect ('/ParkManager/repairs')->with('success',"vous avez ajouter une Reparation avec succès");
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
    return redirect ('/ParkManager/repairs')->with('success',"vous avez modifier une Reparation avec succès");
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
        return redirect('/ParkManager/repairs')->with('success',"vous avez supprimer une Reparation avec succès");
    }
}
