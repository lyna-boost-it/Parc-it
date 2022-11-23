<?php

namespace App\Http\Controllers\ParkManager;

use App\ConsumedPieces;
use App\Designation;
use App\Dt;
use App\DtMaterial;
use App\Http\Controllers\Controller;
use App\Marque;
use App\Material;
use App\Models\User;
use App\MoreNotifs;
use App\Notifications\RepairMNotification;
use App\RepairM_pieces;
use App\RepairsMaterial;
use App\RepairsMaterial_Staff;
use App\Staff;

use Illuminate\Http\Request;
class RepairMController extends Controller
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
        $dts=DtMaterial::all()->where('type_maintenance','=','Réparation')->where('answer','=','Acceptée');
        $repairs=RepairsMaterial::all();
        $materials=Material::all();
         return view('ParkManager.repairsM.index')
        ->with('repairs',$repairs)->with('materials',$materials)
        -> with('dts',$dts);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createRepairs($id)
    {    $designations=Designation::all();
        $marques=Marque::all();
        $dt=Dt::find($id);
        $material=Material::find($dt->vehicle_id );
        $repair = new RepairsMaterial();
        $staffs=Staff::all()->where('person_type','=','Personnel du centre de maintenance')->where('function','=','Mécanicien spécialisé (matériel motorisé)')->where('staff_state','=','au travail');
        $pieces = ConsumedPieces::all()->where('type', '=', 'Machine');

          return view('ParkManager.repairsM.create',
          compact('repair','dt' , 'staffs', 'material','pieces','designations' ,'marques'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeRepairs(Request $request)
    {

        $repair=RepairsMaterial:: create($request->only('id', 'dt_code', 'intervention_date', 'repaired_breakdowns', 'end_date','end_time',  'observation', 'mm_id' ));
    $staffs=$request['staff'];

    foreach($staffs as $s){
        $staff=Staff::find($s);
        $staff_repair=new RepairsMaterial_Staff();
        $staff_repair->staff_id=$staff->id;
        $staff_repair->repairmaterial_id=$repair->id;
        $staff_repair->save();
    }

    $dt=Dt::find($repair->dt_code);
    $dt->previous_state=$dt->state;
    $dt->state='fait';

    $dt->save();
$material=Material::find($repair->mm_id);
$material->previous_state=$material->material_state;
$material->material_state='Libre';
$usersA = User::all()->where('type', '=', 'Gestionnaire parc');
$usersB = User::all()->where('type', '=', 'Utilisateur');

$currentUser=User::find($dt->user_id);
$notif = new MoreNotifs();
$notif->details = 'la reparation de machine: ' . $repair->mm_id . ' est fait';
$notif->save();
foreach ($usersA as $user) {
    $user->notify(new RepairMNotification($repair, $notif));
}
foreach ($usersB as $user) {
    $user->notify(new RepairMNotification($repair, $notif));
}
$currentUser->notify(new RepairMNotification($repair, $notif));
$material->save();


$prices = $request->input('prices', []);
$quantities = $request->input('quantities', []);
$references = $request->input('references', []);
$designations = $request->input('designations', []);
$receips = $request->input('receip', []);
$codes = $request->input('codes', []);
$marques = $request->input('marques', []);
$types = $request->input('types', []);

for ($designation = 0; $designation < count($designations); $designation++) {
    if ($designations[$designation] != '') {
        $dt_piece = new RepairM_pieces();
        $dt_piece->repair_id = $repair->id;
        $dt_piece->reference = $references[$designation];
        $dt_piece->designation = $designations[$designation];
        $dt_piece->price = $prices[$designation];
        $dt_piece->quantity = $quantities[$designation];
        $dt_piece->receip = $receips[$designation];
        $dt_piece->code = $codes[$designation];
$dt_piece->marque = $marques[$designation];
$dt_piece->type = $types[$designation];

        $dt_piece->full_price = $dt_piece->price * $dt_piece->quantity;
        $dt_piece->save();
    }
}


if($request->action=='more'){
    if ($dt->state=='en attente'){
        $dt->state = '1';
        $dt->save();
    }else{
        $dt->state = $dt->state.'1';
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
    public function showRepairs($id)
    {  $designations=Designation::all();
        $repair =RepairsMaterial::find($id);
        $dt=Dt::find($repair->dt_code);

        $material=Material::find($dt->vehicle_id);
        $staffs=Staff::all() ;
        $rps=RepairM_pieces::all()->where('repair_id', '=', $repair->id);

        $repair_staffs=RepairsMaterial_Staff::all()->where('repairmaterial_id','=',$repair->id);
        return view('ParkManager.repairsM.view',
        compact('repair','dt', 'repair_staffs', 'material','staffs','rps','designations' ));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function editRepairs($id)
    {

        $repair =RepairsMaterial::find($id);
        $dt=Dt::find($repair->dt_code);
        $material=Material::find($repair->mm_id);

        return view('ParkManager.repairsM.edit',
          compact('repair','dt',  'material'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateRepairs(Request $request, $id)
    {
        $repair =RepairsMaterial::find($id);
        $repair->update($request->only('id', 'dt_code', 'intervention_date', 'repaired_breakdowns', 'end_date','end_time',  'observation', 'mm_id'));
    return redirect ('/ParkManager/repairs')->with('success',"vous avez modifié une reparation avec succès");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroyRepairs($id)
    {
        $repair=RepairsMaterial::find($id);
        $dt=DtMaterial::find($repair->dt_code);
        $dt->state=$dt->previous_state;
        $dt->save();
    $material=Material::find($repair->mm_id);
    $material->material_state=$material->previous_state;
    $material->save();
    $repair_pieces = RepairM_pieces::all()->where('repair_id', '=', $repair->id);
    foreach($repair_pieces as $repair_piece){

        $repair_piece->delete();
    }
    $repair_staffs=RepairsMaterial_Staff::all()->where('repairmaterial_id','=',$repair->id);
    foreach($repair_staffs as $repair_staff){
        $repair_staff->delete();
    }

        $repair->delete();
        return redirect('/ParkManager/repairs')
        ->with('success',"vous avez supprimé une reparation avec succès");
    }}

