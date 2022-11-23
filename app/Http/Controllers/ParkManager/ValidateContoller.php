<?php

namespace App\Http\Controllers\ParkManager;

use App\Dt;
use App\DtMaterial;
use App\Http\Controllers\Controller;
use App\Material;
use App\Models\User;
use App\MoreNotifs;
use App\Notifications\DtMNotification;
use App\Notifications\DtVNotification;
use App\Staff;
use App\Unit;
use App\Vehicule;
use Illuminate\Http\Request;

class ValidateContoller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createV(Request $request, $id)
    {
        $maintenance = Dt::find($id);
        $type = $maintenance->type;
        $valide = $request->valide;
        $staffs = Staff::all()->where('person_type', '=', 'Personnel du parc')->where('staff_state', '=', 'au travail');
        if ($maintenance->type == 'Véhicule') {
            $driver = Staff::find($maintenance->driver_id);
            $unit = Unit::find($maintenance->unit_id);
            $vehicule = Vehicule::find($maintenance->vehicle_id);
            $staff = Staff::find($maintenance->staff_id);
            return view('ParkManager.validation.viewV', compact(
                'maintenance',
                'unit',
                'vehicule',
                'driver',
                'staff',
                'type',
                'valide',
                'staffs'
            ));
        }
        if ($maintenance->type == 'Matériel Motorisés') {
            $unit = Unit::find($maintenance->unit_id);
            $material = Material::find($maintenance->vehicle_id);
            $staff = Staff::find($maintenance->staff_id);
            $emp = Staff::find($maintenance->emp_id);
            return view('ParkManager.validation.viewV', compact(
                'maintenance',
                'unit',
                'material',
                'staff',
                'staffs',
                'emp',
                'type',
                'valide'
            ));
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeV($id, Request $request)
    {
        $type = $request->type;
        $maintenance = Dt::find($id);
        $answer = $request->answer;
        $currentUser = User::find($maintenance->user_id);
        $notif = new MoreNotifs();

        if ($answer == 'Acceptée') {

            $maintenance->update($request->only(
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
                'answer'
            ));
            if ($maintenance->type == 'Véhicule') {

                $vehicule = Vehicule::find($maintenance->vehicle_id);
                if ($maintenance->action != 'A programmer mais opérationnel') {
                    $vehicule->previous_state = $vehicule->vehicle_state;
                    $vehicule->vehicle_state = 'en maintenance';
                    $vehicule->save();
                }
            }
            if ($maintenance->type == 'Matériel Motorisés') {
                $machine = Material::find($maintenance->vehicle_id);
                if ($maintenance->action != 'A programmer mais opérationnel') {
                    $machine->previous_state = $machine->material_state;
                    $machine->material_state = 'en maintenance';
                    $machine->save();
                }
            }

            if ($maintenance->action == 'En maintenance') {
                $maintenance->state = 'en cours';
                $maintenance->save();
                if ($maintenance->type == 'Véhicule') {
                    $vehicule = Vehicule::find($maintenance->vehicle_id);
                    $vehicule->previous_state = $vehicule->vehicle_state;
                    $vehicule->vehicle_state = 'en maintenance';
                    $vehicule->save();
                }
                if ($maintenance->type == 'Matériel Motorisés') {
                    $machine = Material::find($maintenance->vehicle_id);
                    $machine->previous_state = $machine->material_state;
                    $machine->material_state = 'en maintenance';
                    $machine->save();
                }
            }
         else {
            $maintenance->state = 'en instance';
            $maintenance->save();
        }
        if ($maintenance->type == 'Véhicule') {
            $notif->details = 'Vorte demande de travaux pour vehicule: ' . $maintenance->vehicle_id . ' est Accepter';
            $currentUser->notify(new DtVNotification($maintenance, $notif));
            $notif->save();
        }
        if ($maintenance->type == 'Matériel Motorisés') {
            $notif->details = 'Vorte demande de travaux pour machine: ' . $maintenance->vehicule_id . ' est Accepter';
            $currentUser->notify(new DtMNotification($maintenance, $notif));
            $notif->save();
        }
        $maintenance->save();
        return redirect()->route('ParkManager.dts.index')->with('success', 'vous avez accepté cette demande de travaux  ');
    }
        if ($answer == 'Refusée') {
            $maintenance->update($request->only(
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
                'answer'
            ));
            if ($maintenance->type == 'Véhicule') {
                $notif->details = 'Vorte demande de travaux pour vehicule: ' . $maintenance->vehicule_id . ' est Refuser';
                $currentUser->notify(new DtVNotification($maintenance, $notif));
                $notif->save();
            }
            if ($maintenance->type == 'Matériel Motorisés') {
                $notif->details = 'Vorte demande de travaux pour machine: ' . $maintenance->vehicule_id . ' est Refuser';
                $currentUser->notify(new DtMNotification($maintenance, $notif));
                $notif->save();
            }
            $maintenance->save();
            return redirect()->route('ParkManager.dts.index')->with('error', 'vous avez refusé cette demande de travaux pour ');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showV($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function editV($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateV(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $dt=DT::find($id);
        $dt->state='archived';
        $dt->save();
        return redirect()->route('ParkManager.dts.index')->with('error', 'vous avez Archivé cette demande de travaux  ');

    }
    public function choose1($id)
    {

        $dt = Dt::find($id);

        return view('ParkManager.validation.choice1', compact('dt'));
    }
    public function archive($id)
    {
        $dt=DT::find($id);
        $dt->state='archived';
        $dt->save();
        return redirect()->route('ParkManager.dts.index')->with('error', 'vous avez Archivé cette demande de travaux  ');

    }
}
