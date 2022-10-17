<?php

namespace App\Http\Controllers\ParkManager;

use App\Dt;
use App\DtMaterial;
use App\Http\Controllers\Controller;
use App\Material;
use App\Models\User;
use App\MoreNotifs;
use App\Notifications\RepairMNotification;
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
        $dts=DtMaterial::all()->where('type_maintenance','=','Reparation');
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
    {
        $dt=DtMaterial::find($id);
        $material=Material::find($dt->mm_id);
        $repair = new RepairsMaterial();
        $staffs=Staff::all()->where('person_type','=','Personnel du centre de maintenance')->where('function','=','Mécanicien spécialisé (matériel motorisé)');


          return view('ParkManager.repairsM.create',
          compact('repair','dt' , 'staffs', 'material' ));

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

    $dt=DtMaterial::find($repair->dt_code);
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
    return redirect ('/ParkManager/repairsM')->with('success',"vous avez ajouter une reparation avec succès");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showRepairs($id)
    {
        $repair =RepairsMaterial::find($id);
        $dt=DtMaterial::find($repair->dt_code);
        $material=Material::find($repair->mm_id);
        $staffs=Staff::all() ;
        $repair_staffs=RepairsMaterial_Staff::all()->where('repairmaterial_id','=',$repair->id);
        return view('ParkManager.repairsM.view',
        compact('repair','dt', 'repair_staffs', 'material','staffs'));
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
        $dt=DtMaterial::find($repair->dt_code);
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
    return redirect ('/ParkManager/repairsM')->with('success',"vous avez modifier une reparation avec succès");
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
    $repair_staffs=RepairsMaterial_Staff::all()->where('repairmaterial_id','=',$repair->id);
    foreach($repair_staffs as $repair_staff){
        $repair_staff->delete();
    }

        $repair->delete();
        return redirect('/ParkManager/repairsM')
        ->with('success',"vous avez supprimer une reparation avec succès");
    }}

