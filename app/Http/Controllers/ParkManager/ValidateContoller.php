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
        $type = $request->type;
         $valide = $request->valide;
         $staffs=Staff::all()->where('person_type','=','Personnel du parc')->where('staff_state','=','au travail');

        if($type=='Vehicule'){     $maintenance = Dt::find($id);
            $driver = Staff::find($maintenance->driver_id);
            $unit = Unit::find($maintenance->unit_id);
            $vehicule = Vehicule::find($maintenance->vehicle_id);
            $staff = Staff::find($maintenance->staff_id);
            return view('ParkManager.validation.viewV', compact('maintenance', 'unit', 'vehicule', 'driver', 'staff','type','valide','staffs'));
    }



        if ($type == 'Machine') {
            $maintenance=DtMaterial::find($id);
            $unit=Unit::find($maintenance->unit_id);
            $material=Material::find($maintenance->mm_id);
            $staff=Staff::find($maintenance->staff_id);
             $emp=Staff::find($maintenance->emp_id);
            return view('ParkManager.validation.viewV', compact('maintenance'
            ,'unit','material','staff','emp','type'));
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
        $type=$request->type;
        if($request->type=='Vehicule'){

        $maintenance = Dt::find($id);
        $answer = $request->answer;
        $currentUser = User::find($maintenance->user_id);
        $notif = new MoreNotifs();

        if ($answer == 'Acceptée') {

            $maintenance->update($request->only('unit_id','staff_id' ,'perso_id','vehicle_id',
        'action','observation','type_maintenance','type_panne','nature_panne',
       'driver_id','code_dt','enter_time', 'enter_date','answer'
        ));
            $notif->details = 'Vorte demande de travaux pour vehicule: ' . $maintenance->vehicle_id . ' est Accepter';
            $currentUser->notify(new DtVNotification($maintenance, $notif));
            $notif->save();
            $maintenance->save();
            return redirect()->route ('ParkManager.dts.index')->with('success', 'vous avez accepté cette demande de travaux pour vehicule avec succès');


        }
        if ($answer == 'Refusée') {
            $maintenance->update($request->only('unit_id','staff_id' ,'perso_id','vehicle_id',
        'action','observation','type_maintenance','type_panne','nature_panne',
       'driver_id','code_dt','enter_time', 'enter_date','answer'
        ));
            $notif->details = 'Vorte demande de travaux pour vehicule: ' . $maintenance->vehicule_id . ' est Refuser';
            $currentUser->notify(new DtVNotification($maintenance, $notif));
            $notif->save();
            $maintenance->save();
        return redirect()->route ('ParkManager.dts.index')->with('error', 'vous avez refusé cette demande de travaux pour vehicule avec succès');
        }}
        if($request->type=='Machine'){
            $maintenance = DtMaterial::find($id);
            $answer = $request->answer;
            $currentUser = User::find($maintenance->user_id);
            $notif = new MoreNotifs();

            if ($answer == 'accept') {
                $maintenance->answer = 'Accepter';
                $notif->details = 'Vorte demande de travaux pour machine: ' . $maintenance->vehicule_id . ' est Accepter';
                $currentUser->notify(new DtMNotification($maintenance, $notif));
                $notif->save();
                $maintenance->save();
                return redirect()->route ('ParkManager.dtsM.index')->with('success', 'vous avez accepté cette demande de travaux pour machine avec succès');


            }
            if ($answer == 'refuse') {
                $maintenance->answer = 'Refuser';
                $notif->details = 'Vorte demande de travaux pour machine: ' . $maintenance->vehicule_id . ' est Refuser';
                $currentUser->notify(new DtMNotification($maintenance, $notif));
                $notif->save();
                $maintenance->save();
            return redirect()->route ('ParkManager.dtsM.index')->with('error', 'vous avez refusé cette demande de travaux pour machine avec succès');
            }
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
        //
    }
    public function choose1($id)
    {

        $dt=Dt::find($id);

        return view('ParkManager.validation.choice1', compact('dt' ));
    }
}
