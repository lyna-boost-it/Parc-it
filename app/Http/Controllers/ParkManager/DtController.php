<?php

namespace App\Http\Controllers\ParkManager;


use App\Dt;
use App\External;
use App\ExternalMaterial;
use App\Garanti;
use App\Http\Controllers\Controller;
use App\Maintenance;
use App\Maintenance_Staff;
use App\Marque;
use App\Material;
use App\Models\Designation;
use App\Models\User;
use App\MoreNotifs;
use App\Notifications\DtMNotification;
use App\Notifications\DtVNotification;
use App\Repair;
use App\Repair_pieces;
use App\Repair_Staff;
use App\RepairM_pieces;
use App\RepairsMaterial;
use App\RepairsMaterial_Staff;
use App\Staff;
use App\Unit;
use App\Vehicule;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class DtController extends Controller
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
        $maintenances =null;
        $user=User::find(Auth::user()->id);
if($user->type=='Demandeur'){
    $maintenances = Dt::all()->where('user_id', '==', $user->id)->where('state', '!=', 'fait')->where('state','!=','archived');
    $maintenances_done = Dt::all()->where('state', '=', 'fait')->where('user_id', '==', $user->id);
}else{
    $maintenances = Dt::all()->where('state', '!=', 'fait')->where('state','!=','archived');
    $maintenances_done = Dt::all()->where('state', '=', 'fait');
}


        $drivers = Staff::all()->where('person_type', '=', 'Conducteur');
        $units = Unit::all();
        $vehicules = Vehicule::all();
        $materials=Material::all();
        $staffs = Staff::all()->where('person_type', '=', 'Personnel du parc');
        $current_date = Carbon::now()->format('Y-m-d');
        foreach ($vehicules as $vehicule) {
            foreach ($maintenances as $maintenance) {
                if ($vehicule->id == $maintenance->vehicle_id) {


                    $a = date('Y-m-d', strtotime($current_date));
                    $b = date('Y-m-d', strtotime($maintenance->enter_date));

                    if ($a == $b && $maintenance->state == 'en attente' && $vehicule->vehicle_state != 'en maintenance') {
                        $vehicule->vehicle_state = 'en maintenance';
                        $vehicule->save();
                        $maintenance->state = 'en cours';
                        $maintenance->save();
                    }
                }
            }
        }
        return view('ParkManager.dts.index', compact('materials','current_date', 'maintenances', 'units', 'vehicules', 'drivers', 'staffs', 'maintenances_done'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $dt = new Dt();
        $units = Unit::all();
        $vehicules = Vehicule::all();
        $materials = Material::all();
        $drivers = Staff::all()->where('person_type', '=', 'Conducteur')->where('staff_state', '=', 'au travail');
        $staffs = Staff::all()->where('person_type', '=', 'Personnel du parc')->where('staff_state', '=', 'au travail');

        return view('ParkManager.dts.create', compact(
            'dt',
            'units',
            'drivers',
            'vehicules',
            'staffs',
            'materials'
        ));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {


        if ($request->type == 'V??hicule') {
            $dt = Dt::create($request->only(
                'unit_id',
                'staff_id',
                'perso_id',
                1,
                'action',
                'observation',
                'type_maintenance',
                'type_panne',
                'nature_panne',
                'user_id',
                'enter_time',
                'enter_date',
                'driver_id',
                'code_dt',
                'vehicle_id',
                'type'
            ));
            $year = substr($dt->enter_date, 2, 2);
            $month = substr($dt->enter_date, 5, 2);
            if (Str::length($dt->id) == 1) {
                $zero = '000';
            }
            if (Str::length($dt->id) == 2) {
                $zero = '00';
            }
            if (Str::length($dt->id) == 3) {
                $zero = '0';
            }
            $code = 'DT' . $zero . $dt->id . $month . $year;
            $dt->code_dt = $code;
            $dt->save();

            $usersA = User::all()->where('type', '=', 'Gestionnaire parc');

            $notif = new MoreNotifs();
            $notif->details = 'une demandes de travaux pour vehicule: ' . $dt->vehicle_id . ' est cr????';
            $notif->save();
            foreach ($usersA as $user) {
                $user->notify(new DtVNotification($dt, $notif));
            }
        }
        if ($request->type == 'Mat??riel Motoris??s') {

            $dt = Dt::create($request->only(
                'unit_id',
                'staff_id',
                'perso_id',
                1,
                'action',
                'observation',
                'type_maintenance',
                'type_panne',
                'nature_panne',
                'user_id',
                'enter_time',
                'enter_date',
                'driver_id',
                'code_dt',
                'vehicle_id',
                'type'
            ));
            $dt->vehicle_id=$request->mm_id;
            $dt->save();
            $year = substr($dt->enter_date, 2, 2);
            $month = substr($dt->enter_date, 5, 2);
            if (Str::length($dt->id) == 1) {
                $zero = '000';
            }
            if (Str::length($dt->id) == 2) {
                $zero = '00';
            }
            if (Str::length($dt->id) == 3) {
                $zero = '0';
            }
            $code = 'DT' . $zero . $dt->id . $month . $year;
            $dt->code_dt = $code;
            $dt->save();

            $usersA = User::all()->where('type', '=', 'Gestionnaire parc');

            $notif = new MoreNotifs();
            $notif->details = 'une demandes de travaux pour machine: ' . $dt->vehicle_id . ' est cr????';
            $notif->save();
            foreach ($usersA as $user) {
                $user->notify(new DtMNotification($dt, $notif));
            }
        }


        return redirect()->route('ParkManager.dts.index')->with('success', "vous avez ajout?? une demandes de r??paration avec succ??s");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $maintenance = Dt::find($id);
        $driver = Staff::find($maintenance->driver_id);
        $unit = Unit::find($maintenance->unit_id);
        if($maintenance->type=='V??hicule'){ $vehicule = Vehicule::find($maintenance->vehicle_id);}
if($maintenance->type=='Mat??riel Motoris??s'){ $vehicule = Material::find($maintenance->vehicle_id);}

        $repair = null;
        $external = null;
        $repairM = null;
        $externalM = null;
        $dt = null;
        $repair_staffs = null;
        $repair_material_staffs=null;
        $rps = null;
        $rpsM = null;
        $guaranti = null;
        $guarantiM = null;

        $maintenance_staffs = null;
        $external = External::where('dt_code', '=', $id)->first();
          $externalM = ExternalMaterial::where('dt_code', '=', $id)->first();
        $dt = Maintenance::where('dt_code', '=', $id)->first();
        $repair = Repair::where('dt_code', '=', $id)->first();
         $repairM = RepairsMaterial::where('dt_code', '=', $id)->first();
        if ($repair != null) {
            $repair_staffs = Repair_Staff::all()->where('repair_id', '=', $repair->id);
            $rps = Repair_pieces::all()->where('repair_id', '=', $repair->id);
        }
        if ($repairM != null) {
            $repair_material_staffs = RepairsMaterial_Staff::all()->where('repair_id', '=', $repairM->id);
            $rpsM = RepairM_pieces::all()->where('repair_id', '=', $repairM->id);
        }
        if ($dt != null) {

            $maintenance_staffs = Maintenance_Staff::all()->where('maintenance_id', '=', $dt->id);
        }
        if ($external != null) {
            $guaranti = Garanti::find($external->supplier_id);
        }
        if ($externalM != null) {
            $guarantiM = Garanti::find($externalM->supplier_id);
        }
        $staff = Staff::find($maintenance->staff_id);
        $staffs = Staff::all()->where('person_type', '=', 'Personnel du parc');

        $designations = Designation::all();
        $marks = Marque::all();
        return view('ParkManager.dts.view', compact('guarantiM','guaranti', 'maintenance_staffs',
         'marks', 'designations', 'rps',  'rpsM', 'staffs', 'maintenance', 'unit', 'vehicule',
         'driver', 'staff', 'externalM', 'external', 'dt', 'repairM','repair_material_staffs', 'repair', 'repair_staffs'));
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
        $dt->update($request->only(
            'unit_id',
            'staff_id',
            'perso_id',
            'vehicle_id',
            'action',
            'observation',
            'type_maintenance',
            'type_panne',
            'nature_panne',
            'driver_id',
            'code_dt',
            'enter_time',
            'enter_date',
            'type'
        ));
        return redirect()->route('ParkManager.dts.index')->with('success', "vous avez modifi?? une demandes de r??paration avec succ??s");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $maintenance = Dt::find($id);
        $vehicule = Vehicule::find($maintenance->vehicle_id);
        $vehicule->vehicle_state = $vehicule->previous_state;
        $vehicule->save();
        $maintenance->delete();
        return redirect()->route('ParkManager.dts.index')
            ->with('success', "vous avez supprim?? une demandes de r??paration avec succ??s");
    }





    public function archived()
    {

        $maintenances = Dt::all()->where('state','=','archived');

        $drivers = Staff::all()->where('person_type', '=', 'Conducteur');
        $units = Unit::all();
        $vehicules = Vehicule::all();
        $materials=Material::all();
        $staffs = Staff::all()->where('person_type', '=', 'Personnel du parc');
        $current_date = Carbon::now()->format('Y-m-d');
        foreach ($vehicules as $vehicule) {
            foreach ($maintenances as $maintenance) {
                if ($vehicule->id == $maintenance->vehicle_id) {


                    $a = date('Y-m-d', strtotime($current_date));
                    $b = date('Y-m-d', strtotime($maintenance->enter_date));

                    if ($a == $b && $maintenance->state == 'en attente' && $vehicule->vehicle_state != 'en maintenance') {
                        $vehicule->vehicle_state = 'en maintenance';
                        $vehicule->save();
                        $maintenance->state = 'en cours';
                        $maintenance->save();
                    }
                }
            }
        }
        return view('ParkManager.dts.index', compact('materials','current_date',
         'maintenances', 'units', 'vehicules', 'drivers', 'staffs'));
    }
}
