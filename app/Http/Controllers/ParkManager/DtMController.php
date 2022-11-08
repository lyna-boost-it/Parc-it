<?php

namespace App\Http\Controllers\ParkManager;


use App\Dt;
use App\DtMaterial;
use App\Http\Controllers\Controller;
use App\Material;
use App\Models\User;
use App\MoreNotifs;
use App\Notifications\DtMNotification;
use App\Staff;
use App\Unit;
use App\Vehicule;
use Carbon\Carbon;
use Illuminate\Http\Request;

use Illuminate\Support\Str;

class DtMController extends Controller
{public function __construct()
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

        $maintenances=DtMaterial::all();
        $units=Unit::all();
        $materials=Material::all();
        $staffs=Staff::all() ;
        $current_date=Carbon::now()->format('Y-m-d') ;
foreach($materials as $material){
foreach($maintenances as $maintenance)
{
    if($material->id==$maintenance->vehicule_id){


$a=date('Y-m-d', strtotime($current_date));
$b=date('Y-m-d', strtotime($maintenance->enter_date));

if($a==$b && $maintenance->state=='en attente'&& $material->vehicle_state!='en maintenance'){
$material->material_state='en maintenance';
$material->save();
$maintenance->state='en cours';
$maintenance->save();

}

}}}
        return view('ParkManager.dtsM.index', compact(
        'maintenances','units','materials','staffs'));


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $dt = new DtMaterial();
        $units=Unit::all();
        $materials=Material::all();
      $staffs=Staff::all()->where('staff_state','=','au travail');

        return view('ParkManager.dtsM.create', compact('dt',
        'units' ,'materials','staffs'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $dt=DtMaterial:: create($request->only(  'id','code_dt','enter_time','enter_date','type_panne','nature_panne','emp_id','unit_id'
        ,'staff_id','action' ,'observation','mm_id','type_maintenance','state','user_id'));
        $year = substr($dt->enter_date, 2, 2);
        $month = substr($dt->enter_date, 5, 2);
        if(Str::length($dt->id)==1){  $zero='000'; }
        if(Str::length($dt->id)==2){ $zero='00'; }
        if(Str::length($dt->id)==3){ $zero='0'; }
        $code='DT'.$zero.$dt->id.$month.$year;
        $dt->code_dt=$code;
        $dt->save();

                        $material=Material::find($dt->mm_id);
                        if($dt->action!='A programmer mais opérationnel'){
                            $material->previous_state=$material->material_state;
                            $material->material_state='en maintenance';
                            $material->save();
                        }

                   $current_date=Carbon::now()->format('Y-m-d') ;
                   $a=date('Y-m-d', strtotime($current_date));
                   $b=date('Y-m-d', strtotime($dt->enter_date));
                   if($a==$b ){

                       $dt->state='en cours';
                       $dt->save();
                       $material->previous_state=$material->material_state;
                       $material->material_state='en maintenance';
                       $material->save();
                       }


                       $usersA = User::all()->where('type', '=', 'Gestionnaire parc');

                       $notif = new MoreNotifs();
                       $notif->details = 'une demandes de travaux pour machine: ' . $dt->mm_id . ' est créé';
                       $notif->save();
                       foreach ($usersA as $user) {
                           $user->notify(new DtMNotification($dt, $notif));
                       }

        return redirect()->route ('ParkManager.dtsM.index')->with('success',"vous avez ajouté une demandes de travaux avec succès");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $maintenance=DtMaterial::find($id);
        $unit=Unit::find($maintenance->unit_id);
        $material=Material::find($maintenance->mm_id);
        $staff=Staff::find($maintenance->staff_id);
         $emp=Staff::find($maintenance->emp_id);
        return view('ParkManager.dtsM.view', compact('maintenance'
        ,'unit','material','staff','emp'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $dt = DtMaterial::find($id);

        return view('ParkManager.dtsM.edit', compact('dt'));

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

        $dt = DtMaterial::find($id);
        $dt->update($request->only('id','code_dt','enter_time','enter_date','type_panne','nature_panne','emp_id','unit_id'
        ,'staff_id','action' ,'observation','mm_id','type_maintenance','state'
        ));     return redirect()->route ('ParkManager.dtsM.index')->with('success',"vous avez modifié une demandes de travaux avec succès");

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $maintenance=DtMaterial::find($id);
        $material=Material::find($maintenance->mm_id);
        $material->material_state=$material->previous_state;
        $material->save();
        $maintenance->delete();
        return redirect()->route ('ParkManager.dtsM.index')->with('success',"vous avez supprimé une demandes de travaux avec succès");
    }
}
